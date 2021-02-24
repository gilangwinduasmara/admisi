$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip()
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

$('[name="kewarganegaraan"]').change(function(){
	onKewarganegaraanChange($(this))
})

$(document).ready(function(){
	if($('[name="kewarganegaraan"]').length){
		onKewarganegaraanChange($('[name="kewarganegaraan"]:checked'))
	}
})

function onKewarganegaraanChange(el){
	console.log(el.val())
	if(el.val() == 'WNI'){
		$('[name="negara"]').attr('disabled', true)
		$('[name="negara"]').parent().parent().hide()
		$('[name="provinsi"]').attr('disabled', false)
		$('[name="kota_kab"]').attr('disabled', false)
		$('[name="kecamatan"]').attr('disabled', false)
		$('[name="kelurahan"]').attr('disabled', false)
		$('[name="provinsi"]').parent().parent().parent().show()
		$('[data-target="daerah_selector"]').parent().parent().show()
	}else{
		$('[name="negara"]').attr('disabled', false)
		$('[name="negara"]').parent().parent().show()
		$('[name="provinsi"]').attr('disabled', true)
		$('[name="kota_kab"]').attr('disabled', true)
		$('[name="kecamatan"]').attr('disabled', true)
		$('[name="kelurahan"]').attr('disabled', true)
		$('[name="provinsi"]').parent().parent().parent().hide()
		$('[data-target="daerah_selector"]').parent().parent().hide()
	}
}

$('[name="prodi_1_id"]').change(function(){
	// $('[name="prodi_2_id"]').html($('[name="prodi_1_id"]').html());
	// if($(this).val()!=""){
	// 	$('[name="prodi_2_id"] > option[value="'+$(this).val()+'"]').remove();
	// 	setTimeout(() => {
	// 		$('[name="prodi_2_id"]').val("")
	// 	}, 200)
	// }
	// if($(this).val()==$('[name="prodi_2_id"]').val()){
		
		
	// }else{
	// 	$('[name="prodi_2_id"]').html($('[name="prodi_1_id"]').html());
	// }
})

function post(path, params={}){
	console.log('begin post')
	const form = document.createElement('form');
	form.method = "post";
	form.action = path;
	Object.keys(params).map((key) => {
		const inputField = document.createElement('input')
		inputField.name = key
		inputField.value = params[key]
		form.appendChild(inputField)
	})
	
	document.body.appendChild(form)
	form.submit();
	return form;
}

$('.dropdown-toggle').click(function(){
	$(this).click()
})

$('.dropdown-item').click(function(){
	window.location.href = $(this).attr('href')
})


