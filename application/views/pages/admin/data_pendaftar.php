<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<div class="table-responsive">
			<table class="table table-bordered table-checkable" id="data_pendaftar">
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
												echo '<span class="label label-lg label-light-success label-inline">Lunas</span>';
											}else if($p['pembayaran_validasi']){
												echo '<span class="label label-lg label-light-warning label-inline">Menunggu Validasi</span>';
											}else{
												echo '<span class="label label-lg label-light-danger label-inline">Belum Dibayar</span>';
											}
											?>
										</div>
									</td>
									<td class="text-center">
										<?php
											if(!empty($p['pembayaran_validasi'])){
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
