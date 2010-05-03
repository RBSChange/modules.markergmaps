function SVC(svdiv, pano, map, controluiselector, controltextselector, icon, flyicon, dragicon, closeicon, svbutton){
  this._svclient = new GStreetviewClient();
  this._map = map;
  this._pano = new GStreetviewPanorama(pano);
  this._pano_container = pano;
  this._container = svdiv;
  this._controlUI = jQuery(controluiselector)[0];
  this._controlText = jQuery(controltextselector)[0];
  this._overlay = new GStreetviewOverlay();
  this._icon_image = icon;
  this._drag_image = dragicon;
  this._fly_image = flyicon;
  this._close_image = closeicon;
  this._svbutton = svbutton;
};
SVC.prototype = new GControl();
SVC.prototype.initialize = function(map){
  var control = this;
  this._map = map;
  this._control_left = this._svbutton.left;
  this._control_top = this._svbutton.top;
  this.place_man();
  GEvent.addListener(this._map, "move", function(){
    control.place_man();
  });
  this._click_trigger = this._controlText;
  this._map.getContainer().appendChild(this._container);
  this.enableDraggableControl();
  return this._container;
};
SVC.prototype.place_man = function(){
  var control = this,
      jqmap = jQuery(this._map.getContainer()),
      micon = this.man_icon(),
      bb = this._map.getBounds(),
      px_left = this._control_left,
      px_top = this._control_top+(micon.iconSize.height),
      px_point = new GPoint(px_left, px_top);
      px_latlng = this._map.fromContainerPixelToLatLng(px_point);
      ;
  this._man_position = px_latlng;
  if(this._man_marker == null){
    this._man_marker = new GMarker(this._man_position, {icon:micon, draggable:true});
    this._map.addOverlay(this._man_marker);
  }
  else {
  	this._man_marker.hide();
  	this._man_marker.setLatLng(this._man_position);
  	this._man_marker.setImage(this._icon_image.path);
		this._man_marker.show();
  }

};
SVC.prototype.man_icon = function(){
  var guy = new GIcon(G_DEFAULT_ICON);
  guy.image = this._icon_image.path;
  guy.transparent = true;
  guy.shadow = false;
  guy.shadowSize = new GSize(false,false);
  guy.iconSize = new GSize(this._icon_image.width, this._icon_image.height);
  guy.dragCrossImage = this._drag_image.path;
  guy.dragCrossSize = new GSize(this._drag_image.width, this._drag_image.height);
  guy.dragCrossAnchor = new GPoint(25, 25);
  return guy;
};

