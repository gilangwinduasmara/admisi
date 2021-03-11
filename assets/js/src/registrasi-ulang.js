
const STATUS_REGISTRASI_ULANG = {
	'VALIDASI NIM': 'Sedang divalidasi',
	'VALIDASI KEUANGAN': 'Sedang divalidasi',
	'BELUM BAYAR': 'Belum Registrasi Ulang',
	'SUDAH REGISTRASI': 'Sudah Registrasi Ulang'
}
let hasil_penerimaan = null
let registrasi_ulang = []
$('[name="id"]').change(function(){
	registrasi_ulang = []
	const detailEl = $('.detail-wrapper')
	const registrasi_ulang_wrapper = $('#registrasi_ulang_wrapper')
	registrasi_ulang_wrapper.empty()
	detailEl.empty()
	axios.get(BASE_URL+'/service/api/pendaftaran?id='+$(this).val()+"&status=DITERIMA").then(res => {
		console.log(hasil_penerimaan)
		hasil_penerimaan = res.data.hasil_penerimaan
		hasil_penerimaan.map((penerimaan, index) => {
			if(penerimaan.registrasi_ulang){
				registrasi_ulang.push(penerimaan.registrasi_ulang)
			}
		})
		if(registrasi_ulang.length == 0){
			let html = `
				<div class="form-group row">
					<label for="" class="col-md-3 col-form-label">Nama Camaru</label>
					<div class="col-md-9">
						<input type="text" class="form-control" value="${res.data.nama}" disabled>
					</div>
				</div>
				${
					hasil_penerimaan.length>1 ?
					`<div class="form-group row">
						<label class="col-3 col-form-label">Pendaftaran gelar ganda (double degree)</label>
						<div class="col-9 col-form-label">
							<div class="radio-inline">
								<label class="radio radio-primary">
									<input type="radio" name="double_degree" value="Tidak" checked="checked" />
									<span></span>
									Tidak
								</label>
								<label class="radio radio-primary">
									<input type="radio" name="double_degree" value="Ya"/>
									<span></span>
									Ya
								</label>
							</div>
						</div>
					</div>`
					: `<div></div>`
					}
					
				<div class="pembayaran"></div>
			`
			detailEl.append(html)
		}else{
			console.log(registrasi_ulang)
			registrasi_ulang.map((registrasi) => {
				registrasi_ulang_wrapper.append(`
				<div class="card card-custom bg-light mb-8">
					<div class="card-body">
						<div class="row mb-4">
							<div class="col-md-4">
								Status Registrasi Ulang: 
							</div>
							<div class="col-8 font-weight-bolder">
								${registrasi.status ? STATUS_REGISTRASI_ULANG[registrasi.status] : '-'}
							</div>
						</div>
						<div class="row font-weight-bolder">
							<div class="col-3">
								Nim
							</div>
							<div class="col-9 mb-3">
								${registrasi.nim ? registrasi.nim : '-'}
							</div>
							<div class="col-3">
								Nama
							</div>
							<div class="col-9 mb-3">
								${registrasi.nama_camaru ? registrasi.nama_camaru : '-'}
							</div>
							<div class="col-3">
								Program Studi
							</div>
							<div class="col-9 mb-3">
								${registrasi.prodi.nama_prodi}
							</div>
						</div>
					</div>
				</div>
				`)
			})
		}
		$('[name="double_degree"]').change(function(){
			console.log($(this).val())
			let html = "";
			if($(this).val() == "Ya"){
				doubleDegree()		
			}else{
				singleDegree()
				hasil_penerimaan.map((penerimaan, index) => {
					$('[name="prodi"]').append(`
						<option value="${penerimaan.prodi.id}">${penerimaan.prodi.nama_prodi}</option>
					`)
				})
			}
		})
		singleDegree()
		detailEl.show();
		$('[name]').attr('required', true)
	}).catch(err => {
		console.log(err)
	})
})

