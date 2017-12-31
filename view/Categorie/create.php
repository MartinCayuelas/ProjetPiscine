
<div class="card card-register mx-auto mt-5">
    <div class="card-body">
        <div class="card-header text-center"><?php echo $titre; ?> Categorie</div>

        <form method="post" action="index.php?action=<?php echo $action; ?>" >
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="card-header" for="code_id">CodeCategorie</label>
                        <input type="number" value="<?php echo $code ?>"placeholder="CodeCatégorie" name="code" id="code_id"required/>
                    </div>
                 
                      <div class="col-md-6">
                            <label class="card-header" for="nom_id">Nom</label>
                            <input type="text" value="<?php echo $nom ?>"placeholder="Rue" name="nom" id="nom_id"/>
                        
                       
                        
                    </div>
                    </div>
                </div>
                
            </div>
       </form>
    </div>
   </div>
</div>