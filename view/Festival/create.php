
<div class="card card-register mx-auto mt-5">
    <div class="card-body">
        <div class="card-header text-center"><?php echo $titre; ?> Festival</div>

        <form method="post" action="index.php?action=<?php echo $action; ?>" >
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="card-header" for="annee_id">Année</label>
                        <input type="number" value="<?php echo $annee ?>"placeholder="2018" name="annee" id="annee_id"required/>
                    </div>
                    <div class="col-md-6">
                        <label class="card-header" for="date_id">Date</label>
                        <input type="date" value="<?php echo $date ?>"placeholder="Date" name="date" id="date_id"required/>
                    </div>
                 
                      <div class="col-md-6">
                            <label class="card-header" for="nbtables_id">NbreTables</label>
                            <input type="number" value="<?php echo $nbtables ?>"placeholder="NbreTables" name="nbtables" id="nbtables_id"/>
                        
                       
                            <label class="card-header" for="prixplacestd_id">PrixPlaceStandard</label>
                            <input type="number" step="0.1" value="<?php echo $prixplacestd ?>"placeholder="PrixPlaceStandard" name="prixplacestd" id="prixplacestd_id"/>
                        
                        		</div>
                    </div>
                    </div>
                </div>
                
            </div>


            <div class="form-row">

                <div class="col-lg-12 text-center"> 
                    <input type="hidden" name="anneeFestival" value="<?php echo $num ?>" />
                    
                    <input class="btn btn-success" type="submit" value="Enregistrer" />
                </div>
            </div>
    </div>
</form>
</div>

