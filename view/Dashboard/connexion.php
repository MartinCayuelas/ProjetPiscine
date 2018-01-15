<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Connexion - Festival du Jeu MTP</title>
        <!-- Bootstrap core CSS-->
        <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="./css/sb-admin.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">
    </head>

    <body class="bg-connect">
        <div class="container">
            <div class="card card-login mx-auto mt-5">
                <div class="card card-login mx-auto mt-5">
                    <div class="card-header"><img id="logoConnec" src="image/logoSiteConnex.png" alt="logo" width="100%" /></div>
                    <div class="card-body">
                        <form method="post" action="index.php?action=connectedFestival" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="card-headerC">Identifiant</label>
                                <br>
                                <input type="text" name="login" placeholder="identifiant" id="login_id"  required/>
                            </div>
                            <div class="form-group">
                                <label class="card-headerC">Mot de passe</label>
                                <br>
                                <input type="password" name="password" placeholder="******" id="password_id" required/>
                            </div>
                            <div class="form-group col-lg-12 text-center">
                                <input type="hidden" name="connect">
                                <button  type="submit" class="btn btn-success">Connexion</button>
                            </div>
                        </form>
                    </div>
                </div>




            </div>
        </div>
        <footer>
            <p class="nav-link text-center copy">Polytech Montpellier - IG3 2017 &copy;</p>
                     
        </footer>

        <!-- Bootstrap core JavaScript-->
        <script src="./vendor/jquery/jquery.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
    </body>

</html>

