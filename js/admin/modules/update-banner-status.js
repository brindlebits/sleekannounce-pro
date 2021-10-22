;(function($, window, document, undefined) {
	$(function() {
		saStatusDropdown();

		function saStatusDropdown() {
			var $dropdown = $('.sa-js-status-dropdown');

			$dropdown.find('.dropdown__head').on('click', function() {
				var $this = $(this);

				$this.closest('.sa-dropdown-status').toggleClass('is-active');
			});

			$dropdown.find('.dropdown__body > ul a').on('click', function(event) {
				event.preventDefault();
				var $this = $(this);
				var $dropdown = $this.closest('.sa-js-status-dropdown')
				var currentStatus = $dropdown.attr('data-status');
				var newStatus = $this.attr('data-status');

				if (currentStatus === newStatus) {
					$dropdown.removeClass('is-active');

					return
				}

				$dropdown.attr('data-status', newStatus);
				$dropdown.find('.dropdown__head span').text($this.text()).removeClass('sa-live sa-draft');
				$dropdown.removeClass('is-active');

				var bannerID = $dropdown.closest('.sa-banner').attr('data-id');
				var $ajaxContainer = $dropdown.closest('.section-qp-popup');


				saUpdateBannerStatus($ajaxContainer, bannerID, newStatus);
			});
		}

		function saUpdateBannerStatus($ajaxContainer, bannerID, newStatus) {
				console.log(bannerID)
			$.ajax({
				url: sa_options.ajax_url,
				method: 'POST',
				data: {
					action: 'sa_update_banner_status',
					id: bannerID,
					status: newStatus
				},
				beforeSend: function() {
					$ajaxContainer.addClass('is-loading');
					$ajaxContainer.append('<i class="qp-ico-loading"></i>');
				},
				success: function(data) {
					$ajaxContainer.removeClass('is-loading');
					$ajaxContainer.find('.qp-ico-loading').remove();
				}
			});
		}
	});
})(jQuery, window, document);