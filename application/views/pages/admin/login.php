<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<div class="card card-custom">
				<div class="card-body">
					<?php echo form_open("/api/auth/login") ?>
					<!-- <form action="/api/auth/login" method="post" class="py-6"> -->
						<div class="form-group row align-items-center">
							<label class="col-2 col-form-label">Username</label>
							<div class="col-lg-10">
								<input required class="form-control" name="email">
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="col-2 col-form-label">Password</label>
							<div class="col-lg-10">
								<input required class="form-control" type="password" value="" name="password">
							</div>
						</div>
						<div class="row w-100 justify-content-center">
							<input type="submit" value="Login" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
