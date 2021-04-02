<?php ob_start();?>

<div class="container">

<div class="card mb-3" >
  <div class="row g-0">
    <div class="col-md-4">
      <img src="./assets/images/<?=$image;?>" alt="..." >
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?=$marque;?>-<?=$modele;?></h5>
        <p class="card-text">Prix: <?=$prix;?> €</p>
      </div>
    </div>
  </div>
</div>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>