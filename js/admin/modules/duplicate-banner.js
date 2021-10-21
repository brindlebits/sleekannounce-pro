;(function($, window, document, undefined) {
	$(function() {
		$(document).on('click', '.js-duplicate-banner', function(event) {
			event.preventDefault();

			var $this = $(this);
			var popupID = $this.closest('.qp-popup-list').attr('data-id');

			$this.closest('.sa-section-banners').addClass('is-confirming').find('.sa-banner-duplicate-confirmation').attr('data-id', popupID);
		});

		$('.js-confirm-duplicate').on('click', function() {
			event.preventDefault();
			var $this = $(this);
			var popupID = $this.closest('.sa-banner-duplicate-confirmation').attr('data-id');

			var $ajaxContainer = $('.sa-section-banners');

			$ajaxContainer.removeClass('is-confirming');

			$.ajax({
				url: qp_site_ajax.ajaxurl,
				method: 'POST',
				data: {
					action: 'sa_duplicate_banner',
					id: popupID,
				},
				beforeSend: function() {
					$ajaxContainer.addClass('is-loading');
					$ajaxContainer.append('<i class="sa-ico-loading"></i>');
				},
				success: function(data) {
					$ajaxContainer.removeClass('is-loading');
					$ajaxContainer.find('.sa-ico-loading').remove();

					if (data.status === 'success') {
						$ajaxContainer.find('.sa-banners .sa-banners__body > ul').prepend(data.new_popup_html);
					}

				}
			});
		});

		$('.js-reject-duplicate').on('click', function(event) {
			event.preventDefault();

			$(this).closest('.sa-section-banners').removeClass('is-confirming');
		});
	});
})(jQuery, window, document);