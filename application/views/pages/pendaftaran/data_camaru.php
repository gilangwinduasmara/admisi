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
<div class="container-fluid">
	<div class="d-flex justify-content-center">
		<a href="<?php echo base_url('/pendaftaran/formulir') ?>" class="btn btn-primary"><i class="la la-plus-circle"></i>Tambah Formulir</a>
	</div>
	<div>
	<div class="row justify-content-between align-items-end">
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
		<div class="col-md-3">
			<div class="input-icon">
				<input type="text" class="form-control" placeholder="Cari..." id="search_query">
				<span><i class="flaticon2-search-1 text-muted"></i></span>
			</div>
		</div>
	</div>
	</div>
	<div class="mt-12 ">
		<?php if(count($pendaftarans)>0){?>
		<table class="table table-bordered" id="data_pendaftar">
			<thead >
				<tr>
					<th> <div class="font-size-xs">No. Formulir</div></th>
					<th style="max-width: 70px;"><div class="font-size-xs">Tahun Akademik</div></th>
					<th><div class="font-size-xs">Nama Camaru</div></th>
					<th style="max-width: 70px;"><div class="font-size-xs">Tanggal Daftar</div></th>
					<th style="min-width: 100px;"><div class="font-size-xs">Aksi Pembayaran</div></th>
					<th><div class="font-size-xs">Status Pembayaran</div></th>
					<th style="min-width: 100px;"><div class="font-size-xs">Isi Formulir</div></th>
					<th style="min-width: 120px;" class="text-center"><div class="font-size-xs">Status Pendaftaran <br> Pilihan 1</div></th>
					<th style="min-width: 120px;" class="text-center"><div class="font-size-xs">Status Pendaftaran <br> Pilihan 2</div></th>
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
								<td><div class="font-size-xs"><?php echo($pendaftaran['id'])?></div></td>
								<td><div class="font-size-xs"><?php echo($pendaftaran['tahun_akademik']['tahun_akademik'] ?? '')?></div></td>
								<td><div class="font-size-xs"><?php echo($pendaftaran['nama'])?></div></td>
								<td><div class="font-size-xs"><?php echo(formatDate(explode(" ", $pendaftaran['created_at'])[0]))?></div></td>
								<td class="text-center">
									<?php
									if(($pendaftaran['pembayaran'][0]['status']??'BELUM DIBAYAR') == 'LUNAS'){
										?>
											<a class="font-size-xs btn btn-secondary disabled" style="margin-bottom: 4px; width: 100px" data-toggle="tooltip" title="Pilih Pembayaran" href="<?php echo base_url("pendaftaran/informasi_pembayaran?id=".$pendaftaran["id"]) ?>">Pilih Metode</a><br >
											<a class="font-size-xs btn btn-secondary disabled" style="margin-bottom: 4px; width: 100px" data-toggle="tooltip" title="Upload Bukti Pembayaran" href="<?php echo base_url("pendaftaran/upload_pembayaran?id=".$pendaftaran["id"]) ?>">Upload Bukti</a>
										<?php
									}else{
										?>
											<a class="font-size-xs btn btn-primary btn-shadow" style="margin-bottom: 4px; width: 100px" data-toggle="tooltip" title="Pilih Pembayaran" href="<?php echo base_url("pendaftaran/informasi_pembayaran?id=".$pendaftaran["id"]) ?>">Pilih Metode</a><br >
											<a class="font-size-xs btn btn-warning btn-shadow" style="margin-bottom: 4px; width: 100px" data-toggle="tooltip" title="Upload Bukti Pembayaran" href="<?php echo base_url("pendaftaran/upload_pembayaran?id=".$pendaftaran["id"]) ?>">Upload Bukti</a>
										<?php
									}
									?>
								</td>
								<td class="text-center">
									<a href="#" data-status="<?php echo ($pendaftaran['pembayaran'][0]['status']??'BELUM LUNAS')?>" data-toggle="informasi-pembayaran">
										<div class="font-size-xs btn btn-light-<?php echo ($status_pembayaran[$pendaftaran['pembayaran'][0]['status']??'BELUM LUNAS'])?> label-inline bg-hover-<?php echo ($status_pembayaran[$pendaftaran['pembayaran'][0]['status']??'BELUM LUNAS'])?> text-hover-white"><?php echo ($pendaftaran['pembayaran'][0]['status']??'BELUM LUNAS')?></div>
									</a href="#">
									<!-- <div class="d-flex align-items-center justify-content-center mt-2">
									</div> -->
								</td>
								<td class="text-center"> 
								<?php
									if(($pendaftaran['pembayaran'][0]['status']??'BELUM DIBAYAR') == 'LUNAS'){
										?>
										
											<?php 
											if(count($pendaftaran['hasil_penerimaan'])==0){
												?>
												<a data-toggle="tooltip" title="Isi Formulir Pendaftaran" href="<?php echo base_url('pendaftaran/formulir/data_diri?id='.$pendaftaran['id']) ?>" class="btn btn-primary font-size-xs">
													Isi Formulir
												</a>
												<?php
											}
											?>
										
										<?php
									}
										?>
								</td>
								<td class="text-center" style="vertical-align: bottom">
									<div class="font-size-xs">
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
																<a data-toggle="tooltip" title="Hasil Penerimaan" href="<?php echo base_url('pendaftaran/hasil_penerimaan?id='.$pendaftaran['id']) ?>" class="label label-xs label-<?php echo $status_pendaftaran[$pendaftaran['hasil_penerimaan'][0]['status']]['color']?> my-lg-0 my-2 label-inline font-weight-bolder"><?php echo ($pendaftaran['hasil_penerimaan'][0]['status'] ?? 'x')?></a>
																<div><?php echo "No. Test: ".($pendaftaran['hasil_penerimaan'][0]['no_test'] ?? null) ?><div>
															<?php
														}
													?>
												<?php
											}
										?>
									</div>
								</td>
								<td class="text-center" style="vertical-align: bottom">
									<div class="font-size-xs">
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
																	<a data-toggle="tooltip" title="Hasil Penerimaan" href="<?php echo base_url('pendaftaran/hasil_penerimaan?id='.$pendaftaran['id']) ?>" class="label label-xs label-<?php echo $status_pendaftaran[$pendaftaran['hasil_penerimaan'][1]['status']]['color']?> my-lg-0 my-2 label-inline font-weight-bolder"><?php echo ($pendaftaran['hasil_penerimaan'][1]['status'] ?? 'x')?></a>
																	<div><?php echo "No. Test: ".($pendaftaran['hasil_penerimaan'][1]['no_test'] ?? null) ?><div>
																<?php
															}
														?>
													</div>
												<?php
											}
										?>
									</div>
								</td>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<?php } ?>
		<div class="row justify-content-center align-items-center">
			<div class="col-md-4">
				<div class="text-primary d-flex align-items-center justify-content-around p-4" style="border: 1px solid #B22D34">
					<?php if(count($pendaftarans)==0){?>
						<div>
							<img src="<?php echo base_url('assets/media/alert-circle 1.png') ?>" alt="">
						</div>
						<div class="ml-4">
							Belum ada data camaru. Silahkan klik tombol "Tambah Formulir" untuk memulai pendaftaran.
						</div>
					<?php } ?>
				</div>
			</div>
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
			1. Jika status pembayaran Anda "BELUM LUNAS" maka Anda harus memilih metode pembayaran melalui tombol "PILIH PEMBAYARAN" di kolom "AKSI PEMBAYARAN". Kemudian lakukan pembayaran sesuai petunjuk dan mengunggah buktinya di tombol "UPLOAD BUKTI" yang berada di kolom "AKSI PEMBAYARAN"
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
