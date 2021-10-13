(function ($) {
    $(document).on('ready', function () {
        var input = $('.custom-label input');

        if(input.length) {
            input.on('focus', function() {
                var self = $(this);
                var label = self.closest('.gfield').find('label');

                if(label.length) {
                    label.addClass('active');
                }
            });

            input.on('focusout', function() {
                var self = $(this);
                var label = self.closest('.gfield').find('label');

                if(label.length) {
                    if($(this).val().length <= 0 || ($(this).is('input[type="text"]') && $(this).val().length == 14)) {
                        label.removeClass('active');
                    }
                }
            });
        }
    });
})(jQuery);