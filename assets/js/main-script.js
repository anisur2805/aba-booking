; (function ($) {
	$("table.wp-list-table.students").on("click", "a.submit_delete", function (e) {
		e.preventDefault();

		if (!confirm(abaBooking.confirm)) {
			return;
		}

		var self = $(this),
			id = self.data("id");

		wp.ajax.send('aba-booking-delete-student', {
			data: {
				id: id,
				_wpnonce: abaBooking.nonce,
			}
		})
		.done(function (response) {
			self.closest("tr")
				.css("background-color", "red")
				.hide(400, function () {
					$(this).remove();
				});
		})
		.fail(function () {
			alert(abaBooking.error);
		});
	});

})(jQuery);
