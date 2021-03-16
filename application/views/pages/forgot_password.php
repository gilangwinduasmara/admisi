<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-6">
			<?php if ($link_sent){?>
				<div class="card card-custom">
					<div class="card-body">
						Link reset password telah dikirim ke email anda
					</div>
				</div>
			<?php } else if (!empty($this->input->get('token'))){?>
				<form action="<?php echo base_url('/api/auth/reset_password') ?>" method="POST" name="reset_password">
					<input type="text" hidden name="token" value="<?php echo $this->input->get('token') ?? null ?>">
					<div class="form-group row align-items-center">
						<label class="col-md-3 col-form-label">Password</label>
						<div class="col-lg-9">
							<input required class="form-control" type="password" name="password">
						</div>
					</div>
					<div class="form-group row align-items-center">
						<label class="col-md-3 col-form-label">Konfirmasi Password</label>
						<div class="col-lg-9">
							<input required class="form-control" type="password" name="confirm_password">
						</div>
					</div>
					<div class="form-group text-center">
						<button class="btn btn-primary lanjut" type="button">Submit</button>
					</div>
				</form>
			<?php } else{?>
			<div class="card card-custom">
				<div class="card-body">
					<form action="<?php echo base_url('/api/auth/forgot_password') ?>" method="POST">
						<div class="form-group row align-items-center">
							<label class="col-md-3 col-form-label">Email</label>
							<div class="col-lg-9">
								<input required class="form-control" type="email" name="email">
							</div>
						</div>
						<div class="form-group text-center">
							<button class="btn btn-primary" type="submit">Submit</button>
						</div>
					</form>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
