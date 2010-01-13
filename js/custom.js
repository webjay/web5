function mosaic (url, id) {
	var feed = new google.feeds.Feed(url);
	var numEntries = rows * row;
	feed.setNumEntries(numEntries);
	feed.includeHistoricalEntries();
	feed.setResultFormat(google.feeds.Feed.MIXED_FORMAT);
	feed.load(function(result) {
		if (!result.error) {
			for (var i = 1; i <= result.feed.entries.length; i++) {
				var entry = result.feed.entries[i - 1];
				var image = jQuery(entry.xmlNode).find('[nodeName=media:thumbnail]').attr('url');
				if (image) {
					jQuery(id).append('<div class="imgcontainer"><a href="'+entry.link+'"><img src="'+image+'" alt=""></a></div>');
				}				
			}
		}
	});	
}

// Mosaic
var rows = 2; /* How many rows to show */
var row = 13; /* How many images to show per row */

google.load('jquery', '1');
if (flickrss != '') {
	google.load('feeds', '1');
	google.setOnLoadCallback(function(){
		mosaic(flickrss, '#flicks');
	});
} else {
	google.setOnLoadCallback(function(){
		jQuery('#banner').slideUp();
	});
}
