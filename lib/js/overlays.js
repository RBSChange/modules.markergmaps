$(function(){
	$(".gmapsoverlay").click(function(){
		m = $(this).attr('m');
		n = $(this).attr('n');
		if($(this).is(':checked')) { eval(m + '[' + n + '].show();'); }
		else { eval(m + '[' + n + '].hide();');  }
	});
});