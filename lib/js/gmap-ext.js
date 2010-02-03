GMergeOptions = function (options1, options2) {
	if(typeof options1 != "object" || options1 == null)
	{
		options1 = {};
	}
	for(option in options2)
	{
		if(typeof options1[option] == "undefined")
		{
			options1[option] = options2[option];
		}
	}
	return options1;
};

function ErrorControl() {}

	ErrorControl.prototype = new GControl();
	ErrorControl.prototype.errors = [];
	
	ErrorControl.prototype.addError = function(error)
	{
		this.errors[this.errors.length] = error;
	}
	
	ErrorControl.prototype.reset = function()
	{
		this.errors = [];
	}
	
	ErrorControl.prototype.initialize = function(map)
	{
		var controlContainer = document.createElement("div");
		map.getContainer().appendChild(controlContainer);
		this.setButtonStyle_(controlContainer);

		var errorContainer = document.createElement("ul");
		controlContainer.appendChild(errorContainer);

		var errorLength = this.errors.length;
		for(var i=0; i<errorLength; i++)
		{
			var errorString = this.errors[i];
			var error = document.createElement("li");
			controlContainer.appendChild(error);
			error.appendChild(document.createTextNode(errorString));
		}
		map.errorControl = this;
		return controlContainer;
	}
	
	ErrorControl.prototype.getDefaultPosition = function() {
		return new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(7, 7));
	}
	
	ErrorControl.prototype.setButtonStyle_ = function(button) {
		button.style.color = "red";
		button.style.backgroundColor = "white";
		button.style.font = "small Arial";
		button.style.border = "1px solid black";
		button.style.padding = "2px";
		button.style.marginBottom = "2px";
		button.style.textAlign = "center";
		button.style.cursor = "pointer";
	}
	
function MarkerListControl() {}

	MarkerListControl.prototype = new GControl();

	MarkerListControl.prototype.markers = [];

	MarkerListControl.prototype.addMarker = function(marker)
	{
		this.markers[this.markers.length] = marker;
	}
	
	MarkerListControl.prototype.reset = function()
	{
		this.markers = [];
	}
	
	MarkerListControl.prototype.initialize = function(map) {
		
		var controlContainer = document.createElement("div");
		map.getContainer().appendChild(controlContainer);

		var markers = this.markers;
		var markersLength = markers.length;
		
		if(markersLength > 3)
		{
			var markerSelect = document.createElement("select");
			controlContainer.appendChild(markerSelect);
			for(var i=0; i<markersLength; i++)
			{
				var marker = markers[i];
				var markerControl = document.createElement("option");
				markerControl.appendChild(document.createTextNode(marker.getTitle()));
				markerControl.marker = marker;
				marker.control = markerControl;
				markerSelect.appendChild(markerControl);
				GEvent.addListener(marker, 'click', function(){
					this.control.selected = true;
				});
			}
			GEvent.addDomListener(markerSelect, 'change', function() {
				GEvent.trigger(this.options[this.selectedIndex].marker, 'click');
			});
		}
		else
		{
			for(var i=0; i<markersLength; i++)
			{
				var marker = markers[i];
				var markerControl = document.createElement("div");
				markerControl.appendChild(document.createTextNode(marker.getTitle()));
				markerControl.marker = marker;
				controlContainer.appendChild(markerControl);
				this.setButtonStyle_(markerControl);
				GEvent.addDomListener(markerControl, 'click', function() {
					GEvent.trigger(this.marker, 'click');
				});
				GEvent.addDomListener(markerControl, 'mouseover', function() {
					this.style.backgroundColor = '#eee';
				});
				GEvent.addDomListener(markerControl, 'mouseout', function() {
					this.style.backgroundColor = '#fff';
				});
			}
		}
		map.markerListControl = this;
		return controlContainer;
	}
	
	MarkerListControl.prototype.getDefaultPosition = function() {
		return new GControlPosition(G_ANCHOR_BOTTOM_RIGHT, new GSize(7, 7));
	}
	
	// Sets the proper CSS for the given button element.
	MarkerListControl.prototype.setButtonStyle_ = function(button) {
		button.style.backgroundColor = "white";
		button.style.font = "small Arial";
		button.style.border = "1px solid black";
		button.style.padding = "2px";
		button.style.marginBottom = "2px";
		button.style.cursor = "pointer";
	}

