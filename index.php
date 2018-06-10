<?php
include("includes/init.php");
require("getXML.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Subskill Exercice</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <link rel="stylesheet" href="css/main.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <div class="row" id="header">
    <div class="col-md-2" id="logo">
      <img src="images/logo.png" alt="logo">
    </div>
    <div class="col-md-10">
      <div class="row" id="bar1">
        <div class="col-md-4 highlighted centeredVert">
          <p class="">Un réseau de <span>1300</span> crèches</p>
        </div>
        <div class="col-md-6 centeredVert" id="number">
          <img src="images/phone.png" alt="phone" width="20vw" height="auto">
          <p>01 85 53 06 93</p>
        </div>
        <div class="col-md-1 centeredVert" id="email">
          <img src="images/enveloppe.png" alt="enveloppe" width="30vw" height="auto">
        </div>
        <div class="col-md-1 centeredVert" id="profil">
          <img src="images/user.png" alt="user" width="20vw" height="auto">
        </div>
      </div>
      <div class="row" id="bar2">
        <div class="col-md-3 highlighted centeredVert caps" id="parent">
          <p>Je suis un parent</p>
          <img src="images/plus.png" alt="plus" width="25vw" height="auto">
        </div>
        <div class="col-md-9 centeredVert caps" id="nav">
          <ul>
            <li> 
              <a href="">Connaître la maison bleue</a> 
            </li>
            <li>|</li>
            <li> 
              <a href="">Découvrir nos actualités</a> 
            </li>
            <li>|</li>
            <li> 
              <a href="">Besoin d'aide</a> 
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row" id="main">
    <div class="col-md-8 col-md-offset-2">
      <h1>12 crèches trouvées à proximité de <br> « 23 rue Henri Chevreau, Boulogne »</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5 col-md-offset-1">
      <div class="row">
        <?php
          $request = $db->query("SELECT * FROM Creche");
          $creches = $request->fetchAll();
          foreach($creches as $creche){
            $id_creche = $creche['id_creche'];
            $request = $db->query("SELECT * FROM Address WHERE id_creche = $id_creche");
            $result = $request->fetch();
            if(!empty($result)) {
              $address = $result['street'] . ", " . $result['zip'] . " " . $result['city'];
            }
            $request = $db->query("SELECT * FROM Hours WHERE id_creche = $id_creche");
            $result = $request->fetch();
            if(!empty($result)) {
              $hours = "Du lundi au vendredi de " . $result['monday'] . ".";
            }
          ?>
          <div class="col-md-5 card">
            <div class=" col-md-12 card-image" style="background-image: url(./images/<?php echo $creche['image']?>)"></div>
            <div id="check"></div>
            <div class="col-md-12 card-desc">
              <p id="multiaccueil">Multi-Accueil</p>
              <p id="address"><?php echo $address ?></p>
              <p id="name"><?php echo $creche['name'] ?></p>
              <p id="hours"><?php echo $hours ?></p>
            </div>
          </div>
          <?php
        }
      ?>
      </div>
    <div class="col-md-5"></div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <img src="images/footer_img.png" alt="">
    </div>
  </div>
  <div class="row" id="contact">
    <div class="col-md-3 col-md-offset-2" id="horaires">
      <p>
        <img src="images/phone.png" alt="phone" width="20vw" height="auto">
        01 85 53 06 93 
        <br>
        <span>Du lundi au vendredi de 8h à 20h et le samedi de 9h à 15h</span>
      </p>
    </div>
    <div class="col-md-2" id="email2">
      <p>
        <img src="images/enveloppe2.png" alt="enveloppe">
        Je préfère les mails
      </p>
    </div>
    <div class="col-md-3" id="reseaux">
      <p>Retrouvez-nous aussi sur</p>
      <a href="">
        <img src="images/twitter.png" alt="">
      </a>
      <a href="">
        <img src="images/facebook.png" alt="">
      </a>
      <a href="">
        <img src="images/youtube.png" alt="">
      </a>
      <a href="">
        <img src="images/instagram.png" alt="">
      </a>
      <a href="">
        <img src="images/linkedin.png" alt="">
      </a>
    </div>
  </div>
  <div class="row" id="links">
    <div class="col-md-1 col-md-offset-2" id="copyright">
      <img src="images/logo.png" alt="logo">
      <p>
        © Copyright 2018
        <br>
        Tous droits réservés
      </p>
    </div>
    <div class="col-md-2 lists">
      <ul>
        <li class="caps">Je suis</li>
        <li><a href="">Parent</a></li>
        <li><a href="">Employeur</a></li>
        <li><a href="">Collectivité</a></li>
        <li><a href="">Gestionnaire de crèche</a></li>
        <li><a href="">Candidat</a></li>
      </ul>
    </div>
    <div class="col-md-2 lists">
      <ul>
        <li class="caps">Nous connaître</li>
        <li><a href="">Notre projet éducatif</a></li>
        <li><a href="">Activités innovantes</a></li>
        <li><a href="">Notre politique RSE</a></li>
        <li><a href="">Nos aménagements</a></li>
        <li><a href="">Notre histoire</a></li>
        <li><a href="">Ils parlent de nous</a></li>
        <li><a href="">Toutes nos crèches</a></li>
      </ul>
    </div>
    <div class="col-md-3 lists caps">
      <ul>
        <li><a href="">Découvrir nos actualités</a></li>
        <li><a href="">Aide et FAQ</a></li>
        <li><a href="">Témoignages</a></li>
        <li><a href="">Offres d'emploi</a></li>
        <li><a href="">Plan du site</a></li>
        <li><a href="">Mentions légales</a></li>
      </ul>
    </div>
  </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script>
    $("body").click((e) => {
      var target = $(e.target);
      if(target.is("#check")){
        target.toggleClass("check-selected");
        target.next(".card-desc").toggleClass("card-desc-selected");
      }
      
    });
  </script>
</body>
</html>