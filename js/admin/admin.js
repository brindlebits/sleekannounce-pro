;(function($, window, document, undefined) {
	$(function() {
		saUpdateBannerTitle();
		saAddCustomClassToBannerLibraryItem();

		function saDashboardGetCookie(cname) {
			var name = cname + '=';
			var decodedCookie = decodeURIComponent(document.cookie);
			var ca = decodedCookie.split(';');
			
			for(var i = 0; i <ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}

			return '';
		}

		function saUpdateBannerTitle() {
			var $crbBannerTitleField = $('[name="carbon_fields_compact_input[_crb_sa_banner_title]"]');

			if ($crbBannerTitleField.length < 1) {
				return;
			}

			$(window).on('load', function() {
				$('#title').val($crbBannerTitleField.val());
			});

			$crbBannerTitleField.on('input', function() {
				$('#title').val($(this).val());
			});
		}

		function saAddCustomClassToBannerLibraryItem() {
			$('#toplevel_page_my-brindle .wp-submenu > li').each(function() {
				var $this = $(this);

				if ($this.children('a').text() === 'Banners Library') {
					$this.addClass('sa-with-arrow');
				}
			})
		}

		function saDashboardSetCookie(cookieName, cookieValue, expirationDays) {
			const date = new Date();
			date.setTime(date.getTime() + (expirationDays * 24 * 60 * 60 * 1000));
			const expires = 'expires='+ date.toUTCString();
			document.cookie = cookieName + '=' + cookieValue + ';' + expires + ';path=/';
		}

		function saSnoozeUpsell() {
			$('.js-upsell-snooze').on('click', function(event) {
				event.preventDefault();
				event.stopPropagation();

				$(this).closest('.sa-upsell-ad').remove();
	
				saDashboardSetCookie('sa_options_upsell_hidden', true, 15);
			});
		}
	
		function switchTopLevelMenuLinkURL($item, $switch) {
			const newUrl = $switch.attr('href');

			$item.attr('href', newUrl);
		}

		switchTopLevelMenuLinkURL($('.toplevel_page_my-brindle'), $('#toplevel_page_my-brindle > .wp-submenu > .wp-first-item + li > a'));

		function saAddUpsellSidebar() {
			if (! $('body').is('.my-brindle_page_crb_carbon_fields_container_sleek_announce') || saDashboardGetCookie('sa_options_upsell_hidden')) {
				return;
			}

			$('#postbox-container-1').append('<div class="sa-upsell-ad"><div class="sa-upsell-ad__inner"><span class="sa-upsell-ad__image"></span><p><strong>Want even more features?</strong><br><span>SleekAnnounce Pro allows you to build an entire library of banners with more styles, placement options, and full control over your banner designs, Try it FREE!</span></p><a target="_blank" href="https://mybrindle.com/banners-wordpress-plugin/" class="sa-upsell-ad__btn"><strong>Try SleekAnnounce Pro</strong><br>No risk 7 day free trial</a><a href="#" class="sa-upsell-ad__snooze js-upsell-snooze">Hide this message</a></div></div>');
		}

		function saSwitchUpsellSidebar() {
			var textContent = {
				'Announcement': 'SleekAnnounce Pro allows you to build an entire library of banners with more styles, placement options, and full control over your banner designs, Try it FREE!',
				'Cookie Policy Notice': 'SleekAnnounce Pro allows you to fully customize your cookie notice with advanced GDRP compliance features, size & placement options, advanced styling and more.'
			}

			$('.cf-container-carbon_fields_container_sleek_announce .cf-container__tabs-item').on('click', function() {
				var textSelection = $(this).text();

				$('.sa-upsell-ad p span').text(textContent[textSelection]);
			});
		}

		saAddUpsellSidebar();
		saSnoozeUpsell();
		saSwitchUpsellSidebar();
	});
})(jQuery, window, document);