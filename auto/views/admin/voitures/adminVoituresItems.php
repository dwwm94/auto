
<?php ob_start(); ?>
<h1 class="display-6 text-center font-monospace text-decoration-underline">Liste Voitures</h1>
 <div class="row">
     <div class="col-4 offset-8">
     <form action="" method="post" class="input-group">
        <input class="form-control text-center" type="search" name="search" id="search" placeholder="Rechecher...">
        <button class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
     </form>
     </div>
 </div>
  <table class="table table-striped">
      <thead>
          <tr>
              <th>Id</th>
              <th>Marque</th>
              <th>Modele</th>
              <th>Prix</th>
              <th>Image</th>
              <th>Quantite</th>
              <th>Année</th>
              <th>Description</th>
              <th>Categorie</th>
              <th colspan="2" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          
          <tr>
          <?php foreach ($cars as  $car) { ?>
              <td><?=$car->getId_v();?></td>
              <td><?=$car->getMarque();?></td>
              <td><?=$car->getModele();?></td>
              <td><?=$car->getPrix();?></td>
              <td><img src="./assets/images/<?=$car->getImage();?>" alt="" width="100"></td>
              <td><?=$car->getQuantite();?></td>
              <td><?=$car->getAnnee();?></td>
              <td ><?=$car->getDescription();?></td>
              <td><?=$car->getCategorie()->getNom_cat();?></td>
              <td class="text-center">
                <a class="btn btn-success" href="#">
                    <i class="fas fa-pen"></i>
                </a>
              </td>
              <td  class="text-center">
                <a class="btn btn-danger" href="#"
                    onclick="return confirm('Etes vous sûr de ...')">
                    <i class="fas fa-trash"></i>
                </a>
              </td>
          </tr>
          <?php } ?>
      </tbody>
  </table>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
