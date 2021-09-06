<?php 

require('database.php'); // on appelle la basse de données

$sql = 'SELECT * FROM `membre` ORDER BY Nom ASC';
// on prepare la requete 
$query = $bdd->prepare($sql);
// on execut
$query->execute();
// on stock le resultat dans un tableau
$result = $query->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Liste de la cotisation | Espace Membre</title>
</head>
<body style="">
<main class="container">
<?php include_once 'haut.php'; ?>
        <div class="row">
            <section class=" col-12">
            <h1>Liste des Membre</h1>
                <table class="table table-bordered border-primary bg-dark text-white">
                    <thead>
                        <th>ID Membre</th>  
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse</th>
                        <th>Téléphone</th>
                    </thead>
                    <tbody>
                    <?php 
                    // on boucle sur la variable result
                    foreach($result as $cotisation){
                    ?>
                        <tr>
                            <td><?= $cotisation['Matricule'] ?></td>
                            <td><?= $cotisation['Nom'] ?></td>
                            <td><?= $cotisation['Prenom'] ?></td>
                            <td><?= $cotisation['Adresse'] ?></td>
                            <td><?= $cotisation['Tel'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>

                    </tbody>
                </table>
            </section>
        </div>
        <button class="btn btn-primary btn-lg mt-3 text-center"><a href="SaisieMembre.php" class="text-white text-center" style="text-decoration:none; " >Ajouter des Membres</a></button>
        </main>
        

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>