!function(n){n(document).on("ready",(function(){var e=n(".current_openings_block");if(e.length){var i=e.find(".position");if(i.length){var o=i.find(".p"),s=i.find(".c");o.length&&s.length&&o.on("click",(function(){var e=n(this),i=e.next();i.is(":visible")?(e.removeClass("opened"),i.slideUp(120)):(o.removeClass("opened"),s.slideUp(120),e.addClass("opened"),i.slideDown(120))}))}}}))}(jQuery);