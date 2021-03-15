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
					required: true,
					email: true
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
				name: 'rt',
				label: 'RT',
				rules: {
					required: true
				}
			},
			{
				name: 'rw',
				label: 'RW',
				rules: {
					required: true
				}
			},
			{
				name: 'agama',
				label: 'Agama',
				rules: {
					required: true
				}
			},
			{
				name: 'suku',
				label: 'Suku',
				rules: {
					required: true
				}
			},
			{
				name: 'status_tinggal',
				label: 'Status Tinggal',
				rules: {
					required: true
				}
			},
			{
				name: 'KK',
				label: 'No Kartu Keluarga',
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
					required: true,
					email: true
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
			{
				name: 'alamat',
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
			}
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
				name: 'upload_ijazah',
				label: 'Ijazah',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
			{
				name: 'upload_daftar_nilai',
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
				name: 'jenis_pembayaran',
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
	up_bukti_pembayaran: {
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
				name: 'bank_pengirim',
				label: 'Asal Bank Pengirim',
				rules: {
					required: true,
				}
			},
			{
				name: 'no_rek_pengirim',
				label: 'No Rek Pengirim',
				rules: {
					required: true,
				}
			},
			{
				name: 'nama_rek_pengirim',
				label: 'Nama Rek Pengirim',
				rules: {
					required: true,
				}
			},
			{
				name: 'tgl_transfer',
				label: 'Tanggal Transfer',
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
	},
	data_akademik: {
		fields: [
			{
				name: 'prodi_1_id',
				label: 'Pilihan Pertama',
				rules: {
					required: true
				}
			},
			{
				name: 'jenis_prestasi[]',
				label: 'Jenis Prestasi',
				rules: {
					required: true
				}
			},
			{
				name: 'nama_kegiatan[]',
				label: 'Nama Kegiatan',
				rules: {
					required: true
				}
			},
			{
				name: 'tgl_kegiatan[]',
				label: 'Tanggal Kegiatan',
				rules: {
					required: true
				}
			},
			{
				name: 'unggah_bukti_prestasi[]',
				label: 'Unggah Bukti Prestasi',
				rules: {
					required: true,
				},
				dict: {
					required: '%label% belum dipilih'
				}
			},
		]
	},
	submit: {
		fields: []
	},
	register: {
		fields: [
			{
				name: "nama",
				label: "Nama",
				rules: {
					required: true
				}
			},
			{
				name: "no_hp",
				label: "No. Hp",
				rules: {
					required: true
				}
			},
			{
				name: "email",
				label: "Email",
				rules: {
					required: true,
					email: true
				}
			},
			{
				name: "password",
				label: "Password",
				rules: {
					required: true,
					min: 8
				}
			},
			{
				name: "confirm_password",
				label: "Konfirmasi",
				rules: {
					required: true,
					sameAs: "password"
				}
			}
		]
	}
}

const validationDict = {
	required: '%label% harus diisi',
	min: '%label% harus minimal %min% karakter',
	max: '%label% tidak boleh lebih dari %max% karakter',
	sameAs: '%label% harus sama dengan %ref%',
	email: 'Format email tidak sesuai'
}

$('.lanjut').click(function(){
	$('.collapse').addClass('show')
	let form = $(this).closest('form')
	validate(form)
	if($(".is-invalid").length==0){
		switch($('.lanjut').parentsUntil("form").parent().attr('name')){
			case 'submit':
				Swal.fire({
					title: "Submit",
					text: "Sebelum melakukan submit, pastikan data dan informasi CAMARU sudah sesuai dan benar.",
					icon: "warning",
					showCancelButton: true,
					confirmButtonText: "Submit",
					cancelButtonText: "Batal",
					reverseButtons: true
				}).then(function(result) {
					if (result.value) {
						form.submit();
					}
				});
				break
			default:
				form.submit();
		}
	}else{
		$([document.documentElement, document.body]).animate({
			scrollTop: $(".is-invalid").offset().top-200
		}, 500);
	}
})

$(document).ready(function(){
	Object.keys(forms).map((key) => {
		forms[key].fields.map((field) => {
			$(`[name^="${field.name}"]`).change(function(){
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

function validateSize(file) {
	var FileSize = file[0].files[0].size / 1024 / 1024; // in MiB
	if (FileSize > 2) {
		$(file).val('');
		return false
	} else {
		return true
	}
}

$('input[type="file"]').change(function(){
	// if(!validateSize($(this))){
	// 	setInvalid($(this), "tes")
	// }
})

function validateField(field){
	let isError = false;
	$.each($(`[name^="${field.name}"]`),function(){
		let currentField = $(this)	
		if(!$(this).attr('disabled')){
			if(field.rules.required){
				resetError(currentField)
				if(!currentField.val()){
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
			if(field.rules.min){
				resetError(currentField)
				if(currentField.val().length < field.rules.min){
					let error = validationDict.min.replace('%label%', field.label).replace('%min%', field.rules.min)
					setInvalid(currentField, error)
					isError = true
				}
			}
			if(field.rules.sameAs){
				resetError(currentField)
				const refField = $(`[name="${field.rules.sameAs}"]`)
				if(currentField.val() != refField.val()){
					let error = validationDict.sameAs.replace('%label%', field.label).replace('%ref%', field.rules.sameAs)
					setInvalid(currentField, error)
					isError = true
				}
			}
			if(currentField.attr('type') == 'file'){
				console.log('input file')
				if(currentField[0].files[0]?.size){
					var fileSize = currentField[0].files[0].size / 1024 / 1024; // in MiB
					if (fileSize > 2) {
						isError = true
						setInvalid(currentField, "Ukuran berkas melebihi batas 2MB")
					} 
				}
			}
			if(field.rules.email){
				resetError(currentField)
				const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if(!re.test(String(currentField.val()).toLowerCase())){
					let error = validationDict.email
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
	console.log('set invalid', console.log(error), console.log(field.attr('name')))
	field.addClass('is-invalid')
	field.after('<div class="invalid-feedback">'+error+'</div>')
}

function resetError(field){
	field.removeClass('is-invalid')
	field.parent().find('.invalid-feedback').remove()
	
}






// //////////////////////////
$('[name="jenis_pembayaran"]').change(function(){
	$('[name="metode_pembayaran"]').val($(this))
})
