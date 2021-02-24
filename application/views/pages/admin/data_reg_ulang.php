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
		);

	$status_registrasi_ulang = array(
		'VALIDASI KEUANGAN' => [
			'label' => 'Sedang Validasi',
			'color' => 'warning',
		],
		'BELUM BAYAR' => [
			'label' => 'Belum Registrasi',
			'color' => 'success'
		],
		'LUNAS' => [
			'label' => 'Sudah Registrasi',
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
						<option value="Belum Registrasi">Belum Registrasi</option>
						<option value="Sedang Validasi">Sedang Validasi</option>
						<option value="Sudah Registrasi">Sudah Registrasi</option>
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
							<th>No. Pendaftaran</th>
							<th>Prodi</th>
							<th>Nama Camaru</th>
							<th>NIM</th>
							<th class="text-center" style="min-width: 200px;">Registrasi Ulang</th>
							<th>Bukti Registrasi Ulang</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($registrasi_ulang as $registrasi){
								?>
									<tr>
										<td><?php echo $registrasi['pendaftaran_id'] ?></td>
										<td><?php echo $registrasi['nama_prodi'] ?></td>
										<td><?php echo $registrasi['nama_camaru'] ?></td>
										<td><?php echo $registrasi['nim'] ?></td>
										<td class="text-center">
											<span class="label label-lg label-light-<?php echo $status_registrasi_ulang[$registrasi['status_registrasi_ulang']]['color'] ?> label-inline">
												<?php echo $status_registrasi_ulang[$registrasi['status_registrasi_ulang']]['label'] ?>
											</span>
										</td>
										<td class="text-center">
											<?php 
												if(!empty($registrasi['upload_bukti_bayar'])){
													?>
														<img style="max-height: 50px; obj-fit: contain" src="<?php echo base_url('/uploads/'.$registrasi['upload_bukti_bayar']) ?>" alt="">
													<?php
												}
											?>
										</td>
										<td>
											<button data-id="<?php echo $registrasi['registrasi_ulang_id'] ?>"  data-nama="<?php echo $registrasi['nama_camaru'] ?>" class="btn btn-primary" <?php if($registrasi['status_registrasi_ulang'] != 'VALIDASI KEUANGAN') echo 'disabled'; else echo 'data-toggle="validasi_registrasi_ulang"'  ?> type="button">Validasi</button>
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
