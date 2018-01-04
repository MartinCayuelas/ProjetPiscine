<?php


echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des contacts</div>
EOF;

if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createContact&numEditeur={$numE}"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Contact</a>
             
EOF;
}
echo <<<EOF
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered"  width="100%" cellspacing="0">
               <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Téléphone</th>
                   <th>Mail</th>
                </tr>
              </thead>
EOF;

foreach ($tab as $v) {

    $num = htmlspecialchars($v->getNumContact());
    $nom = htmlspecialchars($v->getNomContact());
    $prenom = htmlspecialchars($v->getPrenomContact());
    $tel = htmlspecialchars($v->getNumTelContact());
    $mail = htmlspecialchars($v->getMailContact());


    


    echo <<< EOF

             <tbody>
                <tr>
                  <th>{$nom}</th>
                  <th>{$prenom}</th>
                   <th>{$tel}</th>
                   <th>{$mail}</th>
EOF;
    if (isset($_SESSION['login']) && Session::is_admin()) {

        echo <<< EOF
        
        <th class="text-center"> <a class="nav-link" data-toggle="modal" data-target="#exampleModalS{$num}">
                           <button class="btn btn-danger" type="button"> <i class="fa fa-fw fa-trash"></i>Supprimer</button></a></th>   
       
       <div class="modal fade" id="exampleModalS{$num}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelS{$num}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelS{$num}">Supprimer?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <a href="index.php?action=deleteContact&numEditeur={$numE}&numContact={$num}"><button class="btn btn-danger" type="button">Supprimer</button></a>
                    </div>
                </div>
            </div>
        </div>
                   
                            <form action="index.php?action=updateContact&numEditeur={$numE}" method = "POST">
                                
                                <input type="hidden" name="numContact" value="{$num}" />
                                <input type="hidden" name="nomContact" value="{$nom}" />
                                <input type="hidden" name="prenomContact" value="{$prenom}" />
                                <input type="hidden" name="numTelContact" value="{$tel}" />
                                <input type="hidden" name="mailContact" value="{$mail}" />
                                <input type="hidden" name="numEditeur" value="{$numE}" />
                                


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
