<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">

	<head>
		<base href="">
		<meta charset="utf-8" />
		<title>Admisi | Univerisas Kristen Indonesia Toraja	</title>
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

		<link href="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')?>" rel="stylesheet" type="text/css" />

		<link href="<?php echo base_url('assets/plugins/global/plugins.bundle.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/plugins/custom/prismjs/prismjs.bundle.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('assets/css/style.bundle.css')?>" rel="stylesheet" type="text/css" />

		<link rel="shortcut icon" href="<?php echo base_url('assets/media/logos/favicon.ico')?>" />
	</head>

	<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-static page-loading">
		<?php $this->load->view('layout.php')?>
		<?php $this->load->view('partials/_extras/offcanvas/quick-notifications.php')?>
		<?php $this->load->view('partials/_extras/offcanvas/quick-actions.php')?>
		<?php $this->load->view('partials/_extras/offcanvas/quick-user.php')?>
		<?php $this->load->view('partials/_extras/offcanvas/quick-panel.php')?>
		<?php $this->load->view('partials/_extras/chat.php')?>
		<?php $this->load->view('partials/_extras/scrolltop.php')?>
		<script>
			var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
		</script>

		<script>
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

		<script src="<?php echo base_url('assets/plugins/global/plugins.bundle.js')?>"></script>
		<script src="<?php echo base_url('assets/plugins/custom/prismjs/prismjs.bundle.js')?>"></script>
		<script src="<?php echo base_url('assets/js/scripts.bundle.js')?>"></script>
		<script src="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')?>"></script>
		<script src="<?php echo base_url('assets/js/pages/widgets.js')?>"></script>
		<script src="<?php echo base_url('assets/js/src/app.js')?>"></script>
		<script src="<?php echo base_url('assets/js/src/inputmask.js')?>"></script>
		<script src="<?php echo base_url('assets/js/src/dropzone.js')?>"></script>
	</body>
</html>