GMapLoadOnce = function (el, options, callback) {
	if(typeof gmap != 'object')
	{
		if (GBrowserIsCompatible()) {
			geocoder = new GClientGeocoder();
			gmap = new GMap2(el, options);
			if(typeof callback == 'function')
				callback(gmap);
		}
	}
	return gmap;
};

GMap2.prototype.searchLocationsOptions = {
	module: "markergmaps",
	action: "GetNearestMarkers",
	mincount: null,
	maxcount: null,
	maxdistance: null,
	pointLatLng: null,
	address: "",
	modelname: ""
};

GMap2.prototype.searchLocations = function (options) {
	gmap = this;
	var success = false
	options = GMergeOptions(options, this.searchLocationsOptions);
		geocoder.getLatLng(options.address, function(latLng) {
		options.pointLatLng = latLng;
		gmap.searchLocationsNear(options);
	});
	return success;
};

GMap2.prototype.searchLocationsNear = function (options) {
		
	options = GMergeOptions(options, this.searchLocationsOptions);
	gmap = this;
	
	var downloadOptions = {
		module: options.module,
		action: options.action
	};
	
	var params = {modelname: options.modelname};
	if(options.pointLatLng != null)
	{
		params.lat=options.pointLatLng.lat();
		params.lng=options.pointLatLng.lng();
	}
	if(options.mincount != null)
	{
		params.mincount = options.mincount;
	}
	if(options.maxcount != null)
	{
		params.maxcount = options.maxcount;
	}
	if(options.maxdistance != null)
	{
		params.maxdistance = options.maxdistance;
	}
	downloadOptions.params = params;

	GDownloadMarkers(downloadOptions, function(data){
		gmap.feedMarkers(GXml.parse(data));
	});

};

GMap2.prototype.markers = {};
GMap2.prototype.idStack = [];

GMap2.prototype.loadMarkersOptions = {
	module: "markergmaps",
	action: "GetMarker",
	paramName: "gmapsParam[cmpref]",
	ids: null
}
GMap2.prototype.loadMarkers = function (options, callback)
{
	options = GMergeOptions(options, this.loadMarkersOptions);
	idsLength = options.ids.length;
	params = {};
	downloadOptions = {
		module: options.module,
		action: options.action,
		params: {}
	}
	
	var downloadCallback = function(data)
	{
		var xml = GXml.parse(data);
		var markers = xml.documentElement.getElementsByTagName('Placemark');
		if(markers.length == 0) return;
		
		var marker = markers[0];
		var name = marker.getElementsByTagName('name')[0].firstChild.nodeValue;
		var description = marker.getElementsByTagName('description')[0].firstChild.nodeValue;
		var coordinates = marker.getElementsByTagName('coordinates')[0].firstChild.nodeValue;
		var separatorIdx = coordinates.indexOf(',');
		var lng = parseFloat(coordinates.substring(0, separatorIdx));
		var lat = parseFloat(coordinates.substring(separatorIdx+1));

		var point = new GLatLng(lat, lng);
		
		var markerOptions = {
			title: name
		};
		
		gmap.markers[gmap.idStack.shift()] = gmap.createMarker(point, '<strong>'+name+'</strong><br/>'+description, markerOptions);
	}

	for(var idx=0; idx<idsLength; idx++)
	{
		downloadOptions.params[options.paramName] = options.ids[idx];
		gmap.idStack.push(options.ids[idx]);
		
		if(idx == idsLength - 1 && typeof callback == 'function')
		{
			var oldDownloadCallback = downloadCallback;
			downloadCallback = function (data){
				oldDownloadCallback(data);
				callback();
			}
		}
		GDownloadMarkers(downloadOptions, downloadCallback);
	}
}

GMap2.prototype.createMarkerOptions = {};
GMap2.prototype.createMarker = function(point, html, options) {
	options = GMergeOptions(options, this.createMarkerOptions);
	
	var marker = new GMarker(point, options);
	GEvent.addListener(marker, 'click', function() {
		this.openInfoWindowHtml(html);
	});
	return marker;
}

