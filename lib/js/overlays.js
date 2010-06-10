jQuery(function(){
	jQuery(".gmapsoverlay").click(function(){
		m = jQuery(this).attr('m');
		n = jQuery(this).attr('n');
		if(jQuery(this).is(':checked')) { eval(m + '[' + n + '].show();'); }
		else { eval(m + '[' + n + '].hide();');  }
	});
});