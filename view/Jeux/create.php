<div class="card card-register mx-auto mt-5">
    <div class="card-body">
        <div class="card-header text-center"><?php echo $titre; ?> Jeu</div>

        <form method="post" action="index.php?action=<?php echo $action; ?>" >
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="card-header" for="nomJeu">Nom du jeu</label>
                        <input type="text" value="<?php echo $nom ?>"placeholder="Nom" name="nom" id="nomJeu"required/>
                    </div>
                 
                      <div class="col-md-6">
                            <label class="card-header" for="Nbrejoueurs">Nombre de joueurs</label>
                            <input type="number" value="<?php echo $nbjoueurs ?>"placeholder="0" name="nbjoueurs" id="Nbrejoueurs"/>
                        
                       
                            <label class="card-header" for="dateSortie">Date de sortie</label>
                            <input type="text" value="<?php echo $dates ?>"placeholder="jj/mm/aaaa" name="dates" id="dateSortie"/>
                        
                         
                            <label class="card-header" for="dureePartie">Durée</label>
                            <input type="number" value="<?php echo $duree ?>"placeholder="minutes" name="duree" id="dureePartie"/>


                            <label class="card-header" for="codeCategorie">Catégorie du jeu</label>
                            <input type="text" value="<?php echo $categorie ?>"placeholder="categorie" name="categorie" id="codeCategorie"/>


                            <label class="card-header" for="editeur">Editeur du jeu</label>
                            <input type="text" value="<?php echo $editeur ?>"placeholder="editeur" name="editeur" id="numEditeur"/>
                        
                    </div>
                </div>
                
            </div>


            <div class="form-row">

                <div class="col-lg-12 text-center"> 
                    <input type="hidden" name="numJeux" value="<?php echo $num ?>" />
                    
                    <input class="btn btn-success" type="submit" value="Enregistrer" />
                </div>
            </div>
    </div>
</form>
</div>
