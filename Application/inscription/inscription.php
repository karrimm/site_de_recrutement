<?php

if(isset($_POST['valider'])) {
    if( isset($_POST['person']) AND isset($_POST['Firstname']) AND isset($_POST['Lastname']) AND isset($_POST['Email']) AND isset($_POST['Password'])) {
        if(!empty($_POST['person']) AND !empty($_POST['Firstname']) AND !empty($_POST['Lastname']) AND !empty($_POST['Email']) AND !empty($_POST['Password'])) {

            $type=$_POST['person'];
            $nom=htmlspecialchars($_POST['Lastname']);
            $prenom=htmlspecialchars($_POST['Firstname']);
            $email=htmlspecialchars($_POST['Email']);
            $password=htmlspecialchars($_POST['Password']);

            $conn=mysqli_connect('localhost', 'root', '', 'rec_website') or die(mysqli_error());

            if($type=="candidat"){

                $req="insert into candidats (prenom, nom, email, password) values ('$prenom', '$nom', '$email','$password') ";
                $res=mysqli_query($conn, $req);
                echo "le candidat <mark><b>$prenom $nom</b></mark>, a été ajoutée avec succés !";

            }
            else{

                $req="insert into recruteurs (prenom, nom, email, password) values ('$prenom', '$nom', '$email','$password') ";
                $res=mysqli_query($conn, $req);
                echo "le recruteur <mark><b>$prenom $nom</b></mark>, a été ajoutée avec succés !";
            }

        }
    }
}


?>