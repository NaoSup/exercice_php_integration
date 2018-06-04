<?php
include("includes/init.php");
ini_set('display_errors', 1);

// Récupérer une crèche
function getCreche($name){
  include("includes/init.php");
  $request = $db->prepare("SELECT * FROM Creche WHERE name=:name");
  $request->execute([
    ':name' => $name
  ]);
  $result = $request->fetchAll();
  return ($result);
}

// Si le fichier xml existe
if(file_exists("flux.xml")) 
{
  $file = simplexml_load_file("flux.xml");

  foreach($file as $obj)
  {
    // On vérifie si la crèche est déjà enregistrée
    $result = getCreche($obj->Nom);
    if(count($result) > 0)
    {
        echo "Cette crèche est déjà enregistrée. <br>";
    } 
    else 
    {
      // Ajout des données dans la table Creche
      $request_creche = $db->prepare("INSERT INTO Creche (name, description, email, image) VALUES (:name, :description, :email, :image)");
      $request_creche->execute([
        ':name' => $obj->Nom,
        ':description' => $obj->Description,
        ':email' => $obj->Email,
        ':image' => $obj->image
      ]);
      echo "<br> Crèche ajoutée.";

      //On récupère l'id de la creche qui vient d'etre créée
      $result = getCreche($obj->Nom);
      $id = $result[0]["id_creche"];
      
      // Ajout des horaires dans la table Hours
      $request_hours = $db->prepare("INSERT INTO Hours (sunday, monday, tuesday, wednesday, thursday, friday, saturday, id_creche) VALUES (:sunday, :monday, :tuesday, :wednesday, :thursday, :friday, :saturday, :id_creche)");
      $request_hours->execute([
        ':sunday' => $obj->Horaires->dimanche,
        ':monday' => $obj->Horaires->lundi,
        ':tuesday' => $obj->Horaires->mardi,
        ':wednesday' => $obj->Horaires->mercredi,
        ':thursday' => $obj->Horaires->jeudi,
        ':friday' => $obj->Horaires->vendredi,
        ':saturday' => $obj->Horaires->saturday, 
        ':id_creche' => $id
      ]);

      // Ajout des adresses dans la table Address
      $request_address = $db->prepare("INSERT INTO Address (street, zip, city, country, id_creche) VALUES (:street, :zip, :city, :country, :id_creche)");
      $request_address->execute([
        ':street'=> $obj->Address->Street,
        ':zip'=> $obj->Address->Zip,
        ':city'=> $obj->Address->City,
        ':country'=> $obj->Address->Country,
        'id_creche'=> $id
      ]);
    }
  }
} 
else 
{
  echo "Fichier introuvable";
}

