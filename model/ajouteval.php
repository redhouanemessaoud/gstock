<?php
session_start();
include "connexion.php";

if (!empty($_POST['min']) && !empty($_POST['max']) && !empty($_POST['val'])) {
    $min = $_POST['min'];
    $max = $_POST['max'];
    $val = $_POST['val'];

    $insertSql = "INSERT INTO val(min, max, val) VALUES(:min, :max, :val)";
    $params = array(':min' => $min, ':max' => $max, ':val' => $val);

    $consulta = $connexion->prepare($insertSql);
    $consulta->execute($params);

    if ($consulta->rowCount() > 0) {
        $_SESSION['MESSAGE']['TEXT'] = "Insertion successful";
        $_SESSION['MESSAGE']['TYPE'] = "success";
    } else {
        $_SESSION['MESSAGE']['TEXT'] = "Error in adding value";
        $_SESSION['MESSAGE']['TYPE'] = "danger";
    }
} else {
    $_SESSION['MESSAGE']['TEXT'] = "All fields are required";
    $_SESSION['MESSAGE']['TYPE'] = "warning";
}

header("Location: ../view/tableaux.php");
?>
