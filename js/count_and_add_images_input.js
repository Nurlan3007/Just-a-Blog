$(document).ready(function(){
	$('#return').hide();
	$('#click').on('click',function(){
		let count_images = $('#count_images').val();
		if(count_images <= 5){
			for(let i = 0;i < count_images; i++){
				$('.images').append('<input type="file" name="images_'+i+'">');
			}
			$('#click').hide(); $('#count_images').hide();
			$('#return').show();
		}
		$('#count_images').val('');
	});
});