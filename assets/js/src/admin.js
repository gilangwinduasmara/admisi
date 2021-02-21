$('[data-toggle="validasi_pembayaran"]').click(function(){
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
}
)
$('[data-toggle="data-camaru-edit"]').click(function(){
	$('#modal__data_camaru_edit').modal('show')
	axios.get(BASE_URL+'/service/api/pendaftaran?id='+$(this).data('id')).then(res => {
		$('[name="prodi_1_id"]').val(res.data.hasil_penerimaan[0].id)
		$('[name="modal__data_camaru_edit_pilihan_1"]').val(res.data.hasil_penerimaan[0].prodi.nama_prodi)
		$('[name="prodi_1_status"]').val(res.data.hasil_penerimaan[0].status)
		$('[name="prodi_2_id"]').val(res.data.hasil_penerimaan[1].id)
		$('[name="modal__data_camaru_edit_pilihan_2"]').val(res.data.hasil_penerimaan[1].prodi.nama_prodi)
		$('[name="prodi_2_status"]').val(res.data.hasil_penerimaan[1].status)
		
	}).catch(err => {
		console.log(err)
	})
})
