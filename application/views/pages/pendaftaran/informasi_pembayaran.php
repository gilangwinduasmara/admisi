<div class="container">
	<div class="row align-items-center justify-content-center">
		<div class="col-md-8">
			<div class="card card-custom">
				<?php 
					$nomor_pembayaran = $this->session->flashdata('nomor_pembayaran');
					if(empty($nomor_pembayaran)){
						if($pendaftaran){
							?>
							<form action="<?php echo base_url('/api/pembayaran/save_pembayaran') ?>" method="POST">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-md-3 col-form-label">No. Formulir</label>
										<input type="number" class="form-control" name="id" value="<?php echo $pendaftaran['id'] ?? ''?>" readonly>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label">Nama Camaru</label>
										<input type="text" class="form-control" name="nama_camaru" value="<?php echo $pendaftaran['pembayaran'][0]['nama_camaru'] ?? $pendaftaran['nama']?>" >
									</div>
									<div class="form-group">
										<label>Pilih metode pembayaran:</label>
										<div class="radio-list">
											<?php
												foreach($jenis_pembayarans as $jenis_pembayaran){
													?>
														<label class="radio">
															<input type="radio" name="jenis_pembayaran" value="<?php echo $jenis_pembayaran['id'] ?>" <?php echo count($pendaftaran['pembayaran'])>0 && $jenis_pembayaran['id'] == $pendaftaran['pembayaran'][0]['jenis_pembayaran_id'] ? 'checked':''  ?>>
															<span></span>
															<?php echo $jenis_pembayaran['jenis_pembayaran'] ?>
														</label>
													<?php
												}
											?>
										</div>
									</div>
									<div class="d-flex justify-content-center">
										<input type="submit" class="btn btn-primary">
									</div>
								</div>
							</form>
							<?php
						}
					}else{
						?>
						<div class="card-body">
							<p>Nomor pembayaran Anda <b><?php echo $nomor_pembayaran ?></b>, silahkan melakukan pembayaran sesuai metode yang dipilih. <br>Nomor pendaftaran berlaku 24 jam ke depan.</p>
						</div>
						<div class="d-flex justify-content-center">
							<a href="<?php echo base_url('/pendaftaran/data_camaru') ?>" class="btn btn-primary">Kembali</a>
						</div>
						<?php
					}
				?>
			</div>
		</div>
		
	</div>
</div>
