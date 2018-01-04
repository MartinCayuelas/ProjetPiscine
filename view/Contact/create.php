<div class="card card-register mx-auto mt-5">
    <div class="card-body">
        <div class="card-header text-center"><?php echo $titre; ?> Contact</div>

        <form method="post" action="index.php?action=<?php echo $action; ?>&numEditeur=<?php echo $numEditeur ?>" >
            <div class="form-group form-">
                <br>
                <div class="form-row ">
                    <div class="col-md-12">
                        <label class="card-header" for="prenomContact"><i class="fa fa-user-o" aria-hidden="true"></i> Prénom</label>
                        <input type="text" value="<?php echo $prenom ?>"placeholder="Prenom" name="prenomContact" id="prenomContact"/>
                    </div>
                    <div class="col-md-12">

                        <label class="card-header" for="nomContact"><i class="fa fa-user-o" aria-hidden="true"></i> Nom</label>
                        <input type="text" value="<?php echo $nom ?>"placeholder="Nom" name="nomContact" id="nomContact"/>

                    </div>
                    <hr>
                    <div class="col-md-12">

                        <label class="card-header" for="numTelContact"><i class="fa fa-phone" aria-hidden="true"></i> Telephone</label>
                        <input type="number" value="<?php echo $num ?>"placeholder="Telephone" name="numTelContact" id="numTelContact"/>
                    </div>
                    <div class="col-md-12">
                        <label class="card-header" for="mailContact"><i class="fa fa-envelope" aria-hidden="true"></i> email</label>
                        <input type="email" value="<?php echo $mail ?>"placeholder="Mail" name="mailContact" id="mailContact"/>
                    </div>

                </div>
            </div>




            <div class="form-row">

                <div class="col-lg-12 text-center"> 
                    <input type="hidden" name="numContact" value="<?php echo $num ?>" />
                    <input type="hidden" name="numEditeur" value="<?php echo $numEditeur ?>" />

                    <input class="btn btn-success" type="submit" value="Enregistrer" />
                </div>
            </div>
    </div>
</form>
</div>




