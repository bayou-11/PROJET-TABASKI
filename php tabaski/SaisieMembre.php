<?php 
require('database.php'); // on appelle la basse de données

// validation du formulaire
if(isset($_POST['valider'])){ //on verifie si validate existe
    // apres on verifie si les champs ne sont pas vide avant de recupere les donnees saisi par l utilisateur
    if(!empty($_POST['Nom']) AND !empty($_POST['Prenom']) AND !empty($_POST['Adresse']) AND !empty($_POST['Tel']));
        $user_nom = htmlspecialchars($_POST['Nom']);
        $user_prenom = htmlspecialchars($_POST['Prenom']);
        $user_adresse = htmlspecialchars($_POST['Adresse']);
        $user_tel = htmlspecialchars($_POST['Tel']);

       
            $insertUserOnwebsite = $bdd->prepare('INSERT INTO membre(Nom, Prenom, Adresse, Tel) VALUES (?, ?, ?, ?) ');
            $insertUserOnwebsite->execute(array($user_nom, $user_prenom,$user_adresse,$user_tel));
            $errorMsg = " Inscription Validée";
            
             // recuperer les informations de l utilisateur
             $getInfosOfThisUserReq = $bdd->prepare('SELECT Matricule, Nom, Prenom, Adresse, Tel FROM membre WHERE Nom =? AND Prenom = ? AND Adresse = ? Tel = ?');
             $getInfosOfThisUserReq->execute(array($user_nom, $user_prenom,$user_adresse,$user_tel));
 
             // on enregistre les info sous format de tableau
             $usersInfos =  $getInfosOfThisUserReq->fetch();
        }else{

        }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Saisie Membre | Espace Membre</title>
</head>
<body style="">

<section id="cover" class="min-vh-100">
<?php include_once 'haut.php'; ?>
    <div id="cover-caption">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h1 class="display-4 py-2 text">Espace membre</h1>
                    <div class="px-2 text">
                    <?php 
                        if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; } 
                     ?>
                        <form action="" method="POST" class="justify-content-center">
                        
                            <div class="form-group">
                                <label class="fw-4 text">Nom</label>
                                <input type="text" class="form-control" name="Nom">
                            </div>
                            <div class="form-group">
                                <label class="text">Prénom</label>
                                <input type="text" class="form-control" name="Prenom">
                            </div>
                            <div class="form-group">
                                <label class="text">Adresse</label>
                                <input type="text" class="form-control" name="Adresse">
                            </div>
                            <div class="form-group">
                                <label class="text">Telephone</label>
                                <input type="text" class="form-control" name="Tel">
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

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>