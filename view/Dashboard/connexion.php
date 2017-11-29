
<div class="box "> 

    <div class="col-lg-12 text-center realisation">
        <br>
        <h3>
            Festival du jeu de Montpellier
        </h3>
        <hr>
        <h4>
            Connexion
        </h4>

    </div>


    <div class="col-md-12 realisation">
        <form method="post" action="index.php?action=connectedFestival" enctype="multipart/form-data">
            <div class="row">
                <br>
                <div class="form-group col-md-12 text-center">
                    <label>Identifiant</label>
                    <br>
                    <input type="text" name="login" placeholder="login" id="login_id"  required/>
                </div>
                <div class="form-group col-md-12 text-center">
                    <label>Mot de passe</label>
                    <br>
                    <input type="password" name="password" placeholder="******" id="password_id" required/>
                </div>



                <div class="form-group col-lg-12 text-center">
                    <input type="hidden" name="connect">
                    <button  type="submit" class="btn btn-success">Connexion</button>
                </div>
            </div>
        </form>


    </div>

</div>
