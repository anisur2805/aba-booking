; (function ($) {
	$(document).ready(function () {

		$(".ABA_BOOKING_settings__form").on("submit", function (e) {
			e.preventDefault();

			var values = $(this).serialize();

			if (values) {

				const data = {
					action: 'ABA_BOOKING_add_contact',
					status: 'enabled',
					nonce: ABA_BOOKINGPopup.nonce,
					popup_settings_data : values
				}

				$.post(ABA_BOOKINGPopup.ajaxUrl, data, function (response) {
					if (response) {
						console.log(ABA_BOOKINGPopup.success);
					}
				}).fail(function () {
					console.error(ABA_BOOKINGPopup.error);
				})
					.always(() => console.log('form submitted'))
			}
		});
	});

})(jQuery);
