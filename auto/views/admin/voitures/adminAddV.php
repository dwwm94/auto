<?php ob_start();?>

 <div class="container">
     <div class="row">
         <div class="col-8 offset-2">
         <h1 class="display-6 text-center font-monospace text-decoration-underline">Ajout d'une voiture</h1>
             <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col">
                        <label for="marque">Marque</label>
                        <input type="text" id="marque" name="marque" class="form-control" placeholder="La marque" >
                    </div>
                    <div class="col">
                        <label for="modele">Modèle</label>
                        <input type="text" id="modele" name="modele" class="form-control" placeholder="Le modèle" >
                    </div>
                    <div class="col">
                        <label for="cat">Catégorie</label>
                        <select id="cat" name="cat" class="form-select">
                        <option value="">Choisir</option>
                        <?php foreach ($tabCat as $cat) {; ?>
                            <option value="<?=$cat->getId_cat();?>"><?=$cat->getNom_cat();?></option>
                        <?php }; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="form-control" placeholder="Le prix" >
                    </div>
                    <div class="col">
                        <label for="quantite">Quantité</label>
                        <input type="number" id="quantite" name="quantite" class="form-control" placeholder="La quantité" >
                    </div>
                    <div class="col">
                        <label for="annee">Année</label>
                        <input type="date" id="annee" name="annee" class="form-control" placeholder="L'année'" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control"  >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="desc">Description</label>
                        <textarea id="desc" name="desc" class="form-control" placeholder="La description" rows="5"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary  col-12 mt-2" name="soumis">Insérer</button>
            </form>
         </div>
     </div>
 </div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>