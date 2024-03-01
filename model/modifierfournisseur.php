<?php
session_start();
include "connexion.php";

if (!empty($_POST['id']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['num'])  && !empty($_POST['adresse'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // If the ID, nom, and prenom exist, proceed with the modification
    $updateSql = "UPDATE fourniseur
    SET nom = :nom,
        prenom = :prenom,
        num = :num,
        adresse = :adresse
    WHERE id = :id";

    try {
        $consulta = $connexion->prepare($updateSql);
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':prenom', $prenom);
        $consulta->bindParam(':num', $_POST['num']);
        $consulta->bindParam(':adresse', $_POST['adresse']);
        $consulta->bindParam(':id', $_POST['id']);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            $_SESSION['MESSAGE']['TEXT'] = "Modification successful";
            $_SESSION['MESSAGE']['TYPE'] = "success";
        } else {
            $_SESSION['MESSAGE']['TEXT'] = "No changes made";
            $_SESSION['MESSAGE']['TYPE'] = "warning";
        }
    } catch (PDOException $e) {
        $_SESSION['MESSAGE']['TEXT'] = "Exception: " . $e->getMessage(); // Display the exception message
        $_SESSION['MESSAGE']['TYPE'] = "warning";
    }
} else {
    $_SESSION['MESSAGE']['TEXT'] = "Information not provided";
    $_SESSION['MESSAGE']['TYPE'] = "warning";
}

header("Location: ../view/fournisseur.php");
?>
