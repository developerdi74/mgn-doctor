$(document).ready(function(){
	$('.services-directory').click(function(e){																											// подгрузить услуги
		// e.preventDefault();
		// e.stopPropagation();
		var services=$(this).closest('.card').find('.card-body');
		if(!services.hasClass('loaded')){
			$.ajax({
				type:"POST",
				url:"/include/ajax/services-list.php",
				data:{
					'id':$(this).data('id'),
				},
				dataType:'html',
				cache:false,
				success:function(data){
					services.html(data).addClass('loaded');
					servHandlerInit();
				},
				error:function(jqXHR, exception){
					console.log('ERROR');
				},
			});
		}
		else{
			// services.slideDown().toggleClass('open');
		}
		// return false;
	});

});

function servHandlerInit(){
	$('.service-order').click(function(){
		text=$.trim($(this).find('h6').text())+'     '+$.trim($(this).find('.price').text());
		$('textarea[name="form_textarea_24"]').val(text);
	});
}