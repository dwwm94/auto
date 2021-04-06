<?php

require './vendor/autoload.php';

class PublicController{

    private $pubvm;
    private $pubcm;
    private $pubm;

    public function __construct()
    {
        $this->pubvm = new AdminVoitureModel();
        $this->pubcm = new AdminCategorieModel();
        $this->pubm = new PublicModel();

    }

    public function getPubVoitures(){
        
        if(isset($_GET['id']) && !empty($_GET['id'])){
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabCat = $this->pubcm->getCategories();
                $cars = $this->pubvm->getVoitures($search);
                require_once('./views/public/accueil.php');
            }
            $id = trim(htmlentities(addslashes($_GET['id'])));
            $v = new Voiture();
            $v->getCategorie()->setId_cat($id);
            $tabCat = $this->pubcm->getCategories();
            $voitures = $this->pubm->findCarsByCat($v);
            require_once('./views/public/voituresCat.php');
      
        }else{
            if( isset($_POST['soumis']) && !empty($_POST['search'])){
                $search = trim(htmlspecialchars(addslashes($_POST['search'])));
                $tabCat = $this->pubcm->getCategories();
                $cars = $this->pubvm->getVoitures($search);
                require_once('./views/public/accueil.php');
            }
            $tabCat = $this->pubcm->getCategories();
            $cars = $this->pubvm->getVoitures();

        require_once('./views/public/accueil.php');
        }
    }

    public function recap(){

        if(isset($_POST['envoi']) && !empty($_POST['marque']) && !empty($_POST['prix'])){
            $id = htmlspecialchars(addslashes($_POST['id']));
            $marque = htmlspecialchars(addslashes($_POST['marque']));
            $modele = htmlspecialchars(addslashes($_POST['modele']));
            $image = htmlspecialchars(addslashes($_POST['image']));
            $prix = htmlspecialchars(addslashes($_POST['prix']));

            require_once('./views/public/voitureItem.php');
        }
    }
    public function orderCar(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $id = addslashes(htmlspecialchars($_GET['id']));
            require_once('./views/public/orderForm.php');
        }
    }

    public function payment(){

       if(isset($_POST) && !empty($_POST['email']) && !empty($_POST['quantite'])){
        \Stripe\Stripe::setApiKey('sk_test_51IcbyxAHDrsAEQyVG9lzQe64inxnYbCojcNca06VosuEz5wbeikqSzf0gE99a1DOtgnzNknQ1lIWCzS7ilqrynyJ00epK6uNFM');

        header('Content-Type: application/json');

        $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
            'currency' => 'eur',
            'unit_amount' => $_POST['prix']*100,
            'product_data' => [
                'name' => $_POST['marque']."-".$_POST['modele'],
                'images' => ["https://i.imgur.com/EHyR2nP.png"],
            ],
            ],
            'quantity' => $_POST['quantite'],
        ]],
        'customer_email'=> $_POST['email'],
        'mode' => 'payment',
        'success_url' => 'http://localhost:81/php/poo/apps/auto/index.php?action=success',
        'cancel_url' => 'http://localhost:81/php/poo/apps/auto/index.php?action=cancel',
        ]);

        echo json_encode(['id' => $checkout_session->id]);
       }
    }

    public function confirmation() {
        echo'confirmer';
    }

    public function annuler() {
        echo'annuler';
    }


}