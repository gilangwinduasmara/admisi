function dropzoneFile(field){
	const query = '.dropzone-file'
	var previewNode = $(query + " .dropzone-item");
        previewNode.id = "";
        var previewTemplate = previewNode.parent('.dropzone-items').html();
        previewNode.remove();
	let _dropzoneFile = new Dropzone(query, {
		url: "https://keenthemes.com/scripts/void.php",
		maxFilesize: 1, 
		maxFiles: 1,
		previewTemplate: previewTemplate,
		previewsContainer: query + " .dropzone-items", 
		clickable: query + " .dropzone-select" 
	});

	_dropzoneFile.on("addedfile", function (file){
		if(_dropzoneFile.files.length > 1){
			_dropzoneFile.removeFile(_dropzoneFile.files[0])
		}
		onAddedFile(file, query, this)
	})
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

var history_pendidikan_sma_ijazah = dropzoneFile('.')

$(document).ready(function(){
	dropzoneFile()
})

