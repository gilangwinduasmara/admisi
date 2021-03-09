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

function daerahSelectorInit(element = $('.daerah-wrapper')){
	console.log(element.html())
	if(element.length){
		$.each(element, function (el, index){
			let key = $(this).data('isarray')
			let until = $(this).data('until');
			if($(this).data('pendidikan')){
				until = "kecamatan"
			}
			setLoader(element)
			let that = this
			for(var i=0; i<daerahs.length; i++){
				if(i==4)break;
				
				if(daerahs[i].name==until){
					if($(`[name="${withArray('sekolah', key)}"]`).length) break
					$(that).append(
						`<div class="form-group row" data-sekolah="true" style="display: none">
							<label for="" class="col-md-2 col-form-label">Nama Sekolah/Universitas</label>
							<div class="col-md-10">
								<select style="width: 100%" name="${withArray('sekolah', key)}" class="form-control" >
									<option value="">Pilih</option>
								</select>
							</div>
						</div>
						`
					)
					break
				}
				if($(that).find(`[name="${withArray(daerahs[i].name, key)}"]`).length==0){
					$(that).append(
						`<div class="form-group row" data-${daerahs[i].name}="true" style="display: none">
							<label for="" class="col-md-2 col-form-label">${daerahs[i].label}</label>
							<div class="col-md-10">
								<select style="width: 100%" name="${withArray(daerahs[i].name, key)}" class="form-control" >
									<option value="">Pilih</option>
								</select>
							</div>
						</div>
						`
					)
				}
			}
			
			const provinsiSelect = $(that).find('[data-provinsi] > div > select')
			if(provinsiSelect.children().length == 1){
				axios.get(daerahs[0].fetch(daerahs[0].parent)).then((res) => {
					res.data.provinsi.map((item, index) => {
						$(provinsiSelect).append(`<option value="${item.id}">${item.provinsi}</option>`)
					})
					$(that).find('[data-provinsi]').show()
					$('[data-provinsi]').find('select').select2()
					removeLoader(element)
				});
			}else{
				removeLoader(element)
			}

			$(that).find('div > div > select').change(function(){
				const selectName = $(this).attr('name')
				const selectValue = $(this).val()
				resetError($(this));
				let selectedDaerahIndex = daerahs.map(d=>withArray(d.name, key)).indexOf(selectName)
				for(var i = selectedDaerahIndex+1; i<daerahs.length; i++){
					$(that).find(`[data-${daerahs[i].name}] > div > select`).empty().append(`<option value="">Pilih</option>`)
				}
				let nextDaerah = daerahs[daerahs.map(d=>withArray(d.name, key)).indexOf(selectName)+1]
				if(!nextDaerah){
					return;
				}
				if(nextDaerah.name == 'kecamatan' && $(that).data('pendidikan')){
					nextDaerah = daerahs[4]
				}
				axios.get(nextDaerah.fetch(nextDaerah.parent, $(this).val())).then((res) => {
					console.log(res.data[nextDaerah.name])
					res.data[nextDaerah.name].map((item, index) => {
						console.log(`<option value="${item.id}">${item[nextDaerah.name]}</option>`)
						$(`[data-${nextDaerah.name}] > div > select`).append(`<option value="${item.id}">${item[nextDaerah.name]}</option>`)
					})
					$(that).find(`[data-${nextDaerah.name}]`).show()
					$(that).find(`[data-${nextDaerah.name}]`).find('select').select2()
					removeLoader(element)
				});

			})

			// $(that).find('[data-provinsi] > div > select').change(function(){
			// 	if($(this).val()!==""){
			// 		$(that).append(
			// 			`<div class="form-group row" data-${item.label}="true" style="display: none">
			// 				<label for="" class="col-md-2 col-form-label">${item.label}</label>
			// 				<div class="col-md-10">
			// 					<select name="${item.name}" class="form-control" >
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
}

$(document).ready(function(){
	$.each($('.daerah-wrapper'), function(i,e){
		daerahSelectorInit($(this));
	})
})


$('[data-toggle="sunting"]').click(function(){
	

	if($(this).data('target') == 'daerah_selector'){
		$(this).parent().parent().removeClass('form-group')
		$(this).parent().parent().removeClass('row')
		$(this).parent().parent().html(`
		<div class="daerah-wrapper" >
										
		</div>
		`)
		daerahSelectorInit()
	}
	if($(this).data('target') == 'sekolah_selector'){
		$(this).parent().parent().removeClass('form-group')
		$(this).parent().parent().removeClass('row')
		const parent = $(this).parent().parent()
		parent.html(`
			<div class="daerah-wrapper" data-isarray="true" data-pendidikan="true">

			</div>

			<div class="form-group row">
				<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
				<div class="col-md-10">
					<textarea name="detail_alamat[]"cols="30" rows="10" class="form-control"></textarea>
				</div>
			</div>
		`)
		daerahSelectorInit($(parent.children()[0]))
	}
	if($(this).data('target') == 'upload'){
		const parent = $(this).parent()
		parent.html(`
			<input type="file" name="${$(this).data('name')}" accept="application/pdf">
		`)
	}
})

$('input[name="same_address"]').change(function(){
	if($(this).is(':checked')){
		$('.alamat-camaru').show()
		$('.alamat-wali').hide()
		// $('.same-address').hide()
	}else{
		// $('.same-address').show()
		$('.alamat-wali').show()
		$('.alamat-camaru').hide()
	}
})

$(document).ready(function(){
	$('.alamat-wali > .daerah-wrapper').show()
})
