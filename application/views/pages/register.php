<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card card-custom">
				<div class="card-body">
					<form action="<?php echo base_url('/api/auth/register') ?>" method="POST" name="register">
						<div class="form-group row align-items-center">
							<label class="col-md-3 col-form-label">Nama</label>
							<div class="col-md-9">
								<input required class="form-control" type="text" value="" name="nama">
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="col-md-3 col-form-label">No. HP</label>
							<div class="col-md-9">
								<input required class="form-control" type="text" value="" name="no_hp">
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="col-md-3 col-form-label">Alamat Email</label>
							<div class="col-md-9">
								<input required class="form-control" type="email" value="" name="email">
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="col-md-3 col-form-label">Password</label>
							<div class="col-md-9">
								<input required class="form-control" type="password" value="" name="password">
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="col-md-3 col-form-label">Konfirmasi Password</label>
							<div class="col-md-9">
								<input required class="form-control" type="password" value="" name="confirm_password">
							</div>
						</div>
						<div class="row w-100 justify-content-center">
							<button type="button" class="btn btn-primary lanjut">Buat Akun</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
