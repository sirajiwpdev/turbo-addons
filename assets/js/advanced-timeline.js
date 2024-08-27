(function($){
    $(document).ready(function(){
        console.log('Document Ready');

        var $timelineItems = $('.advanced-timeline .timeline-item');
        console.log('Found timeline items:', $timelineItems.length);

        $timelineItems.each(function(){
            var $this = $(this);
            var waypoint = new Waypoint({
                element: $this,
                handler: function(direction) {
                    if (direction === 'down' && !$this.hasClass('visible')) {
                        console.log('Waypoint triggered for:', $this);
                        $this.addClass('visible');
                    }
                },
                offset: '75%' // Adjust this offset as needed to control when the animation triggers
            });
        });

        // Horizontal scrolling with mousewheel
        $('.advanced-timeline.horizontal').on('mousewheel DOMMouseScroll', function(e) {
            var delta = e.originalEvent.wheelDelta || -e.originalEvent.detail;
            this.scrollLeft += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        });
    });
})(jQuery);
