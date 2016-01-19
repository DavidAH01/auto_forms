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
  
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?= base_url() ?>assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <!--  Auto_Forms core CSS  -->
    <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet"/>
     
</head>
<body> 
<input type="hidden" id="base_url" value="<?= base_url(); ?>">
<div class="wrapper">
    <div class="sidebar auth" data-color="black" data-image="<?= base_url() ?>assets/img/sidebar-2-big.jpg">    
        
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
    <script src="<?= base_url() ?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Auto_Forms Core JS -->
    <script src="<?= base_url() ?>assets/js/sections/login.js"></script>
	
</html>