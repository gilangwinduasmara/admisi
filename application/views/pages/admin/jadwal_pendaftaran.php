<?php
	$days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']
?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form class="card card-custom bg-light" action="<?php echo base_url('/api/admin/save_jadwal') ?>" method="POST">
				<div class="card-body">
					<table class="table table-vertical-center table-head-custom">
						<thead>
							<tr>
								<th style="width: 140px;">Hari</th>
								<th style="width: 140px">Jam Mulai</th>
								<th style="width: 140px">Jam Selesai</th>
								<th class="text-center">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach($jadwal as $j){
									?>
										<tr>
											<td><?php echo 	$j['hari'] ?></td>
											<td>
												<select class="form-control" name="jam_mulai_<?php echo $j['id'] ?>">
													<?php
														for($i=1; $i<=24; $i++){
															?>
																<option <?php if($j['jam_mulai'] == $i) echo 'selected' ?> value="<?php echo $i ?>"><?php echo (sprintf("%02d", $i).":00") ?></option>
															<?php
														}
													?>
												</select>
											</td>
											<td>
												<select class="form-control" name="jam_selesai_<?php echo $j['id'] ?>">
													<?php
														for($i=1; $i<=24; $i++){
															?>
																<option <?php if($j['jam_selesai'] == $i) echo 'selected' ?> value="<?php echo $i ?>"><?php echo (sprintf("%02d", $i).":00") ?></option>
															<?php
														}
													?>
												</select>
											</td>
											<td class="text-center">
												<input type="checkbox" <?php if($j['status'] == 'AKTIF') echo 'checked' ?> name="status_<?php echo $j['id'] ?>">
											</td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-end">
						<button class="btn btn-primary">Simpan Perubahan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
