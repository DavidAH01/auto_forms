<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Auto Forms By David AH</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <!-- Jquery UI CSS     -->
    <link href="<?= base_url() ?>assets/css/jquery-ui.css" rel="stylesheet" />

    <!-- Bootstrap core CSS     -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?= base_url() ?>assets/css/animate.min.css" rel="stylesheet"/>
       
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
    
    <!--  Auto_Forms core CSS  -->
    <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet"/>
     
</head>
<body> 
    <input type="hidden" id="base_url" value="<?= base_url(); ?>">
    <div class="wrapper">
        <div class="sidebar" data-color="black" data-image="<?= base_url() ?>assets/img/sidebar-2.jpg">    
        
        	<div class="sidebar-wrapper">
                <div class="logo">
                    <a href="http://david-ah.com" target="_blank" class="simple-text">
                        Auto_Forms
                    </a>
                </div>
                           
                <ul class="nav">
                    <li class="<?= ($section_title == "Dashboard")?"active":""; ?>">
                        <a href="<?= base_url() ?>dashboard">
                            <i class="pe-7s-graph"></i> 
                            <p>Dashboard</p>
                        </a>            
                    </li>
                    
                    <?php if(is_super_administrator()){ ?>
                        <li class="<?= ($section_title == "Configuration")?"active":""; ?>">
                            <a href="<?= base_url() ?>configuration">
                                <i class="pe-7s-science"></i>
                                <p>Configuration</p>
                            </a>        
                        </li>
                        <li class="<?= ($section_title == "Administrators")?"active":""; ?>">
                            <a href="<?= base_url() ?>administrators">
                                <i class="pe-7s-user"></i> 
                                <p>Administrators</p>
                            </a>
                        </li>
                    <?php } ?>
                    
                    <br>
                    <li>
                        <a href="#" class="underline">
                            <i class="pe-7s-note2"></i> 
                            <p>Administrable sections</p>
                        </a> 
                        <ul class="sub nav">
                            <li>
                                <a href="">Table 1</a>
                            </li>
                            <li>
                                <a href="">Table 1</a>
                            </li>
                            <li>
                                <a href="">Table 1</a>
                            </li>
                        </ul>      
                    </li>
                </ul> 
        	</div>
        </div>
        
        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">    
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">
                            <?= $section_title  ?>

                            <?php if(is_super_administrator() && $section_title == "Administrators"){ ?>
                                <a href="<?= base_url() ?>administrators/create"><button type="submit" class="btn btn-info btn-sm">Create</button></a>
                            <?php } ?>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">       
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?= $this->session->userdata('logged_in')['name'] ?>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= base_url() ?>administrators/user/<?= $this->session->userdata('logged_in')['user_id'] ?>">Profile</a></li>
                                    <li><a href="auth/logout">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
                         
                         
            <div class="content">
                <?= $section ?>
            </div>
            
            
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy; 2016 <a href="http://david-ah.com">David AH</a>, made with love for a better web
                    </p>
                </div>
            </footer>
            
        </div>   

    </div>
</body>
    <!--   Core JS Files   -->
    <script src="<?= base_url() ?>assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="<?= base_url() ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
    
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
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.rowReordering.js"></script>
    
    <!-- Auto_Forms Core JS -->
	<script src="<?= base_url() ?>assets/js/main.js"></script>
    <script src="<?= base_url() ?>assets/js/sections/dashboard.js"></script>
    <script src="<?= base_url() ?>assets/js/sections/configuration.js"></script>
    <script src="<?= base_url() ?>assets/js/sections/administrators.js"></script>

</html>