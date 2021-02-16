const forms = {
	data_diri: {
		fields: [
			{
				name: 'NISN',
				label: 'NISN',
				rules: {
					required: true,
					max: 100,
					min: 5
				}
			},
			{
				name: 'NIK',
				label: 'NIK',
				rules: {
					required: true,
				}
			},
			{
				name: 'email',
				label: 'Email',
				rules: {
					required: true
				}
			},
			{
				name: 'no_hp',
				label: 'No. HP',
				rules: {
					required: true
				}
			},
			{
				name: 'kota_kelahiran',
				label: 'Kota Kelahiran',
				rules: {
					required: true
				}
			},
			{
				name: 'tgl_lahir',
				label: 'Tanggal Lahir',
				rules: {
					required: true
				}
			},
			{
				name: 'pekerjaan',
				label: 'Pekerjaan',
				rules: {
					required: true
				}
			},
			{
				name: 'status_sipil',
				label: 'Status Pernikahan',
				rules: {
					required: true
				}
			},
			{
				name: 'gol_darah',
				label: 'Golongan Darah',
				rules: {
					required: true
				}
			},
			{
				name: 'tinggi_badan',
				label: 'Tinggi Badan',
				rules: {
					required: true
				}
			},
			{
				name: 'berat_badan',
				label: 'Berat Badan',
				rules: {
					required: true
				}
			},
			{
				name: 'alamat_asal',
				label: 'Detail Alamat',
				rules: {
					required: true
				}
			},
		]
	},
	data_wali: {
		fields: [
			{
				name: 'NIK',
				label: 'NIK',
				rules: {
					required: true,
				}
			},
			{
				name: 'nama',
				label: 'Nama',
				rules: {
					required: true
				}
			},
			{
				name: 'no_hp',
				label: 'No. HP',
				rules: {
					required: true
				}
			},
			{
				name: 'email',
				label: 'Email',
				rules: {
					required: true
				}
			},
			{
				name: 'pendidikan_terakhir',
				label: 'Pendidikan Terakhir',
				rules: {
					required: true
				}
			},
			{
				name: 'pekerjaan',
				label: 'Pekerjaan',
				rules: {
					required: true
				}
			},
			{
				name: 'nama_instansi',
				label: 'Nama Instansi',
				rules: {
					required: true
				}
			},
			{
				name: 'alamat_instansi',
				label: 'Alamat Instansi',
				rules: {
					required: true
				}
			},
			{
				name: 'telp_instansi',
				label: 'Telp Instansi',
				rules: {
					required: true
				}
			},
			{
				name: 'penghasilan_perbulan',
				label: 'Penghasilan Perbulan',
				rules: {
					required: true
				}
			},
			{
				name: 'nama_ibu_kandung',
				label: 'Nama Ibu Kandung',
				rules: {
					required: true
				}
			},
			{
				name: 'status_hubungan',
				label: 'Status Hubungan',
				rules: {
					required: true
				}
			},
		]
	},
	data_pendidikan: {
		fields: [
			{
				name: 'npsn[]',
				label: 'NPSN',
				rules: {
					required: true,
				}
			},
			{
				name: 'jurusan[]',
				label: 'Jurusan/Program Studi',
				rules: {
					required: true,
				}
			},
			{
				name: 'tahun_masuk[]',
				label: 'Tahun Masuk',
				rules: {
					required: true,
				}
			},
			{
				name: 'tahun_lulus[]',
				label: 'Tahun Lulus',
				rules: {
					required: true,
				}
			},
			{
				name: 'sekolah[]',
				label: 'Sekolah',
				rules: {
					required: true,
				}
			},
		]
	}
}

const validationDict = {
	required: '%label% harus diisi',
	min: '%label% harus minimal %min% karakter',
	max: '%label% tidak boleh lebih dari %max% karakter',
}

$('.lanjut').click(function(){
	$('.collapse').addClass('show')
	let form = $(this).closest('form')
	if(validate(form)){
		form.submit();
	}else{
		console.log('scroll')
		$($(".is-invalid")[0]).get(0).scrollIntoView();
	}
})

$(document).ready(function(){
	Object.keys(forms).map((key) => {
		forms[key].fields.map((field) => {
			$(`[name="${field.name}"]`).keyup(function(){
				
				resetError($(this))
			})
		})
	})
})

function validate(form){
	let isValid = true
	forms[form.attr('name')].fields.map((field, index) => {
		if(!validateField(field)){
			isValid = false
		}
	})
	return isValid
}

function validateField(field){
	let currentField = $(`[name="${field.name}"]`)
	if(field.rules.required){
		resetError(currentField)
		if(currentField.val() == ""){
			let error = validationDict.required.replace('%label%', field.label)
			setInvalid(currentField, error)
			return false
		}
	}
	if(field.rules.max){
		resetError(currentField)
		if(currentField.val().length > field.rules.max){
			let error = validationDict.max.replace('%label%', field.label).replace('%max%', field.rules.max)
			setInvalid(currentField, error)
			return false
		}
	}

	if(field.rules.max){
		resetError(currentField)
		if(currentField.val().length < field.rules.min){
			let error = validationDict.max.replace('%label%', field.label).replace('%min%', field.rules.min)
			setInvalid(currentField, error)
			return false
		}
	}
	console.log(field.name)
	return true
}

function setInvalid(field, error){
	console.log('set invalid')
	field.addClass('is-invalid')
	field.after('<div class="invalid-feedback">'+error+'</div>')
}

function resetError(field){
	field.removeClass('is-invalid')
	field.next().remove()
}

