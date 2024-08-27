(function ($, elementor) {
    "use strict";

    var AkijCement = {

        init: function () {

            var widgets = {
                'akijcement-banner-slider.default': AkijCement.BannerSlider,
                'akijcement-hero-static.default': AkijCement.Hero,
                'akijcement-project-slider.default': AkijCement.Slider,
				// 'akijcement-chart.default': AkijCement.ChatJs,
                'akijcement-blog-slider.default': AkijCement.BlogSlider,
                'akijcement-dynamic-tabs.default': AkijCement.DynamicTabs,
                // 'akijcement-content-tabs.default': AkijCement.Tabs,
                'akijcement-testimonial.default': AkijCement.Testimonial,
                'akijcement-logo-carousel.default': AkijCement.Logo,
                'akijcement-coming-soon.default': AkijCement.Counting,

            };
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
        },

		BannerSlider: function ($scope) {
			var slideInit = $scope.find('[data-banner]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-banner]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-banner'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});
				}
			});
		},

		Hero: function ($scope) {
			var element = $scope.find('.marquee-wrap');
			var elementtwo = $scope.find('.marquee-wrap-two');

			element.marquee({
				speed: 5, // this echos 20
				gap: 10,
				delayBeforeStart: 0,
				direction: 'right',
				duplicated: true,
				startVisible: true
			});

			elementtwo.marquee({
				speed: 5, // this echos 20
				gap: 10,
				delayBeforeStart: 0,
				direction: 'left',
				duplicated: true,
				startVisible: true
			});
		},

		ChatJs: function ($scope) {
			// Get Attributes
			var chart = $scope.find('.akij-chartbar');
			var ctx = chart.attr('id');

			var chartData = ctx.attr('data-chartdata');

			console.log(chartData)

			// Chart Data
			// var ctx = document.getElementById('chart-canvas-<?php echo esc_attr($this->get_id()); ?>').getContext('2d');


			var labels = chartData.map(function(data) {
				return data.label ;
			});

			var values = chartData.map(function(data) {
				return data.value;
			});

			var mybarChart = new Chart('#' + ctx, {
				type: 'bar',
				data: {
					labels: labels,
					datasets: [{
						// label: 'Candidate A Votes',
						backgroundColor: "#856B24",
						data: values
					}]
				},

				options: {
					legend: {
						display: false,
						position: 'top',
						labels: {
							fontColor: "#856B24",
						}
					},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true,
								fontColor: "#856B24",
							}
						}]
					}
				}
			});

        },

        DynamicTabs: function ($scope) {
            var tabnav = $scope.find('#akijcement-dynamic-tabs-nav li');

            $('#akijcement-dynamic-tabs-nav li:nth-child(1)').addClass('active');
            $('#akijcement-dynamic-tabs-content .content').hide();
            $('#akijcement-dynamic-tabs-content .content:nth-child(1)').show();

            if ($('#akijcement-dynamic-tabs-nav li').length > 0) {
                // $('.tt-portfolio__filter').append('<li class="indicator"></li>');
                if ($('#akijcement-dynamic-tabs-nav li').hasClass('active')) {
                    var cLeft = $('#akijcement-dynamic-tabs-nav li.active').position().left + 'px',
                        cWidth = $('#akijcement-dynamic-tabs-nav li.active').css('width');
                    $('.tab-swipe-line').css({
                        left: cLeft,
                        width: cWidth
                    })
                }
            }

            // Tab Click function
            tabnav.on('click', function () {
                $('#akijcement-dynamic-tabs-nav li').removeClass('active');
                $(this).addClass('active');

                var cLeft = $('#akijcement-dynamic-tabs-nav li.active').position().left + 'px',
                    cWidth = $('#akijcement-dynamic-tabs-nav li.active').css('width');
                $('.tab-swipe-line').css({
                    left: cLeft,
                    width: cWidth
                });

                $('#akijcement-dynamic-tabs-content .content').hide();

                var activeTab = $(this).find('a').attr('href');
                $(activeTab).fadeIn(600);
                return false;
            });
        },

        Tabs: function ($scope) {
            var tabnav = $scope.find('#marco-tabs-nav li');

            $('#marco-tabs-nav li:nth-child(1)').addClass('active');
            $('#marco-tabs-content .content').hide();
            $('#marco-tabs-content .content:nth-child(1)').show();

            // Tab Click function
            tabnav.on('click', function () {
                $('#marco-tabs-nav li').removeClass('active');
                $(this).addClass('active');
                $('#marco-tabs-content .content').hide();

                var activeTab = $(this).find('a').attr('href');
                $(activeTab).fadeIn(600);
                return false;
            });
        },

        Counting: function ($scope) {

            var counting = $scope.find('.countdown');

            counting.each(function (index, value) {
                var count_year = $(this).attr("data-count-year");
                var count_month = $(this).attr("data-count-month");
                var count_day = $(this).attr("data-count-day");
                var count_date = count_year + '/' + count_month + '/' + count_day;
                $(this).countdown(count_date, function (event) {
                    $(this).html(
                        event.strftime('<div class="counting"><span class="minus">-</span><span class="CountdownContent">%D<span class="CountdownLabel">Days</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%H <span class="CountdownLabel">Hours</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%M <span class="CountdownLabel">Minutes</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%S <span class="CountdownLabel">Seconds</span></span></div>')
                    );
                });
            });

        },

        Slider: function ($scope) {
            var slideInit = $scope.find('[data-swiper]');

            slideInit.each(function () {
                var swps = document.querySelectorAll('[data-swiper]');

                if (swps.length > 0) {
                    swps.forEach(function (swp) {
                        var config = JSON.parse(swp.getAttribute('data-swiper'));
                        var mySwiper = new Swiper(swp, config);

                        $('.swiper-slide').on('mouseover', function () {
                            mySwiper.autoplay.stop();
                        });

                        $('.swiper-slide').on('mouseout', function () {
                            mySwiper.autoplay.start();
                        });
                    });
                }
            });
        },

        BlogSlider: function ($scope) {
            var slideInit = $scope.find('[data-blog]');

            slideInit.each(function () {
                var swps = document.querySelectorAll('[data-blog]');

                if (swps.length > 0) {
                    swps.forEach(function (swp) {
                        var config = JSON.parse(swp.getAttribute('data-blog'));
                        var mySwiper = new Swiper(swp, config);

                        $('.swiper-slide').on('mouseover', function () {
                            mySwiper.autoplay.stop();
                        });

                        $('.swiper-slide').on('mouseout', function () {
                            mySwiper.autoplay.start();
                        });
                    });

                }
            });
        },

        Testimonial: function ($scope) {

            var slideInit = $scope.find('[data-testi]');

            slideInit.each(function () {
                var swps = document.querySelectorAll('[data-testi]');

                if (swps.length > 0) {
                    swps.forEach(function (swp) {
                        var config = JSON.parse(swp.getAttribute('data-testi'));
                        var mySwiper = new Swiper(swp, config);

                        $('.swiper-slide').on('mouseover', function () {
                            mySwiper.autoplay.stop();
                        });

                        $('.swiper-slide').on('mouseout', function () {
                            mySwiper.autoplay.start();
                        });
                    });

                }
            });
        },

        Logo: function ($scope) {

            var slideInit = $scope.find('[data-logo]');

            slideInit.each(function () {
                var swps = document.querySelectorAll('[data-logo]');

                if (swps.length > 0) {
                    swps.forEach(function (swp) {
                        var config = JSON.parse(swp.getAttribute('data-logo'));
                        var mySwiper = new Swiper(swp, config);

                        $('.swiper-slide').on('mouseover', function () {
                            mySwiper.autoplay.stop();
                        });

                        $('.swiper-slide').on('mouseout', function () {
                            mySwiper.autoplay.start();
                        });
                    });

                }


            });
        },

    };
    $(window).on('elementor/frontend/init', AkijCement.init);
}(jQuery, window.elementorFrontend));


