jQuery(document).ready(function($) {
	var kittenShown = false;

	$('#commentform').submit(function(e) {
		if (!(kittenShown)) {
			e.preventDefault();
			$.colorbox({
				href: kittenPic,
				maxWidth: "80%",
				maxHeight: "80%",
				title: "Thanks for your comment! Here's your kitten.",
				type: "photo",
				onClosed: function() {
					kittenShown = true;
					HTMLFormElement.prototype.submit.call($('#commentform')[0]);
				}
			});
			return false;
		}
	});

	//waypoint stuff
	$('#commentform').waypoint(function() {
		$('.kittenpanel').show(400);
	}, {
		offset: '110%'
	})
});
