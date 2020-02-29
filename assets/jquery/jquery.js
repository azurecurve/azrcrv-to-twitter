jQuery(document).ready(function() {
	
	jQuery('.nav-tab-wrapper-azrcrv-tt .nav-tab').on('click',function(event) {
		var item_to_show = '.azrcrv_tt_tabs' + jQuery(this).data('item');

		jQuery(this).siblings().removeClass('nav-tab-active');
		jQuery(this).addClass("nav-tab-active");
		
		jQuery(item_to_show).siblings().css('display','none');
		jQuery(item_to_show).css('display','block');
	});
	
});

function countChar(val) {
	var len = val.value.length;
	if (len >= 240) {
		val.value = val.value.substring(0, 240);
	} else {
		$('#current_counter').text(240 - len);
	}
};