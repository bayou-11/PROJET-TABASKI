<?php 

require('database.php'); // on appelle la basse de données

// $trouve = $bdd->query('SELECT * FROM cotisation ORDER BY Mois ASC');
 if(isset($_GET['recherche']) AND !empty($_GET['recherche'])){
     $recherche = htmlspecialchars($_GET['recherche']);
     $trouve = $bdd->query('SELECT * FROM cotisation WHERE Mois LIKE "%'.$recherche.'%" ORDER BY DateCotis ASC');
 }


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
<body>
<main class="container-fluid">
<?php include_once 'haut.php'; ?>

        <div class="row">
            <section class="col-12">
                <form action="" method="GET">
                 
                    <div class="form-group">
                                <label > Selectionnez un Mois</label>
                                <select class="form-control" name="recherche">
                                    <option selected>Selectionnez le mois de la Cotisation</option>
                                    <option value="Janvier">Janvier</option>
                                    <option value="Fevrier">Fevrier</option>
                                    <option value="Mars">Mars</option>
                                    <option value="Avril">Avril</option>
                                    <option value="Mai">Mai</option>
                                    <option value="Juin">Juin</option>
                                    <option value="Juillet">Juillet</option>
                                    <option value="Aout">Aout</option>
                                    <option value="Septembre">Septembre</option>
                                    <option value="Octombre">Octobre</option>
                                    <option value="Novembre">Novembre</option>
                                    <option value="Decembre">Decembre</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg" name="valider">Valider</button>

                </form>
            </section>
            <div class="section">
                <?php 
                    if(@$trouve->rowCount() > 0){
                        while($cotis = $trouve->fetch()){
                            ?>  
                             <table class="table table-bordered border-primary">
                    <thead>
                        
                        <th>Date à cotiser</th>
                        <th>Mois</th>
                        <th>Motif</th>
                        <th>Montant</th>
                        <th>Matricule</th>
                    </thead>
                    <tbody>

                        <tr>
                            
                            <td><?= $cotis['DateCotis'] ?></td>
                            <td><?= $cotis['Mois'] ?></td>
                            <td><?= $cotis['Motif'] ?></td>
                            <td><?= $cotis['Montant'] ?></td>
                            <td><?= $cotis['Matricule'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>

                    </tbody>
                </table>
                            <?php 
                        }
                    else{
                        ?>
                        <p>Aucun Cotisations trouvé</p>
                         <?php 
                    }
                ?>
            </div>
        </div>
        </main>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>