<div class="card card-register mx-auto mt-5">
    <div class="card-body">
        <div class="card-header text-center"><?php echo $titre; ?> Reservation</div>

        <form method="post" action="index.php?action=<?php echo $action; ?>&numEditeur=<?php echo $numEditeur ?>" >
            <div class="form-group">
                <div class="form-row">

                    <div class="col-md-12 text-center">
                        <label class="card-header" for="nomEditeur">Nom Editeur</label>
                        <input type="text" value="<?php echo $nomEditeur ?>" name="nomEditeur" id="nomEditeur" required=""/>
                    </div>

                    <div class="col-md-12 text-center">

                        <label class="card-header" for="nbJeux">Nombre de jeu</label>
                        <input type="number" value="<?php echo $nbJeux ?>" name="nbJeux" id="nbJeux"/>
                         </br>
                         
                        <label class="card-header" for="nomJeu">Nom Jeu</label>
                        <input type="text" value="<?php echo $nomJeu ?>" name="nomJeu" class="rechercheJ" id="nomJeux" required=""/>
                         </br>

                         <label class="card-header" for="catJeu">Catégorie du Jeu</label>
                        <input type="text" value="<?php echo $catJeu ?>" name="catJeu" class="rechercheC" id="catJeu" required=""/>
                         </br>

                        <label class="card-header" for="nomZone">Zone du jeu</label>
                        <input type="text" value="<?php echo $nomZone ?>" name="nomZone" id="nomZone" required=""/>
                    </br>
                        <label class="card-header" for="recu">Jeu Reçu</label>
                        <input type="radio" id="recu" name="recu" value="1">Oui
                        <input type="radio" id="recu" name="recu" value="0">Non

                         </br>
                        <label class="card-header" for="don">Don</label>
                        <input type="radio" id="don" name="don" value="1">Oui
                        <input type="radio" id="don" name="don" value="0">Non

                         </br>
                        <label class="card-header" for="retour">Retour du jeu </label>
                        <input type="radio" id="retour" name="retour" value="1">Oui
                        <input type="radio" id="retour" name="retour" value="0">Non



                    </div>

                    <div class="col-md-12 text-center">

                        <label class="card-header" for="nbPlace">Nombre d'espace</label>
                        <input type="number" value="<?php echo $nbPlace ?>" name="nbPlace" id="nbPlace" required=""/>
                        </br>
                        <label class="card-header" for="prix">Prix réservation</label>
                        <input type="number" value="<?php echo $prixPlaceNego ?>" name="prix" id="prix"/>
                    

                        </br>
                        <label class="card-header" for="commentaire">Informations spécifiques</label>
                        <textarea rows="3" cols="22" id="commentaire" name="commentaire" value="<?php echo $nomJeu ?>"></textarea>
                        </br>
                        <label class="card-header" for="etatFact">Etat de la facture</label>
                        
                        <input type="radio" id="edit" name="etatFact" value="editee">Editée
                        <input type="radio" id="payee" name="etatFact" value="payee">Payée
                        <input type="radio" id="nonEdit" name="etatFact" value="">Non editée

                    </div>

                    
                    <div class="col-md-12 text-center">
                        <label class="card-header" for="log">Logement</label>
                        
                        <input type="radio" id="log" name="log" value="1">Oui
                        <input type="radio" id="log" name="log" value="0">Non
                        
                    </br>
                        <p>Si oui :</p>
                                
                    </div>  
                        <div class="col-md-6">

                            <label class="card-header" for="place">Nombre de place voulues</label>
                            <input type="number" value="<?php echo $place ?>" name="place" id="place"/>

                            <label class="card-header" for="frais">Budget</label>
                            <input type="number" value="<?php echo $frais ?>" name="frais" id="frais"/>

                            <label class="card-header" for="nbChambre">Nombre de chambre à reserver</label>
                            <input type="number" value="<?php echo $nbChambre ?>" name="nbChambre" id="nbChambre"/>

                            <label class="card-header" for="coutNuit">Coût de la nuit</label>
                            <input type="number" value="<?php echo $coutNuit ?>" name="coutNuit" id="coutNuit"/>

                        </div>

                        <div class="col-md-6">

                            <p>Adresse du logement</p>

                            <label class="card-header" for="rue">Rue</label>
                            <input type="text" value="<?php echo $rue ?>" name="rue" id="rue"/>

                            <label class="card-header" for="ville">Ville</label>
                            <input type="text" value="<?php echo $ville ?>" name="ville" id="ville"/>

                            <label class="card-header" for="cp">Code postal</label>
                            <input type="number" value="<?php echo $cp ?>" name="cp" id="cp"/>

                        </div>



                    
                       
                </div>

            </div>


            <div class="form-row">

                <div class="col-lg-12 text-center"> 

                    <input class="btn btn-success" type="submit" value="Enregistrer" />
                </div>
            </div>
    </div>
</form>
</div>




