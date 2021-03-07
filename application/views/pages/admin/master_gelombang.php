<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card card-custom bg-light">
				<div class="card-body">
					<div class="d-flex justify-content-end">
						<button class="btn btn-primary" data-toggle="create_gelombang">Tambah</button>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Cari Berdasarkan Tahun Akademik</label>
								<select id="search_tahun_akademik" class="form-control">
									<option value="">All</option>
									<?php
										foreach($tahun_akademik as $tahun){
											?>
												<option value="<?php echo $tahun['id'] ?>"><?php echo $tahun['tahun_akademik'] ?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
					</div>
					<table class="table table-head-custom" id="table_master_gelombang">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tahun Akademik</th>
								<th>Gelombang</th>
								<th>Tanggal Mulai</th>
								<th>Tanggal Selesai</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($gelombang as $g){
									?>
										<tr>
											<td><?php echo $g['id'] ?></td>
											<td><?php echo $g['tahun_akademik'] ?></td>
											<td><?php echo $g['nama_gelombang'] ?></td>
											<td><?php echo $g['tanggal_mulai'] ?></td>
											<td><?php echo $g['tanggal_selesai'] ?></td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_create_gelombang" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" action="<?php echo base_url('/api/admin/create_gelombang') ?>" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Gelombang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
				<div class="form-group">
					<label for="">Tahun Akademik</label>
					<select name="tahun_akademik_id" id="" class="form-control" required>
						<option value="">Pilih</option>
						<?php
							foreach($tahun_akademik as $tahun){
								?>
									<option value="<?php echo $tahun['id'] ?>"><?php echo $tahun['tahun_akademik'] ?></option>
								<?php
							}
						?>
					</select>
				</div>
                <div class="form-group">
					<label for="">Nama Gelombang</label>
					<input type="text" class="form-control" required name="nama_gelombang">
				</div>
                <div class="form-group">
					<label for="">Tanggal Mulai</label>
					<input type="date" class="form-control" required name="tanggal_mulai">
				</div>
                <div class="form-group">
					<label for="">Tanggal Selesai</label>
					<input type="date" class="form-control" required name="tanggal_selesai">
				</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary font-weight-bold">Save changes</button>
            </div>
        </form>
    </div>
</div>
