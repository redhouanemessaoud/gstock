<?php
session_start();
include "connexion.php";

if (!empty($_POST['categorie'])) {
    $categorie = $_POST['categorie'];
    $checkSql = "SELECT id FROM categorie WHERE lebele	 = :categorie";
    $params = array(':categorie' => $categorie);
    
    $stmtCheck = $connexion->prepare($checkSql);
    $stmtCheck->execute($params);

    if ($stmtCheck->rowCount() > 0) {
        $_SESSION['MESSAGE']['TEXT'] = "Category already exists";
        $_SESSION['MESSAGE']['TYPE'] = "warning";
    } else {
        // Insert a new category
        $insertSql = "INSERT INTO categorie(lebele) VALUES(:categorie)";

        try {
            $consulta = $connexion->prepare($insertSql);
            $consulta->execute($params);

            if ($consulta->rowCount() > 0) {
                $_SESSION['MESSAGE']['TEXT'] = "Insertion successful";
                $_SESSION['MESSAGE']['TYPE'] = "success";
            } else {
                $_SESSION['MESSAGE']['TEXT'] = "Error in adding category";
                $_SESSION['MESSAGE']['TYPE'] = "danger";
            }
        } catch (PDOException $e) {
            $_SESSION['MESSAGE']['TEXT'] = "Exception: " . $e->getMessage();
            $_SESSION['MESSAGE']['TYPE'] = "warning";
        }
    }
} else {
    $_SESSION['MESSAGE']['TEXT'] = "Category name not provided";
    $_SESSION['MESSAGE']['TYPE'] = "warning";
}

header("Location: ../view/categorie.php");
?>
