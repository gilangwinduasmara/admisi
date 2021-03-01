$("#create_panitia").click(function(){
	const modal = $('#modal__data_user')
	modal.find('.modal-body');
	modal.modal('show')
})

$("#table_data_pendaftar").on('click', '[data-toggle="validasi_pembayaran"]', function(){
	const data = {
		pembayaran_id: $(this).data('id')
	}
	Swal.fire({
        title: "Validasi Pemabayaran",
        text: "Apakah Anda yakin akan memvalidasi pembayaran camaru atas nama "+$(this).data('nama'),
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Validasi",
        cancelButtonText: "Tidak",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {
            post(BASE_URL+'/api/admin/validasi_pembayaran', data)
        }
    });
})

$('#table_data_registrasi_ulang').on('click', '[data-toggle="validasi_registrasi_ulang"]', function(){
	const data = {
		registrasi_ulang_id: $(this).data('id')
	}
	Swal.fire({
        title: "Validasi Pemabayaran",
        text: "Apakah Anda yakin akan memvalidasi registrasi ulang atas nama "+$(this).data('nama'),
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Validasi",
        cancelButtonText: "Tidak",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {
            post(BASE_URL+'/api/admin/validasi_pembayaran_registrasi_ulang', data)
        }
    });
})

$('#table_data_camaru').on('click','[data-toggle="data-camaru-edit"]',function (){
	$('#modal__data_camaru_edit').modal('show')
	axios.get(BASE_URL+'/service/api/pendaftaran?id='+$(this).data('id')).then(res => {
		$('[name="prodi_1_id"]').val(res.data.hasil_penerimaan[0].id)
		$('[name="modal__data_camaru_edit_pilihan_1"]').val(res.data.hasil_penerimaan[0].prodi.nama_prodi)
		$('[name="prodi_1_status"]').val(res.data.hasil_penerimaan[0].status)
		if(res.data.hasil_penerimaan[0].status != "DIPROSES"){
			console.log(res.data.hasil_penerimaan[0].status)
			$('[name="prodi_1_status"]').attr('disabled', true)
		}else{
			$('[name="prodi_1_status"]').attr('disabled', false)
		}
		$('[name="prodi_2_id"]').val(res.data.hasil_penerimaan[1].id)
		$('[name="modal__data_camaru_edit_pilihan_2"]').val(res.data.hasil_penerimaan[1].prodi.nama_prodi)
		$('[name="prodi_2_status"]').val(res.data.hasil_penerimaan[1].status)
		if(res.data.hasil_penerimaan[1].status != "DIPROSES"){
			$('[name="prodi_2_status"]').attr('disabled', true)
		}else{
			$('[name="prodi_2_status"]').attr('disabled', false)
		}
		
	}).catch(err => {
		console.log(err)
	})
})

$('#table_data_camaru').on('click','[data-toggle="data-camaru-detail"]', function(){
	$('#data-selector').val('DATA_PERSONAL')
	$('#modal__data_camaru_detail').modal('show')
	axios.get(BASE_URL+"/service/api/pendaftaran?id="+$(this).data('id')).then(res => {
		showDataDiri(res.data)
		$('#data-selector').change(function(){
			if($(this).val() == 'DATA_PERSONAL'){
				showDataDiri(res.data)
			}
			if($(this).val() == 'DATA_WALI'){
				showDataWali(res.data.detail_wali)
			}
			if($(this).val() == 'DATA_PENDIDIKAN'){
				showPendidikan(res.data.detail_pendidikan)
			}
			if($(this).val() == 'UNGGAH_BERKAS'){
				showUnggahBerkas(res.data)
			}
		})
	})
})


function showDataWali(data){
	console.log(data)
	const dataEl = $('#detail_body > .data')
	dataEl.empty()
	const dataDiri = {
		'NIK': 'NIK',
		'nama': 'Nama',
		'no_hp': 'No. HP',
		'email': 'Email',
		'pendidikan_terakhir': 'Pendidikan Terakhir',
		'pekerjaan': 'Pekerjaan',
		'nama_instansi': 'Nama Instansi',
		'alamat_instansi': 'Alamat Instansi',
		'telp_instansi': 'Telp Instansi',
		'penghasilan_perbulan': 'Penghasilan Perbulan',
		'nama_ibu_kandung': 'Nama Ibu Kandung',
		'status_hubungan': 'Status Hubungan',
	}
	Object.keys(dataDiri).map((key) => {
		dataEl.append(`
			<div class="form-group">
				<label>${dataDiri[key]}</label>
				<input class="form-control" disabled value="${data[key]}">
			</div>
		`)
	})
}

function showUnggahBerkas(data){
	console.log(data)
	const dataEl = $('#detail_body > .data')
	dataEl.empty()
	const dataBerkas = {
		'upload_foto': 'Foto' ,
		'upload_kk': 'KK' ,
		'upload_akta_lahir': 'Akta Lahir' ,
		'upload_srt_pernyataan': 'Surat Pernyataan'
	}
	Object.keys(dataBerkas).map((key) => {
		dataEl.append(`
			<div class="form-group">
				<label>${dataBerkas[key]}</label>
				<a class="btn btn-primary form-control" download href="${BASE_URL}/uploads/${data[key]}">Unduh Berkas</a>
			</div>
		`)
	})
	dataEl.append(`<div class="separator separator-solid mb-4"></div>`)
}
function showPendidikan(data){
	console.log(data)
	const dataEl = $('#detail_body > .data')
	dataEl.empty()
	const dataPendidikan = {
		'status': 'Jenjang' ,
		'jurusan': 'Jurusan' ,
		'npsn': 'NPSN' ,
		'tahun_lulus': 'Tahun Masuk' ,
		'tahun_masuk': 'Tahun Lulus' ,
	}
	const dataFile = {
		'upload_ijazah': 'Ijazah' ,
		'upload_daftar_nilai': 'Daftar Nilai'
	}
	data.map((pendidikan) => {
		Object.keys(dataPendidikan).map((key) => {
			console.log(key)
			dataEl.append(`
				<div class="form-group">
					<label>${dataPendidikan[key]}</label>
					<input class="form-control" disabled value="${pendidikan[key]}">
				</div>
			`)
		})
		Object.keys(dataFile).map((key) => {
			console.log(key)
			dataEl.append(`
				<div class="form-group">
					<label>${dataFile[key]}</label>
					<a class="btn btn-primary form-control" download href="${BASE_URL}/uploads/${pendidikan[key]}">Unduh Berkas</a>
				</div>
			`)
		})
		dataEl.append(`<div class="separator separator-solid mb-4"></div>`)
	})
}


function showDataDiri(data){
	console.log(data)
	const dataEl = $('#detail_body > .data')
	dataEl.empty()
	const dataDiri =  {
		'NISN':  'NISN',
		'NIK':  'NIK',
		'email':  'Email',
		'no_hp': 'No. HP',
		'kota_kelahiran': 'Kota Kelahiran',
		'tgl_lahir': 'Tanggal Lahir',
		'pekerjaan':  'Pekerjaan',
		'status_sipil': 'Status Pernikahan',
		'gol_darah': 'Golongan Darah',
		'tinggi_badan': 'Tinggi Badan',
		'berat_badan': 'Berat Badan',
		'alamat_asal': 'Detail Alamat'
	}
	Object.keys(dataDiri).map((key) => {
		dataEl.append(`
			<div class="form-group">
				<label>${dataDiri[key]}</label>
				<input class="form-control" disabled value="${data[key]}">
			</div>
		`)
	})
}


