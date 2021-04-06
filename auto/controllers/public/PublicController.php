<?php
session_start();
require './vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
            $nb = htmlspecialchars(addslashes($_POST['quantite']));

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
                'images' => ["./assets/images/clio2.jpg"],
            ],
            ],
            'quantity' => $_POST['quantite'],
        ]],
        'customer_email'=> $_POST['email'],
        'mode' => 'payment',
        'success_url' => 'http://localhost:81/php/poo/apps/auto/index.php?action=success',
        'cancel_url' => 'http://localhost:81/php/poo/apps/auto/index.php?action=cancel',
        ]);
        $_SESSION['pay'] = $_POST;
        echo json_encode(['id' => $checkout_session->id]);
       }
    }

    public function confirmation() {
        $newStock = ((int)$_SESSION['pay']['nb']) - ((int)$_SESSION['pay']['quantite']);
        $car = new Voiture();
        $car->setId_v($_SESSION['pay']['id']);
        $car->setQuantite($newStock);

        $nbLine = $this->pubm->updateStock($car);
        if($nbLine > 0 ){
           
            //Load Composer's autoloader
            $email = $_SESSION['pay']['email'];
            $marque= $_SESSION['pay']['marque'];
            $modele= $_SESSION['pay']['modele'];
            $prix= $_SESSION['pay']['prix'];
            

            //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'dwwm94@gmail.com';                     //SMTP username
                $mail->Password   = 'mziyzxforjcwijpo';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('dwwm94@gmail.com', 'BUYCAR');
                $mail->addAddress("$email", 'Mr/Mme');     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = "
                    <h2>Confirmation d'achat</h2>
                    <div>
                     <b>Marque:  </b>".$marque." 
                     <b>Modéle:  </b>".$modele." 
                     <b>Prix:  </b>".$prix." 
                     <p>Nous vous remercions pour votre achat.</p>
                    </div>
                ";
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        require_once('./views/public/success.php');
    }

    public function annuler() {
       require_once('./views/public/cancel.php');
    }


}