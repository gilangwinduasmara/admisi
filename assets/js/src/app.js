$(document).ready(function(){
	if($('.dropzone').length){
		$('.dropzone').dropzone({url: "/"});
	}
})

$('#kt_repeater_1').repeater({
	initEmpty: false,

	defaultValues: {
		'text-input': 'foo'
	},

	show: function () {
		$(this).slideDown();
	},

	hide: function (deleteElement) {
		$(this).slideUp(deleteElement);
	}
});



