
<!--begin::Entry-->
<div class="d-flex flex-column-fluid ">
	<div class="container-fluid p-0 overflow-hidden">
		<div class="row">
			<div class="col-lg-8 py-32" style="background-color: #F7C806;">
				<div class="d-flex flex-column align-items-center">
					<div class="text-dark display-2 font-weight-bolder text-center">
						SISTEM INFORMASI ADMISI
					</div>
					<div class="display-1 text-primary font-weight-boldest text-center">
						UKI TORAJA
					</div>
					<div>
						<a href="<?php echo base_url()."register" ?>" class="btn btn-primary">Gabung Sekarang</a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 bg-primary p-0">
				<img style="object-fit: cover;" src="<?php echo base_url('assets/media/univ.jpg') ?>" alt="">
			</div>
			<div class="col-lg-12 bg-primary">
				<div class="pengumuman-slider d-flex" style="max-width: 100%; overflow-x: hidden">
					<?php 
						foreach($pengumuman as $p){
							?>
								<div class="pengumuman-slider-item d-flex align-items-center justify-content-between" style="height: 84px; min-width: 100%">
									<div class="display-4 px-4 text-white"><?php echo $p['judul'] ?></div>
									<div class="px-4">
										<a class="btn btn-warning" href="<?php echo base_url('pengumuman?id='.$p['id'])?>">Lihat Selengkapnya</a>
									</div>
								</div>
							<?php
						}
					?>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="p-4">
					<div class="font-size-h1">Alur Pendaftaran</div>
					<div class="row align-items-end">
						<div class="col-md-2 mb-4 d-flex flex-column align-items-center">
							<div class="text-center">
								<img src="<?php echo base_url('assets/media/landing-icons/1.png') ?>" alt="" style="max-width: 100px">
								<div class="text-center font-weight-bold" style="height: 100px">
									Buat Akun
								</div>
							</div>
						</div>
						<div class="col-md-2 mb-4 d-flex flex-column align-items-center">
							<div class="text-center">
								<img src="<?php echo base_url('assets/media/landing-icons/2.png') ?>" alt="" style="max-width: 100px">
								<div class="text-center font-weight-bold" style="height: 100px">
									Membayar Biaya Formulir
								</div>
							</div>
						</div>
						<div class="col-md-2 mb-4 d-flex flex-column align-items-center">
							<div style="text-center">
								<img src="<?php echo base_url('assets/media/landing-icons/3.png') ?>" alt="" style="max-height: 100px">
								<div class="text-center font-weight-bold" style="height: 100px">
									Isi Form Pendaftaran
								</div>
							</div>
						</div>
						<div class="col-md-2 mb-4 d-flex flex-column align-items-center">
							<div class="text-center">
								<img src="<?php echo base_url('assets/media/landing-icons/4.png') ?>" alt="" style="max-width: 100px">
								<div class="text-center font-weight-bold" style="height: 100px">
									Seleksi
								</div>
							</div>
						</div>
						<div class="col-md-2 mb-4 d-flex flex-column align-items-center">
							<div class="text-center">
								<img src="<?php echo base_url('assets/media/landing-icons/5.png') ?>" alt="" style="max-width: 100px">
								<div class="text-center font-weight-bold" style="height: 100px">
									Registrasi Ulang
								</div>
							</div>
						</div>
						<div class="col-md-2 mb-4 d-flex flex-column align-items-center">
							<div class="text-center">
								<img src="<?php echo base_url('assets/media/landing-icons/6.png') ?>" alt="" style="max-width: 100px">
								<div class="text-center font-weight-bold" style="height: 100px">
									Pendaftaran Orientasi Mahasiswa Baru
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	
</div>
<!--end::Entry-->
