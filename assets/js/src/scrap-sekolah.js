$('[name="submit"]').click(function(){
	const zona1 = pad($('[name="zona1"]').val(), 2)
	const zona2 = pad($('[name="zona2"]').val(), 2)
	const zona3 = pad($('[name="zona3"]').val(), 2)
	console.log(zona1, zona2, zona3)
	const header = {
		method: 'GET',
		mode: 'no-cors'
	}

	const request = new Request('https://referensi.data.kemdikbud.go.id/index11.php?kode=036202&level=3', header)

	fetch(request).then(res => {
		console.log(res)
	})
})

function pad(n, width, z) {
	z = z || '0';
	n = n + '';
	return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
  }
