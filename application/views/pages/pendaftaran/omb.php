<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<div class="card card-custom">
				<div class="card-body">
					<form action="">
						<div class="form-group row">
							<label for="" class="col-3 col-form-label">NIM</label>
							<input type="text" class="col-8 form-control">
						</div>
						<div class="form-group row">
							<label for="" class="col-3 col-form-label">Nama</label>
							<input type="text" class="col-8 form-control">
						</div>
						<div class="form-group row">
							<label for="" class="col-3 col-form-label">Program Studi</label>
							<input type="text" class="col-8 form-control">
						</div>
						
						<div class="form-group">
							<label>Ukuran Jas Almamater</label>
							<div class="radio-list">
								<?php 
									foreach(['S', 'M', 'L', 'LL', 'LLL'] as $ukuran){
										echo '
											<label class="radio">
												<input type="radio" name="radios1"/>
												<span></span>
												'.$ukuran.'
											</label>
										';
									}
								?>
								
							</div>
							<div class="d-flex justify-content-center">
							</div>
						</div>

						<div class="row justify-content-center">
							<input type="Submit" class="btn btn-primary" value="Submit">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
