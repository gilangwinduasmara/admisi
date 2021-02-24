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
})
