<div class="card card-register mx-auto mt-5">
    <div class="card-body">
        <div class="card-header text-center"><?php echo $titre; ?> Utilisateur</div>

        <form method="post" action="index.php?action=<?php echo $action; ?>" >
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="card-header" for="login_id"> <i class="fa fa-user-o" aria-hidden="true"></i> Identifiant</label>
                        <input type="text" value="<?php echo $vLogin ?>"placeholder="login" name="login" id="login_id"required/>
                    </div>
                    <div class="col-md-6">
                        <label class="card-header" for="pwd_id"> <i class="fa fa-lock" aria-hidden="true"></i> Mot de passe</label><br>

                        <input type="password" placeholder="******" name="password" id="pwd_id" required/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="card-header" for="prenom_id"> <i class="fa fa-user-o" aria-hidden="true"></i> Prénom</label><br>

                        <input type="text" value="<?php echo $prenom; ?> " placeholder="MonPrenom" name="prenom" id="prenom_id" required/>

                    </div>
                    <div class="col-md-6">
                        <label class="card-header" for="nom_id"> <i class="fa fa-user-o" aria-hidden="true"></i> Nom</label><br>

                        <input type="text" value="<?php echo $nom; ?> " placeholder="MonNom" name="nom" id=" nom_id" required/>

                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-12 text-center">
                       
                            <label class="card-header" for="admin_id"> <i class="fa fa-wrench" aria-hidden="true"></i> Administrateur</label><br>

                            <p class="onoff">
                                <input name="admin" type="checkbox" value="0" id="checkboxID">
                                <label for="checkboxID"></label>
                            </p>
                       

                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="form-row">

                    <div class="col-lg-12 text-center">
                       
                        <input class="btn btn-success" type="submit" value="Enregistrer" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>