SVC.prototype.addSVOverlay = function(){
  this._map.addOverlay(this._overlay);
  this._layer_enabled = true;
};
SVC.prototype.removeSVOverlay = function(){
  this._map.removeOverlay(this._overlay);
  this._layer_enabled = false;
};
SVC.prototype.dragError = function(){
  this.removeSVOverlay();
  this.place_man();
  return;
};
SVC.prototype.enableDraggableControl = function(){
  var control = this;
  GEvent.addListener(this._man_marker, 'dragstart', function(){
  	control._man_marker.hide();
	  control._man_marker.setImage(control._fly_image);
	  control._man_marker.show();
  	control.removeSVOverlay();
    control.addSVOverlay();
  });

  GEvent.addListener(this._pano, "error", function(){
    return control.dragError();
  });

  GEvent.addListener(this._man_marker, 'dragend', function(){
    var ll = control._man_marker.getLatLng();
    control._svclient.getNearestPanorama(ll,function(res){
      if(res.code == 200){
      	control.append_close_button();
        control._pano.setLocationAndPOV(res.location.latlng, res.location.pov);
        jQuery(control._pano_container).show().css('margin-top', "-"+jQuery(control._map.getContainer()).outerHeight()+'px');
      }
      else{
        return control.dragError();
      }
    });
  });
};
SVC.prototype.create_iframe = function (b) {
    var c = document.createElement("iframe");
    c.style.zIndex = "3";
    if (b.left) {
        c.style.left = b.left
    }
    if (b.right) {
        c.style.right = b.right
    }
    if (b.top) {
        c.style.top = b.top
    }
    if (b.bottom) {
        c.style.bottom = b.bottom
    }
    if (b.width) {
        c.style.width = b.width
    }
    if (b.height) {
        c.style.height = b.height
    }
    c.style.position = "absolute";
    c.frameBorder = "0";
    c.style.backgroundColor = "transparent";
    c.style.allowTransparency = "true";
    c.style.filter = "progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=0)";
    c.style.opacity = "0";
    return c
};
SVC.prototype.append_close_button = function () {
	var control = this;
  control._iframe = this.create_iframe({
      right: "24px",
      top: "4px",
      height: "20px",
      width: "20px"
  });
  control._close_btn = document.createElement("div");
	control._close_btn.style.zIndex = "4";
	control._close_btn.style.cursor = "pointer";
	control._close_btn.style.width = "20px";
	control._close_btn.style.height = "20px";
	control._close_btn.style.top = "4px";
	control._close_btn.style.right = "24px";
	control._close_btn.style.position = "absolute";
	control._close_btn.title = control._close_image.title;
	control._close_btn.style.background = "transparent url("+control._close_image.path+")";
	GEvent.addDomListener(control._close_btn, "click", function(){
		control.removeSVOverlay();
    control.place_man();
    control._pano.remove();
    jQuery(control._pano_container).html("");
    jQuery(control._iframe).remove();
    jQuery(control._close_btn).remove();
	});
  control._map.getContainer().appendChild(control._iframe);
  control._map.getContainer().appendChild(control._close_btn);
};
SVC.prototype.getDefaultPosition = function() {
  return new GControlPosition(G_ANCHOR_TOP_LEFT, new GSize(10, 10));
};

SVC.prototype._icon_image = null;
SVC.prototype._fly_image = null;
SVC.prototype._drag_image = null;
SVC.prototype._close_image = null;
SVC.prototype._svclient = null;
SVC.prototype._map = null;
SVC.prototype._pano = null;
SVC.prototype._pano_container = null;
SVC.prototype._man_marker = null;
SVC.prototype._click_trigger = null;
SVC.prototype._container = null;
SVC.prototype._position = null;
SVC.prototype._controlUI = null;
SVC.prototype._controlText = null
SVC.prototype._layer_enabled = false;
SVC.prototype._overlay = null;
SVC.prototype._drag = null;
SVC.prototype._drag_start = null;
SVC.prototype._drag_end = null;
SVC.prototype._iframe = null;
SVC.prototype._close_btn = null;
SVC.prototype._svbutton = null;

(function(jQuery) {

  jQuery.fn.streetview = function(options){
    var config = jQuery.extend({}, jQuery.fn.streetview.data, options, {container:this});
    return this.each(function(){
      if(this.__sv) return;
      else this.__sv = true;
      jQuery.streetview.setup(config);
    });
  };

  jQuery.fn.streetview.data = {
	  map:false,
	  control:false,
	  selector_ids:{
	    map_container:false,
	    control_container:"sv_control",
	    control_ui:"sv_ui",
	    control_text:"sv_text",
	    street_view: "gstreetview"
		}
  };

  jQuery.streetview = {
    setup:function(config){
      var selectors = config.selector_ids;
      config.map_container = config.map.getContainer();
      config.map_parent = jQuery(config.map_container).parent();
      if(!jQuery("#"+selectors.control_container).length){
        jQuery(config.map_parent).append('<div id="'+selectors.control_container+'"><div id="'+selectors.control_ui+'"><div id="'+selectors.control_text+'"></div></div></div>');
      }
      if(!jQuery("#"+selectors.street_view).length){
        jQuery(config.map_parent).append('<div style="width:'+config.width+'px; height:'+config.height+'px; margin-top:-'+config.height+'px;" id="'+selectors.street_view+'"></div>');
      }
      jQuery("#"+selectors.control_container)[0].index=1;
      config.control = new SVC(jQuery("#"+selectors.control_container)[0], jQuery("#"+selectors.street_view)[0], config.map,'#'+selectors.control_ui, '#'+selectors.control_text, config.icon, config.flyicon, config.dragicon, config.closeicon, config.svbutton);
      config.map.addControl(config.control);
    }
  };

})(jQuery);