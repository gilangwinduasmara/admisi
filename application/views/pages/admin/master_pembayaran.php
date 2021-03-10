<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-custom card-scretch gutter-b bg-light">
				<div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder text-dark">Pembayaran</span>
					</h3>
					<div class="card-toolbar">
						<a href="#" class="btn btn-success font-weight-bolder font-size-sm" id="button_tambah_pembayaran">
						<span class="svg-icon svg-icon-md svg-icon-white">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24"></polygon>
									<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
									<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
								</g>
							</svg>
						</span>Tambah</a>
					</div>
				</div>
				<div class="card-body pt-2 pb-0 mt-n3">
					<div class="table-responsive">
						<table class="table table-head-custom table-vertical-center" id="table_master_pembayaran">
							<thead>
								<tr>
									<th>Id</th>
									<th>Jenis Pembayaran</th>
									<th>Informasi Pembayaran</th>
									<th class="text-right">Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<div class="modal fade" id="modal_jalur_pendaftaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jalur Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
			<form action="<?php echo base_url('service/api/jalur_pendaftaran') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Nama</label>
						<input type="text" class="form-control" name="jalur_pendaftaran">
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

<div class="modal fade" id="modal_tahun_akademik" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jalur Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
			<form action="<?php echo base_url('service/api/tahun_akademik') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Tahun Akademik</label>
						<input type="text" class="form-control" name="tahun_akademik">
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

<div class="modal fade" id="modal_pembayaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
			<form action="<?php echo base_url('service/api/jenis_pembayaran') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Jenis Pembayaran</label>
						<input type="text" class="form-control" name="jenis_pembayaran">
					</div>
					<div class="form-group">
						<label for="">Info</label>
						<textarea type="text" class="form-control" name="info_pembayaran"></textarea>
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

<div class="modal fade" id="modal_edit_pembayaran" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
			<form action="<?php echo base_url('service/api/jenis_pembayaran') ?>" method="POST" id="form_edit">
				<div class="modal-body">
					<div class="form-group" hidden>
						<input type="text" class="form-control" name="id">
					</div>
					<div class="form-group">
						<label for="">Jenis Pembayaran</label>
						<input type="text" class="form-control" name="jenis_pembayaran">
					</div>
					<div class="form-group">
						<label for="">Info</label>
						<textarea type="text" class="form-control" name="info_pembayaran"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
					<button type="submit" name="edit" value="true" class="btn btn-primary font-weight-bold">Simpan</button>
				</div>
			</form>
        </div>
    </div>
</div>

