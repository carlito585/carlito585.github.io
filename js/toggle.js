jQuery(document).ready(function($){

	$('.container').each(function(index, element){
		$(this).find('.toggle-content').hide();
	});

	$('.container .toggle-title a .details').click(function(event){
		event.preventDefault();
		$(this).toggleClass('active').parent().parent().siblings('.toggle-content').slideToggle('fast');

	});
});
