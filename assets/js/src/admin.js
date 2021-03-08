$('[data-toggle="create_gelombang"').click(function(){
	$('#modal_create_gelombang').modal('show')
})

$("#create_panitia").click(function(){
	const modal = $('#modal__data_user')
	modal.find('.modal-body');
	modal.modal('show')
})

$('#table_master_tahun_akademik').on('click', '[data-toggle="set_tahun_akademik"]', function(){
	const data = {
		tahun_akademik_id: $(this).data('id')
	}
	Swal.fire({
        title: "Tahun Akdemik",
        text: "Apakah Anda yakin akan menggunakan tahun akademik "+$(this).data('tahun_akademik')+"?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Ya",
        cancelButtonText: "Tidak",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {
            post(BASE_URL+'/api/admin/set_tahun_akademik', data)
        }
    });
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


$(document).ready(function(){
	const chartEl = $('#chart')

	

	fetch(BASE_URL+'/api/admin/chart', {
		headers: {
			'Content-type': 'application/json'
		}
	}).then(res => {
		res.json().then(data => {
			console.log(data)
			$('#formulir_keluar').text(data.formulir_keluar)
			$('#formulir_submit').text(data.formulir_submit)
			$('#daftar_ulang').text(data.daftar_ulang)
			$('#daftar_omb').text(data.daftar_omb)
			let mendaftar = data.mendaftar.map((item, index) => (item.count))
			let registrasi_ulang = data.registrasi_ulang.map((item, index) => (item.count))

			const options = {
				series: [
				  {
					name: "Mendaftar",
					data: mendaftar
				  },
				  {
					name: "Registrasi Ulang",
					data: registrasi_ulang
				  }
				],
				chart: {
				  type: "bar",
				  height: 350
				},
				plotOptions: {
				  bar: {
					horizontal: false,
					columnWidth: "15%",
					endingShape: "rounded"
				  }
				},
				dataLabels: {
				  enabled: false
				},
				stroke: {
				  show: true,
				  width: 2,
				  colors: ["transparent"]
				},
				xaxis: {
				  
				  categories: [ ...data.prodi],
				  labels: {
					style: {
						colors: [],
						fontSize: '10px',
						fontFamily: 'Helvetica, Arial, sans-serif',
						cssClass: 'apexcharts-xaxis-label',
					},
					trim: true
				  }
				},
				yaxis: {
				  title: {
					text: "Formulir"
				  }
				},
				fill: {
				  opacity: 1
				},
			};
			var chart = new ApexCharts(document.querySelector("#chart"), options);
			chart.render();

		})
	})

})
