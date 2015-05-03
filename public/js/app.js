(function() {
	window.App = {};

	App.Notifier = function() {
		this.notify = function(message) {
			for (var i in message.input) {
				message.input = $.parseJSON(i);
			}

			var template = Handlebars.compile($('#api-call').html());
			$(template(message)).prependTo('#api-calls').fadeIn(300, function() {
				var jaun = $(this);
				setTimeout(function() {
					console.log($(this));
					jaun.removeClass('panel-success').addClass('panel-default');
				}, 2000);
			});
		};
	};

	var pusher = new Pusher('8b70545cb1629c2331be');

	var channel = pusher.subscribe('apiChannel');

	channel.bind('apiCall', function(data) {
		(new App.Notifier).notify(data);
	});
})();