<div class="container">
	<div class="row align-items-center justify-content-center">
		<div class="col-lg-8">
			<div class="card card-custom">
				<?php
					if(!$isValidating){
						?>
							<form action="<?php echo base_url('/api/pembayaran/upload_bukti') ?>" method="POST">
								<div class="card-body">
									<div class="form-group row">
										<label for="" class="col-md-3 col-form-label">No. Formulir</label>
										<input name="id" hidden type="text" class="form-control" readonly value="<?php echo $pendaftaran['id'] ?>">
										<input type="text" class="form-control" disabled value="<?php echo $pendaftaran['id'] ?>">
									</div>
									<div class="form-group row">
										<label for="" class="col-md-3 col-form-label">Nama Camaru</label>
										<input type="text" class="form-control" disabled value="<?php echo $pendaftaran['nama'] ?? '' ?>">
									</div>
									<div class="form-group row">
										<label for="" class="col-md-3 col-form-label">No. Pembayaran</label>
										<input type="text" class="form-control" name="pembayaran_id">
									</div>
									<div class="form-group row">
										<label for="" class="col-md-3 col-form-label">Total Pembayaran</label>
										<input type="number" class="form-control" name="total_bayar">
									</div>
									<div class="form-group">
										<label for="" >Upload bukti pembayaran</label>
										<div action="" class="dropzone dropzone-default dropzone-primary">
											<div class="callback">
											</div>
										</div>
										<input type="text" hidden name="upload_bukti_bayar" value="_">
									</div>
									<div class="d-flex justify-content-center">
										<input type="submit" value="Submit" class="btn btn-primary">
									</div>
								</div>
							</form>
						<?php
					}else{
						?>
							<div class="card-body">
								Pembayaran sedang dalam proses validasi
								<div class="d-flex justify-content-center">
									<a href="<?php echo base_url('/pendaftaran/data_camaru') ?>" class="btn btn-primary">Kembali</a>
								</div>
							</div>
							
						<?php
					}
				?>
				
			</div>
		</div>
	</div>
</div>

