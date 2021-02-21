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
			{
				name: 'provinsi',
				label: 'Provinsi',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'kota_kab',
				label: 'Kabupaten',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'kecamatan',
				label: 'Provinsi',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'kelurahan',
				label: 'Kabupaten',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
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
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'provinsi[]',
				label: 'Provinsi',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'kota_kab[]',
				label: 'Kabupaten',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'upload_ijazah[]',
				label: 'Ijazah',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'upload_daftar_nilai[]',
				label: 'Daftar nilai',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
		]
	},
	unggah_berkas: {
		fields: [
			{
				name: 'upload_foto',
				label: 'Foto',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'upload_kk',
				label: 'KK',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'upload_akta_lahir',
				label: 'Akta Lahir',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'upload_srt_pernyataan',
				label: 'Surat Pernyataan',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
		]
	},
	informasi_pembayaran: {
		fields: [
			{
				name: 'metode_pembayaran',
				label: 'Metode Pembayaran',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
		]
	},
	upload_bukti_bayar: {
		fields: [
			{
				name: 'pembayaran_id',
				label: 'No Pembayaran',
				rules: {
					required: true,
				}
			},
			{
				name: 'pembayaran_id',
				label: 'No Pembayaran',
				rules: {
					required: true,
				}
			},
			{
				name: 'total_bayar',
				label: 'Total Bayar',
				rules: {
					required: true,
				}
			},
			{
				name: 'upload_bukti',
				label: 'Bukti Bayar',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
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
	validate(form)
	if($(".is-invalid").length==0){
		form.submit();
	}
})

$(document).ready(function(){
	Object.keys(forms).map((key) => {
		forms[key].fields.map((field) => {
			$(`[name="${field.name}"]`).change(function(){
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
	let isError = false;
	$.each($(`[name="${field.name}"]`),function(){
		console.log($(this).attr('name'))
		let currentField = $(this)	
		if(!$(this).attr('disabled')){
			if(field.rules.required){
				resetError(currentField)
				if(currentField.val() == ""){
					let errorDict = field.dict?.required!=null?field.dict.required : validationDict.required
					let error = errorDict.replace('%label%', field.label)
					setInvalid(currentField, error)
					isError = true
				}
			}
			if(field.rules.max){
				resetError(currentField)
				if(currentField.val().length > field.rules.max){
					let error = validationDict.max.replace('%label%', field.label).replace('%max%', field.rules.max)
					setInvalid(currentField, error)
					isError = true
				}
			}
		
			if(field.rules.max){
				resetError(currentField)
				if(currentField.val().length < field.rules.min){
					let error = validationDict.max.replace('%label%', field.label).replace('%min%', field.rules.min)
					setInvalid(currentField, error)
					isError = true
				}
			}
		}else{
			return isError = false;
		}
	})
	return !isError
	
}

function setInvalid(field, error){
	console.log('set invalid', console.log(error))
	field.addClass('is-invalid')
	field.after('<div class="invalid-feedback">'+error+'</div>')
}

function resetError(field){
	field.removeClass('is-invalid')
	field.next().remove()
}






// //////////////////////////
$('[name="jenis_pembayaran"]').change(function(){
	$('[name="metode_pembayaran"]').val($(this))
})
