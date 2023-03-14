<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$domaine = "";
$profil = "";

$result = array();

if(isset($_POST['search'])){

    require 'connectDB.php';

    $domaine=$_POST['domaine'];
    $profil =$_POST['profil'];


    if($domaine=="All" && $profil=="All") {

        $sql = "select id, nom, prenom, Domaine, Profil, Score from candidats order by Score DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } elseif($domaine=="All") {

        $sql = "select id, nom, prenom, Domaine, Profil, Score from candidats where Profil = :Profil order by Score DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Profil', $profil);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } elseif($profil=="All") {

        $sql = "select id, nom, prenom, Domaine, Profil, Score from candidats where Domaine = :Domaine order by Score DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Domaine', $domaine);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } else {

        $sql = "select id, nom, prenom, Domaine, Profil, Score from candidats where Domaine = :Domaine and Profil = :Profil order by Score DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Domaine', $domaine);
    $stmt->bindParam(':Profil', $profil);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    

}


?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruteur | Webpage</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header>
      <h1>Recruteur</h1>
      <nav>
        <ul>
          <li><a href="#dashboard">Acceuil</a></li>
          <li><a href="#publier">Publier</a></li>
          <li><a href="#annonces">Mes Annonces</a></li>
          <li><a href="#recrut-profil">Profile</a></li>
          <li><a href="#sign-out">Sign out</a></li>
        </ul>
      </nav>
    </header>
    <main>
        <section id="dashboard">
            <h2>Cherchez vos futures employés</h2>
            <div style="border-top: 1px solid black; padding: 12px 0;"></div>
        <form method="POST">
            <div class="filters">
              <label style="font-size: 27px;" class="lab" for="domaine">Domaine :</label>
              <select style="background-color: lightblue;" name="domaine" id="domaine">
                <option value="All">All</option>
                <option value="Software Engineer" <?php if($domaine == "Software Engineer") echo "selected"; ?> >Software Engineer</option>
                <option value="Data Scientist" <?php if($domaine == "Data Scientist") echo "selected"; ?> >Data Scientist</option>
                <option value="Project Manager" <?php if($domaine == "Project Manager") echo "selected"; ?> >Project Manager</option>
                <option value="UX Designer" <?php if($domaine == "UX Designer") echo "selected"; ?> >UX Designer</option>
                <option value="Web Developer" <?php if($domaine == "Web Developer") echo "selected"; ?> >Web Developer</option>
              </select>
              <label style="margin-left: 19px; font-size: 27px;" for="profil">Profil :</label>
              <select style="background-color: lightblue;" name="profil" id="profil">
                <option value="All">All</option>
                <option value="Technicien" <?php if($profil == "Technicien") echo "selected"; ?> >Technicien</option>
                <option value="Injénieur" <?php if($profil == "Injénieur") echo "selected"; ?> >Injénieur</option>
              </select>
              <div class="input-field">
                <button style="border-radius: 12px; background-color: gold;" type="submit" name="search" class="search" >Search</button>
              </div>
            </div>

            <table>

              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Domaine</th>
                  <th>Profil</th>
                  <th>Score</th>
                </tr>
              </thead>

              <tbody>
                <?php 
                foreach ($result as $row){
                    echo "<tr>";
                    echo "<td>".$row['nom'];echo "</td>";
                    echo "<td>".$row['prenom'];echo "</td>";
                    echo "<td>".$row['Domaine'];echo "</td>";
                    echo "<td>".$row['Profil'];echo "</td>";
                    echo "<td>".$row['Score'];echo "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>

            </table>

        </form>
        
          </section>

      <section id="candidate-profile">
        <h2>Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
            Expedita ex aspernatur excepturi hic officiis libero.</h2>
        <!-- Insert candidate profile code here -->
      </section>
    </main>
    <footer>
      <p>Made by karim &copy; 2023 Recruiter Webpage</p>
    </footer>
  </body>
</html>
