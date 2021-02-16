function dropzoneFile(query){
	// const query = '.dropzone-file'
	var previewNode = $(query).find('.dropzone-item')
        previewNode.id = "";
        var previewTemplate = previewNode.parent('.dropzone-items').html();
        previewNode.remove();
	// let _dropzoneFile = new Dropzone(query, {
	// 	url: "https://keenthemes.com/scripts/void.php",
	// 	maxFilesize: 1, 
	// 	maxFiles: 1,
	// 	previewTemplate: previewTemplate,
	// 	previewsContainer: query + " .dropzone-items", 
	// 	clickable: query + " .dropzone-select" 
	// });
	
	console.log('#'+$(query).attr('id')+' > div > .dropzone-select')
	let _dropzoneFile = $('#'+$(query).attr('id')).dropzone({
		url: "https://keenthemes.com/scripts/void.php",
		maxFilesize: 1, 
		maxFiles: 1,
		// previewTemplate: previewTemplate,
		// previewsContainer: $(query).find(".dropzone-items"), 
		clickable: '#'+$(query).attr('id')+' > div > .dropzone-select'
	});

	_dropzoneFile.on("addedfile", function (file){
		if(_dropzoneFile.files.length > 1){
			_dropzoneFile.removeFile(_dropzoneFile.files[0])
		}
		onAddedFile(file, query, this)
	})
	_dropzoneFile.on('sendingmultiple', function (data, xhr, formData) {
		formData.append("Username", $(`[name='${$(query).data('field')}']`).val());
	});
}

function onAddedFile (file, query, dropzone){
	// file.previewElement.querySelector(query + " .dropzone-start").onclick = function() { history_pendidikan_sma_ijazah.enqueueFile(file); };
	$(document).find( query + ' .dropzone-item').css('display', '');
	$(dropzone).append(`<input name="${dropzone.data('field')}">`)
	// $( query + " .dropzone-upload, " + query + " .dropzone-remove-all").css('display', 'inline-block');
	
}

const fields = ['history_pendidikan_sma_ijazah', 'history_pendidikan_s1_ijazah', 'history_pendidikan_s2_ijazah']

fields.map((field, index) => {
})

if($('.dropzone').length){
	$.each($('.dropzone'), function(i, v){
		dropzoneFile(this)
	})
}
// $(document).ready(function(){
// 	if($('.dropzone').length){
// 		dropzoneFile()
// 	}
// })

