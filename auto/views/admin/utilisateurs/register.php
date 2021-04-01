<?php ob_start();?>

 <div class="container">
     <div class="row">
         <div class="col-8 offset-2">
         <h1 class="display-6 text-center font-monospace text-decoration-underline">Ajout d'un utilisateur</h1>
             <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col">
                        <label for="nom">Nom*</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Le nom" >
                    </div>
                    <div class="col">
                        <label for="modele">Prénom*</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Le prénom" >
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col">
                        <label for="login">Login*</label>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Le login" >
                    </div>
                    <div class="col">
                        <label for="quantite">Mot de passe*</label>
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Le mot de passe" >
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email">Email*</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="L'email" >
                    </div>
                    <div class="col">
                        <label for="cat">Grade</label>
                        <select id="grade" name="grade" class="form-select">
                        <!-- <option value="">Choisir</option> -->
                        <?php foreach ($allGrades as $grade) {; ?>
                            <option value="<?=$grade->getId_g();?>"><?=$grade->getNom_g();?></option>
                        <?php }; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary  col-12 mt-2" name="soumis">Soumettre</button>
            </form>
         </div>
     </div>
 </div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>