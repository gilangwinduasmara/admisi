$('input[type=number]').on('mousewheel', function(){
	var el = $(this);
	el.blur();
	setTimeout(function(){
	  el.focus();
	}, 10);
  })

$(document).ready(function(){
	
	$('.max-today').prop('max', function(){
		return new Date().toJSON().split("T")[0]
	})
	$('select').select2()
	console.log('select2')
	$('[data-toggle="tooltip"]').tooltip()
	if($('.dropzone').length){
		$('.dropzone').dropzone({url: "/"});
	}
	onKewarganegaraanChange($('[name="kewarganegaraan"]:checked'))
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
	setTimeout(() => {
		if($('[name="kewarganegaraan"]').length){
			onKewarganegaraanChange($('[name="kewarganegaraan"]:checked'))
		}
	}, 400)
})

function onKewarganegaraanChange(el){
	console.log(el.val())
	if(el.val() == 'WNI'){
		$('[name="rt"]').attr('disabled', false)
		$('[name="rw"]').attr('disabled', false)
		$('[name="rt"]').parent().parent().show()
		$('[name="rw"]').parent().parent().show()

		$('[name="negara"]').attr('disabled', true)
		$('[name="negara"]').parent().parent().hide()
		$('[name="provinsi"]').attr('disabled', false)
		$('[name="kota_kab"]').attr('disabled', false)
		$('[name="kecamatan"]').attr('disabled', false)
		$('[name="kelurahan"]').attr('disabled', false)
		$('[name="provinsi"]').parent().parent().parent().show()
		$('[data-target="daerah_selector"]').parent().parent().show()
	}else{
		$('[name="rt"]').attr('disabled', true)
		$('[name="rw"]').attr('disabled', true)
		$('[name="rt"]').parent().parent().hide()
		$('[name="rw"]').parent().parent().hide()
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

$('table').on('click','.img-preview', function(){
	$('#modalImagePreview').modal('show')
	$('.modal-image').attr('src', $(this).attr('src'))
})

$('table').on('click', '[data-toggle="sudah_bayar"]', function(){
	toastr.clear()
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-bottom-center",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};
	toastr.info('Anda sudah melakukan pembayaran')
})

$('[name="jenis_pembayaran"]').change(function(){
	$(`[data-info]`).hide()
	if($(this).val()){
		$('.info-pembayaran-wrapper').show()
		$(`[data-info="${$(this).val()}"]`).show()
	}else{
		$('.info-pembayaran-wrapper').hide()
	}
})


$('table').on('click', '[data-toggle="informasi-pembayaran"]', function(e){
	e.preventDefault();
	$('#modal_informasi_pembayaran').modal('show')
})

function formatDate(date){
	try{
		const splited = date.split("-")
		return splited[2]+"-"+splited[1]+"-"+splited[0]
	}catch(e){
		return date
	}
}


$(document).ready(function(){
	let i = 1;
	setInterval(()=>{
		if(i>=$('.pengumuman-slider').children().length){
			scrollDuration = 0
			i = 0;
		} else{
			scrollDuration = 500
		}
		let scrollVal = $($('.pengumuman-slider-item')[0]).width()*(i++)
		console.log(scrollVal)
		// $('.pengumuman-slider').scrollLeft(scrollVal)
		$('.pengumuman-slider').animate({scrollLeft: scrollVal}, scrollDuration)
	}, 25000)
})
