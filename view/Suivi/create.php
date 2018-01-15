<div class="card card-register mx-auto mt-5">
    <div class="card-body">
        <div class="card-header text-center"><?php echo $titre; ?> Suivi</div>

        <form method="post" action="index.php?action=<?php echo $action; ?>" >
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="card-header" for="premierContact">Premier contact</label>
                        <input type="date" value="<?php echo $premierContact ?>" placeholder="aaaa/mm/jj" name="premierContact" id="premierContact" required=""/>
                    </div>

                    <div class="col-md-6">

                        <label class="card-header" for="relance">Relance</label>
                        <input type="date" value="<?php echo $relance ?>" placeholder="aaaa/mm/jj" name="relance" id="relance"/>


                    </div>
                    <div class="col-md-6">

                        <label class="card-header" for="nomE">Nom Editeur</label>
                        <input type="text" value="<?php echo $nom ?>" name="nomE" class="rechercheE" id="nomE"/>


                    </div>


                    
                            <div class="col-md-12 text-center">
                                
                               <label class="card-header" for="reponse_id"> <i class="fa fa-wrench" aria-hidden="true"></i> Réponse</label><br>

                            <input type="radio" name="reponse" value="1" required/> Oui
                            <input type="radio" name="reponse" value="0" required/> Non<br>


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




