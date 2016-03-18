<!doctype html>
<html lang="en">
<head>
    <input type="hidden" id="base_url" value="<?= base_url(); ?>">
    <input type="hidden" id="email_invalid" value="<?= $this->lang->line('email_invalid') ?>">

	<meta charset="utf-8" />
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Auto_Forms by David AH</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <!-- Animation library for notifications   -->
    <link href="<?= base_url() ?>assets/css/animate.min.css" rel="stylesheet"/>

    <!-- Bootstrap core CSS     -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?= base_url() ?>assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <!--  Auto_Forms core CSS  -->
    <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet"/>
     
</head>
<body> 
<div class="wrapper">
    <div class="sidebar auth" data-color="orange" data-image="<?= base_url() ?>assets/images/sidebar-2-big.jpg">    
        
        <?php if(isset($errors)) { ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) {
                    echo $error; 
                } ?>
            </div>
        <?php } ?>

        <?= $section ?>

    </div>
</div>
</body>

    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/js/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    
    <!--  jsTimezoneDetect    -->
    <script src="<?= base_url() ?>assets/js/jstz.main.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?= base_url() ?>assets/js/bootstrap-notify.min.js"></script>
    
    <!-- Auto_Forms Core JS -->
    <script src="<?= base_url() ?>assets/js/sections/auth.js"></script>
	
</html>