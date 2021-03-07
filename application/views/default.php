<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">

	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>Admisi | UKIT	</title>
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

		<link href="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')?>" rel="stylesheet" type="text/css" />

		<link href="<?php echo base_url('assets/plugins/global/plugins.bundle.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/plugins/custom/prismjs/prismjs.bundle.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/style.bundle.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/style.css?')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/plugins/custom/datatables/datatables.bundle.css')?>" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

		<link rel="shortcut icon" href="<?php echo base_url('assets/media/logo.png')?>" />
	</head>

	<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-static page-loading">
		
		<?php $this->load->view('layout.php')?>
		<script>
			var HOST_URL = '<?php echo base_url() ?>';
		</script>

		<script>
			const BASE_URL = '<?php echo base_url() ?>';
			let pendaftaran = <?php echo (json_encode($pendaftaran ?? null)) ?>;
			var KTAppSettings = {
				"breakpoints": {
					"sm": 576,
					"md": 768,
					"lg": 992,
					"xl": 1200,
					"xxl": 1200
				},
				"colors": {
					"theme": {
						"base": {
							"white": "#ffffff",
							"primary": "#6993FF",
							"secondary": "#E5EAEE",
							"success": "#1BC5BD",
							"info": "#8950FC",
							"warning": "#FFA800",
							"danger": "#F64E60",
							"light": "#F3F6F9",
							"dark": "#212121"
						},
						"light": {
							"white": "#ffffff",
							"primary": "#E1E9FF",
							"secondary": "#ECF0F3",
							"success": "#C9F7F5",
							"info": "#EEE5FF",
							"warning": "#FFF4DE",
							"danger": "#FFE2E5",
							"light": "#F3F6F9",
							"dark": "#D6D6E0"
						},
						"inverse": {
							"white": "#ffffff",
							"primary": "#ffffff",
							"secondary": "#212121",
							"success": "#ffffff",
							"info": "#ffffff",
							"warning": "#ffffff",
							"danger": "#ffffff",
							"light": "#464E5F",
							"dark": "#ffffff"
						}
					},
					"gray": {
						"gray-100": "#F3F6F9",
						"gray-200": "#ECF0F3",
						"gray-300": "#E5EAEE",
						"gray-400": "#D6D6E0",
						"gray-500": "#B5B5C3",
						"gray-600": "#80808F",
						"gray-700": "#464E5F",
						"gray-800": "#1B283F",
						"gray-900": "#212121"
					}
				},
				"font-family": "Poppins"
			};
		</script>

		<script src="<?php echo base_url('assets/plugins/global/plugins.bundle.js?')?>"></script>
		<script src="<?php echo base_url('assets/plugins/custom/prismjs/prismjs.bundle.js?')?>"></script>
		<script src="<?php echo base_url('assets/plugins/custom/axios/axios.js?')?>"></script>
		<script src="<?php echo base_url('assets/plugins/custom/repeater/repeater.js?')?>"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="<?php echo base_url('assets/js/pages/crud/datatables/extensions/buttons.js"?')?>"></script>
		<script src="<?php echo base_url('assets/js/scripts.bundle.js?')?>"></script>
		<script src="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?')?>"></script>
		<script src="<?php echo base_url('assets/js/pages/widgets.js?')?>"></script>
		<script src="<?php echo base_url('assets/js/src/app.js?v=2')?>"></script>
		<script src="<?php echo base_url('assets/js/src/inputmask.js')?>"></script>
		<script src="<?php echo base_url('assets/js/src/validate.js?v=3'.now())?>"></script>
		<script src="<?php echo base_url('assets/js/src/dropzone.js?')?>"></script>
		<script src="<?php echo base_url('assets/js/src/daerah.js?')?>"></script>
		<script src="<?php echo base_url('assets/js/src/penerimaan.js?')?>"></script>
		<?php
			if(($subheader[1] ?? 'null') != 'Isi Formulir'){
				?>
					<script src="<?php echo base_url('assets/plugins/custom/datatables/datatables.bundle.js?')?>"></script>
					<script src="<?php echo base_url('assets/js/src/datatables.js?')?>"></script>
				<?php
			}
		?>
		<script src="<?php echo base_url('assets/js/src/registrasi-ulang.js?')?>"></script>
		<script src="<?php echo base_url('assets/js/src/omb.js?')?>"></script>
		<script src="<?php echo base_url('assets/js/src/prestasi.js?')?>"></script>
		
		<script src="<?php echo base_url('assets/js/src/pengumuman.js?')?>"></script>
		<script src="<?php echo base_url('assets/js/src/admin.js?v=2'.now())?>"></script>
		<script src="<?php echo base_url('assets/js/src/master-data.js?v=2.js')?>"></script>
		<script src="<?php echo base_url('assets/js/src/scrap-sekolah.js?')?>"></script>
	
	</body>
</html>
