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
									<select type="text" class="form-control" disabled name="agama">
										<option value="">Pilih</option>
										<?php 
											foreach(['Kristen', 'Islam', 'Katolik', 'Hindu', 'Budha', 'Konghucu'] as $agama){
												?>
													<option <?php if ($pendaftaran['agama'] == $agama) echo 'selected'  ?> value="<?php echo $agama ?>"><?php echo $agama ?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Status Pernikahan</label>
								<div class="col-md-10">
									<select disabled name="status_sipil" id="" class="form-control">
										<option value="">Pilih</option>
										<option value="NIKAH" <?php echo (($data_diri['status_sipil'] ?? null) == 'NIKAH' ? 'selected': '') ?>>Nikah</option>
										<option value="BELUM NIKAH" <?php echo (($data_diri['status_sipil'] ?? null) == 'BELUM NIKAH' ? 'selected': '') ?>>Belum Nikah</option>
										<option value="JANDA" <?php echo (($data_diri['status_sipil'] ?? null) == 'JANDA' ? 'selected': '') ?>>Janda</option>
										<option value="DUDA" <?php echo (($data_diri['status_sipil'] ?? null) == 'DUDA' ? 'selected': '') ?>>Duda</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Golongan Darah</label>
								<div class="col-md-10">
									<select disabled name="gol_darah" id="" class="form-control">
										<option value="">-</option>
										<option value="A" <?php echo (($data_diri['gol_darah'] ?? null) == 'A' ? 'selected': '') ?>>A</option>
										<option value="B" <?php echo (($data_diri['gol_darah'] ?? null) == 'B' ? 'selected': '') ?>>B</option>
										<option value="AB" <?php echo (($data_diri['gol_darah'] ?? null) == 'AB' ? 'selected': '') ?>>AB</option>
										<option value="O" <?php echo (($data_diri['gol_darah'] ?? null) == 'O' ? 'selected': '') ?>>O</option>
									</select>
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
									<select disabled name="status_tinggal" class="form-control">
										<option value="">Pilih</option>
										<option <?php echo ($data_diri['status_tinggal'] ?? null) == 'Kost/kontrak' ? 'selected': '' ?> value="Kost/kontrak">Kost/kontrak</option>
										<option <?php echo ($data_diri['status_tinggal'] ?? null) == 'Tinggal bersama keluarga' ? 'selected': '' ?> value="Tinggal bersama keluarga">Tinggal bersama keluarga</option>
										<option <?php echo ($data_diri['status_tinggal'] ?? null) == 'Rumah sendiri' ? 'selected': '' ?> value="Rumah sendiri">Rumah sendiri</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Kewarganegaraan</label>
								<div class="col-md-10">
									<div class="radio-inline">
										<label class="radio">
											<input type="radio" disabled name="kewarganegaraan" value="WNI" <?php echo (($data_diri['kewarganegaraan'] ?? 'WNI') == 'WNI' ? 'checked': '') ?>/>
											<span></span>
											WNI
										</label>
										<label class="radio">
											<input type="radio" disabled name="kewarganegaraan" value="WNA" <?php echo (($data_diri['kewarganegaraan'] ?? 'WNI') == 'WNA' ? 'checked': '') ?>/>
											<span></span>
											WNA
										</label>
									</div>
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
									<input type="text" class="form-control" disabled name="negara" value="<?php echo $data_diri['negara'] ?? null ?>">
								</div>
							</div>
							<?php
								if(!empty($data_diri['kelurahan_id'])){
									?>
										<div class="daerah-wrapper" >
											<?php 
												if(!empty($daerah)){
													?>
														<div class="form-group row" data-provinsi="true" >
															<label for="" class="col-md-2 col-form-label">Provinsi</label>
															<div class="col-md-10">
																<select disabled name="provinsi" class="form-control" >
																	<option value="">Pilih</option>
																	<?php
																		foreach($daerah['provinsi'] as $provinsi){
																			echo '<option '.($provinsi['id'] == $parentIds['selected_provinsi_id'] ? 'selected': '').' value="'.$provinsi['id'].'">'.$provinsi['provinsi'].'</option>';
																		}
																	?>
																	
																</select>
															</div>
														</div>

														<div class="form-group row" data-kota_kab="true" >
															<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
															<div class="col-md-10">
																<select disabled name="kota_kab" class="form-control" >
																	<option value="">Pilih</option>
																	<?php
																		foreach($daerah['kota_kab'] as $kota_kab){
																			echo '<option '.($kota_kab['id'] == $parentIds['selected_kota_id'] ? 'selected': '').' value="'.$kota_kab['id'].'">'.$kota_kab['kota_kab'].'</option>';
																		}
																	?>
																	
																</select>
															</div>
														</div>

														<div class="form-group row" data-kecamatan="true" >
															<label for="" class="col-md-2 col-form-label">Kecamatan</label>
															<div class="col-md-10">
																<select disabled name="kecamatan" class="form-control" >
																	<option value="">Pilih</option>
																	<?php
																		foreach($daerah['kecamatan'] as $kecamatan){
																			echo '<option '.($kecamatan['id'] == $parentIds['selected_kecamatan_id'] ? 'selected': '').' value="'.$kecamatan['id'].'">'.$kecamatan['kecamatan'].'</option>';
																		}
																	?>
																	
																</select>
															</div>
														</div>

														<div class="form-group row" data-kelurahan="true" >
															<label for="" class="col-md-2 col-form-label">Kelurahan</label>
															<div class="col-md-10">
																<select disabled name="kelurahan" class="form-control" >
																	<option value="">Pilih</option>
																	<?php
																		foreach($daerah['kelurahan'] as $kelurahan){
																			echo '<option '.($kelurahan['id'] == $parentIds['selected_kelurahan_id'] ? 'selected': '').' value="'.$kelurahan['id'].'">'.$kelurahan['kelurahan'].'</option>';
																		}
																	?>
																	
																</select>
															</div>
														</div>

													<?php
													
												}
											?>
										</div>
									<?php
								}else{
									?>
										<div class="daerah-wrapper" >

										</div>
									<?php
								}
							?>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
								<div class="col-md-10">
									<textarea disabled name="alamat_asal" id="" cols="30" rows="10" class="form-control"><?php echo($data_diri['alamat_asal'] ?? null) ?></textarea>
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
									<select class="form-control" required disabled name="status_hubungan" value="<?php echo $data_wali['status_hubungan'] ?? null ?>">
										<option value="">Pilih</option>
										<option value="AYAH" <?php echo(($data_wali['status_hubungan'] ?? null) == "AYAH" ? "selected": "") ?>>Ayah</option>
										<option value="IBU" <?php echo(($data_wali['status_hubungan'] ?? null) == "IBU" ? "selected": "") ?>>Ibu</option>
										<option value="WALI" <?php echo(($data_wali['status_hubungan'] ?? null) == "WALI" ? "selected": "") ?>>Wali</option>
									</select>
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
									<select disabled name="pendidikan_terakhir" class="form-control">
										<option value="">Pilih</option>
										<option <?php echo (($data_wali['pendidikan_terakhir'] ?? 'x') == 'Tidak Sekolah' ? 'selected': '') ?> value="Tidak Sekolah">Tidak Sekolah</option>
										<option <?php echo (($data_wali['pendidikan_terakhir'] ?? 'x') == 'SD' ? 'selected': '') ?> value="SD">SD</option>
										<option <?php echo (($data_wali['pendidikan_terakhir'] ?? 'x') == 'SMP/Sederajat' ? 'selected': '') ?> value="SMP/Sederajat">SMP/Sederajat</option>
										<option <?php echo (($data_wali['pendidikan_terakhir'] ?? 'x') == 'SMA/Sederajat' ? 'selected': '') ?> value="SMA/Sederajat">SMA/Sederajat</option>
										<option <?php echo (($data_wali['pendidikan_terakhir'] ?? 'x') == 'S1' ? 'selected': '') ?> value="S1">S1</option>
										<option <?php echo (($data_wali['pendidikan_terakhir'] ?? 'x') == 'S2' ? 'selected': '') ?> value="S2">S2</option>
										<option <?php echo (($data_wali['pendidikan_terakhir'] ?? 'x') == 'S3' ? 'selected': '') ?> value="S3">S3</option>
									</select>
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
							<div class="form-group row ml-1" style="display: none;">
								<label class="checkbox checkbox-outline checkbox-success">
									<input type="checkbox" disabled name="same_address" value="true" <?php echo (($data_wali['same_address'] ?? null) == 'true' ? 'checked': '') ?>/>
									<span></span>
									Alamat wali sama dengan alamat camaru
								</label>
							</div>
								
							<div class="same-address">
								<?php
									if(!empty($data_wali['kelurahan_id'])){
										?>
										<div class="alamat-wali">
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Kewarganegaraan</label>
												<div class="col-md-10">
													<div class="radio-inline">
														<label class="radio">
															<input type="radio" disabled name="kewarganegaraan" value="WNI" <?php echo (($data_wali['kewarganegaraan'] ?? 'WNI') == 'WNI' ? 'checked': '') ?>/>
															<span></span>
															WNI
														</label>
														<label class="radio">
															<input type="radio" disabled name="kewarganegaraan" value="WNA" <?php echo (($data_wali['kewarganegaraan'] ?? 'WNI') == 'WNA' ? 'checked': '') ?>/>
															<span></span>
															WNA
														</label>
													</div>
												</div>
											</div>	
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Negara</label>
												<div class="col-md-10">
													<input type="text" class="form-control" disabled name="negara" value="<?php echo $data_wali['negara'] ?? null ?>">
												</div>
											</div>
											<div class="daerah-wrapper" >
												<?php 
													if(!empty($daerah)){
														?>
															<div class="form-group row" data-provinsi="true" >
																<label for="" class="col-md-2 col-form-label">Provinsi</label>
																<div class="col-md-10">
																	<select disabled name="provinsi" class="form-control" >
																		<option value="">Pilih</option>
																		<?php
																			foreach($daerah['provinsi'] as $provinsi){
																				echo '<option '.($provinsi['id'] == $parentIds['selected_provinsi_id'] ? 'selected': '').' value="'.$provinsi['id'].'">'.$provinsi['provinsi'].'</option>';
																			}
																		?>
																		
																	</select>
																</div>
															</div>

															<div class="form-group row" data-kota_kab="true" >
																<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
																<div class="col-md-10">
																	<select disabled name="kota_kab" class="form-control" >
																		<option value="">Pilih</option>
																		<?php
																			foreach($daerah['kota_kab'] as $kota_kab){
																				echo '<option '.($kota_kab['id'] == $parentIds['selected_kota_id'] ? 'selected': '').' value="'.$kota_kab['id'].'">'.$kota_kab['kota_kab'].'</option>';
																			}
																		?>
																		
																	</select>
																</div>
															</div>

															<div class="form-group row" data-kecamatan="true" >
																<label for="" class="col-md-2 col-form-label">Kecamatan</label>
																<div class="col-md-10">
																	<select disabled name="kecamatan" class="form-control" >
																		<option value="">Pilih</option>
																		<?php
																			foreach($daerah['kecamatan'] as $kecamatan){
																				echo '<option '.($kecamatan['id'] == $parentIds['selected_kecamatan_id'] ? 'selected': '').' value="'.$kecamatan['id'].'">'.$kecamatan['kecamatan'].'</option>';
																			}
																		?>
																		
																	</select>
																</div>
															</div>

															<div class="form-group row" data-kelurahan="true" >
																<label for="" class="col-md-2 col-form-label">Kelurahan</label>
																<div class="col-md-10">
																	<select disabled name="kelurahan" class="form-control" >
																		<option value="">Pilih</option>
																		<?php
																			foreach($daerah['kelurahan'] as $kelurahan){
																				echo '<option '.($kelurahan['id'] == $data_wali['kelurahan_id'] ? 'selected': '').' value="'.$kelurahan['id'].'">'.$kelurahan['kelurahan'].'</option>';
																			}
																		?>
																		
																	</select>
																</div>
															</div>

														<?php
														
													}else{
														echo "nope";
													}

												?>
											</div>
										</div>
										<?php
									}else{
										?>
											<div class="alamat-wali">
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Kewarganegaraan</label>
													<div class="col-md-10">
														<div class="radio-inline">
															<label class="radio">
																<input type="radio" disabled name="kewarganegaraan" value="WNI" <?php echo (($data_wali['kewarganegaraan'] ?? 'WNI') == 'WNI' ? 'checked': '') ?>/>
																<span></span>
																WNI
															</label>
															<label class="radio">
																<input type="radio" disabled name="kewarganegaraan" value="WNA" <?php echo (($data_wali['kewarganegaraan'] ?? 'WNI') == 'WNA' ? 'checked': '') ?>/>
																<span></span>
																WNA
															</label>
														</div>
													</div>
												</div>	
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Negara</label>
													<div class="col-md-10">
														<input type="text" class="form-control" disabled name="negara" value="<?php echo $data_wali['negara'] ?? null ?>">
													</div>
												</div>
												<div class="daerah-wrapper" data>
										
												</div>
											</div>
										<?php
									}
								?>
								<?php
									if(($pendaftaran['kewarganegaraan']) == 'WNI'){
										?>
											<div class="alamat-camaru" style="display: none;">
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Provinsi</label>
													<div class="col-md-10">
														<input type="text" class="form-control" value="<?php echo $alamat_camaru['provinsi']['provinsi'] ?>" disabled>
													</div>
												</div>	
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Kab/Kota</label>
													<div class="col-md-10">
														<input type="text" class="form-control" value="<?php echo $alamat_camaru['kota']['kota_kab'] ?>" disabled>
													</div>
												</div>	
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Kecamatan</label>
													<div class="col-md-10">
														<input type="text" class="form-control" value="<?php echo $alamat_camaru['kecamatan']['kecamatan'] ?>" disabled>
													</div>
												</div>	
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Kelurahan</label>
													<div class="col-md-10">
														<input type="text" class="form-control" value="<?php echo $alamat_camaru['kelurahan']['kelurahan'] ?>" disabled>
													</div>
												</div>	
											</div>
										<?php
									}else{
										?>
											<div class="alamat-camaru" style="display: none;">
												<div class="form-group row">
													<label for="" class="col-md-2 col-form-label">Negara</label>
													<div class="col-md-10">
														<input type="text" class="form-control" value="<?php echo $pendaftaran['negara'] ?>" disabled>
													</div>
												</div>
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
													<div class="daerah-wrapper" data-isarray="true" data-pendidikan="true">
														<?php 
															if(!empty($sekolah)){
																?>
																	<div class="form-group row" data-provinsi="true" >
																		<label for="" class="col-md-2 col-form-label">Provinsi</label>
																		<div class="col-md-10">
																			<select disabled name="provinsi[]" class="form-control" >
																				<option value="">Pilih</option>
																				<?php
																					foreach($provinsi as $p){
																						echo '<option '.($p['id'] == $data_pendidikan['sekolah_parentIds[]'][$key]['selected_provinsi_id'] ? 'selected': '').' value="'.$p['id'].'">'.$p['provinsi'].'</option>';
																					}
																				?>
																				
																			</select>
																		</div>
																	</div>

																	<div class="form-group row" data-kota_kab="true" >
																		<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
																		<div class="col-md-10">
																			<select disabled name="kota_kab[]" class="form-control" >
																				<option value="">Pilih</option>
																				<?php
																					foreach($data_pendidikan['kota_kab[]'][$key] as $kota_kab){
																						echo '<option '.($kota_kab['id'] == $data_pendidikan['sekolah_parentIds[]'][$key]['selected_kota_id'] ? 'selected': '').' value="'.$kota_kab['id'].'">'.$kota_kab['kota_kab'].'</option>';
																					}
																				?>
																			</select>
																		</div>
																	</div>

																	<div class="form-group row" data-kota_kab="true" >
																		<label for="" class="col-md-2 col-form-label">Nama Sekolah/Universitas</label>
																		<div class="col-md-10">
																			<select disabled name="sekolah[]" class="form-control" >
																				<option value="">Pilih</option>
																				<?php
																					foreach($data_pendidikan['data_sekolah[]'][$key] as $sekolah){
																						echo '<option '.($sekolah['id'] == $data_pendidikan['sekolah_parentIds[]'][$key]['selected_sekolah_id'] ? 'selected': '').' value="'.$sekolah['id'].'">'.$sekolah['sekolah'].'</option>';
																					}
																				?>
																			</select>
																		</div>
																	</div>

																<?php
																
															}
														?>
													</div>
												<?php
											}else{
												?>
													<div class="daerah-wrapper" data-isarray="true" data-pendidikan="true">

													</div>

													<div class="form-group row">
														<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
														<div class="col-md-10">
															<textarea disabled name="detail_alamat[]"cols="30" rows="10" class="form-control"><?php echo ($data_pendidikan['detail_alamat[]'][$key] ?? null) ?></textarea>
														</div>
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
									<select disabled name="prodi_1_id"  class="form-control">
										<option value="">Pilih</option>
										<?php
											foreach($prodi as $p){
												echo '<option '.($p["id"] == ($pendaftaran['prodi_1_id'] ?? null) ? 'selected': null).' value="'.$p['id'].'">'.$p['nama_prodi'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-md-2 col-form-label">Pilihan Kedua</label>
								<div class="col-md-10">
									<select disabled name="prodi_2_id" class="form-control">
										<option value="">Pilih</option>
										<?php
											foreach($prodi as $p){
												echo '<option '.($p["id"] == ($pendaftaran['prodi_2_id'] ?? null) ? 'selected': null).' value="'.$p['id'].'">'.$p['nama_prodi'].'</option>';
											}
										?>
									</select>
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

