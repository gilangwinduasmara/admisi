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
let tableDataPendaftar = null

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

	

	tableDataPendaftar = $('#table_data_pendaftar').DataTable({
		"processing": true,
		"serverSide": true,
		"ordering": true, // Set true agar bisa di sorting
		"order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		"ajax":
		{
			"url": BASE_URL+"/service/api/pendaftaran", // URL file untuk proses select datanya
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
					console.log(row)
					let html = `<span class="label label-lg label-light-${statusPembayaran[data].color} label-inline">${statusPembayaran[data].label}</span>`
					return html
				}
			},  
			{ 
				"data": "upload_bukti_bayar",
				"orderable": false,
				"render": function (data, type, row){
					if(data){
						return `<img style="max-height: 50px; obj-fit: contain" src="${BASE_URL+'/uploads/'+data}">`
					}
					return ""
				}
			 },  
			{ 
				"data": "status",
				"orderable": false,
				"render": function(data, type, row){
					console.log(row)
					if(data == 'VALIDASI'){
						return `<button class="btn btn-primary" data-toggle="validasi_pembayaran" data-id="${row.id}" data-nama="${row.nama}">Validasi</button>`
					}else{
						return `<button class="btn btn-primary" disabled >Validasi</button>`
					}
				}
			},
		],
	});

	$('#table_data_pendaftar_filter').hide()
	$('#table_data_pendaftar_length').hide()
	$('#search_status_pembayaran').change(function(){
		tableDataPendaftar.columns(3).search($(this).val()).draw()
	})
	// $('#search_date_from').change(function(){
	// 	tableDataPendaftar.draw()
	// })
	$('.search-by-date').change(function(){
		const date_from = $('#search_date_from').val()
		const date_to = $('#search_date_to').val()

		if(date_from && date_to){
			tableDataPendaftar.draw()
		}
	})
})
