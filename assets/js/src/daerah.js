const daerahs = [
	{
		'name': 'provinsi',
		'label': 'Provinsi',
		'fetch': ()=>(HOST_URL+'/service/api/daerah?type=provinsi'),
		'parent': null
	},
	{
		'name': 'kota_kab',
		'label': 'Kabupaten/Kota',
		'fetch': (parent, parent_id)=>(HOST_URL+'/service/api/daerah?type=kota&'+parent+'='+parent_id),
		'parent': 'provinsi_id'
	},
	{
		'name': 'kecamatan',
		'label': 'Kecamatan',
		'fetch': (parent, parent_id)=>(HOST_URL+'/service/api/daerah?type=kecamatan&'+parent+'='+parent_id),
		'parent': 'kota_id'
	},
	{
		'name': 'kelurahan',
		'label': 'Kelurahan',
		'fetch': (parent, parent_id)=>(HOST_URL+'/service/api/daerah?type=kelurahan&'+parent+'='+parent_id),
		'parent': 'kecamatan_id'
	},
	{
		'name': 'sekolah',
		'label': 'Nama Sekolah/Universitas',
		'fetch': (parent, parent_id)=>(HOST_URL+'/service/api/daerah?type=sekolah&'+parent+'='+parent_id),
		'parent': 'kota_id'
	}
]

async function getProvinsi() {
	const response = await axios.get(HOST_URL+'/service/api/daerah?type=provinsi')
	return response
}

function removeLoader(element){
	element.find('.daerah-loader').remove();	
}

function setLoader(element){
	// removeLoader()
	element.append(`
		<div class="daerah-loader d-flex justify-content-center mt-4">
			<div class="spinner"></div>
		</div>
	`)
}

function withArray(name,isArray = false){
	if(isArray){
		return `${name}[]`
	}
	return name
}


$(document).ready(function(){
	if($('.daerah-wrapper').length){
		$.each($('.daerah-wrapper'), function (el, index){
			let key = $(this).data('isarray')
			console.log(key)
			console.log('tes')
			let until = $(this).data('until');
			if($(this).data('pendidikan')){
				until = "kecamatan"
			}
			setLoader($('.daerah-wrapper'))
			let that = this
			for(var i=0; i<daerahs.length; i++){
				if(i==4)break;
				if(daerahs[i].name==until){
					$(that).append(
						`<div class="form-group row" data-sekolah="true" style="display: none">
							<label for="" class="col-md-2 col-form-label">Nama Sekolah/Universitas</label>
							<div class="col-md-10">
								<select name="${withArray('sekolah', key)}" class="form-control" required>
									<option value="">Pilih</option>
								</select>
							</div>
						</div>
						`
					)
					break
				}
				$(that).append(
					`<div class="form-group row" data-${daerahs[i].name}="true" style="display: none">
						<label for="" class="col-md-2 col-form-label">${daerahs[i].label}</label>
						<div class="col-md-10">
							<select name="${withArray(daerahs[i].name, key)}" class="form-control" required>
								<option value="">Pilih</option>
							</select>
						</div>
					</div>
					`
				)
			}
			const provinsiSelect = $(that).find('[data-provinsi] > div > select')
			axios.get(daerahs[0].fetch(daerahs[0].parent)).then((res) => {
				res.data.provinsi.map((item, index) => {
					console.log(`<option value="${item.id}">${item.provinsi}</option>`)
					$(provinsiSelect).append(`<option value="${item.id}">${item.provinsi}</option>`)
				})
				$(that).find('[data-provinsi]').show()
				removeLoader($('.daerah-wrapper'))
			});

			$(that).find('div > div > select').change(function(){
				const selectName = $(this).attr('name')
				const selectValue = $(this).val()
				console.log(selectName,selectValue)
				let selectedDaerahIndex = daerahs.map(d=>withArray(d.name, key)).indexOf(selectName)
				console.log(selectedDaerahIndex)
				for(var i = selectedDaerahIndex+1; i<daerahs.length; i++){
					$(that).find(`[data-${daerahs[i].name}] > div > select`).empty().append(`<option value="">Pilih</option>`)
				}
				let nextDaerah = daerahs[daerahs.map(d=>withArray(d.name, key)).indexOf(selectName)+1]
				if(nextDaerah.name == 'kecamatan' && $(that).data('pendidikan')){
					nextDaerah = daerahs[4]
				}
				console.log(nextDaerah.name)
				axios.get(nextDaerah.fetch(nextDaerah.parent, $(this).val())).then((res) => {
					console.log(res.data[nextDaerah.name])
					res.data[nextDaerah.name].map((item, index) => {
						console.log(`<option value="${item.id}">${item[nextDaerah.name]}</option>`)
						$(`[data-${nextDaerah.name}] > div > select`).append(`<option value="${item.id}">${item[nextDaerah.name]}</option>`)
					})
					$(that).find(`[data-${nextDaerah.name}]`).show()
					removeLoader($('.daerah-wrapper'))
				});

			})

			// $(that).find('[data-provinsi] > div > select').change(function(){
			// 	if($(this).val()!==""){
			// 		$(that).append(
			// 			`<div class="form-group row" data-${item.label}="true" style="display: none">
			// 				<label for="" class="col-md-2 col-form-label">${item.label}</label>
			// 				<div class="col-md-10">
			// 					<select name="${item.name}" class="form-control" required>
			// 						<option value="">Pilih</option>
			// 					</select>
			// 				</div>
			// 			</div>
			// 			`
			// 		)	
			// 	}
			// })

		})
	}
})

$('input[name="same_address"]').change(function(){
	if($(this).is(':checked')){
		$('.same-address').hide()
	}else{
		$('.same-address').show()
	}
})
