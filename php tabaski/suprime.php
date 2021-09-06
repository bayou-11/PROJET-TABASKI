<?php 

require('database.php'); // on appelle la basse de données

$sql = 'SELECT * FROM `cotisation`';
// on prepare la requete 
$query = $bdd->prepare($sql);
// on execute
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
        <div class="row text">
            <section class=" col-12">
            <h1>Liste des Cotisations</h1>
                <table class="table table-bordered border-primary bg-dark text-white">
                    <thead>
                        <th>Id Cotisation</th>
                        <th>Date cotisation</th>
                        <th>Mois</th>
                        <th>Motif</th>
                        <th>Montant</th>
                        <th>Matricule</th>
                        
                    </thead>
                    <tbody>
                    <?php 
                    // on boucle sur la variable result
                    foreach($result as $cotisation){
                    ?>
                        <tr>
                            <td><?= $cotisation['NumCotis'] ?></td>
                            <td><?= $cotisation['DateCotis'] ?></td>
                            <td><?= $cotisation['Mois'] ?></td>
                            <td><?= $cotisation['Motif'] ?></td>
                            <td><?= $cotisation['Montant'] ?></td>
                            <td><?= $cotisation['Matricule'] ?></td>
                            <td>
                            <button class="btn btn-danger btn-lg mt-3 text-center"><a style="text-decoration:none;" class="text-white" href="SupprimerCotisation2.php?NumCotis=<?= $cotisation['NumCotis'] ?>">supprimer</a></button>
                            <button class="btn btn-warning btn-lg mt-3 text-center"><a style="text-decoration:none;" class="text-white" href="ModifierPaiement.php?NumCotis=<?= $cotisation['NumCotis'] ?>">modifier</a></button>
                        </tr>
                    <?php
                    }
                    ?>

                    </tbody>
                </table>
            </section>
        </div>
        </main>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>