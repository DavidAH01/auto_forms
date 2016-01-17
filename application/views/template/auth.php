<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Auto Forms By David AH</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    
    <!-- Bootstrap core CSS     -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?= base_url() ?>assets/css/animate.min.css" rel="stylesheet"/>
    
    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?= base_url() ?>assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
        
    <!--  DataTables CSS    -->
    <link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://www.datatables.net/release-datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet">
        
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?= base_url() ?>assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <!--     Bootstrap Tags Input     -->
    <link href="<?= base_url() ?>assets/css/bootstrap-tagsinput.css" rel="stylesheet" />

    <!--     Bootstrap Multiselect     -->
    <link href="<?= base_url() ?>assets/css/bootstrap-multiselect.css" rel="stylesheet" />

</head>
<body> 
<input type="hidden" id="base_url" value="<?php base_url(); ?>">
<div class="wrapper">
    <div class="sidebar auth" data-color="black" data-image="<?= base_url() ?>assets/img/sidebar-2-big.jpg">    
        
        <?= $section ?>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	
    <!--   TinyMCE   -->
    <script src="<?= base_url() ?>assets/js/jquery.iframe-post-form.js"></script>
    <script src="<?= base_url() ?>assets/js/tinymce/tinymce.min.js"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="<?= base_url() ?>assets/js/bootstrap-checkbox-radio-switch.js"></script>
	
    <!--  Notifications Plugin    -->
    <script src="<?= base_url() ?>assets/js/bootstrap-notify.js"></script>

    <!--     Bootstrap Tags Input     -->
    <script src="<?= base_url() ?>assets/js/bootstrap-tagsinput.js"></script>
    
    <!--     Bootstrap Multiselect     -->
    <script src="<?= base_url() ?>assets/js/bootstrap-multiselect.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	
     <!--  DataTables Plugin    -->
    <script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.tableTools.js"></script>
    <script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="<?= base_url() ?>assets/js/light-bootstrap-dashboard.js"></script>
	
</html>