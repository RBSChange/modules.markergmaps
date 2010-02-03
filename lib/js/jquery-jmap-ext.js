(function($){

	$.jmap.JSearchLocationsDefaults = {
		url: {module: "markergmaps", action: "GetNearestMarkers"},
		mincount: null,
		maxcount: null,
		maxdistance: null,
		pointLatLng: [],
		address: "",
		modelname: ""
	};
	
	$.jmap.initOnce = function(el, options, callback)
	{
		if(!($.jmap.GMap2))
		{
			return $(el).jmap('init', options, callback);
		}
	}
	
	$.jmap.searchLocations = function(options, callback){

		var options = $.extend({}, $.jmap.JSearchLocationsDefaults, options);

		$.jmap.GClientGeocoder.getLatLng(options.address, function(latlng)
		{
			if (!latlng)
			{
				alert(options.address + ' not found');
				return null;
			}
			else
			{
				options.pointLatLng = [latlng.lat(), latlng.lng()];
				return $.jmap.searchLocationsNear(options, callback);
			}
		});
	};

	$.jmap.searchLocationsNear = function(options, callback){
		var gMap = $.jmap.GMap2;
		var infobar = $.jmap.infobar;
		
		var module = options.url.module;
		var action = options.url.action;
		var modelname = options.modelname;
		
		var searchUrl = '&module='+module+'&action='+action+'&modelname='+escape(modelname);
		searchUrl += '&lat='+options.pointLatLng[0]+'&lng='+options.pointLatLng[1];
		if(typeof options.mincount != 'undefined')
		{
			searchUrl += '&mincount='+options.mincount;
		}
		if(typeof options.maxcount != 'undefined')
		{
			searchUrl += '&maxcount='+options.maxcount;
		}
		if(typeof options.maxdistance != 'undefined')
		{
			searchUrl += '&maxdistance='+options.maxdistance;
		}
		
		GDownloadUrl(searchUrl, function(data)
		{
			var xml = GXml.parse(data);
			var markers = xml.documentElement.getElementsByTagName('Placemark');
			gMap.clearOverlays();

			if (markers.length == 0)
			{
				gMap.setCenter(new GLatLng(40, -100), 4);
				return;
			}

			var bounds = new GLatLngBounds();

			var markerListControl = new MarkerListControl();
			markerListControl.reset();
			gMap.removeControl(gMap.markerListControl);
			
			for (var i = 0; i < markers.length; i++)
			{
				var name = markers[i].getElementsByTagName('name')[0].firstChild.nodeValue;
				var description = markers[i].getElementsByTagName('description')[0].firstChild.nodeValue;
				var coordinates = markers[i].getElementsByTagName('coordinates')[0].firstChild.nodeValue;
				var separatorIdx = coordinates.indexOf(',');
				var lng = parseFloat(coordinates.substring(0, separatorIdx));
				var lat = parseFloat(coordinates.substring(separatorIdx+1));
 
 				var gMarkerOptions = {
 					pointLatLng: [lat, lng],
 					pointHTML: '<strong>'+name+'</strong><br/>'+description,
 					title: name
 				};			

				var iconStyle = markers[i].getElementsByTagName('IconStyle');
				if(iconStyle.length > 0)
				{
					var icon = iconStyle[0].getElementsByTagName('Icon')[0].getElementsByTagName('href')[0].firstChild.nodeValue;
				}
				
				$.jmap.addMarkerExtended(gMarkerOptions, function(marker){
					bounds.extend(marker.getPoint());
					markerListControl.addMarker(marker);

					if (typeof icon != 'undefined')
						marker.setImage(icon);
				});

			}

			gMap.addControl(markerListControl);
			$.jmap.moveTo({
				mapCenter: [bounds.getCenter().lat(), bounds.getCenter().lng()],
				mapZoom: gMap.getBoundsZoomLevel(bounds)
			});
		});

		if (typeof callback == 'function') return callback(el, options);
	};

	/**
	 *	Create a marker and add it as a point to the map
	 */
	$.jmap.addMarkerExtended = function(options, callback) {
		// Create options
		var options = $.extend({}, $.jmap.JMarkerDefaults, options);
		var markerOptions = {}
		
		if (typeof options.title != 'undefined')
			$.extend(markerOptions, {title: options.title});

		if (options.pointIsDraggable)
			$.extend(markerOptions, {draggable: options.pointIsDraggable});
		
		// Create marker, optional parameter to make it draggable
		var marker = new GMarker(new GLatLng(options.pointLatLng[0],options.pointLatLng[1]), markerOptions);
		
		// If it has HTML to pass in, add an event listner for a click
		if(options.pointHTML)
			GEvent.addListener(marker, options.pointOpenHTMLEvent, function(){
				marker.openInfoWindowHtml(options.pointHTML, {maxContent: options.pointMaxContent, maxTitle: options.pointMaxTitle});
			});

		// If it is removable, add dblclick event
		if(options.pointIsRemovable)
			GEvent.addListener(marker, options.pointRemoveEvent, function(){
				$.jmap.GMap2.removeOverlay(marker);
			});

		// If the marker manager exists, add it
		if($.jmap.GMarkerManager) {
			$.jmap.GMarkerManager.addMarker(marker, options.pointMinZoom, options.pointMaxZoom);	
		} else {
			// Direct rendering to map
			$.jmap.GMap2.addOverlay(marker);
		}
		
		if (typeof callback == 'function') return callback(marker);
	}

	$.jmap.addInfobarEntry = function (options, callback){
		var entry = $('<li/>');
		var html = '<a><strong>' + options.name + '</strong> <br/>' + options.infoHtml + '</a>';
		$(entry).html(html);
		//$(entry).click(function(){GEvent.trigger(marker, 'click');});
	
		var infobar = $.jmap.infobar;
		$(infobar).append(entry);
	};

})(jQuery);