/*!
 * Custom Select2 Integration
 * Version 4.0.0
 *
 * This script includes the essential Select2 functionality for initializing searchable select boxes.
 * Ensure compatibility with the existing jQuery library.
 */

// Define the Select2 plugin (simplified version)
(function($) {
    $.fn.select2 = function(options) {
        var settings = $.extend({
            width: 'resolve'
        }, options);

        return this.each(function() {
            var $select = $(this);

            // Initialize Select2
            $select.hide().after('<span class="select2-container"><span class="selection"><span class="select2-selection" tabindex="0" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false"><span class="select2-selection__rendered"></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span></span>');
            var $container = $select.next('.select2-container');
            var $selection = $container.find('.select2-selection');
            var $rendered = $selection.find('.select2-selection__rendered');

            // Populate options
            $select.find('option').each(function() {
                var $option = $(this);
                if ($option.is(':selected')) {
                    $rendered.text($option.text());
                }
            });

            // Handle focus and blur
            $selection.on('focus', function() {
                $(this).css('border-color', 'rgb(232, 227, 227)');
            }).on('blur', function() {
                $(this).css('border-color', '#007bff');
            });

            // Handle selection
            $selection.on('click', function() {
                $select.trigger('focus');
            });

            $select.on('change', function() {
                var selectedText = $(this).find('option:selected').text();
                $rendered.text(selectedText);
            });

            // Apply styles
            $selection.css({
                'height': '40px',
                'border': '1px solid rgb(232, 227, 227)',
                'border-radius': '4px',
                'line-height': '38px',
                'color': '#555'
            });

            $selection.find('.select2-selection__arrow').css({
                'height': '38px'
            });
        });
    };
}(jQuery));

// Usage example
$(function() {
    $("select.searchable").select2();
});
