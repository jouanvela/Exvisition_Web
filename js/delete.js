jQuery(document).ready(function($) {
	$('.fackDelete').click(function(event) {

		event.preventDefault();
		if(confirm("確定要刪除嗎?")){
			console.log($(this));
			console.log($(this).next('a').attr("href"));
			$(this).next('a')[0].click();
		}
	});
});