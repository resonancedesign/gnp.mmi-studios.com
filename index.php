<?php 
    session_start();
    error_reporting(0);
    require_once('app/config.php');
    if(isset($_GET['page'])) {
        $pages = array('recent', 'produkts', 'cart', 'charge', 'bio', 'media', 'diskog', 'lyriks', 'links', 'kontakt');
        if(in_array($_GET['page'], $pages)) {
            $page = $_GET['page'];
        } else {
            $page = 'produkts';
        }
    } else {
        $page = 'recent';
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-language" content="en">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gross National Produkt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="The official website for the dark electro-industrial project, Gross National Produkt.">
        <meta name="keywords" content="gross national produkt, gnp, gnprodukt, dark, electro, industrial, electro-industrial">
        <meta name="author" content="Riki Rezinunts">
        <!-- <meta name="generator" content=""> -->
        <!--[if IE]><link rel="shortcut icon" href="favicon.ico"><![endif]-->
        <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
        <link rel="icon" href="favicon.png">
        
        <!-- Import all styles -->
        <link href="css/gnp-styles.css" rel="stylesheet">

        <!-- Google fonts -->
        <link href='//fonts.googleapis.com/css?family=Economica:400,400italic,700,700italic' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="index">
	        <div class="container-fluid">
	            <div class="row-fluid">
	                <div class="col-lg-12">
                        <!-- header start -->
                        <?php include_once('app/includes/layout/header.php'); ?>
                        <!-- header stop -->

                        <!-- main content start -->
                        <div class="container-fluid lr-borders">
                            <div class="row-fluid">
                                <!-- column left -->
                                <div class="col-md-9 remove-padding" id="content-swapper">
                                    <?php require('app/includes/content/general/' . $page . '.php'); ?>
                                </div>
                                <!-- column right -->
                                <?php include_once('app/includes/layout/sidebar.php'); ?>
                            </div>
                        </div>
                        <!-- main content stop -->

                        <!-- footer start -->
                        <?php include_once('app/includes/layout/footer.php'); ?>
                        <!-- footer stop -->
                    </div>
	            </div>
	        </div>
	    </div>
        
        <!-- Javascript -->
        <?php include_once('app/includes/content/data/javascripts.php') ?>
    </body>
</html>