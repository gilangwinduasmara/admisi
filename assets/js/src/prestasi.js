$('button[data-prestasi-create]').click(function(){
	const prestasiWrapper = $('.prestasi-wrapper')
	prestasiWrapper.append(`
		<div class="prestasi-item">
			<div class="d-flex justify-content-end gutter-b">
			<a href="javascript:;" data-prestasi-delete="" class="btn btn-sm font-weight-bolder btn-light-danger"><i class="la la-trash-o"></i>Delete</a>
			</div>
			<input hidden name="type[]" value="create">
			<input type="hidden" name="detail_prestasi_id[]" value="skip">
			<div class="form-group row">
				<label for="" class="col-md-2 col-form-label">Jenis prestasi</label>
				<div class="col-md-10">
					<select name="jenis_prestasi[]"  class="form-control">
						<option value="">Pilih</option>
						<option value="NASIONAL">Nasional</option>
						<option value="INTERNASIONAL">Internasional</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="" class="col-md-2 col-form-label">Nama Kegiatan</label>
				<div class="col-md-10">
					<input type="text" class="form-control" name="nama_kegiatan[]">
				</div>
			</div>
			<div class="form-group row">
				<label for="" class="col-md-2 col-form-label">Tanggal Kegiatan</label>
				<div class="col-md-10">
					<input type="date" class="form-control" name="tgl_kegiatan[]">
				</div>
			</div>
			<div class="form-group row">
				<label for="" class="col-md-2 col-form-label">Unggah Bukti Prestasi</label>
				<input type="file" name="unggah_bukti_prestasi[]" accept="application/pdf, image/jpeg, image/png">
				<span class="text-muted">(pdf, jpg, jpeg, png)</span>
			</div>
			<div class="separator separator-solid mb-8"></div>
		</div>
	`)
	$('[data-prestasi-delete]').click(function(){
		$(this).parent().parent().remove()
	})
})
