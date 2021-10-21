;(function($, window, document, undefined) {
	$(document).ready(function() {
		barPlugin();
		mb_cookiePolicyBtnsHover();
		mb_closeCookieNotice();
		mb_triggerCookiePolicyBanner();
	});

	function barPlugin(){
		var $win = $(window);
		var $doc = $(document);
		var $body = $('body');
		var $container = $('.bar-plugin');
		
		if($container.length){

			if($container.data('show') == true){
				var _delay = $container.data('delay');
				var _position = $container.data('position');
				var _btnTopGradient = $container.data('button-gradient-top');
				var _btnBottomGradient = $container.data('button-gradient-bottom');
				var _backgroundTopGradient = $container.data('background-gradient-top');
				var _backgroundBottomGradient = $container.data('background-gradient-bottom');
				var _color = $container.data('color');
				var _separator = $container.data('separator');
				var _prefix = 'bar-plugin';
				var $classes = {
					ShowBar : _prefix + '-show-bar'
				}
				var _height = 0;
				var _fixedHeaderSelector = $container.data('fixed-header');
				var $fixedHeader = $(_fixedHeaderSelector);

				$container.css({
					'background' : 'linear-gradient(' + _backgroundTopGradient + ', ' + _backgroundBottomGradient +')',
					'color' : _color
				});

				$container.find('.' + _prefix + '-btn').css({
					'background' : 'linear-gradient(' + _btnTopGradient + ', ' + _btnBottomGradient +')'
				});

				$container.find('.' + _prefix + '-separator').css({
					'background' : _separator
				});

				var _clone = $container.clone();

				$container.remove();

				if (_position == 'bottom') {
					_clone.appendTo('body');
				} else {
					_clone.prependTo('body');
				}

				var $barPlugin = $body.find('.' + _prefix + ' ul');

				$body.find('.' + _prefix + '-btn-close, .sa-close-btn').click(function(event){

						setTimeout(function() {
							if ($fixedHeader.length > 0 && $fixedHeader.css('position') === 'fixed' || $fixedHeader.css('position') === 'absolute') {
								$fixedHeader.animate({
									'margin-top' : '0'
								});

								$body.animate({
									'margin-top' : '0'
								});
							}
						}, _delay)

					event.preventDefault();
					$body.find('.' + _prefix).removeClass($classes.ShowBar);	

					// Sets a cookie, when closing the message bar
					$.ajax({
						type: 'POST',
						url: sa_options.ajax_url,
						data: {
							action: 'crb_set_user_cookie'
						}

					})

				});

				$win.load(function(){
					_height = $barPlugin.height();
					_data_height = parseInt($barPlugin.closest('.bar-plugin').data('height'));
					
					if (_data_height > _height) {
						$barPlugin.css('height', _data_height);
					} else {
						$barPlugin.css('height', _height);
					}

					if ($fixedHeader.length > 0 && $fixedHeader.css('position') === 'fixed') {
						var _top = $body.hasClass('admin-bar') ? $('#wpadminbar') .outerHeight() : '0';

						$barPlugin.closest('.bar-plugin').css({
							'position' : 'fixed',
							'top'      : _top,
							'left'      : '0',
							'right'      : '0'
						});
					} else if ($fixedHeader.length > 0 && $fixedHeader.css('position') === 'absolute') {
						var _top = $body.hasClass('admin-bar') ? $('#wpadminbar') .outerHeight() : '0';

						$barPlugin.closest('.bar-plugin').css({
							'position' : 'absolute',
							'top'      : _top,
							'left'      : '0',
							'right'      : '0'
						});
					}

					setTimeout(function() {
						$body.find('.' + _prefix).addClass($classes.ShowBar);

						if ($fixedHeader.length > 0 && $fixedHeader.css('position') === 'fixed' || $fixedHeader.css('position') === 'absolute') {
							$fixedHeader.animate({
								'margin-top' : $barPlugin.css('height')
							});

							$body.animate({
								'margin-top' : $barPlugin.css('height')
							});
						}

						$win.on('resize', function(){
							$barPlugin.removeAttr('style');

							_height = $barPlugin.height();
							_data_height = parseInt($barPlugin.closest('.bar-plugin').data('height'));
							_used_height = 0;

							if (_data_height > _height) {
								_used_height = _data_height;
							} else {
								_used_height = _height;
							}

							$barPlugin.css('height', _used_height);

							if ($fixedHeader.length > 0 && $fixedHeader.css('position') === 'fixed' || $fixedHeader.css('position') === 'absolute') {
								var _top = $body.hasClass('admin-bar') ? $('#wpadminbar') .outerHeight() : '0';

								$barPlugin.closest('.bar-plugin').css({
									'top'        : _top,
								});
							}

							if ($fixedHeader.length && $fixedHeader.css('position') === 'fixed') {
								$barPlugin.closest('.bar-plugin').css({
									'top'             : _top,
									'position'        : 'fixed',
								});

								$fixedHeader.css({
									'margin-top' : _used_height
								});

								$body.css({
									'margin-top' : _used_height
								});
							} else if ($fixedHeader.length > 0 && $fixedHeader.css('position') === 'absolute') {
								$barPlugin.closest('.bar-plugin').css({
									'top'             : _top,
									'position'        : 'absolute',
								});
							} else if ($fixedHeader.length > 0 && $fixedHeader.css('position') === 'static') {
								$barPlugin.closest('.bar-plugin').css({
									'position'        : 'static',
								});
							}
						});

					}, _delay);

				});
			}else{
				$container.remove();
			}
		}
	}

	function mb_triggerCookiePolicyBanner() {
		const $cookieBanner = $('.section-sa-cookie-notice');

		if (! $cookieBanner.length) {
			return;
		}

		const delay = parseInt($cookieBanner.data('delay'));

		$(window).on('load', function() {
			const timeout = delay * 1000;

			setTimeout(function() {
				$cookieBanner.css({
					'opacity'       : '1',
					'visibility'    : 'visible',
					'margin-bottom' : '0'
				})
			}, timeout);
		});
	}

	function mb_cookiePolicyBtnsHover() {
		$('.section-sa-cookie-notice .section__actions a').on('mouseover', function() {
			const $this = $(this);

			if ($this.parent().hasClass('hollow')) {
				$this.css({
					'background': $this.data('hover-color'),
				});
			} else {
				$this.attr('data-background-color', $this.css('background-color'))
				
				$this.css({
					'background-color' : 'transparent',
				});
			}
		});

		$('.section-sa-cookie-notice .section__actions a').on('mouseout', function() {
			const $this = $(this);

			if ($this.parent().hasClass('hollow')) {
				$this.css({
					'background': 'transparent',
				});
			} else {
				$this.css({
					'background-color' : $this.data('background-color')
				})
			}
		});
	}

	function mb_closeCookieNotice() {
		$('.js-sa-close-cookie').on('click', function(e) {
			e.preventDefault();
			var $this = $(this);
			var $popup = $this.closest('.section-sa-cookie-notice');
			var snoozePopup = $popup.data('snooze');
			var snoozeDays = $popup.data('snooze-days');
			snoozeDays = parseInt(snoozeDays);

			$this.closest('.section-sa-cookie-notice').addClass('sa-hide-cookie-notice').css({
				'opacity'     : '0',
				'visibility'  : 'hidden'
			});

			if (snoozePopup && snoozeDays) {
				mb_setCookie('crb_sa_hide_cookie_notice', true, snoozeDays);
			}

			setTimeout(function() {
				$this.closest('.section-sa-cookie-notice').remove();
			}, 400);
		});
	}

	function mb_setCookie(cookieName, cookieValue, expirationDays) {
		const date = new Date();
		date.setTime(date.getTime() + (expirationDays * 24 * 60 * 60 * 1000));
		const expires = "expires="+ date.toUTCString();
		document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
	}
})(jQuery, window, document);