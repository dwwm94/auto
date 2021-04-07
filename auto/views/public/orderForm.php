<?php ob_start();?>

<div class="container">
  <div class="row">
    <div class="col-6 offset-3">
      <div class="card mt-2">
        <div class="card-header  text-center ">
          <h2>Commander</h2>
        </div>
        <div class="card-body">
          <form action="<?php $_SERVER['PHP_SELF']  ?>" method="post">
            <input type="hidden" value="<?=$id;?>">
            <label for="objet">Objet*</label>
            <input type="text" id="objet" required name="objet" class="form-control" placeholder="Votre objet ...">
            <label for="email">Email*</label>
            <input type="email" id="email" required name="email" class="form-control" placeholder="Votre email ...">
            <label for="message">Message*</label>
            <textarea  id="message" name="message" required class="form-control" placeholder="Votre message ..."></textarea>
           <button type="submit" name="submit" class="mt-2 btn btn-warning col-12"><i class="far fa-check-square"></i> Envoyer</button>
          </form>
        
      </div>
</div>
  </div>
</div>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>