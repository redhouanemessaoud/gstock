<?php
session_start();
include "connexion.php";
include "fonction.php";



if (!empty($_POST['idvente']) && !empty($_POST['id_article'])  && !empty($_POST['id_client']) && !empty($_POST['quantite'])  && !empty($_POST['prix']) && !empty($_POST['datevente']) && !empty($_POST['verser'])) {
    $idvente = $_POST['idvente'];
    $id_article = $_POST['id_article'];
    $id_client = $_POST['id_client'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];
    $datevente = $_POST['datevente'];
    $verser = $_POST['verser'];
    if (empty($_POST['nette'])) {
        $_POST['nette'] = $_POST['prix'];
        $nette = $_POST['prix'];
    } else {
        $nette = $_POST['nette']; 
        $nette=$prix-$nette;
    }
    

    // Retrieve article information
    $article = getArticle($id_article);

    if (!empty($article) && is_array($article)) {
       
            try {
                // Update the sale in the database
                $updateSql = "UPDATE vente SET id_article = :id_article, id_client = :id_client, quantite = :quantite, prix = :prix, datevente = :datevente, verser = :verser, nette = :nette WHERE id = :idvente";
                $consulta = $connexion->prepare($updateSql);
                $consulta->bindParam(':id_article', $id_article);
                $consulta->bindParam(':id_client', $id_client);
                $consulta->bindParam(':quantite', $quantite);
                $consulta->bindParam(':prix', $prix);
                $consulta->bindParam(':datevente', $datevente);
                $consulta->bindParam(':verser', $verser);
                $consulta->bindParam(':nette', $nette);
                $consulta->bindParam(':idvente', $idvente);
                $consulta->execute();

            } catch (PDOException $e) {
                $_SESSION['MESSAGE']['TEXT'] = "Exception: " . $e->getMessage();
                $_SESSION['MESSAGE']['TYPE'] = "warning";
            }
        
    } else {
        $_SESSION['MESSAGE']['TEXT'] = "L'article n'existe pas ou n'est pas disponible";
        $_SESSION['MESSAGE']['TYPE'] = "danger";
    }
} else {

    if (empty($_POST['idvente'])) {
        echo "idvente is empty.<br>";
    }
    
    if (empty($_POST['id_article'])) {
        echo "id_article is empty.<br>";
    }
    
    if (empty($_POST['id_client'])) {
        echo "id_client is empty.<br>";
    }
    
    if (empty($_POST['quantite'])) {
        echo "quantite is empty.<br>";
    }
    
    if (empty($_POST['nette'])) {
        echo "nette is empty.<br>";
    }
    
    if (empty($_POST['prix'])) {
        echo "prix is empty.<br>";
    }
    
    if (empty($_POST['datevente'])) {
        echo "datevente is empty.<br>";
    }
    
    if (empty($_POST['verser'])) {
        echo "verser is empty.<br>";
    }
    
    $_SESSION['MESSAGE']['TEXT'] = "Veuillez remplir tous les champs";
    $_SESSION['MESSAGE']['TYPE'] = "warning";
}
header("Location: ../view/vente.php");
?>
