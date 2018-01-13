<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $pagetitle; ?></title>
        <!-- Bootstrap core CSS-->
        <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="./vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="./css/sb-admin.css" rel="stylesheet">
        <link href="./css/style.css" rel="stylesheet">

    </head>

    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <a class="navbar-brand" href="index.php?action=festivalAccueil"><img id="logo" src="./image/logoSite.png" alt="logo" width="45%" /></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>

            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Editeur">
                        <a class="nav-link" href="index.php?action=listEditeur">
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                            <span class="nav-link-text">Editeurs</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Jeux">
                        <a class="nav-link" href="index.php?action=listJeux">
                            <i class="fa fa-fort-awesome" aria-hidden="true"></i>
                            <span class="nav-link-text">Jeux</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Categories">
                        <a class="nav-link" href="index.php?action=listCategorie">
                            <i class="fa fa-server" aria-hidden="true"></i>
                            <span class="nav-link-text">Catégories</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Zones">
                        <a class="nav-link" href="index.php?action=listZone">
                            <i class="fa fa-window-maximize" aria-hidden="true"></i>
                            <span class="nav-link-text">Zones</span>
                        </a>
                    </li>

                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reservations">
                        <a class="nav-link" href="index.php?action=listResa">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="nav-link-text">Reservations</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Suivis">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSuivis" data-parent="#exampleAccordion">
                            <i class="fa fa-fw fa-folder"></i>
                            <span class="nav-link-text">Suivis</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseSuivis">
                            <li>
                                <a href="index.php?action=listSuivi">Editeurs</a>
                            </li>
                            <li>
                                <a href="cards.html">Cards</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Festival">
                        <a class="nav-link" href="index.php?action=listFestival">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            <span class="nav-link-text">Festivals</span>
                        </a>
                    </li>
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Utilisateurs">
                        <a class="nav-link" href="index.php?action=listUser">
                            <i class="fa fa-fw fa-wrench" aria-hidden="true"></i>
                            <span class="nav-link-text">Administration</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav sidenav-toggler">
                    <li class="nav-item">
                        <div class="nav-link text-center" id="sidenavToggler">
                            <i class="fa fa-fw fa-angle-lefts"></i>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">


                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-fw fa-sign-out"></i>Deconnexion</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="content-wrapper">
            <div class="container-fluid">

                <?php
                $filepath = File::build_path(array("view", $controller, "$view.php"));
                require $filepath;
                ?>


            </div>
        </div>


        <footer>


        </footer>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Quitter?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Cliquez sur "Deconnexion" pour quitter la session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <a class="btn btn-success" href="index.php?action=deconnectFestival">Deconnexion</a>
                    </div>
                </div>
            </div>
        </div>





        <!-- Bootstrap core JavaScript-->
        <script src="./vendor/jquery/jquery.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Page level plugin JavaScript-->
        <script src="./vendor/chart.js/Chart.min.js"></script>
        <script src="./vendor/datatables/jquery.dataTables.js"></script>
        <script src="./vendor/datatables/dataTables.bootstrap4.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="./js/sb-admin.min.js"></script>
        <!-- Custom scripts for this page-->
        <script src="./js/sb-admin-datatables.min.js"></script>
        <script src="./js/sb-admin-charts.min.js"></script>

        <script>
            $('#rechercheE').autocomplete({
                source: '/view/autocompleteE.php'

            });
        </script>

        <script>
            $('#toggleNavPosition').click(function () {
                $('body').toggleClass('fixed-nav');
                $('nav').toggleClass('fixed-top static-top');
            });

        </script>
        <!-- Toggle between dark and light navbar-->
        <script>
            $('#toggleNavColor').click(function () {
                $('nav').toggleClass('navbar-dark navbar-light');
                $('nav').toggleClass('bg-dark bg-light');
                $('body').toggleClass('bg-dark bg-light');
            });

        </script>


    </div>
</body>

</html>