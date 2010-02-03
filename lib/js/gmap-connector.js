var gmapLoaded;
if(!gmapLoaded)
{
	gmapLoaded = true;
	
	var params = {
		file:	'api',
		v:		'2',
		key:	gmapConfig.key
	};
	
	var url = "http://maps.google.com/maps";
	
	var first = true;
	for(var param in params)
	{
		if(first)
		{
			url += '?';
		}
		else
		{
			url += "&amp;";
		}
		url += param+'='+params[param];
		first = false;
	}
	document.write('<script src="'+url+'" type="text/javascript"></script>');
	
	var oldUnload = window.onunload;
	window.onunload = function()
	{
		if(typeof oldUnload == "function")
			oldUnload();
		GUnload();
	}
	
	var gmap;
	var geocoder;
}