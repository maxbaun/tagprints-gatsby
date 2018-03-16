const jQuery = require('jquery');
require('./lib/jquery.json');
require('./lib/gravityforms.js');
require('./lib/placeholders');
require('./lib/gfplaceholderaddon');

document.addEventListener("DOMContentLoaded", function() {
    jQuery(document).ready(function($) {
        gformInitSpinner(1, 'http://localhost:8080/wp-content/plugins/gravityforms/images/spinner.gif');
        jQuery('#gform_ajax_frame_1').load(function() {

            var contents = jQuery(this).contents().find('*').html();
            var is_postback = contents.indexOf('GF_AJAX_POSTBACK') >= 0;
            if (!is_postback) {
                return;
            }
            var form_content = jQuery(this).contents().find('#gform_wrapper_1');
            var is_confirmation = jQuery(this).contents().find('#gform_confirmation_wrapper_1').length > 0;
            var is_redirect = contents.indexOf('gformRedirect(){') >= 0;
            var is_form = form_content.length > 0 && !is_redirect && !is_confirmation;
            if (is_form) {
                jQuery('#gform_wrapper_1').html(form_content.html());
                if (form_content.hasClass('gform_validation_error')) {
                    jQuery('#gform_wrapper_1').addClass('gform_validation_error');
                } else {
                    jQuery('#gform_wrapper_1').removeClass('gform_validation_error');
                }
                setTimeout(function() { /* delay the scroll by 50 milliseconds to fix a bug in chrome */
                    jQuery(document).scrollTop(jQuery('#gform_wrapper_1').offset().top);
                }, 50);
                if (window['gformInitDatepicker']) {
                    window.gformInitDatepicker();
                }
                if (window['gformInitPriceFields']) {
                    window.gformInitPriceFields();
                }
                var current_page = jQuery('#gform_source_page_number_1').val();
                window.gformInitSpinner(1, 'http://localhost:8080/wp-content/plugins/gravityforms/images/spinner.gif');
                jQuery(document).trigger('gform_page_loaded', [1, current_page]);
                window['gf_submitting_1'] = false;
            } else if (!is_redirect) {
                var confirmation_content = jQuery(this).contents().find('.GF_AJAX_POSTBACK').html();
                if (!confirmation_content) {
                    confirmation_content = contents;
                }
                setTimeout(function() {
                    jQuery('#gform_wrapper_1').replaceWith(confirmation_content);
                    jQuery(document).scrollTop(jQuery('#gf_1').offset().top);
                    jQuery(document).trigger('gform_confirmation_loaded', [1]);
                    window['gf_submitting_1'] = false;
                }, 50);
            } else {
                jQuery('#gform_1').append(contents);
                if (window['gformRedirect']) {
                    gformRedirect();
                }
            }
            jQuery(document).trigger('gform_post_render', [1, current_page]);
        });
    });
}, false);
