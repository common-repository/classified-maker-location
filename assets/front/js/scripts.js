jQuery(document).ready(function($)
	{

		var arr_data_loc = [];
		
		$(document).on('keyup', '.post-ads .location', function(){
			
			
			//alert('Hello');
			
			
			var location = $(this).val();

			//
			//$(this).val(location);
			//alert(location);
			
			
			if( location != '' ) {
				
				
				
				$.ajax(
					{
				type: 'POST',
				context: this,
				url:classified_maker_loc_ajax.classified_maker_loc_ajaxurl,
				data: {
					"action": "classified_maker_loc_ajax_add_suggestion", 
					"location":location,
				},
				success: function(arr_html) {
					
					//alert(arr_html);
					//alert(location);
					
					$.each( JSON.parse(arr_html) , function( index, val ) {
						arr_data_loc.push( { value: val, data: val } );
					});
					
					arr_data_loc = arr_unique(arr_data_loc);	
				}
				
					});
			}
		})
		
		$('.post-ads .location').autocomplete({
			lookup: arr_data_loc,
			onSelect: function (suggestion) {
				//var keyword = $('.big-search-box .job-keyword').val();
				//var data_url = $('.big-search-box .job-submit').attr('data-url');
				//$('.submit-wrap .job-submit').attr('url-send',data_url+"?keywords="+keyword+"&locations="+suggestion.value);
			}
		});
		
		
		
		
	});	


	function arr_unique(arr) {
		var i,
			len = arr.length,
			out = [],
			obj = { };

		for (i = 0; i < len; i++) {
			obj[arr[i]] = 0;
		}
		for (i in obj) {
			out.push(i);
		}
		return out;
	};