GMap2.prototype.goToMarkerOptions = {
	module: "markergmaps",
	action: "GetMarker",
	paramName: "gmapsParam[cmpref]",
	zoom: 12,
	id: null
};
GMap2.prototype.goToMarker = function (options)
{
	options = GMergeOptions(options, this.goToMarkerOptions);
	params = {};
	params[options.paramName] = options.id;
	downloadOptions = {
		module: options.module,
		action: options.action,
		params: params
	}
	
	var marker = gmap.markers[options.id];
	if(typeof marker == 'object')
	{
		GEvent.trigger(marker, 'click');
	}
	return;
}

GDownloadMarkersOptions = {
	module: "markergmaps",
	action: "GetMarkers",
	params: null
}
GDownloadMarkers = function (options, callback)
{
	options = GMergeOptions(options, GDownloadMarkersOptions);

	var params = "";
	if(typeof options.params == 'object')
	{
		for(param in options.params)
		{
			params += "&"+param+"="+options.params[param];
		}
	}
	var url = '&module='+options.module+'&action='+options.action+escape(params);
	
	return GDownloadUrl(url, callback);
}

GMap2.prototype.feedMarkers = function (xml)
{
	var gmap = this;
	//var xml = GXml.parse(data);
	var markers = xml.documentElement.getElementsByTagName('Placemark');
	gmap.clearOverlays();

	if (markers.length == 0)
	{
//		gmap.setCenter(new GLatLng(40, -100), 4);
		var errorControl = new ErrorControl();
		errorControl.reset();
		gmap.removeControl(gmap.markerListControl);
		gmap.removeControl(gmap.errorControl);
		
		var errors = xml.documentElement.getElementsByTagName('error');
		for (var i = 0; i < errors.length; i++)
		{
			errorControl.addError(errors[i].firstChild.nodeValue);
		}
		gmap.addControl(errorControl);
		return;
	}

	var bounds = new GLatLngBounds();

	var markerListControl = new MarkerListControl();
	markerListControl.reset();
	gmap.removeControl(gmap.markerListControl);
	gmap.removeControl(gmap.errorControl);
	
	for (var i = 0; i < markers.length; i++)
	{
		var name = markers[i].getElementsByTagName('name')[0].firstChild.nodeValue;
		var description = markers[i].getElementsByTagName('description')[0].firstChild.nodeValue;
		var coordinates = markers[i].getElementsByTagName('coordinates')[0].firstChild.nodeValue;
		var separatorIdx = coordinates.indexOf(',');
		var lng = parseFloat(coordinates.substring(0, separatorIdx));
		var lat = parseFloat(coordinates.substring(separatorIdx+1));

		var point = new GLatLng(lat, lng);
		
		var markerOptions = {
			title: name
		};
		
		var marker = gmap.createMarker(point, '<strong>'+name+'</strong><br/>'+description, markerOptions);
		gmap.addOverlay(marker);
		bounds.extend(point);
		markerListControl.addMarker(marker);
	}
	
	var zoom = gmap.goToMarkerOptions.zoom;
	if(markers.length > 1)
	{
		gmap.addControl(markerListControl);
		var zoom = gmap.getBoundsZoomLevel(bounds);
	}
	gmap.setCenter(bounds.getCenter(), zoom);
}

GMap2.prototype.showMarkers = function ()
{
	var gmap = this;
	var markers = gmap.markers;
	gmap.clearOverlays();

	var bounds = new GLatLngBounds();

	var markerListControl = new MarkerListControl();
	markerListControl.reset();
	gmap.removeControl(gmap.markerListControl);
	gmap.removeControl(gmap.errorControl);
	
	var length = 0;
	for (var id in markers)
	{
		length++;
		var marker = markers[id];
		var point = marker.getPoint();
		gmap.addOverlay(marker);
		bounds.extend(point);
		markerListControl.addMarker(marker);
	}
	
	var zoom = gmap.goToMarkerOptions.zoom;
	if(length > 1)
	{
		gmap.addControl(markerListControl);
		var zoom = gmap.getBoundsZoomLevel(bounds);
	}
	gmap.setCenter(bounds.getCenter(), zoom);
}	