<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des utilisateurs </div>
EOF;

            if (isset($_SESSION['login']) && Session::is_admin()) {
            echo <<<EOF
           
           <a class="ajout" href="index.php?action=createUser">Ajouter un Utilisateur</a>
            
             
EOF;

}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th >Login</th>
                  
                  <th>Prénom</th>
                  <th>Nom</th>
                   <th>Administrateur</th>
                </tr>
              </thead>
EOF;
foreach ($tab as $v) {

    $vLogin = htmlspecialchars($v->getLogin());
    $nom = htmlspecialchars($v->getNom());
    $prenom = htmlspecialchars($v->getPrenom());
    $admin = htmlspecialchars($v->getAdmin());
    
    if ($admin == 0){
        $admin = "Non";   
    }
    else {
        $admin = "Oui";
    }





    echo <<< EOF

             <tbody>
                <tr>
                  <th>{$vLogin}</th>
                  <th>{$prenom}</th>
    <th>{$nom}</th>
    <th>{$admin}</th>
EOF;
     if (isset($_SESSION['login']) && Session::is_admin()) {

        echo <<< EOF
                   
                   <th class="text-center" ><a href="index.php?action=deleteUser&login={$vLogin}"><button class="btn btn-danger" type="button">Supprimer</button></a></th> 
                             <form action="index.php?action=updateUser" method = "POST">
                                

                                <input type="hidden" name="login" value="{$vLogin}" />
                                <input type="hidden" name="prenom" value="{$prenom}" />
                                <input type="hidden" name="nom" value="{$nom}" />
                                


                                <br>
                               <th class="text-center" > <button type="submit" class="btn btn-primary">Modifier</button></th>   
                            </form>
                               
                       
                       
EOF;
    }
   
    echo <<< EOF

        </tr>
      </tbody>
                         
              
                      
EOF;
}


echo "</div>";
echo "</div>";