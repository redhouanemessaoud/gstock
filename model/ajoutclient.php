<?php
session_start();
include "connexion.php";

if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['telephone1']) && !empty($_POST['telephone2']) && !empty($_POST['adresse'])) {
    $nom = $_POST['nom']; // You forgot to assign a value to $nom
    $prenom = $_POST['prenom']; // You forgot to assign a value to $prenom

    // If the nom and prenom don't exist, proceed with insertion
    $insertSql = "INSERT INTO client(nom, prenom, telephone1, telephone2, adresse) VALUES(:nom, :prenom, :telephone1, :telephone2, :adresse)";

    try {
        $consulta = $connexion->prepare($insertSql);
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':prenom', $prenom);
        $consulta->bindParam(':telephone1', $_POST['telephone1']);
        $consulta->bindParam(':telephone2', $_POST['telephone2']); // Corrected the parameter name
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

header("Location: ../view/client.php");
?>

