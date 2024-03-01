<?php
session_start();
include "connexion.php";

if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['num'])  && !empty($_POST['adresse'])) {
    $nom = $_POST['nom']; // You forgot to assign a value to $nom
    $prenom = $_POST['prenom']; // You forgot to assign a value to $prenom

    // If the nom and prenom don't exist, proceed with insertion
    $insertSql = "INSERT INTO fourniseur(nom, prenom, num, adresse) VALUES(:nom, :prenom, :num,  :adresse)";

    try {
        $consulta = $connexion->prepare($insertSql);
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':prenom', $prenom);
        $consulta->bindParam(':num', $_POST['num']);
        $consulta->bindParam(':adresse', $_POST['adresse']);
        $consulta->execute();

        if ($consulta->rowCount() > 0) {
            $_SESSION['MESSAGE']['TEXT'] = "Insertion successful";
            $_SESSION['MESSAGE']['TYPE'] = "success";
        } else {
            $_SESSION['MESSAGE']['TEXT'] = "Error in adding client";
            $_SESSION['MESSAGE']['TYPE'] = "danger";
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

