
<div class="card card-register mx-auto mt-5">
    <div class="card-body">
        <div class="card-header text-center"><?php echo $titre; ?> Logement</div>

        <form method="post" action="index.php?action=<?php echo $action; ?>" >
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="card-header" for="ville_id">Ville</label>
                        <input type="text" value="<?php echo $ville ?>"placeholder="Ville" name="ville" id="ville_id"required/>
                    </div>
                 
                      <div class="col-md-6">
                            <label class="card-header" for="rue_id">Rue</label>
                            <input type="text" value="<?php echo $rue ?>"placeholder="Rue" name="rue" id="rue_id"/>
                        
                       
                            <label class="card-header" for="cp_id">CodePostal</label>
                            <input type="number" value="<?php echo $cp ?>"placeholder="CodePostal" name="cp" id="cp_id"/>
                        
                         
                            <label class="card-header" for="nbchambre_id">NbreChambres</label>
                            <input type="number" value="<?php echo $nbchambre ?>"placeholder="NbreChambres" name="nbchambre" id="nbchambre_id"/>
                          	
                          	<label class="card-header" for="cout_id">CoutParNuit</label>
                            <input type="number" value="<?php echo $cpn ?>"placeholder="CoutParNuit" name="cpn" id="_id"/>
                        
                        		</div>
                    </div>
                    </div>
                </div>
                
            </div>


            <div class="form-row">

                <div class="col-lg-12 text-center"> 
                    <input type="hidden" name="numLogement" value="<?php echo $num ?>" />
                    
                    <input class="btn btn-success" type="submit" value="Enregistrer" />
                </div>
            </div>
    </div>
</form>
</div>

