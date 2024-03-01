<?php
session_start();
include "connexion.php";

if (!empty($_POST['id']) && !empty($_POST['categorie'])) {
    $id = $_POST['id'];
    $categorie = $_POST['categorie'];
   

        $updateSql = "UPDATE categorie SET lebele = :categorie WHERE id = :id";

        try {
            $consulta = $connexion->prepare($updateSql);
            $consulta->execute(array(':categorie' => $categorie, ':id' => $id));

            if ($consulta->rowCount() > 0) {
                $_SESSION['MESSAGE']['TEXT'] = "Update successful";
                $_SESSION['MESSAGE']['TYPE'] = "success";
            }
        } catch (PDOException $e) {
            $_SESSION['MESSAGE']['TEXT'] = "Exception: " . $e->getMessage();
            $_SESSION['MESSAGE']['TYPE'] = "warning";
        }
   
} else {
    $_SESSION['MESSAGE']['TEXT'] = "Category ID or name not provided";
    $_SESSION['MESSAGE']['TYPE'] = "warning";
}

header("Location: ../view/categorie.php");
?>
