(function ($) {
    $(document).on('ready', function () {
        var section = $('.current_openings_block');
        if(section.length) {
            var question = section.find('.position');

            if(question.length) {
                var q = question.find('.p');
                var a = question.find('.c');

                if(q.length && a.length) {
                    q.on('click', function () {
                        var self = $(this);
                        var currentA = self.next();

                        if(currentA.is(':visible')) {
                            self.removeClass('opened');
                            currentA.slideUp(120);
                        } else {
                            q.removeClass('opened');
                            a.slideUp(120);

                            self.addClass('opened');
                            currentA.slideDown(120);
                        }
                    });
                }
            }
        }
    });
})(jQuery);