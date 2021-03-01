<div class="container">
	<div class="text-center">
		<div class="display-1">
			<?php echo $pengumuman['judul'] ?>
		</div>
		<div class="text-muted gutter-b">
		<?php 
			echo strftime( "%d %h %Y %H:%M",strtotime($pengumuman['created_at'] ));
		?>
		</div>
		<img src="<?php echo empty($pengumuman['foto']) ? base_url('/assets/media/logo.png') :base_url('uploads/'.$pengumuman['foto']) ?>"  style="width: 40%; object-fit: contain; background-color: #21232f">
	</div>
	<div class="mt-8 text-left">
		<?php echo $pengumuman['isi'] ?>
	</div>
</div>
<!-- <div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-12">
			<div class="card card-custom">
				<div class="card-header">
					<div class="card-title">
						<?php echo $pengumuman['judul'] ?>
					</div>
				</div>
				<div class="card-body">
				</div>
			</div>
		</div>
	</div>
</div> -->
