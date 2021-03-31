
<?php ob_start(); ?>
  
  
<div class="container">
     <div class="row">
         <div class="col-6 offset-3">
            <h1 class="display-6 text-center font-monospace text-decoration-underline">Formulaire de connexion</h1>
            <?php if(isset($error)){ ?>
            <div class="alert alert-danger text-center"><?=$error;?></div>
            <?php } ?>
             <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                
                 <label for="loginEmail">Login ou Email*</label>
                 <input type="text" id="loginEmail" name="loginEmail" class="form-control" placeholder="Entrez votre login ou votre email...">

                 <label for="pass">Mot de passe*</label>
                 <input type="password" id="pass" name="pass" class="form-control" placeholder="Entrez votre mot de passe...">
                <button type="submit" class="btn btn-primary  col-12 mt-2" name="soumis">Se connecter</button>
                </form>
         </div>
     </div>
 </div>

<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>
