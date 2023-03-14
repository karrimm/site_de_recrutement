<?php


if(isset($_POST['person']) AND isset($_POST['Email']) AND isset($_POST['Password'])) {
    if(!empty($_POST['person']) AND !empty($_POST['Email']) AND !empty($_POST['Password'])){
        
        $type=$_POST['person'];
        $email=htmlspecialchars($_POST['Email']);
        $password=htmlspecialchars($_POST['Password']);

        $servername = "localhost";
        $DB="rec_website";
        $username = "root";
        $pass = "";

        $dsn = "mysql:host=$servername;dbname=$DB";

        try {
              $conn = new PDO($dsn, $username, $pass);
              // set the PDO error mode to exception
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {
              echo "Connection failed: " . $e->getMessage();

            }

        //requete pour selectionner l'utilisateur
        if($type=="candidat"){
            $sql="select * from candidats where email=:email and password=:password ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $num_rows = count($results);

            if($num_rows > 0){
                header("Location:bienvenue.php");
            }else{
                echo "Adresse Mail ou Password incorrects!";
            }
        }else{
            $sql="select * from recruteurs where email=:email and password=:password ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $num_rows = count($results);

            if($num_rows){
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




?>