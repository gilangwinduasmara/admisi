<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-custom">
				<div class="card-header flex-wrap py-3">
					<div class="card-title">
						<h3 class="card-label">Pengumuman</h3>
					</div>
					<div class="card-toolbar">
						<a href="<?php echo base_url('admin/pengumuman/edit') ?>" class="btn btn-light-primary">Pengumuman Baru</a>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered" id="table_pengumuman">
						<thead>
							<tr>
								<th>No</th>
								<th>Judul</th>
								<th>Isi</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach($pengumuman as $key=>$p){
									?>
										<tr>
											<td><?php echo $key+1 ?></td>
											<td><?php echo $p['judul'] ?></td>
											<td><?php echo substr($p['isi'], 0, 20) ?></td>
											<td>
												<a href="<?php echo base_url('admin/pengumuman/edit?id='.$p['id']) ?>" class="btn btn-icon btn-light">
													<i class="far fa-edit"></i>
												</a>
											</td>
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
