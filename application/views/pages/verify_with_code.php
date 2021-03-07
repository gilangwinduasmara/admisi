<div class="container">
	<?php 
		if($valid){
			?>
			<div class="card card-custom bg-light-success">
				<div class="card-body text-success">
					Validasi email berhasil
				</div>
			</div>
			<?php
		}else{
			?>
			<div class="card card-custom bg-light-danger">
				<div class="card-body text-danger">
					Link validasi tidak valid
				</div>
			</div>
			<?php
		}
	?>
</div>
