jQuery(document).ready(function($) {

    // The number of the next page to load (/page/x/).
    var pageNum = parseInt(akijcement_load_portfolio.startPage) + 1;

    // The maximum number of pages the current query can return.
    var max = parseInt(akijcement_load_portfolio.maxPages);

    // The link of the next page of posts.
    // var nextLink = akijcement_load_portfolio.nextLink;

    // More text.
    var more_text = akijcement_load_portfolio.more_text;

    // Loading text.
    var loading_text = akijcement_load_portfolio.loading_text;

    // End of post text.
    var end_text = akijcement_load_portfolio.end_text;

    var $el = $('.akijcement-portfolio'),
        $grid = $el.find('.akijcement-grid'),
        resizeTimer;


    function calculateMasonrySize(isotopeOptions) {
        var tabletBreakPoint = 1025,
            mobileBreakPoint = 768,
            windowWidth = window.innerWidth,
            gridWidth = $grid[0].getBoundingClientRect().width,
            gridColumns = 1,
            gridGutter = 0,
            zigzagHeight = 0,
            settings = $el.data('grid'),
            lgGutter = settings.gutter ? settings.gutter : 0,
            mdGutter = settings.gutterTablet ? settings.gutterTablet : lgGutter,
            smGutter = settings.gutterMobile ? settings.gutterMobile : mdGutter,
            lgColumns = settings.columns ? settings.columns : 1,
            mdColumns = settings.columnsTablet ? settings.columnsTablet : lgColumns,
            smColumns = settings.columnsMobile ? settings.columnsMobile : mdColumns,
            lgZigzagHeight = settings.zigzagHeight ? settings.zigzagHeight : 0,
            mdZigzagHeight = settings.zigzagHeightTablet ? settings.zigzagHeightTablet : lgZigzagHeight,
            smZigzagHeight = settings.zigzagHeightMobile ? settings.zigzagHeightMobile : mdZigzagHeight,
            zigzagReversed = settings.zigzagReversed && settings.zigzagReversed === 1 ? true : false;

        if (typeof elementorFrontendConfig !== 'undefined') {
            tabletBreakPoint = elementorFrontendConfig.breakpoints.lg;
            mobileBreakPoint = elementorFrontendConfig.breakpoints.md;
        }

        if (windowWidth >= tabletBreakPoint) {
            gridColumns = lgColumns;
            gridGutter = lgGutter;
            zigzagHeight = lgZigzagHeight;
        } else if (windowWidth >= mobileBreakPoint) {
            gridColumns = mdColumns;
            gridGutter = mdGutter;
            zigzagHeight = mdZigzagHeight;
        } else {
            gridColumns = smColumns;
            gridGutter = smGutter;
            zigzagHeight = smZigzagHeight;
        }

        var totalGutterPerRow = (
            gridColumns - 1
        ) * gridGutter;

        var columnWidth = (
            gridWidth - totalGutterPerRow
        ) / gridColumns;

        columnWidth = Math.floor(columnWidth);

        var columnWidth2 = columnWidth;
        if (gridColumns > 1) {
            columnWidth2 = columnWidth * 2 + gridGutter;
        }

        $grid.children('.grid-sizer').css({
            'width': columnWidth + 'px'
        });

        var columnHeight = 0,
            columnHeight2 = 0, // 200%.
            columnHeight7 = 0, // 70%.
            columnHeight13 = 0, // 130%.
            isMetro = false,
            ratioW = 1,
            ratioH = 1;

        if (settings.ratio) {
            ratioH = settings.ratio;
            isMetro = true;
        }

        // Calculate item height for only metro type.
        if (isMetro) {
            columnHeight = columnWidth * ratioH / ratioW;
            columnHeight = Math.floor(columnHeight);

            if (gridColumns > 1) {
                columnHeight2 = columnHeight * 2 + gridGutter;
                columnHeight13 = parseInt(columnHeight * 1.3);
                columnHeight7 = columnHeight2 - gridGutter - columnHeight13;
            } else {
                columnHeight2 = columnHeight7 = columnHeight13 = columnHeight;
            }
        }

        $grid.children('.grid-item').each(function (index) {
            var gridItem = $(this);

            // Zigzag.
            if (
                zigzagHeight > 0 // Has zigzag.
                &&
                gridColumns > 1 // More than 1 column.
                &&
                index + 1 <= gridColumns // On top items.
            ) {
                if (zigzagReversed === false) { // Is odd item.
                    if (index % 2 === 0) {
                        gridItem.css({
                            'marginTop': zigzagHeight + 'px'
                        });
                    } else {
                        gridItem.css({
                            'marginTop': '0px'
                        });
                    }
                } else {
                    if (index % 2 !== 0) {
                        gridItem.css({
                            'marginTop': zigzagHeight + 'px'
                        });
                    } else {
                        gridItem.css({
                            'marginTop': '0px'
                        });
                    }
                }

            } else {
                gridItem.css({
                    'marginTop': '0px'
                });
            }

            if (gridItem.data('width') === 2) {
                gridItem.css({
                    'width': columnWidth2 + 'px'
                });
            } else {
                gridItem.css({
                    'width': columnWidth + 'px'
                });
            }

            if ('grid' === settings.type) {
                gridItem.css({
                    'marginBottom': gridGutter + 'px'
                });
            }

            if (isMetro) {
                var $itemHeight;

                if (gridItem.hasClass('grid-item-height')) {
                    $itemHeight = gridItem;
                } else {
                    $itemHeight = gridItem.find('.grid-item-height');
                }

                if (gridItem.data('height') === 2) {
                    $itemHeight.css({
                        'height': columnHeight2 + 'px'
                    });
                } else if (gridItem.data('height') === 1.3) {
                    $itemHeight.css({
                        'height': columnHeight13 + 'px'
                    });
                } else if (gridItem.data('height') === 0.7) {
                    $itemHeight.css({
                        'height': columnHeight7 + 'px'
                    });
                } else {
                    $itemHeight.css({
                        'height': columnHeight + 'px'
                    });
                }
            }
        });

        if (isotopeOptions) {
            isotopeOptions.packery.gutter = gridGutter;
            isotopeOptions.fitRows.gutter = gridGutter;
            $grid.isotope(isotopeOptions);
        }

        $grid.isotope('layout');
    }


    /**
     * Load new posts when the link is clicked.
     */
    if(pageNum <= max) {
        $('#akijcement-load-more-btn a').on( "click", function() {

            // Show that we're working.
            $(this).text(loading_text);

            $.ajax({
                type: 'POST',
                url: location.href + 'page/' + pageNum + '/',
                success: function(data) {

                    var result = $(data).find('div.portfolio_ajax .grid-item');

                    // var $grid = $('.akijcement-grid');
                    var settings = $el.data('grid');

                    if ($grid.length > 0 && settings && typeof settings.type !== 'undefined') {

                        var isotopeOptions = {
                            itemSelector: '.grid-item',
                            percentPosition: true,
                            // transitionDuration: 0,
                            packery: {
                                columnWidth: '.grid-sizer',
                            },
                            fitRows: {
                                gutter: 10
                            }
                        };


                        if ('masonry' === settings.type || 'metro' === settings.type) {
                            isotopeOptions.layoutMode = 'packery';
                        } else {
                            isotopeOptions.layoutMode = 'fitRows';
                        }

                        gridData = $grid.imagesLoaded(function () {
                            calculateMasonrySize(isotopeOptions);
                            $grid.addClass('loaded');
                        });

                        $(window).resize(function () {
                            calculateMasonrySize(isotopeOptions);

                            // Sometimes layout can be overlap. then re-cal layout one time.
                            clearTimeout(resizeTimer);
                            resizeTimer = setTimeout(function () {
                                // Run code here, resizing has "stopped"
                                calculateMasonrySize(isotopeOptions);
                            }, 500); // DO NOT decrease the time. Sometime, It'll make layout overlay on resize.
                        });

                        var $items = $(result);
                        $grid.append( $items );
                        $grid.isotope( 'appended', $items );
                        $grid.imagesLoaded().progress(function(){
                            $grid.isotope( 'layout' );
                        });


                        // Reverel Effect
                        var $single_portfolio_img = $('.overlay_effect');
                        var $window = $(window);

                        function scroll_addclass() {
                            var window_height = $(window).height() - 200;
                            var window_top_position = $window.scrollTop();
                            var window_bottom_position = (window_top_position + window_height);

                            $.each($single_portfolio_img, function() {
                                var $element = $(this);
                                var element_height = $element.outerHeight();
                                var element_top_position = $element.offset().top;
                                var element_bottom_position = (element_top_position + element_height);

                                //check to see if this current container is within viewport
                                if ((element_bottom_position >= window_top_position) &&
                                    (element_top_position <= window_bottom_position)) {
                                    $element.addClass('is_show');
                                }
                            });
                        }

                        $window.on('scroll resize', scroll_addclass);
                        $window.trigger('scroll');

                        // Tilt effect
                        $('.tilt-effect').tilt({
                            maxTilt: 15,
                            perspective: 1000,
                            easing: "cubic-bezier(.03,.98,.52,.99)",
                            scale: 1.02,
                            speed: 500,
                            transition: true,
                        });
                    }

                    pageNum++;


                    // Update the button message.
                    if(pageNum <= max) {
                        $('#akijcement-load-more-btn a').text(more_text);
                    } else {
                        $('#akijcement-load-more-btn a').css({'pointer-events': 'none','cursor': 'default'}).text(end_text);
                    }

                }
            });

            return false;
        });

    } else {
        $('#akijcement-load-more-btn a').hide();
    }
});