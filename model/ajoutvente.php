<?php
session_start();
include "connexion.php";
include "fonction.php";



$emptyFields = [];
if (!empty($_POST['id_article']) && !empty($_POST['id_client']) && !empty($_POST['quantite'])  && !empty($_POST['prix']) && !empty($_POST['datevente']) && !empty($_POST['verser'])) {
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
    
   


    // Echo variables
echo "POST nette: " . $_POST['nette'] . "<br>";
echo "POST prix: " . $_POST['prix'] . "<br>";
echo "POST idvente: " . $_POST['idvente'] . "<br>";
echo "POST id_article: " . $_POST['id_article'] . "<br>";
echo "POST id_client: " . $_POST['id_client'] . "<br>";
echo "POST quantite: " . $_POST['quantite'] . "<br>";
echo "POST datevente: " . $_POST['datevente'] . "<br>";
echo "POST verser: " . $_POST['verser'] . "<br>";

// Variables derived from POST data
if (isset($nette)) {
    echo "Variable nette: " . $nette . "<br>";
}
if (isset($idvente)) {
    echo "Variable idvente: " . $idvente . "<br>";
}
if (isset($id_article)) {
    echo "Variable id_article: " . $id_article . "<br>";
}
if (isset($id_client)) {
    echo "Variable id_client: " . $id_client . "<br>";
}
if (isset($quantite)) {
    echo "Variable quantite: " . $quantite . "<br>";
}
if (isset($prix)) {
    echo "Variable prix: " . $prix . "<br>";
}
if (isset($datevente)) {
    echo "Variable datevente: " . $datevente . "<br>";
}
if (isset($verser)) {
    echo "Variable verser: " . $verser . "<br>";
}


    // Retrieve article information
    $article = getArticle($id_article);

    if (!empty($article) && is_array($article)) {
        if ($quantite > $article['quantite']) {
            // Not enough quantity in stock
            $_SESSION['MESSAGE']['TEXT'] = "Quantité insuffisante";
            $_SESSION['MESSAGE']['TYPE'] = "danger";
        } else {
            try {
                // Insert the sale into the database
                $insertSql = "INSERT INTO vente(id_article, id_client, quantite, prix, datevente, verser,nette) VALUES(:id_article, :id_client, :quantite, :prix, :datevente, :verser, :nette)";
                $consulta = $connexion->prepare($insertSql);
                $consulta->bindParam(':id_article', $id_article);
                $consulta->bindParam(':id_client', $id_client);
                $consulta->bindParam(':quantite', $quantite);
                $consulta->bindParam(':prix', $prix);
                $consulta->bindParam(':datevente', $datevente);
                $consulta->bindParam(':verser', $verser);
                $consulta->bindParam(':nette', $nette);
                $consulta->execute();

                if ($consulta->rowCount() > 0) {
                    // Update the article quantity
                    $sql = "UPDATE article SET quantite = quantite - ? WHERE id = ?";
                    $consulta = $connexion->prepare($sql);
                    $parameters = [$quantite, $id_article];
                    if ($consulta->execute($parameters)) {
                        $_SESSION['MESSAGE']['TEXT'] = "Vente ajoutée avec succès";
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
    } else {
        $_SESSION['MESSAGE']['TEXT'] = "L'article n'existe pas ou n'est pas disponible";
        $_SESSION['MESSAGE']['TYPE'] = "danger";
    }
} else {

    if (empty($_POST['idarticle'])) {
        echo "idarticle is empty.<br>";
    }

    if (empty($_POST['idclient'])) {
        echo "idclient is empty.<br>";
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
