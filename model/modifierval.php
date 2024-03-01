<?php
session_start();
include "connexion.php";

if (!empty($_POST['min']) && !empty($_POST['max']) && !empty($_POST['val']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    $min = $_POST['min'];
    $max = $_POST['max'];
    $val = $_POST['val'];

    $updateSql = "UPDATE val SET min = :min, max = :max, val = :val WHERE id = :id";
    $params = array(':id' => $id, ':min' => $min, ':max' => $max, ':val' => $val);

    $consulta = $connexion->prepare($updateSql);
    $consulta->execute($params);

    if ($consulta->rowCount() > 0) {
        $_SESSION['MESSAGE']['TEXT'] = "Update successful";
        $_SESSION['MESSAGE']['TYPE'] = "success";
    } else {
        $_SESSION['MESSAGE']['TEXT'] = "Error in updating value";
        $_SESSION['MESSAGE']['TYPE'] = "danger";
    }
} else {
    $_SESSION['MESSAGE']['TEXT'] = "All fields are required";
    $_SESSION['MESSAGE']['TYPE'] = "warning";
}

header("Location: ../view/tableaux.php");
?>
