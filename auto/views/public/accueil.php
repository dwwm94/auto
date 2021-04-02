<?php ob_start(); ?>

<div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./assets/images/mercedes.jpg" class="d-block w-100 " style="height:400px" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./assets/images/lamborghini.jpg" class="d-block w-100" style="height:400px" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./assets/images/mercedes.jpg" class="d-block w-100" style="height:400px" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
          </div>
          <!---end carrousel-->
          <div class="row my-3">
              <div class="col-8">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach($cars as $car){ ?>
                    <div class="col">
                      <div class="card">
                        <img src="./assets/images/<?=$car->getImage();?>" class="card-img-top" height="300" alt="...">
                        <div class="card-body">
                          <h5 class="bg-secondary text-center text-white card-title"> <?=strtoupper($car->getCategorie()->getNom_cat());?>:  <?=$car->getMarque();?></h5>
                          <p class="card-text"><?=$car->getDescription();?></p>
                          <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                             Modèle:
                              <span class="badge text-primary rounded-pill"><?=$car->getModele();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                            Année:
                              <span class="badge text-primary rounded-pill"><?=$car->getAnnee();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                             Prix:
                              <span class="badge bg-primary rounded-pill"><?=$car->getPrix();?> €</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Quantité:
                              <span class="badge bg-primary rounded-pill"><?=$car->getQuantite();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              
                              <form action="index.php?action=checkout" method="post">
                                <input type="hidden" name="marque"  value="<?=$car->getMarque();?>">
                                <input type="hidden" name="modele" value="<?=$car->getModele();?>">
                                <input type="hidden" name="image" value="<?=$car->getImage();?>">
                                <input type="hidden" name="prix" value="<?=$car->getPrix();?>">
                                <?php if($car->getQuantite() > 0){ ?>
                                  <button type="submit" class="btn btn-success" name="envoi">Acheter</button>
                                <?php } ?>
                              </form>
                              <strong class="badge rounded-pill">
                                <?php if($car->getQuantite() == 0){ ?>
                                <a href="index.php?action=order&id=<?=$car->getId_v();?>" class="btn btn-warning text-white">
                                   Commander
                                </a>
                                <?php } ?>
                              </strong>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
         
              </div>
            </div>
              <!--end cards-->
              <div class="col-4">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="input-group">
                        <input class="form-control text-center" type="search" name="search" id="search" placeholder="Rechecher...">
                        <button type="submit" class="btn btn-outline-secondary" name="soumis"><i class="fas fa-search"></i></button>
                     </form>
                <div class="card mt-1">
                    <ul class="list-group list-group-flush">
                      <?php foreach($tabCat as $cat ){ ?>
                      <li class="list-group-item text-center">
                        <a class="btn text-center" href="index.php?id=<?=$cat->getId_cat();?>"><?=ucfirst($cat->getNom_cat());?></a>
                      </li>
                     <?php } ?>
                    </ul>
                </div> 
              </div>
          
    </div>
 
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>