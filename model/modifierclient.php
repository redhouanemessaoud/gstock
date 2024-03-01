<?php
session_start();
include "connexion.php";

if (!empty($_POST['id']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['telephone1']) && !empty($_POST['telephone2']) && !empty($_POST['adresse'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    // If the ID, nom, and prenom exist, proceed with the modification
    $updateSql = "UPDATE client
    SET nom = :nom,
        prenom = :prenom,
        telephone1 = :telephone1,
        telephone2 = :telephone2,
        adresse = :adresse
    WHERE id = :id";

    try {
        $consulta = $connexion->prepare($updateSql);
        $consulta->bindParam(':nom', $nom);
        $consulta->bindParam(':prenom', $prenom);
        $consulta->bindParam(':telephone1', $_POST['telephone1']);
        $consulta->bindParam(':telephone2', $_POST['telephone2']);
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

header("Location: ../view/client.php");
?>
