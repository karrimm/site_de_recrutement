<?php


if(isset($_POST['person']) AND isset($_POST['Email']) AND isset($_POST['Password'])) {
    if(!empty($_POST['person']) AND !empty($_POST['Email']) AND !empty($_POST['Password'])){
        
        $type=$_POST['person'];
        $email=htmlspecialchars($_POST['Email']);
        $password=htmlspecialchars($_POST['Password']);

        //connexion à la base de données
        $conn=mysqli_connect("localhost", "root", "", "rec_website") or die(mysqli_error());

        //requete pour selectionner l'utilisateur
        if($type=="candidat"){
            $req="select * from candidats where email='$email' and password='$password' ";
            $res=mysqli_query($conn, $req);
            $num_lines=mysqli_num_rows($res);
            if($num_lines > 0){
                header("Location:bienvenue.php");
            }else{
                echo "Adresse Mail ou Password incorrects!";
            }
        }else{
            $req="select email, password from recruteurs where email='$email' and password='$password' ";
            $res=mysqli_query($conn, $req);
            $num_lines=mysqli_num_rows($res);
            if($num_lines > 0){
                header("Location:bienvenue.php");
            }else{
                echo "Adresse Mail ou Password incorrects!";
            }
        }

    }
}

else{
    echo "veuillez remplir tous les champs !";
}


// if( isset($_POST['person']) AND isset($_POST['Firstname']) AND isset($_POST['Lastname']) AND isset($_POST['Email']) AND isset($_POST['Password'])) {
//     if(!empty($_POST['person']) AND !empty($_POST['Firstname']) AND !empty($_POST['Lastname']) AND !empty($_POST['Email']) AND !empty($_POST['Password'])) {

//         $type=$_POST['person'];
//         $nom=htmlspecialchars($_POST['Lastname']);
//         $prenom=htmlspecialchars($_POST['Firstname']);
//         $email=htmlspecialchars($_POST['Email']);
//         $password=htmlspecialchars($_POST['Password']);

//         if($type=="candidat"){

//             $conn=mysqli_connect('localhost', 'root', '', 'rec_website') or die(mysqli_error());
//             $req="insert into candidats (prenom, nom, email, password) values ('$prenom', '$nom', '$email','$password') ";
//             $res=mysqli_query($conn, $req);
//             echo "le candidat <mark><b>$prenom $nom</b></mark>, a été ajoutée avec succés !";

//         }
//         else{
//             $conn=mysqli_connect('localhost', 'root', '', 'rec_website') or die(mysqli_error());
//             $req="insert into recruteurs (prenom, nom, email, password) values ('$prenom', '$nom', '$email','$password') ";
//             $res=mysqli_query($conn, $req);
//             echo "le recruteur <mark><b>$prenom $nom</b></mark>, a été ajoutée avec succés !";
//         }

//     }
// }

?>