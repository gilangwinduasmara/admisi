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
		<div class="col-lg-12 mb-4">
			<div class="row">
				<div class="col-md-3">
					<label for="">Cari berdasarkan status penerimaan</label>
					<select class="form-control" id="search_status_penerimaan">
						<option value="">Status Penerimaan</option>
						<option value="DIPROSES">Diproses</option>
						<option value="DITERIMA">Diterima</option>
						<option value="DITOLAK">Ditolak</option>
					</select>
				</div>
				<div class="col-md-2">
					<label for="">Cari berdasarkan prodi</label>
					<select class="form-control" id="search_prodi">
						<option value="">All</option>
						<?php 
							foreach($prodi as $p){
								echo "<option value='$p[id]'>$p[nama_prodi]</option>";
							}
						?>
					</select>
				</div>
				<div class="col-md-3">
					<label for="">Cari berdasarkan jalur pendaftaran</label>
					<select class="form-control" id="search_jalur_pendaftaran">
						<option value="">All</option>
						<?php 
							foreach($jalur_pendaftaran as $jp){
								echo "<option value='$jp[id]'>$jp[jalur_pendaftaran]</option>";
							}
						?>
					</select>
				</div>
				<div class="col-md-2">
					<label for="">Dari</label>
					<input type="date" id="search_date_from" class="form-control search-by-date">
				</div>
				<div class="col-md-2">
					<label for="">Sampai</label>
					<input type="date" id="search_date_to" class="form-control search-by-date">
				</div>
				<div class="col-md-3 my-4">
					<div class="input-icon">
						<input type="text" class="form-control" placeholder="Cari..." id="search_query">
						<span><i class="flaticon2-search-1 text-muted"></i></span>
					</div>
				</div>
				
			</div>
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="count-camaru"></div>
				</div>
				<div class="col-md-6 mt-4 mb-4 text-right">
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Export
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#" id="export_pdf">PDF</a>
						<a class="dropdown-item" href="#" id="export_excel">Excel</a>
					</div>
				</div>
				</div>
			</div>
			
		</div>
		
		<div class="col-lg-12">
			<div class="table-responsive">
			<table class="table table-bordered " id="table_data_camaru">
					<thead>
						<tr>
							<th>No Formulir</th>
							<th>Tahun Akademik</th>
							<th>Nama Camaru</th>
							<th>Tanggal Submit</th>
							<th>Jalur Pendaftaran</th>
							<th class="text-center" style="min-width: 140px;">Pilihan 1</th>
							<th class="text-center" style="min-width: 140px;">Pilihan 2</th>
							<th class="text-center" style="min-width: 100px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<!-- <?php 
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
						?> -->
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
