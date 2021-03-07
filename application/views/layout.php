
<!--begin::Main-->

		<?php $this->load->view('partials/_header-mobile.php') ?>
		<div class="d-flex flex-column flex-root">

			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">

				<?php $this->load->view('partials/_aside.php') ?>

				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

					<?php $this->load->view('partials/_header.php') ?>

					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="container">
							<div class="row justify-content-center">
								<?php 
									$success = $this->session->flashdata('success');
									if(!empty($success)){
										foreach($success as $scs){
											echo '
											<div class="col-lg-10">
												<div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
													<div class="alert-text">'.$scs.'</div>
													<div class="alert-close">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="ki ki-close"></i></span>
														</button>
													</div>
												</div>
											</div>
											';
										}
									}
									$warnings = $this->session->flashdata('warnings');
									if(!empty($warnings)){
										foreach($warnings as $warning){
											echo '
											<div class="col-lg-10">
												<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert">
													<div class="alert-text">'.$warning.'</div>
													<div class="alert-close">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="ki ki-close"></i></span>
														</button>
													</div>
												</div>
											</div>
											';
										}
									}
									$errors = $this->session->flashdata('errors');
									if(!empty($errors)){
										foreach($errors as $error){
											echo '
											<div class="col-lg-10">
												<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
													<div class="alert-text">'.$error.'</div>
													<div class="alert-close">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="ki ki-close"></i></span>
														</button>
													</div>
												</div>
											</div>
											';
										}
									}
								?>
							</div>
						</div>
						<?php 
							if(isset($subheader)){
								$this->load->view('partials/_subheader/subheader-v6.php');
							}
						?>
						
						<?php $this->load->view($page) ?>
					</div>

					<!--end::Content-->

					<?php 
						$this->load->view('partials/_footer.php') 
					?>
				</div>

				<!--end::Wrapper-->
			</div>

			<!--end::Page-->
		</div>

		<!--end::Main-->

<div class="modal fade" id="modalImagePreview" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <img src="" class="modal-image">
        </div>
    </div>
</div>
