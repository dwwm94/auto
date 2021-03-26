<?php ob_start();?>

 <div class="container">
     <div class="row">
         <div class="col-6 offset-3">
             <form action="index.php?action=edit_cat&id=<?=$cat->getId_cat();?>" method="post">
                <label for="">Identifiant</label>
                 <input type="text" class="form-control"  value="<?=$cat->getId_cat();?>" readonly>
                 <label for="categorie">Catégorie</label>
                 <input type="text" id="categorie" name="categorie" class="form-control" value="<?=$cat->getNom_cat();?>">
                <button type="submit" class="btn btn-primary  col-12 mt-2" name="soumis">Insérer</button>
                </form>
         </div>
     </div>
 </div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>