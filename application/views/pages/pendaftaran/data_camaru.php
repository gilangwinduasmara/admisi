<div class="container">
	<div class="d-flex justify-content-center">
		<a href="<?php echo base_url('/pendaftaran/formulir') ?>" class="btn btn-warning"><i class="fas fa-plus"></i> Formulir</a>
	</div>
	<div class="table-responsive mt-12">
		<table class="table table table-vertical-center table-formulir">
			<thead>
				<tr>
					<th class="p-0 py-6 min-w-100px">No. Formulir</th>
					<th class="p-0 py-6 min-w-150px">Nama Camaru</th>
					<th class="p-0 py-6 min-w-120px">Tanggal Daftar</th>
					<th class="py-6 min-w-100px text-left">Status</th>
					<th class="p-0 py-6 min-w-100px text-center">Aksi</th>
					<th class="p-0 py-6 min-w-150px">Status Pembayaran</th>
					<th class="p-0 py-6"></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$status_pembayaran = [
						'BELUM LUNAS' => 'warning', 
						'VALIDASI' => 'info', 
						'LUNAS' => 'success', 
						'EXPIRED' => 'danger'
					];
					foreach($pendaftarans as $pendaftaran){
						?>
						<tr>
							<?php
							echo '
								<td>'.$pendaftaran['id'].'</td>
								<td>'.$pendaftaran['nama'].'</td>
								<td>'.$pendaftaran['created_at'].'</td>
								<td class="text-left">
									'.((count($pendaftaran['hasil_penerimaan'])>0 ? '<span class="label label-lg label-light-info label-inline">SELEKSI</span>': '')).'
								</td>
								<td class="text-center">
									<a class="btn btn-icon btn-light btn-sm" data-toggle="toltip" title="Informasi Pembayaran" href="'.base_url("pendaftaran/informasi_pembayaran?id=".$pendaftaran["id"]).'"><i class="la la-info-circle"></i></a>
									<a class="btn btn-icon btn-light btn-sm" title="Upload Bukti Pembayaran" href="'.base_url("pendaftaran/upload_pembayaran?id=".$pendaftaran["id"]).'"><i class="la la-check-circle"></i></a>
								</td>
								<td>
									<span class="label label-lg label-light-'.$status_pembayaran[$pendaftaran['pembayaran'][0]['status']??'BELUM LUNAS'].' label-inline">'.($pendaftaran['pembayaran'][0]['status']??'BELUM LUNAS').'</span>
								</td>
							';
							?>
							<?php
								if(($pendaftaran['pembayaran'][0]['status']??'BELUM DIBAYAR') == 'LUNAS'){
									?>
									<td> 
										<?php 
										if(count($pendaftaran['hasil_penerimaan'])==0){
											?>
											<a href="<?php echo base_url('pendaftaran/formulir/data_diri?id='.$pendaftaran['id']) ?>" class="btn btn-icon btn-light btn-sm">
												<i class="la la-arrow-right text-hover-primary"></i>
											</a>
											<?php
										}
										?>
									</td>
									<?php
								}
							?>
						</tr>
						<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>
