/*
 * Yii EAuth extension.
 * @author Maxim Zemskov
 * @link http://code.google.com/p/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
jQuery(function($) {
    var popup;
	
	$.fn.eauth = function(options) {
		options = $.extend({
			id: '',
			popup: {
				width: 450,
				height: 380
			}
		}, options);
		
		return $(document).on('click', '.auth-service>a', function(e) {
                e.preventDefault();
	            if (popup !== undefined) {
	                popup.close();
                    popup = undefined;
                }

	            var redirect_uri, url = redirect_uri = this.href;
				url += (url.indexOf('?') >= 0 ? '&' : '?') + 'redirect_uri=' + encodeURIComponent(redirect_uri);
				url += '&js';
				
	            /*var remember = $(this).parents('.auth-services').parent().find('.auth-services-rememberme');
	            if (remember.size() > 0 && remember.find('input').is(':checked')) 
					url += (url.indexOf('?') >= 0 ? '&' : '?') + 'remember';*/
	            
	            var centerWidth = ($(window).width() - options.popup.width) / 2;
	            var centerHeight = ($(window).height() - options.popup.height) / 2;
				
	            popup = window.open(url, "yii_eauth_popup", "width=" + options.popup.width + ",height=" + options.popup.height + ",left=" + centerWidth + ",top=" + centerHeight + ",resizable=yes,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes");
	            popup.focus();
	            
	            return false;
        });
	};
});
