<?php 
include "connexion.php";

if (empty($_GET['idvente'])) {
    echo "Parameter 'idvente' is empty.";
} elseif (empty($_GET['idarticle'])) {
    echo "Parameter 'idarticle' is empty.";
} elseif (empty($_GET['quantite'])) {
    echo "Parameter 'quantite' is empty.";
} else {
    $sql = "UPDATE vente SET vendu = ? WHERE id = ?";
    $stmt = $connexion->prepare($sql);

    if ($stmt !== false) {
        $stmt->execute(array(0, $_GET['idvente']));

    } else {
        echo "Prepare statement for updating vente failed: " . implode(" - ", $connexion->errorInfo());
    }
}


header("Location: ../view/today.php");

?>