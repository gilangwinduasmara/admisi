
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

						<?php 
							if(isset($subheader)){
								$this->load->view('partials/_subheader/subheader-v6.php');
							}
						?>
						
						<?php $this->load->view($page) ?>
					</div>

					<!--end::Content-->

					<?php 
						// $this->load->view('partials/_footer.php') 
					?>
				</div>

				<!--end::Wrapper-->
			</div>

			<!--end::Page-->
		</div>

		<!--end::Main-->
