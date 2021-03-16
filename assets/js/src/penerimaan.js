$(document).ready(function(){
	$('#formulir_selector').attr('disabled', false)
	$('#formulir_selector').change(function(){
		if($(this).val()){
			let selectedFormulir = pendaftaran.filter((obj, i) => (obj.id == $(this).val()))[0]
			$('#nama_camaru').val(selectedFormulir.nama)
			$('.penerimaan-list').empty()
			selectedFormulir.hasil_penerimaan.map((item, index) => {
				if(item.status == 'DITERIMA'){
					$('.penerimaan-list').append(`
						<div class="d-flex flex-column align-items-center mt-24">
							<div for="" class="">${item.prodi.fakultas.nama_fakultas+' <b>'+item.prodi.nama_prodi}</b></div>
							<a target="_blank" href="${BASE_URL+'/service/api/pendaftaran/generate_skr?hasil_penerimaan_id='+item.id}" class="btn btn-primary">Download Surat Keputusan Penerimaan</a>
						</div>
					`)
				}
				if(item.status == 'DITOLAK'){
					$('.penerimaan-list').append(`
						<div class="d-flex flex-column align-items-center mt-24">
							<div for="" class="">${item.prodi.fakultas.nama_fakultas+' <b>'+item.prodi.nama_prodi}</b></div>
							<div class="text-danger text-weight-bolder font-size-lg">Ditolak</div>
						</div>
					`)
				}
			})
			$('.penerimaan-wrapper').show()
		}else{
			$('.penerimaan-wrapper').hide()
		}
	})
	if($('#formulir_selector').length){
		var url = new URL(window.location);
		var id = url.searchParams.get("id");
		if(id){
			$('#formulir_selector').val(id)
			$('#formulir_selector').change()
		}
	}
})
