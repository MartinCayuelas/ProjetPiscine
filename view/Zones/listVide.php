<?php

echo <<< EOF
 <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Liste des Zones</div>
EOF;
if (isset($_SESSION['login']) && Session::is_admin()) {
    echo <<<EOF
            <a class="ajout" href="index.php?action=createZone"><i class="fa fa-plus-circle" aria-hidden="true"></i>Zone</a>
             
EOF;
}

echo "</div>";
echo "</div>";


