<div class="container">
	<div class="row justify-content-center">
		<?php 
			if(empty($pendaftaran['pembayaran'])){
				?>
				<div class="card card-custom">
					<div class="card-body">
						<div class="gutter-b">Anda harus memilih metode pembayaran terlebih dahulu</div>
						<a class="btn btn-primary" href="<?php echo base_url('pendaftaran/metode_pembayaran?id='.$this->input->get('id')) ?>">Pilih Metode Pembayaran</a>
					</div>
				</div>
				<?php
			}else{
				?>
				<div class="card card-custom">
					<div class="card-body">
						<?php 
							if($pendaftaran['pembayaran'][0]){
								?>
									<p>Nomor pembayaran Anda <b><?php echo $pendaftaran['pembayaran'][0]['id'] ?></b>,<br> Silahkan lakukan pembayaran melalui metode yang sudah dipilih. <br> Lalu, upload bukti pembayaran pada tombol "Upload Bukti" pada kolom "Aksi Pembayaran"</p>
									<div class="d-flex justify-content-center">
										<a href="<?php echo base_url('/pendaftaran/data_camaru') ?>" class="btn btn-primary">Kembali</a>
									</div>
								<?php
							}
							else if($pendaftaran['pembayaran'][0]['id']['status'] == 'LUNAS'){
								?>
									<p>Pembayaran sudah <b>divalidasi</b>, silahkan melanjutkan proses pendaftaran</p>
									<div class="d-flex justify-content-center">
										<a href="<?php echo base_url('/pendaftaran/data_camaru') ?>" class="btn btn-primary">Kembali</a>
									</div>
								<?php
							}
							else if($pendaftaran['pembayaran'][0]['id']['status'] == 'DITOLAK'){
								?>
									<p>Pembayaran anda <b class="text-danger">ditolak</b>, silahkan ulangi proses validasi pembayaran sesuai metode yang dipilih</p>
									<div class="d-flex justify-content-center">
										<a href="<?php echo base_url('/pendaftaran/data_camaru') ?>" class="btn btn-primary">Kembali</a>
									</div>
								<?php
							}
						?>
					</div>
				</div>
				<?php
			}
		?>

	</div>
</div>
