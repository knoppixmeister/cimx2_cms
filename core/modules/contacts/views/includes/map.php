<div id="gmap_addr_canvas"></div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
window.onload = function() {
	(function($) {
		var canvas = $("div#gmap_addr_canvas");
		canvas.css("width", 	"100%");
		canvas.css("height", 	"400");

		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			address : "new york" 
		}, 
		function(results, status) {
			if(status == google.maps.GeocoderStatus.OK) {
				var latlng = results[0].geometry.location;
				var map = new google.maps.Map(canvas.get(0), {
																	zoom : 15,
																	center : latlng, 
																	mapTypeId : google.maps.MapTypeId.HYBRID, 
																	mapTypeControl : true, 
																	mapTypeControlOptions : {
																		style : google.maps.MapTypeControlStyle.DROPDOWN_MENU
																	}, 
                       												navigationControl : true, 
                       												navigationControlOptions : {
																		style : google.maps.NavigationControlStyle.SMALL
                       												}, 
					   												streetViewControl: true 
												});

				var marker = new google.maps.Marker({
						map : map, 
						position : latlng 
				});

				var info = new google.maps.InfoWindow({
                           content : 	""
				});
				google.maps.event.addListener(marker, "click", function() {
					info.open(map, marker);
				});
			};
        });
    })(jQuery);
};
</script>
