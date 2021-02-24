<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<div class="card card-custom">
				
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<select class="form-control" id="search_status_pembayaran">
							<option value="">Status Pembayaran</option>
							<option value="Belum Bayar">Belum Bayar</option>
							<option value="Menunggu Validasi">Menunggu Validasi</option>
							<option value="Sudah Bayar">Sudah Bayar</option>
						</select>
					</div>
					<div class="col-md-4">
						<div class="input-icon">
							<input type="text" class="form-control" placeholder="Cari..." id="search_query">
							<span><i class="flaticon2-search-1 text-muted"></i></span>
						</div>
					</div>

				</div>
				<table class="table table-bordered mt-4" id="data_pendaftar">
					<thead>
						<tr>
							<th>No Formulir</th>
							<th>Nama Camaru</th>
							<th>Tanggal Daftar</th>
							<th>Status Pembayaran</th>
							<th>Bukti Pembayaran</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach($pendaftaran as $p){
								?>
								<tr>
									<td><?php echo $p['id'] ?></td>
									<td><?php echo $p['nama'] ?></td>
									<td><?php echo explode(' ', $p['created_at'])[0]  ?></td>
									<td class="text-center">
										<div>
											<?php
											if($p['pembayaran_lunas']){
												echo '<span class="label label-lg label-light-success label-inline">Sudah Bayar</span>';
											}else if($p['pembayaran_validasi']){
												echo '<span class="label label-lg label-light-warning label-inline">Menunggu Validasi</span>';
											}else{
												echo '<span class="label label-lg label-light-danger label-inline">Belum Bayar</span>';
											}
											?>
										</div>
									</td>
									<td class="text-center">
										<?php
											if(!empty($p['pembayaran_lunas'])){
												?>
												<div class="symbol symbol-40 symbol-light-white">
													<div class="symbol-label">
														<img style="max-height: 50px; obj-fit: contain" src="<?php echo base_url("uploads/".$p['pembayaran_lunas']['upload_bukti_bayar']) ?>">
													</div>
												</div>
												<?php
											}
											else if(!empty($p['pembayaran_validasi'])){
												?>
												<div class="symbol symbol-40 symbol-light-white">
													<div class="symbol-label">
														<img style="max-height: 50px; obj-fit: contain" src="<?php echo base_url("uploads/".$p['pembayaran_validasi']['upload_bukti_bayar']) ?>">
													</div>
												</div>
												<?php
											}
										?>
									</td>
									<td>
										<?php
											if(!empty($p['pembayaran_validasi'])){
												?>
													<button class="btn btn-primary" data-toggle="validasi_pembayaran" data-id="<?php echo $p['pembayaran_validasi']['id'] ?>" data-nama="<?php echo $p['nama'] ?>">Validasi</button>
												<?php
											}else{
												?>
													<button class="btn btn-dark disabled" disabled>Validasi</button>
												<?php
											}
										?>
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
	<div class="modal fade" id="modal__data_pendaftar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Validasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</div>
