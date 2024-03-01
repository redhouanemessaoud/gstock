<?php 
include "connexion.php";

if (empty($_GET['idvente'])) {
    echo "Parameter 'idvente' is empty.";
} elseif (empty($_GET['idarticle'])) {
    echo "Parameter 'idarticle' is empty.";
} elseif (empty($_GET['quantite'])) {
    echo "Parameter 'quantite' is empty.";
} else {
    $sql = "UPDATE vente SET etat = ? WHERE id = ?";
    $stmt = $connexion->prepare($sql);

    if ($stmt !== false) {
        $stmt->execute(array(0, $_GET['idvente']));

        if ($stmt->rowCount() > 0) {
            $sql = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
            $stmt2 = $connexion->prepare($sql);

            if ($stmt2 !== false) {
                $stmt2->execute(array($_GET['quantite'], $_GET['idarticle']));
            } else {
                echo "Prepare statement for updating article failed: " . implode(" - ", $connexion->errorInfo());
            }
        } else {
            echo "Update of vente failed: " . implode(" - ", $stmt->errorInfo());
        }
    } else {
        echo "Prepare statement for updating vente failed: " . implode(" - ", $connexion->errorInfo());
    }
}


header("Location: ../view/vente.php");

?>