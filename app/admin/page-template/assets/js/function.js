(function($) {
    $(document).ready(function() {
        $('.nav-tab').on('click', function(e) {
            e.preventDefault();
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');

            $('.tab-content').hide();  // Hide all tab content
           
            $($(this).attr('href')).show();  // Show the selected tab content
        });
    });
})(jQuery);