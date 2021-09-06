<?php
// ON DEMARRE LA SESSION?

// est ce que l id existe et n est pas vide
if(isset($_GET['NumCotis']) && !empty($_GET['NumCotis'])){
    require_once('database.php');

    // on nettoie l id envoyé
    $id = strip_tags($_GET['NumCotis']);

    $sql = 'SELECT * FROM `cotisation` WHERE `NumCotis` = :NumCotis;';

    // on prepare la requete
    $query = $bdd->prepare($sql);

    // on "accroche" les parametres
    $query->bindValue(':NumCotis', $id, PDO::PARAM_INT);

    //  on excute la requete

    $query->execute();

    // on recupere le produits

    $produit = $query->fetch();
    //  on verifie si le produits existe
    if(!$produit){
        $errorMsg = "Cet id n existe pas";
        die();
    }
    
    $sql = 'DELETE FROM `cotisation` WHERE `NumCotis` = :NumCotis;';

    // on prepare la requete
    $query = $bdd->prepare($sql);

    // on "accroche" les parametres
    $query->bindValue(':NumCotis', $id, PDO::PARAM_INT);

    //  on excute la requete

    $query->execute();
    $_SESSION['message'] = "Produit supprimé";
    header('Location: suprime.php');
   
}
?>


