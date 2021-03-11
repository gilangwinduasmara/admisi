const statusPembayaran = {
	"LUNAS": {
		label: "Sudah Bayar",
		color: "warning"
	},
	"VALIDASI": {
		label: "Menunggu Validasi",
		color: "info"
	},
	"BELUM LUNAS": {
		label: "Belum Bayar",
		color: "success"
	},
	"DITOLAK": {
		label: "Ditolak",
		color: "danger"
	}
}
const statusPenerimaan = {
	"DIPROSES": {
		label: "Diproses",
		color: "warning"
	},
	"DITERIMA": {
		label: "Diterima",
		color: "info"
	},
	"DITOLAK": {
		label: "Ditolak",
		color: "danger"
	}
}

const statusRegistrasiUlang = {
	"VALIDASI KEUANGAN": {
		label: "Sedang Validasi",
		color: 'info'
	},
	"BELUM BAYAR": {
		label: "Belum Registrasi",
		color: 'warning'
	},
	"LUNAS": {
		label: "Sudah Registrasi",
		color: 'success'
	},
}
let tableDataPendaftar = null
let tableDataOmb = null
let tableDataCamaru = null
let tableDataRegistrasiUlang = null
let tablePengumuman = null
let tableDataUser = null

$(document).ready(function(){

	

	let data_pendaftar = $('#data_pendaftar').DataTable({
		responsive: true,
		lengthMenu: [5, 10, 25, 50],
		pageLength: 10,
		language: {
			'lengthMenu': 'Display _MENU_',
		},
		// Order settings
		order: [[1, 'desc']]
	})
	// $('#data_pendaftar_filter').hide()
	$('#data_pendaftar_length').hide()

	$('#search_query').keyup(function(){
		data_pendaftar.search($(this).val()).draw()
	})
	$('#search_status_pembayaran').change(function(){
		data_pendaftar.columns(3).search($(this).val()).draw()
	})
	$('#search_status_penerimaan').change(function(){
		data_pendaftar.search($(this).val()).draw()
	})

	

	tableDataUser = $('#table_data_user').DataTable({
		buttons: [
			'pdfHtml5',
			'excelHtml5',
			'csvHtml5',
			'print',
			'copyHtml5',
		],
		"processing": true,
		"serverSide": true,
		"ordering": true, // Set true agar bisa di sorting
		"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		"ajax":
		{
			"url": BASE_URL+"/service/api/user/dt_user", // URL file untuk proses select datanya
			"type": "GET",
			"data": function(data){
				const date_from = $('#search_date_from').val()
				const date_to = $('#search_date_to').val()
				const jenis_user = $('#search_jenis_user').val()
				
				data.searchByJenisUser = jenis_user
				if(date_from && date_to){
					data.searchByFromDate = date_from
					data.searchByToDate = date_to
				}
				return data
			}
		},
		"deferRender": true,
		"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
		"columns": [
			{ "data": "id" }, // Tampilkan nis
			{ "data": "nama" },  // Tampilkan nama
			{ "data": "email" },  // Tampilkan nama
			{ "data": "no_hp" },  // Tampilkan nama
			{ 
				"data": "role",
				"render": function(data){
					if(data == 'PPMB'){
						return 'Panitia'
					}
					return 'User'
				}
			},  // Tampilkan nama
			
		],
	});
	
	tableDataPendaftar = $('#table_data_pendaftar').DataTable({
		buttons: [
			'pdfHtml5',
			'excelHtml5',
			'csvHtml5',
			'print',
			'copyHtml5',
		],
		"processing": true,
		"serverSide": true,
		"ordering": true, // Set true agar bisa di sorting
		"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		"ajax":
		{
			"url": BASE_URL+"/service/api/pendaftaran/dt_data_pendaftar", // URL file untuk proses select datanya
			"type": "GET",
			"data": function(data){
				const date_from = $('#search_date_from').val()
				const date_to = $('#search_date_to').val()
				const search_tahun_akademik = $('#search_tahun_akademik')
				// data.searchByTahunAkademik = search_tahun_akademik
				if(date_from && date_to){
					data.searchByFromDate = date_from
					data.searchByToDate = date_to
				}
				
				
				return data
			}
		},
		"deferRender": true,
		"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
		"columns": [
			{ "data": "id" }, // Tampilkan nis
			{ "data": "tahun_akademik" },  // Tampilkan nama
			{ "data": "nama" },  // Tampilkan nama
			{ 
				"data": "created_at", 
				"render": function(data, type, row){
					return data.split(" ")[0]
				}
			},  
			{ 
				"data": "status",
				"orderable": false,
				"render": function (data, type, row){
					let html = `<span class="label label-lg label-light-${statusPembayaran[data].color} label-inline">${statusPembayaran[data].label}</span>`
					return html
				}
			},
			{ 
				"data": "upload_bukti_bayar",
				"orderable": false,
				"render": function (data, type, row){
					if(data){
						return `<img class="img-preview" style="max-height: 50px; obj-fit: contain" src="${BASE_URL+'/uploads/'+data}">`
					}
					return ""
				}
			},  
			{
				"data": "jenis_pembayaran",
			},  
			{
				"render": function (data, type, row){
					return(
						`
							<div>
								<p>${row.nama_rek_pengirim || '-'}</p>
								<p>${row.no_rek_pengirim || '-'}</p>
								<p>${row.bank_pengirim || '-'}</p>
							</div>
						`
					)
				}
			},  
			{ 
				"data": "status",
				"orderable": false,
				"render": function(data, type, row){
					if(data == 'VALIDASI'){
						return `<button class="btn btn-primary" data-toggle="validasi_pembayaran" data-id="${row.id}" data-nama="${row.nama}">Validasi</button>`
					}else{
						return `<button class="btn btn-primary" disabled >Validasi</button>`
					}
				}
			},
		],
	});
	tableDataOmb = $('#table_data_omb').DataTable({
		buttons: [
			'pdfHtml5',
			'excelHtml5',
			'csvHtml5',
			'print',
			'copyHtml5',
		],
		"processing": true,
		"serverSide": true,
		"ordering": true, // Set true agar bisa di sorting
		"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		"ajax":
		{
			"url": BASE_URL+"/service/api/daftar_omb/dt_daftar_omb", // URL file untuk proses select datanya
			"type": "GET",
			"data": function(data){
				const date_from = $('#search_date_from').val()
				const date_to = $('#search_date_to').val()
				const search_prodi = $('#search_prodi').val()

				data.searchByProdi = search_prodi
				
				if(date_from && date_to){
					data.searchByFromDate = date_from
					data.searchByToDate = date_to
				}
				
				
				return data
			}
		},
		"deferRender": true,
		"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
		"columns": [
			{ "data": "nim" }, 
			{ "data": "nama_camaru" },  
			{ "data": "nama_prodi" },  
			{ "data": "created_at" },  
			{ "data": "ukuran_jas_alma" },  
			
		],
	});
	tableDataCamaru = $('#table_data_camaru').DataTable({
		buttons: [
			'pdfHtml5',
			'excelHtml5',
			'csvHtml5',
			'print',
			'copyHtml5',
		],
		"processing": true,
		"serverSide": true,
		"ordering": true, // Set true agar bisa di sorting
		"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		"ajax":
		{
			"url": BASE_URL+"/service/api/pendaftaran/dt_data_camaru", // URL file untuk proses select datanya
			"type": "GET",
			"data": function(data){
				const date_from = $('#search_date_from').val()
				const date_to = $('#search_date_to').val()
				const status_penerimaan = $('#search_status_penerimaan').val()
				const search_prodi = $('#search_prodi').val()
				const search_jalur_pendaftaran = $('#search_jalur_pendaftaran').val()
				if(status_penerimaan){
					data.searchByStatusFormulir = status_penerimaan
				}
				if(date_from && date_to){
					data.searchByFromDate = date_from
					data.searchByToDate = date_to
				}
				data.searchByProdi = search_prodi
				data.searchByJalurPendaftaran = search_jalur_pendaftaran
				return data
			}
		},
		"deferRender": true,
		"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
		"columns": [
			{ "data": "id" }, // Tampilkan nis
			{ "data": "tahun_akademik" },  
			{ "data": "nama" },  
			{ 
				"data": "created_at",
				"render": function(data){
					return data.split(" ")[0]
				}
			},  // 
			{ 
				"orderable": false,
				"data": "jalur_pendaftaran"
			},  // 
			{ 
				"orderable": false,
				"data": "status_penerimaan_1",
				"className": "text-center",
				"render": function(data, type, row){
					return `
						<div class="text-center">${row.prodi_1}</div>
						<div class="text-center label label-xl label-light-${statusPenerimaan[data].color} my-lg-0 my-2 label-inline font-weight-bolder">${statusPenerimaan[data].label}</div>
					`
				} 
			}, 
			{ 
				"orderable": false,
				"data": "status_penerimaan_2",
				"className": "text-center",
				"render": function(data, type, row){
					if(data){
						return `
							<div class="text-center">${row.prodi_2}</div>
							<div class="text-center label label-xl label-light-${statusPenerimaan[data].color} my-lg-0 my-2 label-inline font-weight-bolder">${statusPenerimaan[data].label}</div>
						`
					}else return "-"
				} 
			},  // 
			{ 
				"orderable": false,
				"render": function(data, type, row){
				return `<button class="btn btn-icon btn-light" data-toggle="data-camaru-detail" data-id="${row.id}">
					<i class="fas fa-info-circle"></i>
				</button>
				<button class="btn btn-icon btn-light" data-toggle="data-camaru-edit" data-id="${row.id}">
					<i class="far fa-edit"></i>
				</button>`
				} 
			},  
		],
		"fnInitComplete": function(){
			const {selectedStatusPenerimaan, dateFrom, dateTo} = localStorage
			if(selectedStatusPenerimaan){
				$('#search_status_penerimaan').val(selectedStatusPenerimaan)
			}
			if(dateFrom){
				$('#search_date_from').val(dateFrom)
			}
			if(dateTo){
				$('#search_date_to').val(dateTo)
			}
		},
		"drawCallback": function(){
			var api = this.api();
		}
	});
	tableDataRegistrasiUlang = $('#table_data_registrasi_ulang').DataTable({
		buttons: [
			'pdfHtml5',
			'excelHtml5',
			'csvHtml5',
			'print',
			'copyHtml5',
		],
		"processing": true,
		"serverSide": true,
		"ordering": true, // Set true agar bisa di sorting
		"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		"ajax":
		{
			"url": BASE_URL+"/service/api/registrasi_ulang/dt_registrasi_ulang", // URL file untuk proses select datanya
			"type": "GET",
			"data": function(data){
				const date_from = $('#search_date_from').val()
				const date_to = $('#search_date_to').val()
				const status = $('#search_status_registrasi_ulang').val()
				const search_prodi = $('#search_prodi').val()
				if(status){
					data.searchByStatus = status
				}
				if(date_from && date_to){
					data.searchByFromDate = date_from
					data.searchByToDate = date_to
				}
				data.searchByProdi = search_prodi
				return data
			}
		},
		"deferRender": true,
		"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
		"columns": [
			{ "data": "id" }, // Tampilkan nis
			{ "data": "tahun_akademik" },  
			{ "data": "kode_skpm" },  
			{ "data": "nama_prodi" },  
			{ "data": "nama_camaru" },  
			{ "data": "nim" },  
			{ 
				"class": "text-center",
				"data": "status",
				"render": function(data, type, row){
					return `<div class="text-center label label-xl label-light-${statusRegistrasiUlang[data].color} my-lg-0 my-2 label-inline font-weight-bolder">${statusRegistrasiUlang[data].label}</div>`
				}
			},  
			{ 
				"class": "text-center",
				"data": "upload_bukti_bayar",
				"render" : function(data){
					return `
						<img class="img-preview" style="max-height: 50px; obj-fit: contain" src="${BASE_URL}/uploads/${data}" alt="">
					`
				}
			},  
			{
				"render": function (data, type, row){
					return(
						`
							<div>
								<p>${row.nama_rek_pengirim || '-'}</p>
								<p>${row.no_rek_pengirim || '-'}</p>
								<p>${row.bank_pengirim || '-'}</p>
							</div>
						`
					)
				}
			},  
			{ 
				"render" : function(data, type, row){
					return `
						<button data-id="${row.id}" data-nama="${row.nama_camaru}" class="btn btn-primary" ${row.status != 'VALIDASI KEUANGAN' ? 'disabled' : 'data-toggle="validasi_registrasi_ulang"'}  type="button">Validasi</button>
					`
				}
			},  
		],
		"fnInitComplete": function(){
			const {selectedStatusPenerimaan, dateFrom, dateTo} = localStorage
			if(selectedStatusPenerimaan){
				$('#search_status_penerimaan').val(selectedStatusPenerimaan)
			}
			if(dateFrom){
				$('#search_date_from').val(dateFrom)
			}
			if(dateTo){
				$('#search_date_to').val(dateTo)
			}
		},
		"drawCallback": function(){
			var api = this.api();
		}
	});

	tablePengumuman = $('#table_pengumuman').DataTable()

	$('#search_query').keyup(function(){
		data_pendaftar.search($(this).val()).draw()
		tableDataPendaftar.search($(this).val()).draw()
		tableDataCamaru.search($(this).val()).draw()
		tableDataRegistrasiUlang.search($(this).val()).draw()
		tableDataOmb.search($(this).val()).draw()
	})

	$('#table_data_pendaftar_filter').hide()
	$('#table_data_omb_filter').hide()
	// $('#table_data_pendaftar_length').hide()
	$('#table_data_camaru_filter').hide()
	$('#table_data_registrasi_ulang_filter').hide()
	// $('#table_data_camaru_length').hide()
	$('#search_status_pembayaran').change(function(){
		tableDataPendaftar.columns(3).search($(this).val()).draw()
	})
	$('#search_prodi').change(function(){
		tableDataCamaru.draw()
		tableDataRegistrasiUlang.draw()
		tableDataOmb.draw()
	})
	$('#search_jalur_pendaftaran').change(function(){
		tableDataCamaru.draw()
	})
	$('#search_jenis_user').change(function(){
		tableDataUser.draw()
	})
	$('#search_status_penerimaan').change(function(){
		// localStorage.selectedStatusPenerimaan = $(this).val()
		tableDataCamaru.draw();
		tableDataRegistrasiUlang.draw()
	})
	$('#search_status_registrasi_ulang').change(function(){
		tableDataRegistrasiUlang.draw()
	})

	$('#search_tahun_akademik').change(function(){
		console.log($(this).val())
		tableDataPendaftar.columns(1).search($(this).val()).draw()
		tableDataCamaru.columns(1).search($(this).val()).draw()
		tableDataRegistrasiUlang.columns(1).search($(this).val()).draw()
		data_pendaftar.columns(1).search($(this).val()).draw()
	})
	
	$('.search-by-date').change(function(){
		const date_from = $('#search_date_from').val()
		const date_to = $('#search_date_to').val()
		// localStorage.dateFrom = date_from
		// localStorage.dateTo = date_to
		// if(date_from && date_to){
		// 	tableDataPendaftar.draw()
		// 	tableDataCamaru.draw()
		// 	tableDataRegistrasiUlang.draw()
		// }
	})

	$('#export_pdf').click(function () {
		console.log('export pdf')
		tableDataPendaftar.button(0).trigger();
		tableDataCamaru.button(0).trigger();
		tableDataRegistrasiUlang.button(0).trigger();
		tablePengumuman.button(0).trigger();
		tableDataUser.button(0).trigger();
	})
	$('#export_excel').click(function () {
		tableDataPendaftar.button(1).trigger();
		tableDataCamaru.button(1).trigger();
		tableDataRegistrasiUlang.button(1).trigger();
		tablePengumuman.button(1).trigger();
		tableDataUser.button(1).trigger();
	})
})


