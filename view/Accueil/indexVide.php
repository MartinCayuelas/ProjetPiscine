<div class="card mb-3 v">
          <canvas id="myAreaChart" width="0%" height="0"></canvas>
      </div>

          <!-- infos importantes-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bell-o"></i> Données importantesl</div>
            <div class="list-group list-group-flush small">
              <a class="list-group-item list-group-item-action" href="#">
                <div class="espace">
                  <div class="media-body">
                   <span class="esp"> <strong>Tables disponibles : </strong></span>
                    <div class="text-muted smaller"><?php 

                    $totalnb=0;
                    foreach ($tr as $r) {
                      $nb=$r->getNbPlace();
                      $totalnb=$totalnb+$nb;
                    }
                    echo $tD1-$totalnb

                     ?></div>
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
                    <div class="text-muted smaller"><?php 
                    $totalnb=0;
                    foreach ($tr as $r) {
                      $nb=$r->getNbPlace();
                      $totalnb=$totalnb+$nb;
                    }
                    echo $totalnb

                     ?></div>
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
                
           
      </div>
    </div>
  </div>
</div>