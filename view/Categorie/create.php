
<div class="card card-register mx-auto mt-5">
    <div class="card-body">
        <div class="card-header text-center"><?php echo $titre; ?> Categorie</div>

        <form method="post" action="index.php?action=<?php echo $action; ?>" >
            <div class="form-group">
                <div class="form-row">

                    <div class="col-md-6">
                        <label class="card-header" for="nom_id">Nom de la catégorie</label>
                        <input type="text" value="<?php echo $nom ?>"placeholder="Nom" name="nomCategorie" id="nom_id"required/>


                    </div>
                </div>
            </div>


            <div class="form-row">

                <div class="col-lg-12 text-center"> 
                    <input type="hidden" name="codeCategorie" value="<?php echo $code ?>" />

                    <input class="btn btn-success" type="submit" value="Enregistrer" />
                </div>
            </div>
        </form>
    </div>
</div>