$('table').on("xhr.dt", function (e, settings, json, xhr) {
    settings.json = {
        data: json
    };
	$('.count-camaru').text(settings.json.data.recordsFiltered+" Camaru")
})

let tableMasterJalurPendaftaran = null
let tableMasterTahunAkademik = null
let tableMasterPembayaran = null
let tableMasterProdi = null

$(document).ready(function(){
	tableMasterJalurPendaftaran = $('#table_master_jalur_pendaftaran').DataTable({
		buttons: [
			'pdfHtml5',
			'excelHtml5',
			'csvHtml5',
			'print',
			'copyHtml5',
		],
		"processing": true,
		"serverSide": true,
		"ordering": true, // Set true agar bisa di sorting
		"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		"ajax":
		{
			"url": BASE_URL+"/service/api/jalur_pendaftaran/dt", // URL file untuk proses select datanya
			"type": "GET",
		},
		"deferRender": true,
		"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
		"columns": [
			{ "data": "id" }, // Tampilkan nis
			{ "data": "jalur_pendaftaran" },  // Tampilkan nama
			// { 
			// 	"render": function(){
			// 		return `<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
			// 		<span class="svg-icon svg-icon-md svg-icon-primary">
			// 			<!--begin::Svg Icon | path:/metronic/theme/html/demo5/dist/assets/media/svg/icons/Communication/Write.svg-->
			// 			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
			// 				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
			// 					<rect x="0" y="0" width="24" height="24"></rect>
			// 					<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
			// 					<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
			// 				</g>
			// 			</svg>
			// 			<!--end::Svg Icon-->
			// 		</span>
			// 	</a>`
			// 	} 
			// }
		],
	});
	tableMasterTahunAkademik = $('#table_master_tahun_akademik').DataTable({
		buttons: [
			'pdfHtml5',
			'excelHtml5',
			'csvHtml5',
			'print',
			'copyHtml5',
		],
		"processing": true,
		"serverSide": true,
		"ordering": true, // Set true agar bisa di sorting
		"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		"ajax":
		{
			"url": BASE_URL+"/service/api/tahun_akademik/dt", // URL file untuk proses select datanya
			"type": "GET",
		},
		"deferRender": true,
		"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
		"columns": [
			{ "data": "id" }, // Tampilkan nis
			{ "data": "tahun_akademik" },  // Tampilkan nama
			{ "data": "status" },  // Tampilkan nama
			{ 
				"render": function(data, type, row){
					return `<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3 " data-id="${row.id}" data-tahun_akademik="${row.tahun_akademik}" data-toggle="set_tahun_akademik">
					<span class="svg-icon svg-icon-md svg-icon-primary">
						<!--begin::Svg Icon | path:/metronic/theme/html/demo5/dist/assets/media/svg/icons/Communication/Write.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24"></rect>
								<path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
								<path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</a>`
				} 
			}
		],
	});
	tableMasterPembayaran = $('#table_master_pembayaran').DataTable({
		buttons: [
			'pdfHtml5',
			'excelHtml5',
			'csvHtml5',
			'print',
			'copyHtml5',
		],
		"processing": true,
		"serverSide": true,
		"ordering": true, // Set true agar bisa di sorting
		"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		"ajax":
		{
			"url": BASE_URL+"/service/api/jenis_pembayaran/dt", // URL file untuk proses select datanya
			"type": "GET",
		},
		"deferRender": true,
		"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
		"columns": [
			{ "data": "id" }, // Tampilkan nis
			{ "data": "jenis_pembayaran" },  // Tampilkan nama
			{ "data": "info_pembayaran" },  // Tampilkan nama
			{ 
				"render": function(data, type, row){
					return(
						`<a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" data-info_pembayaran="${row.info_pembayaran}" data-id="${row.id}" data-jenis_pembayaran="${row.jenis_pembayaran}" data-toggle="edit_pembayaran">
							<span class="svg-icon svg-icon-md svg-icon-primary">
								<!--begin::Svg Icon | path:/metronic/theme/html/demo5/dist/assets/media/svg/icons/General/Settings-1.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24"></rect>
										<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
										<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>
						</a>`
					)
				} 
			}
		],
	});
	tableMasterProdi = $('#table_master_prodi').DataTable({
		buttons: [
			'pdfHtml5',
			'excelHtml5',
			'csvHtml5',
			'print',
			'copyHtml5',
		],
		"processing": true,
		"serverSide": true,
		"ordering": true, // Set true agar bisa di sorting
		"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		"ajax":
		{
			"url": BASE_URL+"/service/api/prodi/dt", // URL file untuk proses select datanya
			"type": "GET",
		},
		"deferRender": true,
		"aLengthMenu": [[5, 10, 50],[ 5, 10, 50]], // Combobox Limit
		"columns": [
			{ "data": "id" }, // Tampilkan nis
			{ "data": "nama_fakultas" },  // Tampilkan nama
			{ "data": "nama_prodi" },  // Tampilkan nama
			// { 
			// 	"render": function(){
			// 		return `.`
			// 	} 
			// }
		],
	});
	
	
})
