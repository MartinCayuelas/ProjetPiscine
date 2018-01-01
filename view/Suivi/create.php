<div class="card card-register mx-auto mt-5">
    <div class="card-body">
        <div class="card-header text-center"><?php echo $titre; ?> Suivi</div>

        <form method="post" action="index.php?action=<?php echo $action; ?>&numEditeur=<?php echo $numEditeur ?>" >
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="card-header" for="premierContact">Premier contact</label>
                        <input type="text" value="<?php echo $premierContact ?>" name="premierContact" id="premierContact" required=""/>
                    </div>

                    <div class="col-md-6">

                        <label class="card-header" for="relance">Relance</label>
                        <input type="text" value="<?php echo $relance ?>" name="relance" id="relance"/>


                        <label class="card-header" for="reponse">Reponse</label>
                        <input type="checkbox" value="<?php echo $reponse ?>" name="reponse" id="reponse"/>



                    </div>
                </div>

            </div>


            <div class="form-row">

                <div class="col-lg-12 text-center"> 
                    <input type="hidden" name="refSuivi" value="<?php echo $ref ?>" />
                    <input type="hidden" name="numEditeur" value="<?php echo $numEditeur ?>" />

                    <input class="btn btn-success" type="submit" value="Enregistrer" />
                </div>
            </div>
    </div>
</form>
</div>




