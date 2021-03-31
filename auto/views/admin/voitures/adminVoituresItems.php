
<?php ob_start(); ?>
<h1 class="display-6 text-center font-monospace text-decoration-underline">Liste Voitures</h1>
 <div class="row">
     <div class="col-4 offset-8">
     <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="input-group">
        <input class="form-control text-center" type="search" name="search" id="search" placeholder="Rechecher...">
        <button type="submit" class="btn btn-outline-secondary" name="soumis"><i class="fas fa-search"></i></button>
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
          <?php if(is_array($cars)){ foreach ($cars as  $car) { ?>
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
                <a class="btn btn-warning" href="index.php?action=edit_v&id=<?=$car->getId_v();?>">
                    <i class="fas fa-pen"></i>
                </a>
              </td>
              <?php if($_SESSION['Auth']->id_g != 3 ){ ?>
              <td  class="text-center">
                <a class="btn btn-danger" href="index.php?action=delete_v&id=<?=$car->getId_v();?>"
                    onclick="return confirm('Etes vous sûr de ...')">
                    <i class="fas fa-trash"></i>
                </a>
              </td>
              <?php } ?>
          </tr>
          <?php }}else{ echo"<tr class='text-center text-danger'><td colspan='10' >".$cars."</td></tr>";} ?>
      </tbody>
  </table>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
