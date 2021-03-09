<div class="container">
	<ul class="nav nav-tabs nav-tabs-line">
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab" href="#kt_tab_pane_1">1. Data Personal</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab" disabled>2. Data Wali</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab">3. Data Pendidikan</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab">3. Data Akademik</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab">4. Unggah Berkas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab">5. Submit</a>
		</li>
	</ul>
	<div class="tab-content mt-5" id="myTabContent">
		<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
			<div class="accordion accordion-toggle-arrow" id="accordion-personal">
				<div class="card">
					<div class="card-header">
						<div class="card-title" data-toggle="collapse" data-target="#collapse-personal">
							Data Diri Camaru
						</div>
					</div>
					<div id="collapse-personal" class="collapse" data-parent="#accordion-personal">
						<div class="card-body">
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">No. Pendaftaran</label>
								<div class="col-md-10">
									<input type="text" class="form-control" readonly name="form_type" hidden value="data_diri">
									<input type="text" class="form-control" readonly disabled name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
									<input type="text" class="form-control" disabled value="<?php echo $pendaftaran['id'] ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Nama Camaru</label>
								<div class="col-md-10">
									<input type="text" disabled name="nama" class="form-control" value="<?php echo $pendaftaran['nama'] ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">No Kartu Keluarga</label>
								<div class="col-md-10">
									<input type="number" class="form-control" disabled name="KK" value="<?php echo $data_diri['KK'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">NIK</label>
								<div class="col-md-10">
									<input type="number" class="form-control" disabled name="NIK" value="<?php echo $data_diri['NIK'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Email</label>
								<div class="col-md-10">
									<input type="email" class="form-control" disabled name="email" value="<?php echo $data_diri['email'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">No. HP</label>
								<div class="col-md-10">
									<input type="number" class="form-control" disabled name="no_hp" value="<?php echo $data_diri['no_hp'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Kota Kelahiran</label>
								<div class="col-md-10">
									<input type="text" class="form-control" disabled name="kota_kelahiran" value="<?php echo $data_diri['kota_kelahiran'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Tanggal Lahir</label>
								<div class="col-md-10">
									<input type="date" class="form-control" disabled name="tgl_lahir" value="<?php echo $data_diri['tgl_lahir'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Jenis kelamin</label>
								<div class="col-md-10">
									<div class="radio-inline">
										<label class="radio">
											<input type="radio" disabled name="jenis_kelamin" value="P" <?php echo (($data_diri['jenis_kelamin'] ?? 'P') == 'P' ? 'checked': '') ?>/>
											<span></span>
											Perempuan
										</label>
										<label class="radio">
											<input type="radio" disabled name="jenis_kelamin" value="L" <?php echo (($data_diri['jenis_kelamin'] ?? 'P') == 'L' ? 'checked': '') ?>/>
											<span></span>
											Laki-laki
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Pekerjaan</label>
								<div class="col-md-10">
									<input type="text" class="form-control" disabled name="pekerjaan" value="<?php echo $data_diri['pekerjaan'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Agama</label>
								<div class="col-md-10">
									<input disabled type="text" value="<?php echo $pendaftaran['agama'] ?>" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Status Pernikahan</label>
								<div class="col-md-10">
									<input disabled type="text" value="<?php echo ucwords( strtolower($pendaftaran['status_sipil']) ) ?>" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Golongan Darah</label>
								<div class="col-md-10">
									<input disabled type="text" value="<?php echo $pendaftaran['gol_darah'] ?>" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Tinggi Badan (cm)</label>
								<div class="col-md-10">
									<input type="number" class="form-control" disabled name="tinggi_badan" value="<?php echo $data_diri['tinggi_badan'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Berat Badan (kg)</label>
								<div class="col-md-10">
									<input type="number" class="form-control" disabled name="berat_badan" value="<?php echo $data_diri['berat_badan'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Suku</label>
								<div class="col-md-10">
									<input class="form-control" disabled name="suku" value="<?php echo $data_diri['suku'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Status Tinggal</label>
								<div class="col-md-10">
									<input disabled type="text" value="<?php echo $pendaftaran['status_tinggal'] ?>" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Kewarganegaraan</label>
								<div class="col-md-10">
									<input disabled type="text" value="<?php echo $pendaftaran['kewarganegaraan'] ?>" class="form-control">
								</div>
							</div>								
						</div>
					</div>
				</div>
			</div>
			
			<div class="accordion accordion-toggle-arrow" id="accordion-alamat">
				<div class="card">
					<div class="card-header">
						<div class="card-title" data-toggle="collapse" data-target="#collapse-alamat">
							Alamat Camaru
						</div>
					</div>
					<div id="collapse-alamat" class="collapse" data-parent="">
						<div class="card-body">
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Negara</label>
								<div class="col-md-10">
									<input type="text" class="form-control" disabled value="<?php echo $data_diri['negara'] ?? null ?>">
								</div>
							</div>
							<?php
								if(!empty($pendaftaran['kelurahan_id'])){
									?>
										<div class="" >
											<?php 
												if(!empty($daerah)){
														foreach($daerah['provinsi'] as $provinsi){
															if($provinsi['id'] == $daerah['parentsIds']['selected_provinsi_id']){
																?>
																	<div class="form-group row">
																		<label for="" class="col-md-2 col-form-label">Provinsi</label>
																		<div class="col-md-10">
																			<input type="text" class="form-control" disabled value="<?php echo $provinsi['provinsi'] ?>">
																		</div>
																	</div>
																<?php
															}
														}
														foreach($daerah['kota_kab'] as $kota){
															if($kota['id'] == $daerah['parentsIds']['selected_kota_id']){
																?>
																	<div class="form-group row">
																		<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
																		<div class="col-md-10">
																			<input type="text" class="form-control" disabled value="<?php echo $kota['kota_kab'] ?>">
																		</div>
																	</div>
																<?php
															}
														}
														foreach($daerah['kecamatan'] as $kecamatan){
															if($kecamatan['id'] == $daerah['parentsIds']['selected_kecamatan_id']){
																?>
																	<div class="form-group row">
																		<label for="" class="col-md-2 col-form-label">Kecamatan</label>
																		<div class="col-md-10">
																			<input type="text" class="form-control" disabled value="<?php echo $kecamatan['kecamatan'] ?>">
																		</div>
																	</div>
																<?php
															}
														}
														foreach($daerah['kelurahan'] as $kelurahan){
															if($kelurahan['id'] == $daerah['parentsIds']['selected_kelurahan_id']){
																?>
																	<div class="form-group row">
																		<label for="" class="col-md-2 col-form-label">kelurahan</label>
																		<div class="col-md-10">
																			<input type="text" class="form-control" disabled value="<?php echo $kelurahan['kelurahan'] ?>">
																		</div>
																	</div>
																<?php
															}
														}
													?>

													<?php
													
												}
											?>
										</div>
									<?php
								}
							?>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
								<div class="col-md-10">
									<textarea disabled name="alamat_asal" id="" cols="30" rows="10" class="form-control"><?php echo($pendaftaran['alamat_asal'] ?? null) ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="accordion accordion-toggle-arrow" id="accordion-personal-wali">
				<div class="card">
					<div class="card-header">
						<div class="card-title" data-toggle="collapse" data-target="#collapse-personal-wali">
							Data Wali
						</div>
					</div>
					<div id="collapse-personal-wali" class="collapse" data-parent="#accordion-personal-wali">
						<div class="card-body">
							<input type="text" class="form-control" readonly disabled name="form_type" hidden value="data_wali">
							<input type="text" class="form-control" readonly disabled name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">NIK</label>
								<div class="col-md-10">
									<input type="number" class="form-control" disabled name="NIK" value="<?php echo $data_wali['NIK'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Nama</label>
								<div class="col-md-10">
									<input type="text" class="form-control" disabled name="nama" value="<?php echo $data_wali['nama'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Status dengan Camaru</label>
								<div class="col-md-10">
									<input type="text" class="form-control" disabled name="nama" value="<?php echo ucwords(strtolower($data_wali['status_hubungan']))  ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">No. HP</label>
								<div class="col-md-10">
									<input type="number" class="form-control" disabled name="no_hp" value="<?php echo $data_wali['no_hp'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Email</label>
								<div class="col-md-10">
									<input type="email" class="form-control input-email" disabled name="email" value="<?php echo $data_wali['email'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Pendidikan Terakhir</label>
								<div class="col-md-10">
									<input type="text" class="form-control" disabled value="<?php echo (strtolower($data_wali['pendidikan_terakhir']))  ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Pekerjaan</label>
								<div class="col-md-10">
									<input type="text" class="form-control" disabled name="pekerjaan" value="<?php echo $data_wali['pekerjaan'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Instansi Tempat Wali Bekerja</label>
								<div class="col-md-10">
									<input type="text" class="form-control" disabled name="nama_instansi" value="<?php echo $data_wali['nama_instansi'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Alamat Instansi Tempat Wali Bekerja</label>
								<div class="col-md-10">
									<textarea type="text" class="form-control" rows="5" disabled name="alamat_instansi"><?php echo $data_wali['alamat_instansi'] ?? null ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">No. Telepon Instansi</label>
								<div class="col-md-10">
									<input type="number" class="form-control" disabled name="telp_instansi" value="<?php echo $data_wali['telp_instansi'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Penghasilan Per Bulan</label>
								<div class="col-md-10">
									<input type="number" class="form-control input-uang" disabled name="penghasilan_perbulan" value="<?php echo $data_wali['penghasilan_perbulan'] ?? null ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Nama Ibu Kandung</label>
								<div class="col-md-10">
									<input type="text" class="form-control" disabled name="nama_ibu_kandung" value="<?php echo $data_wali['nama_ibu_kandung'] ?? null ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="accordion accordion-toggle-arrow" id="accordion-alamat-wali">
				<div class="card">
					<div class="card-header">
						<div class="card-title" data-toggle="collapse" data-target="#collapse-alamat-wali">
							Alamat Wali
						</div>
					</div>
					<div id="collapse-alamat-wali" class="collapse" data-parent="">
						<div class="card-body">
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Negara</label>
								<div class="col-md-10">
									<input type="text" disabled value="<?php echo $data_wali['negara'] ?>" class="form-control">
								</div>
							</div>
							<div class="">
								<?php
									if(!empty($data_wali['kelurahan_id'])){
										?>
											<div class="" >
												<?php 
													if(!empty($data_wali['kelurahan_id'])){
															foreach($daerah_wali['provinsi'] as $provinsi){
																if($provinsi['id'] == $daerah_wali['parentsIds']['selected_provinsi_id']){
																	?>
																		<div class="form-group row">
																			<label for="" class="col-md-2 col-form-label">Provinsi</label>
																			<div class="col-md-10">
																				<input type="text" class="form-control" disabled value="<?php echo $provinsi['provinsi'] ?>">
																			</div>
																		</div>
																	<?php
																}
															}
															foreach($daerah_wali['kota_kab'] as $kota){
																if($kota['id'] == $daerah_wali['parentsIds']['selected_kota_id']){
																	?>
																		<div class="form-group row">
																			<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
																			<div class="col-md-10">
																				<input type="text" class="form-control" disabled value="<?php echo $kota['kota_kab'] ?>">
																			</div>
																		</div>
																	<?php
																}
															}
															foreach($daerah_wali['kecamatan'] as $kecamatan){
																if($kecamatan['id'] == $daerah_wali['parentsIds']['selected_kecamatan_id']){
																	?>
																		<div class="form-group row">
																			<label for="" class="col-md-2 col-form-label">Kecamatan</label>
																			<div class="col-md-10">
																				<input type="text" class="form-control" disabled value="<?php echo $kecamatan['kecamatan'] ?>">
																			</div>
																		</div>
																	<?php
																}
															}
															foreach($daerah_wali['kelurahan'] as $kelurahan){
																if($kelurahan['id'] == $daerah_wali['parentsIds']['selected_kelurahan_id']){
																	?>
																		<div class="form-group row">
																			<label for="" class="col-md-2 col-form-label">kelurahan</label>
																			<div class="col-md-10">
																				<input type="text" class="form-control" disabled value="<?php echo $kelurahan['kelurahan'] ?>">
																			</div>
																		</div>
																	<?php
																}
															}
														?>

														<?php
														
													}
												?>
											</div>
										<?php
									}
								?>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
									<div class="col-md-10">
										<textarea disabled name="alamat" cols="30" rows="10" class="form-control"><?php echo ($data_wali['alamat'] ?? null) ?></textarea>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<?php
				$pendidikans = ['SMA'];
				if($pendaftaran['jenjang_id'] == 2){
					$pendidikans = ['SMA'];
				}
				if($pendaftaran['jenjang_id'] == 3){
					$pendidikans = ['SMA', 'S1'];
				}
				if($pendaftaran['jenjang_id'] == 4){
					$pendidikans = ['SMA', 'S1', 'S2'];
				}
			?>
			<input type="text" class="form-control" readonly disabled name="form_type" hidden value="data_pendidikan">
			<input type="text" class="form-control" readonly disabled name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
			<?php 
				foreach($pendidikans as $key=>$pendidikan){
					?>
						<div class="accordion accordion-toggle-arrow" id="accordion-<?php echo $pendidikan ?>">
							<div class="card">
								<div class="card-header">
									<div class="card-title" data-toggle="collapse" data-target="#collapse-<?php echo $pendidikan ?>">
										Histori Pendidikan - <?php echo $pendidikan ?>
									</div>
								</div>
								<div id="collapse-<?php echo $pendidikan ?>" class="collapse" data-parent="#accordion-<?php echo $pendidikan ?>">
									<div class="card-body">
										<div class="form-group row">
											<input type="text" disabled name="status_pendidikan[]" value="<?php echo $pendidikan ?>" readonly hidden>
										</div>
										<div class="form-group row">
											<label for="" class="col-md-2 col-form-label">NISN / NIM</label>
											<div class="col-md-10">
												<input type="number" class="form-control" disabled name="npsn[]" value="<?php echo ($data_pendidikan['npsn[]'][$key] ?? null) ?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="" class="col-md-2 col-form-label">Jurusan/Program Studi</label>
											<div class="col-md-10">
												<input type="text" class="form-control" disabled name="jurusan[]" value="<?php echo ($data_pendidikan['jurusan[]'][$key] ?? null) ?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="" class="col-md-2 col-form-label">Tahun Masuk</label>
											<div class="col-md-10">
												<input type="number" class="form-control" disabled name="tahun_masuk[]" value="<?php echo ($data_pendidikan['tahun_masuk[]'][$key] ?? null) ?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="" class="col-md-2 col-form-label">Tahun Lulus</label>
											<div class="col-md-10">
												<input type="number" class="form-control" disabled name="tahun_lulus[]" value="<?php echo ($data_pendidikan['tahun_lulus[]'][$key] ?? null) ?>">
											</div>
										</div>

										<h3 class="card-title text-primary">Data Sekolah</h3>		
										<?php
											if(!empty($data_pendidikan['sekolah[]'][$key])){
												$sekolah = $data_pendidikan['sekolah[]'][$key]
												?>
													<div class="" data-isarray="true" data-pendidikan="true">
														<?php 
															if(!empty($sekolah)){
																?>
																	<div class="form-group row" data-kota_kab="true" >
																		<label for="" class="col-md-2 col-form-label">Provinsi</label>
																		<div class="col-md-10">
																			<input type="text" disabled class="form-control" value="<?php echo $data_pendidikan['provinsi[]'][$key]['provinsi'] ?>">
																		</div>
																	</div>

																	<div class="form-group row" data-kota_kab="true" >
																		<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
																		<div class="col-md-10">
																			<?php
																				foreach($data_pendidikan['kota_kab[]'][$key] as $kota_kab){
																					if($kota_kab['id'] == $data_pendidikan['sekolah_parentIds[]'][$key]['selected_kota_id']){
																					?>
																						<input type="text" disabled class="form-control" value="<?php echo $kota_kab['kota_kab'] ?>">
																					<?php
																					}
																				}
																			?>
																		</div>
																	</div>

																	<div class="form-group row" data-kota_kab="true" >
																		<label for="" class="col-md-2 col-form-label">Nama Sekolah/Universitas</label>
																		<div class="col-md-10">
																			<?php
																				foreach($data_pendidikan['data_sekolah[]'][$key] as $sekolah){
																					if($sekolah['id'] == $data_pendidikan['sekolah_parentIds[]'][$key]['selected_sekolah_id']){
																					?>
																						<input type="text" disabled class="form-control" value="<?php echo $sekolah['sekolah'] ?>">
																					<?php
																					}
																				}
																			?>
																		</div>
																	</div>

																<?php
																
															}
														?>
													</div>
												<?php
											}
										?>
										
										<div class="form-group row">
											<label for="" class="col-md-2 col-form-label">Unggah Ijazah</label>
											<div class="col-md-10">
												<?php
													if(empty($data_pendidikan['upload_ijazah[]'][$key])){
														?>
															<input type="file" disabled name="upload_ijazah_<?php echo $pendidikan ?>" accept="application/pdf">
														<?php
													}else{
														?>
															<a href="<?php echo base_url('uploads/'.$data_pendidikan['upload_ijazah[]'][$key]) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
															<!-- <button type="button" data disabled-name="upload_ijazah_<?php echo $pendidikan ?>" data-id="<?php echo $pendidikan ?>" class="btn btn-light-primary" data-toggle="sunting" data-target="upload" data-field="upload_ijazah[]">
																<i class="fas fa-pen"></i> Sunting
															</button> -->
														<?php
													}
												?>
											</div>
										</div>
										<div class="form-group row">
											<label for="" class="col-md-2 col-form-label">Unggah Raport/Transkrip Nilai</label>
											<div class="col-md-10">
												<?php
													if(empty($data_pendidikan['upload_daftar_nilai[]'][$key])){
														?>
															<input type="file" disabled name="upload_daftar_nilai_<?php echo $pendidikan ?>" accept="application/pdf">
														<?php
													}else{
														?>
															<a href="<?php echo base_url('uploads/'.$data_pendidikan['upload_daftar_nilai[]'][$key]) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
															<!-- <button type="button" class="btn btn-light-primary" data disabled-name="upload_daftar_nilai<?php echo $pendidikan ?>" data-id="<?php echo $pendidikan ?>" data-toggle="sunting" data-target="upload" data-field="upload_daftar_nilai[]">
																<i class="fas fa-pen"></i> Sunting
															</button> -->
														<?php
													}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
				}
			?>

			<div class="accordion accordion-toggle-arrow" id="accordion-program-studi">
				<div class="card">
					<div class="card-header">
						<div class="card-title" data-toggle="collapse" data-target="#collapse-program-studi">
							Pilihan Program Studi
						</div>
					</div>
					<div id="collapse-program-studi" class="collapse" data-parent="#accordion-program-studi">
						<div class="card-body">
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Pilihan Pertama</label>
								<div class="col-md-10">
									<?php
										foreach($prodi as $p){
											if($p['id'] == $pendaftaran['prodi_1_id']){
												?>
													<input type="text" class="form-control" disabled value="<?php echo $p['nama_prodi']?>">
												<?php
											}
										}
									?>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Pilihan Kedua</label>
								<div class="col-md-10">
									<?php
										if(!empty($pendaftaran['prodi_2_id'])){
											foreach($prodi as $p){
												if($p['id'] == $pendaftaran['prodi_2_id']){
													?>
														<input type="text" class="form-control" disabled value="<?php echo $p['nama_prodi']?>">
													<?php
												}
											}
										}else{
											?>
												<input type="text" class="form-control" disabled value="-">
											<?php
										}
									?>
								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>

			<div class="accordion accordion-toggle-arrow" id="accordion-prestasi">
				<div class="card">
					<div class="card-header">
						<div class="card-title" data-toggle="collapse" data-target="#collapse-prestasi">
							Prestasi Akademik yang Pernah Diraih (Opsional)
						</div>
					</div>
					<div id="collapse-prestasi" class="collapse" data-parent="#accordion-prestasi">
						<div class="card-body">
								<div class="prestasi-wrapper">
									<?php 
										foreach($pendaftaran['detail_prestasi'] as $prestasi){
											?>
												<input type="hidden" disabled name="detail_prestasi_id[]" value="<?php echo $prestasi['id'] ?>">
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Jenis prestasi</label>
													<div class="col-md-10">
														<select disabled name="jenis_prestasi[]"  class="form-control">
															<option value="">Pilih</option>
															<option <?php  if ($prestasi['jenis_prestasi'] == 'NASIONAL') echo 'selected' ?> value="NASIONAL">Nasional</option>
															<option <?php  if ($prestasi['jenis_prestasi'] == 'INTERNASIONAL') echo 'selected' ?> value="INTERNASIONAL">Internasional</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Nama Kegiatan</label>
													<div class="col-md-10">
														<input value="<?php  echo $prestasi['nama_kegiatan'] ?>" type="text" class="form-control" disabled name="nama_kegiatan[]">
													</div>
												</div>
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Tanggal Kegiatan</label>
													<div class="col-md-10">
														<input value="<?php  echo $prestasi['tgl_kegiatan'] ?>" type="date" class="form-control" disabled name="tgl_kegiatan[]">
													</div>
												</div>
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Unggah Bukti Prestasi</label>
													<?php 
														if(empty($prestasi['upload_bukti_prestasi'])){
															?>
																<input type="file" disabled name="upload_bukti_prestasi_<?php echo $prestasi['id'] ?>">
															<?php
														}else{
															?>
																<a href="<?php echo base_url('uploads/'.$prestasi['upload_bukti_prestasi']) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
																<!-- <button type="button" class="btn btn-light-primary" data disabled-name="upload_bukti_prestasi_<?php echo $prestasi['id'] ?>" data-toggle="sunting" data-target="upload" >
																	<i class="fas fa-pen"></i> Sunting
																</button> -->
															<?php
														}
													?>
												</div>
												<div class="separator separator-solid mb-8"></div>
											<?php
										}
									?>
								</div>
						</div>
					</div>
				</div>
			</div>

			<div class="accordion accordion-toggle-arrow" id="accordion-berkas">
				<div class="card">
					<div class="card-header">
						<div class="card-title" data-toggle="collapse" data-target="#collapse-berkas">
							Berkas
						</div>
					</div>
					<div id="collapse-berkas" class="collapse" data-parent="#accordion-berkas">
						<div class="card-body">
						<input type="text" class="form-control" readonly disabled name="form_type" hidden value="unggah_berkas">
						<input type="text" class="form-control" readonly disabled name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
						<div class="form-group row">
							<label for="" class="col-md-2 col-form-label">Unggah Foto</label>
							<div class="col-md-10">
								<?php
									if(empty($pendaftaran['upload_foto'])){
										?>
											<input type="file" accept="application/pdf, image/jpeg, image/png" disabled name="upload_foto">
										<?php
									}else{
										?>
											<a href="<?php echo base_url('uploads/'.$pendaftaran['upload_foto']) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
											<!-- <button type="button" class="btn btn-light-primary" data-toggle="sunting" data-target="upload" data-field="upload_foto">
												<i class="fas fa-pen"></i> Sunting
											</button> -->
										<?php
									}
								?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-2 col-form-label">Unggah Kartu Keluarga</label>
							<div class="col-md-10">
								<?php
									if(empty($pendaftaran['upload_kk'])){
										?>
											<input type="file" accept="application/pdf, image/jpeg, image/png" disabled name="upload_kk">
										<?php
									}else{
										?>
										<a href="<?php echo base_url('uploads/'.$pendaftaran['upload_kk']) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
											<!-- <button type="button" class="btn btn-light-primary" data-toggle="sunting" data-target="upload" data-field="upload_kk">
												<i class="fas fa-pen"></i> Sunting
											</button> -->
										<?php
									}
								?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-2 col-form-label">Unggah Akta Kelahiran</label>
							<div class="col-md-10">
								<?php
									if(empty($pendaftaran['upload_akta_lahir'])){
										?>
											<input type="file" accept="application/pdf, image/jpeg, image/png" disabled name="upload_akta_lahir">
										<?php
									}else{
										?>
											<a href="<?php echo base_url('uploads/'.$pendaftaran['upload_akta_lahir']) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
											<!-- <button type="button" class="btn btn-light-primary" data-toggle="sunting" data-target="upload" data-field="upload_akta_lahir">
												<i class="fas fa-pen"></i> Sunting
											</button> -->
										<?php
									}
								?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-md-2 col-form-label">Surat Pernyataan</label>
							<div class="col-md-10">
								<?php
									if(empty($pendaftaran['upload_srt_pernyataan'])){
										?>
											<input type="file" accept="application/pdf, image/jpeg, image/png" disabled name="upload_srt_pernyataan">
										<?php
									}else{
										?>
											<a href="<?php echo base_url('uploads/'.$pendaftaran['upload_srt_pernyataan']) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
											<!-- <button type="button" class="btn btn-light-primary" data-toggle="sunting" data-target="upload" data-field="upload_srt_pernyataan">
												<i class="fas fa-pen"></i> Sunting
											</button> -->
										<?php
									}
								?>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>

			<form action="<?php echo base_url('/api/pendaftaran/update_form')?>" method="POST" name="submit">
				<input type="text" class="form-control" readonly name="form_type" hidden value="submit">
				<input type="text" class="form-control" readonly name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
				<div class="d-flex justify-content-end mt-4">
					<div class="d-flex">
						<div class="mr-2">
						<a href="<?php echo base_url('/pendaftaran/formulir/unggah_berkas?id='.$this->input->get('id')) ?>" class="btn btn-primary">Kembali</a>
						</div>
						<div class="">
							<button class="btn btn-primary lanjut" type="button">Submit</button>
						</div>
					</div>
				</div>
			</form>

		</div>
		
	</div>
	
</div>
