<?php 
	$status_pendaftaran = array(
		'DIPROSES' => [
			'label' => 'Mendaftar',
			'color' => 'warning',
		],
		'DITERIMA' => [
			'label' => 'Diterima',
			'color' => 'success'
		],
		'DITOLAK' => [
			'label' => 'Ditolak',
			'color' => 'danger'
		]
	)
?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10 mb-4">
			<div class="row">
				<div class="col-md-4">
					<select class="form-control" id="search_status_penerimaan">
						<option value="">Status Penerimaan</option>
						<option value="Diproses">Diproses</option>
						<option value="Diterima">Diterima</option>
						<option value="Ditolak">Ditolak</option>
					</select>
				</div>
				<div class="col-md-4">
					<div class="input-icon">
						<input type="text" class="form-control" placeholder="Cari..." id="search_query">
						<span><i class="flaticon2-search-1 text-muted"></i></span>
					</div>
				</div>

			</div>
			
		</div>
		
		<div class="col-lg-10">
			<div class="table-responsive">
			<table class="table table-bordered " id="data_pendaftar">
					<thead>
						<tr>
							<th>No Formulir</th>
							<th>Nama Camaru</th>
							<th>Tanggal Submit</th>
							<th>Pilihan 1</th>
							<th>Pilihan 2</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($pendaftaran as $p){
								?>
								<tr>
									<td><?php echo $p['id'] ?></td>
									<td><?php echo $p['nama'] ?></td>
									<td><?php echo explode(' ', $p['created_at'])[0]  ?></td>
									<td class="text-center">
										<?php 
											if(!empty($p['hasil_penerimaan'][0])){
												?>
													<div>
														<div>
															<?php 
																echo $p['hasil_penerimaan'][0]['prodi']['nama_prodi'];
															?>
														</div>
														<?php 
															if(!empty($p['hasil_penerimaan'][0]['status'])){
																?>
																	<div class="label label-xl label-<?php echo $status_pendaftaran[$p['hasil_penerimaan'][0]['status']]['color']?> my-lg-0 my-2 label-inline font-weight-bolder"><?php echo ($p['hasil_penerimaan'][0]['status'] ?? 'x')?></div>
																<?php
															}
														?>
													</div>
												<?php
											}
										?>
									</td>
									<td class="text-center">
										<?php 
											if(!empty($p['hasil_penerimaan'][1])){
												?>
													<div>
														<div>
															<?php 
																echo $p['hasil_penerimaan'][1]['prodi']['nama_prodi'];
															?>
														</div>
														<?php 
															if(!empty($p['hasil_penerimaan'][1]['status'])){
																?>
																	<div class="label label-xl label-<?php echo $status_pendaftaran[$p['hasil_penerimaan'][1]['status']]['color']?> my-lg-0 my-2 label-inline font-weight-bolder"><?php echo ($p['hasil_penerimaan'][1]['status'] ?? 'x')?></div>
																<?php
															}
														?>
													</div>
												<?php
											}
										?>
									</td>
									<td>
										<div>
											<button class="btn btn-icon btn-light" data-toggle="data-camaru-detail" data-id="<?php echo $p['id'] ?>">
												<i class="fas fa-info-circle"></i>
											</button>
											<button class="btn btn-icon btn-light" data-toggle="data-camaru-edit" data-id="<?php echo $p['id'] ?>">
												<i class="far fa-edit"></i>
											</button>
										</div>
									</td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal__data_camaru_edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form class="modal-content" action="<?php echo base_url('/api/admin/hasil_penerimaan') ?>" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="" class="">Pilihan 1</label>
						<input class="form-control" name="prodi_1_id" type="text"  hidden value="">
						<input class="form-control" name="modal__data_camaru_edit_pilihan_1" type="text" disabled value="">
					</div>
					<div class="form-group">
						<label for="" class="">Status</label>
						<select name="prodi_1_status" class="form-control">
							<option value="DIPROSES">Mendaftar</option>
							<option value="DITERIMA">Diterima</option>
							<option value="DITOLAK">Ditolak</option>
						</select>
					</div>
					<div class="form-group">
						<label for="" class="">Pilihan 2</label>
						<input class="form-control" name="prodi_2_id" type="text"  hidden value="">
						<input class="form-control" name="modal__data_camaru_edit_pilihan_2" type="text" disabled value="">
					</div>
					<div class="form-group">
						<label for="" class="">Status</label>
						<select name="prodi_2_status" class="form-control">
							<option value="DIPROSES">Mendaftar</option>
							<option value="DITERIMA">Diterima</option>
							<option value="DITOLAK">Ditolak</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
				</div>
			</form>
		</div>
	</div>
	<div class="modal fade" id="modal__data_camaru_detail" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body" id="detail_body">
					<div class="form-group">
						<select id="data-selector" class="form-control">
							<option value="DATA_PERSONAL">Data Personal</option>
							<option value="DATA_WALI">Data Wali</option>
							<option value="DATA_PENDIDIKAN">Data Pendidikan</option>
							<option value="DATA_WALI">Data Akademik</option>
							<option value="UNGGAH_BERKAS">Unggah Berkas</option>
						</select>
					</div>
					<div class="data">
					
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

</div>