// !function () {
// 	"use strict";
// 	class Heading extends elementorModules.frontend.handlers.Base {
// 		onInit(...e) {
// 			super.onInit(...e), this.handleDestroy(), this.initSplitText(), this.initTextRotator(), this.initInView()
// 		}
//
// 		getDefaultSettings() {
// 			return {
// 				selectors: {
// 					splitTextElement: "[data-split-text]",
// 					textRotatorElement: "[data-text-rotator]",
// 					inViewElement: "[data-inview]"
// 				}
// 			}
// 		}
//
// 		getDefaultElements() {
// 			const e = this.getSettings("selectors");
// 			return {
// 				$splitTextElement: this.$element.find(e.splitTextElement),
// 				$textRotatorElement: this.$element.find(e.textRotatorElement),
// 				$inViewElement: this.$element.find(e.inViewElement)
// 			}
// 		}
//
// 		initSplitText() {
// 			this.elements.$splitTextElement.liquidSplitText()
// 		}
//
// 		initCustomAnimation() {
// 			this.elements.$customAnimationElement.liquidCustomAnimations()
// 		}
//
// 		initTextRotator() {
// 			this.elements.$textRotatorElement.liquidTextRotator()
// 		}
//
// 		initInView() {
// 			this.elements.$inViewElement.liquidInView()
// 		}
//
// 		onDestroy() {
// 			this.handleDestroy(), super.onDestroy()
// 		}
//
// 		handleDestroy() {
// 			this.handleSplitTextDestroy(), this.handleTextRotatorDestroy()
// 		}
//
// 		handleSplitTextDestroy() {
// 			if (!this.elements.$splitTextElement.length) return;
// 			const e = this.elements.$splitTextElement.data("plugin_liquidSplitText");
// 			e && e.destroy()
// 		}
//
// 		handleTextRotatorDestroy() {
// 			if (!this.elements.$textRotatorElement.length) return;
// 			const e = this.elements.$textRotatorElement.data("plugin_liquidTextRotator");
// 			e && e.destroy()
// 		}
// 	}
//
// 	var SplitHeading = e => {
// 		elementorFrontend.elementsHandler.addHandler(Heading, {$element: e})
// 	};
//
// 	jQuery(window).on("elementor/frontend/init", () => {
// 			elementorFrontend.hooks.addAction("frontend/element_ready/akijcement_fancy_heading.default", SplitHeading)
//
//
// 	});
// }();


// jQuery(document).ready(function ($) {
// 	const $elements = $('[data-split-text]').filter((i, el) => {
// 		const $el = $(el);
// 		const isCustomAnimation = el.hasAttribute('data-custom-animations');
// 		const hasCustomAnimationParent = $el.closest('[data-custom-animations]').length;
// 		const hasAccordionParent = $el.closest('.accordion-content').length;
// 		const hasTabParent = $el.closest('.lqd-tabs-pane').length;
// 		const webglSlideshowParent = $el.closest('[data-lqd-webgl-slideshow]').length;
// 		return !isCustomAnimation && !hasCustomAnimationParent && !hasAccordionParent && !hasTabParent && !webglSlideshowParent;
// 	});
// 	$elements.liquidSplitText();
// });