(function($) {
	$.tvmaze = {
		getEpisode: function(showId, callback) {
			var req = $.ajax({
				url:'http://api.tvmaze.com/shows/' + showId + '/episodes'
			});
			req.done(callback);
		},

		getShow: function(showName, callback) {
			var req = $.ajax({
				url:'http://api.tvmaze.com/search/shows/?q=' + showName
			});
			req.done(callback);
		},

		getAllShows: function(callback) {
			alert("getAllShows");
			var req = $.ajax({
				url:'http://api.tvmaze.com/shows'
			});
			req.done(callback);	
		} 
	};
})(jQuery);