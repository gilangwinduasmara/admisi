
<div id="kt_header" class="header header-fixed">

	<!--begin::Container-->
	<div class="container d-flex align-items-stretch justify-content-between">

		<div class="d-none d-lg-flex align-items-center mr-3">

			<a href="<?php echo base_url() ?>" class="">
				<img class="header-logo" src="<?php echo base_url('/assets/media/logo.png') ?>" alt="">
			</a>

		</div>
		<?php 
			if(empty($this->session->userdata('role'))){
				?>
					<div class="topbar">
						<div class="topbar-item mr-4" data-offset="10px,0px">
							<a href="<?php echo base_url('/pengumuman') ?>" class="btn font-weight-bolder btn-sm btn-link px-5">Pengumuman</a>
						</div>
						<div class="dropdown">
							<button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Pendaftaran
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="<?php echo base_url("pendaftaran/data_camaru") ?>">Data Camaru</a>
								<a class="dropdown-item" href="<?php echo base_url("pendaftaran/formulir") ?>">Formulir Pendaftaran</a>
								<a class="dropdown-item" href="<?php echo base_url("pendaftaran/hasil_penerimaan") ?>">Hasil Penerimaan</a>
								<a class="dropdown-item" href="<?php echo base_url("pendaftaran/registrasi_ulang") ?>">Registrasi Ulang</a>
								<a class="dropdown-item" href="<?php echo base_url("pendaftaran/omb") ?>">Pendaftaran OMB</a>
							</div>
						</div>
						<div class="topbar-item mr-4" data-toggle="dropdown" data-offset="10px,0px">
						</div>
						<div class="topbar-item mr-4" data-offset="10px,0px">
							<div class="btn font-weight-bolder btn-sm btn-link px-5">Panduan</div>
						</div>
						<div class="topbar-item mr-4" data-offset="10px,0px">
							<div class="btn font-weight-bolder btn-sm btn-link px-5">Kontak</div>
						</div>
						<div class="topbar-item mr-4" data-offset="10px,0px">
							<a class="btn font-weight-bolder btn-sm btn-primary px-5" href="<?php echo base_url('login')?>">Login</a>
							<div class="dropdown">

							</div>

						</div>
					</div>
				<?php
			}else if($this->session->userdata('role') == 'USER'){
				?>
					<div class="topbar">
						<div class="topbar-item mr-4" data-offset="10px,0px">
							<a href="<?php echo base_url('/pengumuman') ?>" class="btn font-weight-bolder btn-sm btn-link px-5">Pengumuman</a>
						</div>
						<div class="topbar-item mr-4" data-toggle="dropdown" data-offset="10px,0px">
							<div class="dropdown">
								<button class="btn btn-link dropdown-toggle" type="button" id="dropdownData" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Pendaftaran
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownData">
									<a class="dropdown-item" href="<?php echo base_url("pendaftaran/data_camaru") ?>">Data Camaru</a>
									<a class="dropdown-item" href="<?php echo base_url("pendaftaran/formulir") ?>">Formulir Pendaftaran</a>
									<a class="dropdown-item" href="<?php echo base_url("pendaftaran/hasil_penerimaan") ?>">Hasil Penerimaan</a>
									<a class="dropdown-item" href="<?php echo base_url("pendaftaran/registrasi_ulang") ?>">Registrasi Ulang</a>
									<a class="dropdown-item" href="<?php echo base_url("pendaftaran/omb") ?>">Pendaftaran OMB</a>
								</div>
							</div>
						</div>
						<div class="topbar-item mr-4" data-offset="10px,0px">
							<div class="btn font-weight-bolder btn-sm btn-link px-5">Panduan</div>
						</div>
						<div class="topbar-item mr-4" data-offset="10px,0px">
							<div class="btn font-weight-bolder btn-sm btn-link px-5">Kontak</div>
						</div>
						<div class="topbar-item mr-4" data-offset="10px,0px">
							<button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="far fa-user-circle"></i>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuProfile">
								<a class="dropdown-item" href="<?php echo base_url("/logout") ?>">Logout</a>
							</div>
						</div>
					</div>
				<?php
			}else{
				?>
				<div class="topbar">
					<div class="topbar-item mr-4" data-offset="10px,0px">
						<a href="<?php echo base_url('/pengumuman') ?>" class="btn font-weight-bolder btn-sm btn-link px-5">Pengumuman</a>
					</div>
					<div class="topbar-item mr-4" data-toggle="dropdown" data-offset="10px,0px">
						<div class="dropdown">
							<button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuData" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Data
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuData">
								<a class="dropdown-item" href="<?php echo base_url("admin/data_pendaftar") ?>">Data Pendaftaran</a>
								<a class="dropdown-item" href="<?php echo base_url("admin/data_camaru") ?>">Data Camaru</a>
								<a class="dropdown-item" href="<?php echo base_url("admin/data_registrasi_ulang") ?>">Data Registrasi Ulang</a>
								<a class="dropdown-item" href="<?php echo base_url("admin/data_omb") ?>">Data OMB</a>
								<a class="dropdown-item" href="<?php echo base_url("admin/pengumuman") ?>">Pengumuman</a>
								<?php 
									if($this->session->userdata('role') == 'ADMIN'){
										?>
											<a class="dropdown-item" href="<?php echo base_url("admin/data_user") ?>">Data User</a>
										<?php
									}
								?>
							</div>
						</div>
					</div>
					
					<div class="topbar-item mr-4" data-offset="10px,0px">
						<button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="far fa-user-circle"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuProfile">
							<a class="dropdown-item" href="<?php echo base_url("/logout") ?>">Logout</a>
						</div>
					</div>
				</div>
				<?php
			}
		?>

	</div>

</div>
