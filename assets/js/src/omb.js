$('[name="nim"]').change(function(){
	const detailWrapper = $('.detail-wrapper');
	detailWrapper.empty()
	axios.get(BASE_URL+"/service/api/pendaftaran?nim="+$(this).val()).then(res => {
		detailWrapper.html(
			`<div class="form-group row">
				<label for="" class="col-lg-3 col-form-label">Nama</label>
				<input type="text" class="col-lg-9 form-control" disabled name="nama">
			</div>
			<div class="form-group row">
				<label for="" class="col-lg-3 col-form-label">Program Studi</label>
				<input type="text" class="col-lg-9 form-control" disabled name="prodi">
			</div>
			<div class="form-group">
				<label>Ukuran Jas Almamater</label>
				<div class="radio-list">
					<label class="radio">
						<input type="radio" name="ukuran_jas_alma" value="S" id="S"/>
						<span></span>
						S
					</label>
					<label class="radio">
						<input type="radio" name="ukuran_jas_alma" value="M" id="M"/>
						<span></span>
						M
					</label>
					<label class="radio">
						<input type="radio" name="ukuran_jas_alma" value="L" id="L"/>
						<span></span>
						L
					</label>
					<label class="radio">
						<input type="radio" name="ukuran_jas_alma" value="LL" id="LL"/>
						<span></span>
						LL
					</label>
					<label class="radio">
						<input type="radio" name="ukuran_jas_alma" value="LLL" id="LLL"/>
						<span></span>
						LLL
					</label>
				</div>
				<div class="d-flex justify-content-center">
				</div>
			</div>
			<div class="row justify-content-center">
				<button class="btn btn-primary" type="Submit">Submit</button>
			</div>`
		)
		$('[name="nama"]').val(res.data[0].nama_camaru)
		$('[name="prodi"]').val(res.data[0].nama_prodi)
		if(res.data[0].ukuran_jas_alma){
			$('[name="ukuran_jas_alma"]').val(res.data[0].ukuran_jas_alma)
			$(`#${res.data[0].ukuran_jas_alma}`).click();
			$('button.btn.btn-primary').hide()
			$('input:radio').attr('disabled', true)
		}
	}).catch(err => {
		console.log(err)
	})
})


$('[name="ukuran_jas_alma"]').change(function(){
	console.log($(this).val())
})
