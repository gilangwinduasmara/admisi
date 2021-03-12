<div class="container">
	<div class="row justify-content-center">
		<?php 
			foreach($pengumuman as $p){
				?>
					<div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
						<div class="card card-custom w-75 h-100 gutter-b">
							<img src="<?php echo empty($p['foto']) ? base_url('/assets/media/logo.png') :base_url('uploads/'.$p['foto']) ?>" class="card-img-top" style="height: 200px; object-fit: contain; background-color: #21232f">
							<div class="card-body">
								<div class="card-title">
									<?php echo $p['judul'] ?>
								</div>
								<!-- <div class="card-text">
									<?php echo $p['isi'] ?>
								</div> -->
								<div class="d-flex justify-content-end">
									<a href="<?php echo base_url('/pengumuman?id='.$p['id']) ?>" class="btn btn-primary">Read more</a>
								</div>
							</div>
						</div>
					</div>
				<?php
			}
		?>
	</div>
</div>
