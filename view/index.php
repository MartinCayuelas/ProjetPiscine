

<div class="card mb-3 v">
          <canvas id="myAreaChart" width="0%" height="0"></canvas>
      </div>

            <!-- infos importantes-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bell-o"></i> Données importantes Lol</div>
            <div class="list-group list-group-flush small">
              <a class="list-group-item list-group-item-action" href="#">
                <div class="espace">
                  <div class="media-body">
                   <span class="esp"> <strong>Tables disponibles : </strong></span>
                    <div class="text-muted smaller"><?php echo $tD2 ?></div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="espace">
                  <div class="media-body">
                   <span class="esp"> <strong> Nombre de jeux :</strong></span>
                    <div class="text-muted smaller"><?php echo $nbJ ?></div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="espace">
                  <div class="media-body">
                    <span class="esp"><strong>Tables réservées :</strong></span>
                    <div class="text-muted smaller"><?php echo $tr ?></div>
                  </div>
                </div>
              </a>
              <a class="list-group-item list-group-item-action" href="#">
                <div class="espace">
                  <div class="media-body">
                    <span class="esp"><strong>Nombre d'éditeurs :</strong></span>
                    <div class="text-muted smaller"><?php echo $nbE ?></div>
                  </div>
                </div>
              </a>
            </div>
        </div>

            <!-- paiement a venir-->
          <div class="mb-0 mt-4">
          <hr class="mt-2">
          <div class="card-columns">
        
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bell-o"></i> Paiement à venir</div>



 <?php 
            foreach ($p as $s) {

              $pV = htmlspecialchars($s->getprixPlaceNego()); //cherche prix de la facture 
              $numJeux=htmlspecialchars($s->getNumJeux($s->getNumResa())); //cherche le numero de jeux a partir reservation
              $nume=htmlspecialchars($s->getEditeur($numJeux)); //cherche num editeur avec num jeux
              $Ed=htmlspecialchars($s->getNomEdit($nume)); // cherche nom editeur avec num editeur 
              
              

         
          
               echo <<< EOF
               <div class="list-group list-group-flush small">
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <div class="media-body">
                    <strong>{$Ed}</strong>
                    <div class="text-muted smaller">Somme : {$pV}</div>
                  </div>
                </div>
              </a>
            

                
EOF;
}
echo '<div>';?>
      </div>
      </div>
      </div>
    </div>

            <!-- Example Social Card-->
            <div class="card mb-3 f"> 
            </div>
            <!-- jeux a recevoir-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bell-o"></i> Jeux à recevoir</div>
            

            <?php 
            foreach ($c as $s) {

              $jR1 = htmlspecialchars($s->getJeuxARecevoir($s->getnumJeu())); //cherche nom du jeu
              $eR0 = htmlspecialchars($s->getJeuxRecuEd($s->getnumJeu())); // cherche num editeur
              $eR1=htmlspecialchars($s->getEditJeux($eR0)); //cherche nom editeur
    
            
            
         
          
               echo <<< EOF
               <div class="list-group list-group-flush small">
              <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <div class="media-body">
                    <strong>{$eR1}</strong> 
                    <div class="text-muted smaller">Jeu : {$jR1}</div>
                  </div>
                </div>
              </a>
            

                
EOF;
}
echo '<div>';?>         
           
      </div>
    </div>
  </div>
</div>