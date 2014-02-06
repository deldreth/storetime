$('.user').live('click', function (event) {
	var userId = $(this).data('userid');

	$.ajax({
		url : 'index.php/main/update',
		data : {
			userId : userId
		},
		success : function (response) {
			$.mobile.loadPage($('#store'), {reloadPage:true});
		}
	})
});