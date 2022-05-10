(function ($) {
	$("table.wp-list-table.contacts").on(
		"click",
		"a.submit_delete",
		function (e) {
			e.preventDefault();

			if (!confirm(oopAcademy.confirm)) {
				return;
			}

			var self = $(this),
				id = self.data("id");

			wp.ajax
				.send("oop-ac-contact-delete", {
					data: {
						nonce: oopAcademy.nonce,
						id: id,
					},
				})
				.done(function (response) {
					self.closest("tr")
						.css("background-color", "red")
						.hide(400, function () {
							$(this).remove();
						});
				})
				.fail(function () {
					alert(oopAcademy.error);
				});
		}
	);
})(jQuery);
