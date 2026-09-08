<?php
// Disable caching
header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
?>

<?php
$sl ="SELECT `pro_id`, `pro_logo`,`pro_dark_logo`, `pro_favicon` , `pro_title`, `pro_keyword`, `pro_detail` FROM `tbl_profile`";
$resut = $conn->query($sl);
$ro = $resut->fetch_assoc();
?>
<head>
	<title><?=$ro['pro_title']?> | Admin Panel</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="shortcut icon" type="image/x-icon" href="<?= SITE_URL ?>uploads/<?php echo $ro['pro_favicon']; ?>">-->
	 <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_URL ?>uploads/<?php echo $ro['pro_favicon']; ?>"> 
	<link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="assets/css/default/style.min.css" rel="stylesheet" />
	<link href="assets/css/default/style.css" rel="stylesheet" />
	<link href="assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<!-- Latest CKEditor 5 Super-Build (All Available Features: Source Editing, Fonts, Colors, Tables, Media) -->
	<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
	<script>
		if (typeof CKEDITOR === 'undefined') {
			document.write('<script src="assets/ckeditor/ckeditor.js"><\/script>');
		}
	</script>
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
    <script src="assets/plugins/jquery/jquery-3.3.1.min.js"></script>
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="assets/js/admin-custom.js?v=<?= file_exists(__DIR__ . '/../assets/js/admin-custom.js') ? filemtime(__DIR__ . '/../assets/js/admin-custom.js') : time() ?>"></script>
    <script type="text/javascript" src="assets/toaster/toaster.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/toaster/toaster.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="assets/css/admin-custom.css?v=<?= file_exists(__DIR__ . '/../assets/css/admin-custom.css') ? filemtime(__DIR__ . '/../assets/css/admin-custom.css') : time() ?>" rel="stylesheet" />
</head>