function doubleDegree(){
	const pembayaran = $('.pembayaran')
	pembayaran.empty()
	let html = `
		<h3>Pilihan 1</h3>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Prodi</label>
			<div class="col-md-9">
				<input class="form-control" disabled value="${hasil_penerimaan[0].prodi.nama_prodi}">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">No. SKR</label>
			<div class="col-md-9">
				<input class="form-control" readonly name="skpm_1" value="${hasil_penerimaan[0].kode_skpm}">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Bank Pengirim</label>
			<div class="col-md-9">
				<input class="form-control" name="bank_pengirim_1">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">No rek pengirim</label>
			<div class="col-md-9">
				<input class="form-control" name="no_rek_pengirim_1">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Nama rek pengirim</label>
			<div class="col-md-9">
				<input class="form-control" name="nama_rek_pengirim_1">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Tanggal Transfer</label>
			<div class="col-md-9">
				<input class="form-control" type="date" name="tgl_transfer_1">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Upload Bukti Pembayaran</label>
			<div class="col-md-9">
				<input class="form-control" type="file" name="upload_bukti_pembayaran_1">
			</div>
		</div>
		<div class="separator separator-solid mb-8"></div>
		<h3>Pilihan 2</h3>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Prodi</label>
			<div class="col-md-9">
				<input class="form-control" disabled value="${hasil_penerimaan[1].prodi.nama_prodi}">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">No. SKR</label>
			<div class="col-md-9">
				<input class="form-control" readonly name="skpm_2" value="${hasil_penerimaan[1].kode_skpm}">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Bank Pengirim</label>
			<div class="col-md-9">
				<input class="form-control" name="bank_pengirim_1">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">No rek pengirim</label>
			<div class="col-md-9">
				<input class="form-control" name="no_rek_pengirim_1">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Nama rek pengirim</label>
			<div class="col-md-9">
				<input class="form-control" name="nama_rek_pengirim_1">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Tanggal Transfer</label>
			<div class="col-md-9">
				<input class="form-control" type="date" name="tgl_transfer_1">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Upload Bukti Pembayaran</label>
			<div class="col-md-9">
				<input class="form-control" type="file" name="upload_bukti_pembayaran_2">
			</div>
		</div>

		<div class="form-group row justify-content-center">
			<input type="submit" class="btn btn-primary" value="Submit">
		</div>
	`
	pembayaran.append(html)
}

function singleDegree(){
	let pembayaran = $('.pembayaran')
	pembayaran.empty()
	let html = `
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Prodi</label>
			<div class="col-md-9">
				<select name="pilihan_prodi" class="form-control">
					
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">No. SKR</label>
			<div class="col-md-9">
				<input class="form-control" name="skpm" readonly>
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Bank Pengirim</label>
			<div class="col-md-9">
				<input class="form-control" name="bank_pengirim">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">No rek pengirim</label>
			<div class="col-md-9">
				<input class="form-control" name="no_rek_pengirim">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Nama rek pengirim</label>
			<div class="col-md-9">
				<input class="form-control" name="nama_rek_pengirim">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Tanggal Transfer</label>
			<div class="col-md-9">
				<input class="form-control" type="date" name="tgl_transfer">
			</div>
		</div>
		<div class="form-group row">
			<label for="" class="col-md-3 col-form-label">Upload Bukti Pembayaran</label>
			<div class="col-md-9">
				<input class="form-control" type="file" name="upload_bukti_pembayaran" accept="image/png,image/jpeg">
			</div>
		</div>

		<div class="form-group row justify-content-center">
			<input type="submit" class="btn btn-primary" value="Submit">
		</div>
	`
	pembayaran.append(html)
	if(hasil_penerimaan.length>1){
		$('[name="pilihan_prodi"]').html('<option value>Pilih</option>')
	}
	hasil_penerimaan.map((item) => {
		console.log(item)
		$('[name="pilihan_prodi"]').append(`<option value="${item.kode_skpm}">${item.prodi.nama_prodi}</option>`)
	})
	if(hasil_penerimaan.length == 1){
		$('[name="skpm"]').val($('[name="pilihan_prodi"] > option:first-child').val())
	}
	$('[name="pilihan_prodi"]').change(function(){
		console.log($(this).val())
		$('[name="skpm"]').val($(this).val())
	})
	
}

