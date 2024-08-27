( function( $, window ) {
    'use strict';
    $(window).on('elementor/frontend/init', function (){
        if ( window.elementorFrontend.isEditMode() ) {

            window.elementorFrontend.hooks.addAction( 'frontend/element_ready/column',
                function( $scope ){
                    if (jQuery('.sticky-sidebar').length) {
                        jQuery('body').addClass('sticky-sidebar_init');
                        jQuery('.sticky-sidebar').each(function() {
                            jQuery(this).theiaStickySidebar({
                                additionalMarginTop: 130,
                                additionalMarginBottom: 30
                            });
                        });
                    }

                    if (jQuery('.sticky_layout .info-wrapper').length) {
                        jQuery('.sticky_layout .info-wrapper').each(function() {
                            jQuery(this).theiaStickySidebar({
                                additionalMarginTop: 150,
                                additionalMarginBottom: 150
                            });
                        });
                    }
                }
            );

        }

    });
}( jQuery, window ) );
