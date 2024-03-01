<?php
session_start();
include "connexion.php";
include "fonction.php";

if (!empty($_POST['id']) &&!empty($_POST['nom_article']) && !empty($_POST['categorie']) && !empty($_POST['reference']) && !empty($_POST['nom_fournisseur']) && !empty($_POST['mvente']) && !empty($_POST['machat']) && !empty($_POST['quantite'])) {
    $categorie = $_POST['categorie'];
    $reference = $_POST['reference'];
   $reference = preg_replace('/[^0-9]/', '', $reference);
    $categorieb=getcategorie($categorie);
    if (is_array($categorieb)) {
        // Handle the array case. Maybe take the first element or some other logic based on your requirements.
        $categorieb = isset($categorieb[0]) ? $categorieb[0] : '';
    }
    // Extract the first 4 characters of "categorie"
    $categoriePrefix = substr($categorieb, 0, 4);
    
    // Combine the "categorie" prefix with "reference"
    $combinedReference = $categoriePrefix . $reference;

    echo "id: " . $_POST['id'] . "<br>";
    echo "nom_article: " . $_POST['nom_article'] . "<br>";
    echo "categorie: " . $categorie . "<br>";
    echo "reference: " . $reference . "<br>";
    echo "nom_fournisseur: " . $_POST['nom_fournisseur'] . "<br>";
    echo "mvente: " . $_POST['mvente'] . "<br>";
    echo "machat: " . $_POST['machat'] . "<br>";
    echo "quantite: " . $_POST['quantite'] . "<br>";

    echo "Combined Reference: " . $combinedReference . "<br>";

    $sql = "UPDATE article
    SET id_categorie = :categorie, 
        reference = :combinedReference,
        nomproduit = :nom_article,
        nomfourn = :nom_fournisseur,
        machat = :machat,
        mvente = :mvente,
        quantite = :quantite,
        date = NOW()
    WHERE id = :id;";
    
    try {
        $consulta = $connexion->prepare($sql);
        $consulta->bindParam(':categorie', $categorie);
        $consulta->bindParam(':combinedReference', $combinedReference); // Corrected binding
        $consulta->bindParam(':nom_article', $_POST['nom_article']);
        $consulta->bindParam(':nom_fournisseur', $_POST['nom_fournisseur']);
        $consulta->bindParam(':machat', $_POST['machat']);
        $consulta->bindParam(':mvente', $_POST['mvente']);
        $consulta->bindParam(':quantite', $_POST['quantite']);
        $consulta->bindParam(':id', $_POST['id']);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            $_SESSION['MESSAGE']['TEXT'] = "modification successful";
            $_SESSION['MESSAGE']['TYPE'] = "success";
        } else {
            $_SESSION['MESSAGE']['TEXT'] = "rien n'est changer";
            $_SESSION['MESSAGE']['TYPE'] = "warning";
        }
    } catch (PDOException $e) {
        $_SESSION['MESSAGE']['TEXT'] = "Exception" .$e->getMessage();
        $_SESSION['MESSAGE']['TYPE'] = "warning";
    }
} else {
    $_SESSION['MESSAGE']['TEXT'] = "entrer toute les valeurs";
    echo "ID: " . $_POST['id'] . "<br>";
    echo "Nom article: " . $_POST['nom_article'] . "<br>";
    echo "Catégorie: " . $_POST['categorie'] . "<br>";
    echo "Référence: " . $_POST['reference'] . "<br>";
    echo "Nom fournisseur: " . $_POST['nom_fournisseur'] . "<br>";
    echo "Mvente: " . $_POST['mvente'] . "<br>";
    echo "Machat: " . $_POST['machat'] . "<br>";
    echo "Quantité: " . $_POST['quantite'] . "<br>";
    $_SESSION['MESSAGE']['TYPE'] = "danger";
}

header("Location: ../view/article.php");
?>
