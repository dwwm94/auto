<?php ob_start();?>

<div class="container">
<h2>Echec au cours de paiement</h2>
<p>Vérifiez votre coordonnées bancaires, Shop around then come back to pay!</p>
</div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/public/templatePublic.php');
?>