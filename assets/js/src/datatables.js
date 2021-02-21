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
})
