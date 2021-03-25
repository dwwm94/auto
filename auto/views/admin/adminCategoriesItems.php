categories ...
<?php ob_start(); ?>
  <table class="table table-striped">
      <thead>
          <tr>
              <th>Id</th>
              <th>Nom</th>
              <th colspan="2" class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($allCat as  $cat) { ?>
          <tr>
              <td><?=$cat->getId_cat();?></td>
              <td><?=$cat->getNom_cat();?></td>
              <td class="text-center"><a class="btn btn-success" href=""><i class="fas fa-pen"></i></a></td>
              <td  class="text-center"><a class="btn btn-danger" href=""><i class="fas fa-trash"></a></td>
          </tr>
          <?php } ?>
      </tbody>
  </table>
  


<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
