(function ($) {
	'use strict';

	const pluginName = 'liquidSplitText';
	let defaults = {
		type: "words",
		forceApply: false
	};
	class Plugin {
		constructor(element, options) {
			this._defaults = defaults;
			this.name = pluginName;
			this.options = {
				...defaults,
				...options
			};
			this.splittedTextList = {
				lines: [],
				words: [],
				chars: []
			};
			this.splitTextInstance = null;
			this.isRTL = $('html').attr('dir') === 'rtl';
			this.element = element;
			this.$element = $(element);
			this.prevWindowWidth = window.innerWidth;
			this.fontInfo = {};
			this.splitDonePormise = new Promise(resolve => {
				this.$element.on('lqdsplittext', resolve.bind(this, this));
			});
			if (!this.options.forceApply) {
				new IntersectionObserver(([entry], observer) => {
					if (entry.isIntersecting) {
						observer.disconnect();
						this.init();
					}
				}, {
					rootMargin: '20%'
				}).observe(this.element);
			} else {
				this.init();
			}
		}
		async init() {
			// await this.measure();
			await this.onFontsLoad();
			this.windowResize();
		}
		measure() {
			return fastdomPromised.measure(() => {
				const styles = getComputedStyle(this.element);
				this.fontInfo.elementFontFamily = styles.fontFamily.replace(/"/g, '').replace(/'/g, '').split(',')[0];
				this.fontInfo.elementFontWeight = styles.fontWeight;
				this.fontInfo.elementFontStyle = styles.fontStyle;
				this.fontInfo.lowecaseFontFamily = this.fontInfo.elementFontFamily.toLowerCase();
			});
		}
		onFontsLoad() {
			// return fastdomPromised.measure(() => {
			// 	if (window.liquidCheckedFonts && window.liquidCheckedFonts.length && window.liquidCheckedFonts.indexOf(this.fontInfo.lowecaseFontFamily) >= 0) {
			// 		return this.doSplit();
			// 	}
			// 	const font = new FontFaceObserver(this.fontInfo.elementFontFamily, {
			// 		weight: this.fontInfo.elementFontWeight,
			// 		style: this.fontInfo.elementFontStyle
			// 	});
			// 	font.load().finally(() => {
			// 		window.liquidCheckedFonts.push(this.fontInfo.lowecaseFontFamily);
			// 		this.doSplit();
			// 	});
			// });

			return this.doSplit();
		}
		getSplitTypeArray() {
			const {
				type
			} = this.options;
			const splitTypeArray = type.split(',').map(item => item.replace(' ', ''));
			if (!this.isRTL) {
				return splitTypeArray;
			} else {
				return splitTypeArray.filter(type => type !== 'chars');
			}
		}
		async doSplit() {
			await this.split();
			await this.unitsOp();
			await this.onSplittingDone();
		}
		split() {
			const splitType = this.getSplitTypeArray();
			const fancyHeadingInner = this.element.classList.contains('ld-fh-txt') && this.element.querySelector('.ld-fh-txt-inner') != null;
			const el = fancyHeadingInner ? this.element.querySelector('.ld-fh-txt-inner') : this.element;
			let splittedText;
			// return fastdomPromised.mutate(() => {
				splittedText = new SplitText(el, {
					type: splitType,
					charsClass: 'split-unit lqd-chars',
					linesClass: 'split-unit lqd-lines',
					wordsClass: 'split-unit lqd-words'
				});
				splitType.forEach(type => {
					splittedText[type].forEach(element => {
						this.splittedTextList[type].push(element);
					});
				});
				this.element.classList.add('split-text-applied');
				this.splitTextInstance = splittedText;
			// });
		}
		unitsOp() {
			// return fastdomPromised.mutate(() => {
				for (const [splitType, splittedTextArray] of Object.entries(this.splittedTextList)) {
					if (splittedTextArray && splittedTextArray.length > 0) {
						splittedTextArray.forEach((splitElement, i) => {
							splitElement.style.setProperty(`--${splitType}-index`, i);
							splitElement.style.setProperty(`--${splitType}-last-index`, splittedTextArray.length - 1 - i);
							$(splitElement).wrapInner(`<span class="split-inner" />`);
						});
					}

				}

			// });
		}
		onSplittingDone() {
			// return fastdomPromised.mutate(() => {
				this.element.dispatchEvent(new CustomEvent('lqdsplittext'));
			// });
		}
		windowResize() {
			$(window).on('resize.lqdSplitText', this.onWindowResize.bind(this));
		}
		onWindowResize() {
			if (this.prevWindowWidth === window.innerWidth) return;
			if (this.splitTextInstance) {
				this.splitTextInstance.revert();
				this.element.classList.remove('split-text-applied');
			}
			this.onAfterWindowResize();
			this.prevWindowWidth = window.innerWidth;
		}
		onAfterWindowResize() {
			this.doSplit();
			this.onSplittingDone();
			this.$element.find('.split-unit').addClass('lqd-unit-animation-done');
		}
		destroy() {
			$(window).off('resize.lqdSplitText');
		}
	}
	$.fn[pluginName] = function (options) {
		return this.each(function () {
			const pluginOptions = {
				...$(this).data('split-options'),
				...options
			};
			if (!$.data(this, "plugin_" + pluginName)) {
				$.data(this, "plugin_" + pluginName, new Plugin(this, pluginOptions));
			}
		});
	};
})(jQuery);