<?php ob_start();?>

<div class="container">
<h2>Commande</h2>
<form action="" method="post">
  <input type="hidden" value="<?=$id;?>">

</form>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>