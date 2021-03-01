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
	$('#data_pendaftar_filter').hide()
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
			'print',
			'copyHtml5',
			'csvHtml5',
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
	tableDataCamaru = $('#table_data_camaru').DataTable({
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
	})

	$('#table_data_pendaftar_filter').hide()
	// $('#table_data_pendaftar_length').hide()
	$('#table_data_camaru_filter').hide()
	// $('#table_data_camaru_length').hide()
	$('#search_status_pembayaran').change(function(){
		tableDataPendaftar.columns(3).search($(this).val()).draw()
	})
	$('#search_prodi').change(function(){
		tableDataCamaru.draw()
		tableDataRegistrasiUlang.draw()
	})
	$('#search_jalur_pendaftaran').change(function(){
		tableDataCamaru.draw()
	})
	$('#search_jenis_user').change(function(){
		tableDataUser.draw()
	})
	$('#search_status_penerimaan').change(function(){
		localStorage.selectedStatusPenerimaan = $(this).val()
		tableDataCamaru.draw();
		tableDataRegistrasiUlang.draw()
	})
	$('#search_status_registrasi_ulang').change(function(){
		tableDataRegistrasiUlang.draw()
	})
	
	$('.search-by-date').change(function(){
		const date_from = $('#search_date_from').val()
		const date_to = $('#search_date_to').val()
		localStorage.dateFrom = date_from
		localStorage.dateTo = date_to
		if(date_from && date_to){
			tableDataPendaftar.draw()
			tableDataCamaru.draw()
			tableDataRegistrasiUlang.draw()
		}
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
