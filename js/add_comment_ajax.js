$(document).ready(function(){
	$('#send').on('click',function(){
		let ValArticalId = $('#artical_id').val();
		let ValComment = $('#text').val();
		$.ajax({
			method:"POST",
			url:"/AddComment",
			data:{
				artical_id: ValArticalId,
				comment: ValComment
			}
		})
		.done(function(message){
			$('.value').append(message);
			$('#text').val('');
		});
	});
});