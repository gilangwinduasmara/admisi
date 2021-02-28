

$(document).ready(function(){
	// if($('[name="isi"]').length == 0)
	// $('.ql-editor').empty()
	$('.ql-editor').html($('[name="isi"]').val())
	$("body").on('DOMSubtreeModified', ".ql-editor", function() {
		$('[name="isi"]').val($(this).html())
	});
})

$('.btn.pengumuman-foto').click(function(){
	$('input:file[name="foto"]').click()
})



$('input:file[name="foto"]').change(function(evt){
	var tgt = evt.target || window.event.srcElement,
        files = tgt.files;
    if (FileReader && files && files.length) {
        var fr = new FileReader();
        fr.onload = function () {
			$('.foto-preview').attr('src', fr.result)
        }
        fr.readAsDataURL(files[0]);
    }
})
