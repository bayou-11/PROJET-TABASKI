<?php 
require('database.php'); // on appelle la basse de données

if(isset($_POST['valider'])){ //on verifie si validate existe
    // apres on verifie si les champs ne sont pas vide avant de recupere les donnees saisi par l utilisateur
    if (!empty($_POST['DateCotis']) AND !empty($_POST['Mois']) AND !empty($_POST['Motif']) AND !empty($_POST['Montant']) AND !empty($_POST['Matricule']));
    
        $user_date = htmlspecialchars($_POST['DateCotis']);
        $user_mois = htmlspecialchars($_POST['Mois']);
        $user_motif = htmlspecialchars($_POST['Motif']);
        $user_montant = htmlspecialchars($_POST['Montant']);
        $user_matricule = htmlspecialchars($_POST['Matricule']);

       
            $insertUserOnwebsite = $bdd->prepare('INSERT INTO cotisation( DateCotis, Mois, Motif, Montant, Matricule) VALUES (?, ?, ?, ?, ?) ');
            $insertUserOnwebsite->execute(array($user_date, $user_mois, $user_motif, $user_montant, $user_matricule));
            $errorMsg = " Cotisation validé";
            
             // recuperer les informations de l utilisateur
             $getInfosOfThisUserReq = $bdd->prepare('SELECT DateCotis, Mois, Motif, Montant, Matricule FROM cotisation WHERE DateCotis =? AND Mois = ? AND Motif = ? AND Montant = ?, Matricule = ?');
             $getInfosOfThisUserReq->execute(array($user_date, $user_mois,$user_motif,$user_montant,$user_matricule));
 
             // on enregistre les info sous format de tableau
             $usersInfos =  $getInfosOfThisUserReq->fetch();
        }else{
            $errorMsg = " Cotisation  NON validé";
        }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>SAISIE COTISATION | Espace Membre</title>
</head>
<body style="">

<div class="container-fluid">

<section id="cover" class="min-vh-100">
<?php include_once 'haut.php'; ?>
    <div id="cover-caption">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h1 class="display-4 py-2 text">Espace cotisation</h1>
                    <div class="px-2 text">
                    <?php 
                        if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; } 
                     ?>
                        <form action="" method="POST" class="justify-content-center">
                        
                            <div class="form-group text">
                                <label class="fw-4">Date de Cotisation</label>
                                <input type="date" class="form-control" name="DateCotis">
                            </div>
                            <div class="form-group text">
                                <label >Mois</label>
                                <select class="form-control" name="Mois">
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
                                    <option value="Octobre">Octobre</option>
                                    <option value="Novembre">Novembre</option>
                                    <option value="Decembre">Decembre</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Motif</label>
                                <select class="form-control" name="Motif">
                                    <option selected>Selectionnez le motif</option>
                                    <option value="Inscription">Inscription</option>
                                    <option value="Mensualité">Mensualité</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Montant</label>
                                <input type="number" class="form-control" name="Montant">
                            </div>
                            <div class="form-group">
                                <label >Matricule</label>
                                <input type="number" class="form-control" name="Matricule">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg" name="valider">Enregistrer</button>
                            <button type="submit" class="btn btn-danger btn-lg" name="annuler">annuler</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>