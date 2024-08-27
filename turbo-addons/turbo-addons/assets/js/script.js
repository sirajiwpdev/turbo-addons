(function($) {
    $(document).ready(function() {
        // Toggle tab content
        $('.tr-tab-title').on('click', function() {
            var $this = $(this);
            var $parent = $this.closest('.tr-advanced-tabs-accordions');
            var tabID = $this.data('tab'); // Get the associated tab content ID
            
            // Deactivate all tabs and contents
            $parent.find('.tr-tab-title').removeClass('active');
            $parent.find('.tr-tab-content').removeClass('active').slideUp();
            
            // Activate the clicked tab and its content
            $this.addClass('active');
            $parent.find('.tr-tab-content[data-tab="' + tabID + '"]').addClass('active').slideDown();
        });

        // Toggle nested tab content
        $('.tr-nested-tab h5').on('click', function() {
            var $this = $(this);
            var $content = $this.next('.tr-nested-content');

            $this.toggleClass('active');
            $content.slideToggle();
        });

        // Dynamic content loading (Example: Load via AJAX)
        $('.tr-tab-title').on('click', function() {
            var $this = $(this);
            if ($this.data('loaded')) return;

            var dynamicContentUrl = $this.data('url'); // URL to load dynamic content from (example)
            if (dynamicContentUrl) {
                $.ajax({
                    url: dynamicContentUrl,
                    success: function(response) {
                        $this.closest('.tr-tab-content').find('.tr-content').html(response);
                        $this.data('loaded', true); // Mark as loaded
                    }
                });
            }
        });

        var $slider = $('.tr-dynamic-content-slider');
        var $slides = $slider.children('.tr-slide');
        var totalSlides = $slides.length;
        var currentIndex = 0;

        function showSlide(index) {
            if (index < 0 || index >= totalSlides) return;
            $slider.css('transform', 'translateX(-' + (index * 100) + '%)');
            currentIndex = index;
            window.location.hash = 'slide-' + index; // Update URL hash
        }

        // Check URL for slide hash
        var hash = window.location.hash;
        if (hash.startsWith('#slide-')) {
            var slideIndex = parseInt(hash.replace('#slide-', ''), 10);
            if (!isNaN(slideIndex) && slideIndex >= 0 && slideIndex < totalSlides) {
                showSlide(slideIndex);
            }
        }

        // Navigation
        $('.tr-slider-next').on('click', function() {
            if (currentIndex < totalSlides - 1) {
                showSlide(currentIndex + 1);
            }
        });

        $('.tr-slider-prev').on('click', function() {
            if (currentIndex > 0) {
                showSlide(currentIndex - 1);
            }
        });

        showSlide(currentIndex);
    });

   function initGrid() {
                var $grid = $('.tr-dynamic-content-grid');
    
                if ($grid.data('layout') === 'masonry') {
                    $grid.imagesLoaded(function() {
                        $grid.masonry({
                            itemSelector: '.tr-grid-item',
                            columnWidth: '.tr-grid-item',
                            percentPosition: true
                        });
                    });
                }
    
                if ($grid.data('infinite-scroll') === 'yes') {
                    $grid.infiniteScroll({
                        path: '.next',
                        append: '.tr-grid-item',
                        history: false
                    });
                }
    
                $('.tr-load-more').on('click', function() {
                    var button = $(this);
                    var nextPage = parseInt(button.attr('data-page')) + 1; // Increase page number
                    var data = {
                        action: 'load_more_posts',
                        query: tr_dynamic_grid_params.posts,
                        page: nextPage
                    };
    
                    $.ajax({
                        url: tr_dynamic_grid_params.ajaxurl,
                        data: data,
                        type: 'POST',
                        beforeSend: function(xhr) {
                            button.text('Loading...');
                        },
                        success: function(data) {
                            if (data) {
                                button.text('Load More');
                                $('.tr-grid-items').append(data);
                                button.attr('data-page', nextPage); // Update the button page number
                                if (nextPage >= tr_dynamic_grid_params.max_page)
                                    button.remove(); // if last page, remove button
                            } else {
                                button.remove(); // if no data, remove button
                            }
                        }
                    });
                });
    
                // Drag-and-drop reordering
                $('.tr-grid-items').sortable({
                    placeholder: 'tr-grid-item-placeholder',
                    update: function(event, ui) {
                        // Save order via AJAX
                        var order = $(this).sortable('toArray').toString();
                        $.post(tr_dynamic_grid_params.ajaxurl, {
                            action: 'save_post_order',
                            order: order
                        });
                    }
                });
            }
    
            // Initialize Grid/Masonry
            initGrid();  
            
// Initialize the Storytelling Slider
                    $('.tr-storytelling-slider').each(function() {
                        var $slider = $(this);
                        var animationType = $slider.data('animation');
                        var slides = $slider.find('.tr-slide');
                        var currentIndex = 0;
            
                        function showSlide(index) {
                            slides.removeClass('active');
                            slides.eq(index).addClass('active');
                        }
            
                        function nextSlide() {
                            currentIndex = (currentIndex + 1) % slides.length;
                            showSlide(currentIndex);
                        }
            
                        function prevSlide() {
                            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                            showSlide(currentIndex);
                        }
            
                        // Add custom triggers for the slider
                        $slider.on('click', '.tr-next', nextSlide);
                        $slider.on('click', '.tr-prev', prevSlide);
            
                        // Parallax effect
                        if ($slider.data('enable-parallax') === 'yes') {
                            $(window).on('scroll', function() {
                                var scrolled = $(window).scrollTop();
                                slides.each(function() {
                                    var $this = $(this);
                                    var offsetTop = $this.offset().top;
                                    var parallaxSpeed = $this.data('parallax-speed') || 0.5;
                                    var parallaxY = (offsetTop - scrolled) * parallaxSpeed;
                                    $this.css('transform', 'translateY(' + parallaxY + 'px)');
                                });
                            });
                        }
            
                        // Text animations
                        slides.each(function() {
                            var $this = $(this);
                            var animation = $this.data('text-animation');
                            if (animation === 'fade_in') {
                                $this.find('.tr-slide-content').hide().fadeIn(1000);
                            } else if (animation === 'slide_in') {
                                $this.find('.tr-slide-content').css({ opacity: 0, left: '-100px' }).animate({ opacity: 1, left: '0' }, 1000);
                            }
                            // Add more animation types as needed
                        });
            
 // Initialize the first slide
 showSlide(currentIndex);

});  

$('.tr-animated-text-effects').each(function() {
    var $element = $(this);
    var animationStyle = $element.data('animation-style');
    var speed = parseInt($element.data('speed'), 10);
    var loop = $element.data('loop') === 'yes';
    var textContent = $element.find('.tr-animated-text').text();
    var highlightedWords = $element.find('.tr-highlighted-words').data('words');

    // Initialize animation based on the style
    function startAnimation() {
        if (animationStyle === 'typing') {
            var index = 0;
            var textArray = textContent.split('');

            function type() {
                if (index < textArray.length) {
                    $element.find('.tr-animated-text').append(textArray[index]);
                    index++;
                    setTimeout(type, speed);
                } else if (loop) {
                    setTimeout(resetAnimation, 2000);
                }
            }

            type();
        } else if (animationStyle === 'flipping') {
            // Implement flipping animation logic
        } else if (animationStyle === 'sliding') {
            // Implement sliding animation logic
        }
    }

    function resetAnimation() {
        $element.find('.tr-animated-text').text('');
        startAnimation();
    }

    // Highlight words
    if (highlightedWords) {
        highlightedWords.forEach(function(word) {
            textContent = textContent.replace(new RegExp('\\b' + word + '\\b', 'gi'), '<span class="highlight">' + word + '</span>');
        });
        $element.find('.tr-animated-text').html(textContent);
    }

    startAnimation();
});

            
 })(jQuery);
    


