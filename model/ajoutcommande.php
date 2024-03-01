<?php
session_start();
include "connexion.php";
include "fonction.php";

if (!empty($_POST['id_article']) && !empty($_POST['id_client']) && !empty($_POST['quantite']) && !empty($_POST['prix'])) {
    $id_article = $_POST['id_article'];
    $id_client = $_POST['id_client'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];

    // Retrieve article information
    $article = getArticle($id_article);

    if (!empty($article) && is_array($article)) {
       
            try {
                // Insert the sale into the database
                $insertSql = "INSERT INTO commande(id_article, id_fourniseur, quantite, prix) VALUES(:id_article, :id_client, :quantite, :prix)";
                $consulta = $connexion->prepare($insertSql);
                $consulta->bindParam(':id_article', $id_article);
                $consulta->bindParam(':id_client', $id_client);
                $consulta->bindParam(':quantite', $quantite);
                $consulta->bindParam(':prix', $prix);
                $consulta->execute();

                if ($consulta->rowCount() > 0) {
                    // Update the article quantity
                    $sql = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
                    $consulta = $connexion->prepare($sql);
                    $parameters = [$quantite, $id_article];
                    if ($consulta->execute($parameters)) {
                        $_SESSION['MESSAGE']['TEXT'] = "commande ajoutée avec succès";
                        $_SESSION['MESSAGE']['TYPE'] = "success";
                    } else {
                        $_SESSION['MESSAGE']['TEXT'] = "Erreur lors de la mise à jour de la quantité de l'article";
                        $_SESSION['MESSAGE']['TYPE'] = "danger";
                    }
                } else {
                    $_SESSION['MESSAGE']['TEXT'] = "Erreur lors de l'ajout de la vente";
                    $_SESSION['MESSAGE']['TYPE'] = "danger";
                }
            } catch (PDOException $e) {
                $_SESSION['MESSAGE']['TEXT'] = "Exception: " . $e->getMessage();
                $_SESSION['MESSAGE']['TYPE'] = "warning";
            }
        }
    else {
        $_SESSION['MESSAGE']['TEXT'] = "L'article n'existe pas ou n'est pas disponible";
        $_SESSION['MESSAGE']['TYPE'] = "danger";
    }
} else {
    $_SESSION['MESSAGE']['TEXT'] = "Veuillez remplir tous les champs";
    $_SESSION['MESSAGE']['TYPE'] = "warning";
}

header("Location: ../view/commandes.php");
?>
