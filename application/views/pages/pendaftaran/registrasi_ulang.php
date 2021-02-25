<div class="container">

	<div class="row justify-content-center">
		<div class="col-lg-8">
			<div class="card card-custom">
				<div class="card-body">
					<form action="<?php echo base_url('/api/pendaftaran/registrasi_ulang') ?>" method="post" enctype="multipart/form-data">
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">No. Formulir</label>
							<div class="col-md-9">
								<select name="id" class="form-control">
									<option value="">Pilih</option>
									<?php
										foreach($pendaftaran as $p){
											?>
												<option value="<?php echo $p['id'] ?>"><?php echo $p['id'] ?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class="detail-wrapper" style="display: none;">
							<div class="form-group row">
								<label for="" class="col-md-3 col-form-label">Nama Camaru</label>
								<div class="col-md-9">
									<input type="text" class="form-control" value="" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-3 col-form-label">Bukti Pembayaran</label>
								<div class="col-md-9">
									<input type="file" name="upload_bukti_bayar" accept="image/png,image/jpeg">
								</div>
							</div>
							<div class="d-flex justify-content-center">
								<input type="Submit" class="btn btn-primary" value="Submit">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-8 mt-4" id="registrasi_ulang_wrapper">
			
		</div>
	</div>
</div>
<?php 
	// echo json_encode($pendaftaran);
?>
