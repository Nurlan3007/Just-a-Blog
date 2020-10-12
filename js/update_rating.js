jQuery(document).ready(function() {
	jQuery('.rating_plus').on('click',function(){
		let plus_rating = 1;
		let artical_id = $(this).data('id');
		jQuery.ajax({
			type:"POST",
			url:"/update_rating",
			data:{
				rating:plus_rating,
				artical_id:artical_id
			}
		}).done(function(message){
			alert(message);
		});
	});
	
});