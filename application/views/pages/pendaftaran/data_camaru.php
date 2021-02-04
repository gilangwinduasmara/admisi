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
					<th class="p-0 py-6 min-w-100px">Status</th>
					<th class="p-0 py-6 min-w-100px text-center">Aksi</th>
					<th class="p-0 py-6 min-w-150px">Status Pembayaran</th>
					<th class="p-0 py-6"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>2021001</td>
					<td>Reinchart Labangkalang</td>
					<td>2 Januari 2021</td>
					<td> </td>
					<td class="text-center">
						<a class="btn btn-icon btn-light btn-sm" data-toggle="toltip" title="Informasi Pembayaran" href="<?php echo base_url("pendaftaran/informasi_pembayaran") ?>"><i class="la la-info-circle"></i></a>
						<a class="btn btn-icon btn-light btn-sm" title="Upload Bukti Pembayaran" href="<?php echo base_url("pendaftaran/upload_pembayaran") ?>"><i class="la la-check-circle"></i></a>
					</td>
					<td><span class="label label-lg label-light-warning label-inline">Belum dibayar</span></td>
				</tr>
				<tr>
					<td>2021002</td>
					<td>Gilang Windu Asmara</td>
					<td>2 Januari 2021</td>
					<td> </td>
					<td class="text-center">
						<a class="btn btn-icon btn-light btn-sm" href="<?php echo base_url("pendaftaran/informasi_pembayaran") ?>"><i class="la la-info-circle"></i></a>
						<a class="btn btn-icon btn-light btn-sm" href="<?php echo base_url("pendaftaran/upload_pembayaran") ?>"><i class="la la-check-circle"></i></a>
					</td>
					<td><span class="label label-lg label-light-success label-inline">Sudah Dibayar</span></td>
					<td> 
						<a href="<?php echo base_url('pendaftaran/data_personal') ?>" class="btn btn-icon btn-light btn-sm"><i class="la la-arrow-right text-hover-primary"></i></a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
