<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-12">
			<div class="card card-custom">
				
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<label for="">Cari berdasarkan jenis user</label>
						<select class="form-control" id="search_jenis_user">
							<option value="">All</option>
							<option value="USER">User</option>
							<option value="PPMB">Panitia</option>
						</select>
					</div>
					<div class="col-md-8 d-flex justify-content-end">
						<div>
							<button class="btn btn-primary" id="create_panitia">Tambah Panitia</button>
						</div>
					</div>
					<div class="col-md-4 mt-4">
						<div class="input-icon">
							<input type="text" class="form-control" placeholder="Cari..." id="search_query">
							<span><i class="flaticon2-search-1 text-muted"></i></span>
						</div>
					</div>
					<div class="col-md-12"></div>
					<div class="col-md-4 mt-4 mb-4">
						<div class="count-camaru"></div>
					</div>
				</div>
				<table class="table table-bordered mt-8" id="table_data_user">
					<thead>
						<tr>
							<th>Id User</th>
							<th>Nama</th>
							<th>Email</th>
							<th>No Hp</th>
							<th>Jenis Akun</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal__data_user" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<form action="<?php echo base_url('api/admin/create_panitia') ?>" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="">Nama</label>
							<input name="nama" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Email</label>
							<input name="email" class="form-control">
						</div>
						<div class="form-group">
							<label for="">No Hp</label>
							<input name="no_hp" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Password</label>
							<input name="password" type="password" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary font-weight-bold">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
