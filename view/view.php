
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Favicon-->
        <link rel="shortcut icon" type="image/x-icon" href="./images/Logo.png" />
        <!-- Bootstrap Core CSS -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/bootstrap.css" rel="stylesheet">

        <script src="./js/Copo.js" type="text/javascript"></script>


        <!-- Custom CSS -->
        <link href="./css/CopoReno.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">



        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>


       


        <!--<div class="brand">Copo Construction inc</div>-->


        <!-- Navigation -->
      

        <!-- container -->


        <?php
        $filepath = File::build_path(array("view", $controller, "$view.php"));
        require $filepath;
        ?>


        <!-- /.container -->

        <footer>

            <div class="col-lg-12 text-center">


              
            </div>

        </footer>

        <!-- jQuery -->
        <script src="./js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="./js/bootstrap.min.js"></script>



    </body>
</html>