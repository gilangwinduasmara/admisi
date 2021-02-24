<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<div class="card card-custom">
				<div class="card-body">
					<?php echo form_open('/api/pendaftaran/new_formulir') ?>
					<!-- <form action=""> -->
						<div class="form-group">
							<label class="col-md-3 col-form-label">Nama Camaru</label>
							<input type="text" class="form-control" name="nama">
						</div>
						<div class="form-group">
							<label class="col-md-3 col-form-label">Jenjang</label>
							<select name="jenjang" id="" class="form-control" required>
								<option value="">Pilih</option>
								<?php
									foreach($jenjangs as $jenjang){
										if($jenjang['jenjang'] != 'SMA')
										echo '
											<option value="'.$jenjang['id'].'">'.$jenjang['jenjang'].'</option>
										';
									}

								?>
							</select>
						</div>
						<div class="form-group">
							<label class="col-md-3 col-form-label">Jalur Pendaftaran</label>
							<select name="jalur_pendaftaran" class="form-control" required>
								<option value="">Pilih</option>
								<?php
									foreach($jalur_pendaftarans as $jalur_pendaftaran){
										if($jalur_pendaftaran['jalur_pendaftaran'] != 'SMA')
										echo '
											<option value="'.$jalur_pendaftaran['id'].'">'.$jalur_pendaftaran['jalur_pendaftaran'].'</option>
										';
									}

								?>
							</select>
						</div>
						<div class="d-flex justify-content-center"><input type="Submit" class="btn btn-primary" value="Submit"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
