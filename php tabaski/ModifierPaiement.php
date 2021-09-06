 <?php
// On démarre une session

if($_POST){
    if(isset($_POST['NumCotis']) && !empty($_POST['NumCotis'])
    && isset($_POST['DateCotis']) && !empty($_POST['DateCotis'])
    && isset($_POST['Mois']) && !empty($_POST['Mois'])
    && isset($_POST['Montant']) && !empty($_POST['Montant'])
    && isset($_POST['Motif']) && !empty($_POST['Motif'])
    && isset($_POST['Matricule']) && !empty($_POST['Matricule'])){
        // On inclut la connexion à la base
        require_once('database.php');

        // On nettoie les données envoyées
        $numcotis = strip_tags($_POST['NumCotis']);
        $DateCotis = strip_tags($_POST['DateCotis']);
        $Mois = strip_tags($_POST['Mois']);
        $Montant = strip_tags($_POST['Montant']);
        $Motif = strip_tags($_POST['Motif']);
        $Matricule = strip_tags($_POST['Matricule']);

        $sql = 'UPDATE `Cotisation` SET `DateCotis`=:DateCotis, `Mois`=:Mois, `Montant`=:Montant, `Motif`=:Motif, `Matricule`=:Matricule WHERE `NumCotis`=:NumCotis;';

        $query = $bdd->prepare($sql);

        $query->bindValue(':NumCotis', $numcotis, PDO::PARAM_INT);
        $query->bindValue(':DateCotis', $DateCotis, PDO::PARAM_STR);
        $query->bindValue(':Mois', $Mois, PDO::PARAM_STR);
        $query->bindValue(':Montant', $Montant, PDO::PARAM_STR);
        $query->bindValue(':Motif', $Motif, PDO::PARAM_STR);
        $query->bindValue(':Matricule', $Matricule, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Cotisation modifié";
        // require_once('closeBase.php');

        header('Location: listeCotisations.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'numcotis existe et n'est pas vide dans l'URL
if(isset($_GET['NumCotis']) && !empty($_GET['NumCotis'])){
    require_once('database.php');

    // On nettoie l'numcotis envoyé
    $numcotis = strip_tags($_GET['NumCotis']);

    $sql = 'SELECT * FROM `Cotisation` WHERE `NumCotis` = :NumCotis;';

    // On prépare la requête
    $query = $bdd->prepare($sql);

    // On "accroche" les paramètre (numcotis)
    $query->bindValue(':NumCotis', $numcotis, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère le produit
    $produit = $query->fetch();

    // On vérifie si le produit existe
    if(!$produit){
        $_SESSION['erreur'] = "Cet numero de cotisation n'existe pas";
        header('Location: listeCotisations.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: listeCotisations.php');
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
<body style="background-image: url(./image/photo.jpg); width: %;">

<section numcotis="cover" class="">
<?php include_once 'haut.php'; ?>
    <div numcotis="cover-caption">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h1 class="display-4 py-2 text-truncate">Modifier Paiement</h1>
                    <div class="px-2">
                    <?php 
                        if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>'; } 
                     ?>
                        <form action="" method="POST" class="justify-content-center">
                            <div class="form-group">
                                <label class="fw-4">Date de Cotisation</label>
                                <input type="date" class="form-control" name="DateCotis" >
                            </div>
                            <div class="form-group">
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
                            <div class="form-group">
                                <label >NumCotis</label>
                                <input type="number" class="form-control" name="NumCotis">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg" name="valider">Enregistrer</button>
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