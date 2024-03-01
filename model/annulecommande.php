<?php
include "connexion.php";

if (empty($_GET['idcommande'])) {
    echo "Parameter 'idcommande' is empty.";
} elseif (empty($_GET['idarticle'])) {
    echo "Parameter 'idarticle' is empty.";
} elseif (empty($_GET['quantite'])) {
    echo "Parameter 'quantite' is empty.";
} else {
    echo  $_GET['idcommande'] ;
    echo "<br>";
    echo  $_GET['idarticle'];
    echo "<br>";
    echo  $_GET['quantite'];
    echo "<br>";
    echo  "";

    try {
        $connexion->beginTransaction();

        // Update the "commande" table
        $sql = "UPDATE commande SET etat = ? WHERE id = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([0, $_GET['idcommande']]);

        // Check the affected rows
        if ($stmt->rowCount() > 0) {
            // Update the "article" table
            $sql2 = "UPDATE article SET quantite = quantite - ? WHERE id = ?";
            $stmt2 = $connexion->prepare($sql2);
            $stmt2->execute([$_GET['quantite'], $_GET['idarticle']]);

            // Check if the second update was successful
            if ($stmt2->rowCount() > 0) {
                // Both updates were successful
                $connexion->commit();
                echo "Commande successfully canceled.";
            } else {
                $connexion->rollBack();
                echo "Update of article failed.";
            }
        } else {
            $connexion->rollBack();
            echo "Update of vente failed.";
        }
    } catch (PDOException $e) {
        $connexion->rollBack();
        echo "An error occurred: " . $e->getMessage();
    }
}
header("Location: ../view/commandes.php");
?>
