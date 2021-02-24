<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<div class="card card-custom">
				<div class="card-body">
					<form action="<?php echo base_url('/api/pendaftaran/omb') ?>" method="POST" name="omb">
						<div class="form-group row">
							<label for="" class="col-lg-3 col-form-label">NIM</label>
							<select class="col-lg-9 form-control" name="nim">
								<option value="" name="nim">Pilih</option>
								<?php
									foreach($daftar_omb as $omb){
										?>
											<option value="<?php echo $omb['nim'] ?>"><?php echo $omb['nim'] ?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="detail-wrapper">
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <?php print_r(json_encode($daftar_omb)) ?> -->
