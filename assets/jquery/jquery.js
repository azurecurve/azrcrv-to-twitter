jQuery(document).ready(function() {
	ratio_mode();
	
	jQuery('#azrcrv_tt_time_selected').on('change',function() {
		ratio_mode();
	});
	
	jQuery('#azrcrv_tt_add_title').on('keypress',function(e) {
	    if(e.which == 13) {
			e.preventDefault();
	    	azrcrv_tt_add_query();
	    }
	});
	
	jQuery('#azrcrv_tt_add_element').click(function() {
		azrcrv_tt_add_query();
	});
	
	jQuery('#azrcrv_tt_elements_selected').on('click','.azrcrv_tt_button_remove',function(event) {
		event.preventDefault();
		jQuery(this).parent().remove();
	});
	
	jQuery('#azrcrv_tt_import_now').on('click',function(event) {
		jQuery('#azrcrv_tt_import_now').text('Running...');
		
		jQuery.post(ajaxurl, {action:'azrcrv_tt_event_start'}, function(response) {
			jQuery('#azrcrv_tt_import_now').text('Import Tweets');
		});
	});
	
	jQuery('.nav-tab-wrapper-azrcrv-tt .nav-tab').on('click',function(event) {
		var item_to_show = '.azrcrv_tt_tabs' + jQuery(this).data('item');

		jQuery(this).siblings().removeClass('nav-tab-active');
		jQuery(this).addClass("nav-tab-active");
		
		jQuery(item_to_show).siblings().css('display','none');
		jQuery(item_to_show).css('display','block');
	});
});

function ratio_mode() {
	var azrcrv_tt_ratio_value = jQuery('#azrcrv_tt_time_selected').val();
	
	if(azrcrv_tt_ratio_value == 'azrcrv_tt_weekly' || azrcrv_tt_ratio_value == 'azrcrv_tt_monthly') {
		jQuery('#azrcrv_tt_cycle_selectors').show();
	} else {
		jQuery('#azrcrv_tt_cycle_selectors').hide();
	}
	
	return true;
}

function azrcrv_tt_add_query() {
	if(jQuery('#azrcrv_tt_add_title').val().length != 0) {
		jQuery('#azrcrv_tt_elements_selected').append('<p style="text-align:lett;padding:5px;"><input class="button-primary azrcrv_tt_button_remove" type="button" name="delete" value="Delete"><input type="text" size="20" class="regular-text" name="azrcrv_tt_item_query['+jQuery('#azrcrv_tt_add_title').val()+'][value]" value="'+jQuery('#azrcrv_tt_add_title').val()+'">&nbsp;&nbsp;&nbsp;tag:&nbsp;<input type="text" size="20" name="azrcrv_tt_item_query['+jQuery('#azrcrv_tt_add_title').val()+'][tag]" value="'+jQuery('#azrcrv_tt_add_title').val()+'"></span></p>');
		jQuery('#azrcrv_tt_add_title').attr('value','')
	} else {
		alert('Fill the query string box!');
	}
}

function countChar(val) {
	var len = val.value.length;
	if (len >= 240) {
		val.value = val.value.substring(0, 240);
	} else {
		$('#current_counter').text(240 - len);
	}
};