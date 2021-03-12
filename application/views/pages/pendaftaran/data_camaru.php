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
	<div class="d-flex justify-content-center">
		<a href="<?php echo base_url('/pendaftaran/formulir') ?>" class="btn btn-warning"><i class="fas fa-plus"></i> Formulir</a>
	</div>
	<div>
	<div class="row">
		<div class="col-md-3">
			<label for="">Cari berdasarkan tahun akademik</label>
			<select class="form-control" id="search_tahun_akademik">
				<option value="">All</option>
				<?php 
					foreach($tahun_akademik as $tahun){
						?>
							<option value="<?php echo $tahun['tahun_akademik'] ?>"><?php echo $tahun["tahun_akademik"] ?></option>
						<?php
					}
				?>
			</select>
		</div>
	</div>
	</div>
	<div class="mt-12">
		<table class="table table-bordered" id="data_pendaftar">
			<thead>
				<tr>
					<th>No. Formulir</th>
					<th>Tahun Akademik</th>
					<th>Nama Camaru</th>
					<th>Tanggal Daftar</th>
					<th style="min-width: 100px;">Aksi</th>
					<th>Status Pembayaran</th>
					<th>Isi Formulir</th>
					<th class="text-center">Status Pendaftaran <br> Pilihan 1</th>
					<th class="text-center">Status Pendaftaran <br> Pilihan 2</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$status_pembayaran = [
						'BELUM LUNAS' => 'warning', 
						'VALIDASI' => 'info', 
						'LUNAS' => 'success', 
						'EXPIRED' => 'danger',
						'DITOLAK' => 'danger'
					];
					foreach($pendaftarans as $pendaftaran){
						?>
						<tr>
								<td><?php echo($pendaftaran['id'])?></td>
								<td><?php echo($pendaftaran['tahun_akademik']['tahun_akademik'] ?? '')?></td>
								<td><?php echo($pendaftaran['nama'])?></td>
								<td><?php echo(formatDate(explode(" ", $pendaftaran['created_at'])[0]))?></td>
								<td class="text-center">
									<?php
									if(($pendaftaran['pembayaran'][0]['status']??'BELUM DIBAYAR') == 'LUNAS'){
										?>
											<button class="btn btn-icon btn-light btn-sm" data-toggle="sudah_bayar" href="#"><i class="la la-info-circle"></i></button>
											<button class="btn btn-icon btn-light btn-sm" data-toggle="sudah_bayar" href=""><i class="la la-check-circle"></i></button>
										<?php
									}else{
										?>
											<a class="btn btn-icon btn-light btn-sm" data-toggle="toltip" title="Pilih Pembayaran" href="<?php echo base_url("pendaftaran/informasi_pembayaran?id=".$pendaftaran["id"]) ?>"><i class="la la-info-circle"></i></a>
											<a class="btn btn-icon btn-light btn-sm" title="Upload Bukti Pembayaran" href="<?php echo base_url("pendaftaran/upload_pembayaran?id=".$pendaftaran["id"]) ?>"><i class="la la-check-circle"></i></a>
										<?php
									}
									?>
								</td>
								<td class="text-center">
									<div class="label label-lg label-light-<?php echo ($status_pembayaran[$pendaftaran['pembayaran'][0]['status']??'BELUM LUNAS'])?> label-inline"><?php echo ($pendaftaran['pembayaran'][0]['status']??'BELUM LUNAS')?></div>
									<div class="d-flex align-items-center justify-content-center mt-2">
										<a href="#" data-status="<?php echo ($pendaftaran['pembayaran'][0]['status']??'BELUM LUNAS')?>" data-toggle="informasi-pembayaran"><i class="fas fa-info-circle mr-4"></i>Info</a href="#">
									</div>
								</td>
								<td> 
								<?php
									if(($pendaftaran['pembayaran'][0]['status']??'BELUM DIBAYAR') == 'LUNAS'){
										?>
										
											<?php 
											if(count($pendaftaran['hasil_penerimaan'])==0){
												?>
												<a title="Isi Formulir Pendaftaran" href="<?php echo base_url('pendaftaran/formulir/data_diri?id='.$pendaftaran['id']) ?>" class="btn btn-icon btn-light btn-sm">
													<i class="la la-arrow-right text-hover-primary"></i>
												</a>
												<?php
											}
											?>
										
										<?php
									}
										?>
								</td>
								<td class="text-center">
										<?php 
											if(!empty($pendaftaran['hasil_penerimaan'][0])){
												?>
													<div>
														<?php 
															echo $pendaftaran['hasil_penerimaan'][0]['prodi']['nama_prodi'];
														?>
													</div>
													<?php 
														if(!empty($pendaftaran['hasil_penerimaan'][0]['status'])){
															?>
																<div class="label label-xl label-<?php echo $status_pendaftaran[$pendaftaran['hasil_penerimaan'][0]['status']]['color']?> my-lg-0 my-2 label-inline font-weight-bolder"><?php echo ($pendaftaran['hasil_penerimaan'][0]['status'] ?? 'x')?></div>
																<div><?php echo ($pendaftaran['hasil_penerimaan'][0]['no_test'] ?? null) ?><div>
															<?php
														}
													?>
												<?php
											}
										?>
								</td>
								<td class="text-center">
									<?php 
										if(!empty($pendaftaran['hasil_penerimaan'][1])){
											?>
												<div>
													<div>
														<?php 
															echo $pendaftaran['hasil_penerimaan'][1]['prodi']['nama_prodi'];
														?>
													</div>
													<?php 
														if(!empty($pendaftaran['hasil_penerimaan'][1]['status'])){
															?>
																<div class="label label-xl label-<?php echo $status_pendaftaran[$pendaftaran['hasil_penerimaan'][1]['status']]['color']?> my-lg-0 my-2 label-inline font-weight-bolder"><?php echo ($pendaftaran['hasil_penerimaan'][1]['status'] ?? 'x')?></div>
																<div><?php echo ($pendaftaran['hasil_penerimaan'][1]['no_test'] ?? null) ?><div>
															<?php
														}
													?>
												</div>
											<?php
										}
									?>
								</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<div class="text-center">
			<?php
				if(count($pendaftarans)==0)
				echo ("Belum ada data camaru" )
			?>
		</div>
	</div>
</div>




<div class="modal fade" id="modal_informasi_pembayaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">INFORMASI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
			<p>
			Kolom ini akan memunculkan status pembayaran Anda. Terdapat 4 status:
			</p>
			<p>
			1. Jika status pembayaran Anda "BELUM LUNAS" maka Anda harus memilih metode pembayaran melalui tombol "PILIH PEMBAYARAN" di kolom "AKSI". Kemudian lakukan pembayaran sesuai petunjuk dan mengunggah buktinya di tombol "UPLOAD BUKTI PEMBAYARAN" yang berada di kolom "AKSI"
			</p>
			<p>
			2. Jika status pembayaran Anda "VALIDASI", silahkan menunggu proses validasi pembayaran.
			</p>
			<p>
			3. Jika status pembayaran Anda "LUNAS", silahkan melanjutkan untuk melakukan pengisian formulir melalui tombol di kolom "ISI FORMULIR"
			</p>
			<p>
			4.Jika status pembayaran Anda "DITOLAK", silahkan membayar dan melakukan upload bukti pembayaran kembali.
			</p>
			</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
