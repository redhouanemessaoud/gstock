<?php
session_start();
include "connexion.php";
include "fonction.php";

if ( !empty($_POST['categorie']) && !empty($_POST['reference'])  && !empty($_POST['mvente']) && !empty($_POST['machat']) && !empty($_POST['quantite'])) {
    
    $categorie = $_POST['categorie'];
    echo $categorie;
    echo "<br>";

    if (empty($_POST['nom_article'])) {
        $_POST['nom_article']='NoN';}
        if (empty($_POST['nom_fournisseur'])) {
            $_POST['nom_fournisseur']='NoN';}


    
    $reference = $_POST['reference'];
  
    

    $categoryData = getcategorie($_POST['categorie']);
   
    
    
    
    // Assuming "lebele" is changed to "categorie" in the array
    $categoryPrefix = substr($categoryData['categorie'], 0, 4);
 
    
    $reference = $categoryPrefix . $reference;
    

    $mvente = $_POST['mvente'];  

    $val = net($mvente);

    // Use the found value or default to 0 if no value is found
    $netValue = isset($val['val']) ? $val['val'] : 0;
    
    $sql = "INSERT INTO article(id_categorie, reference, nomproduit, nomfourn,
     machat, mvente, quantite, date, nette)
      VALUES(:categorie, :reference, :nom_article, :nom_fournisseur, :machat, :mvente, :quantite,
       NOW(), :nette)";
    
    try {
        $consulta = $connexion->prepare($sql);
        $consulta->bindParam(':categorie', $categorie);
        $consulta->bindParam(':reference', $reference);
        $consulta->bindParam(':nom_article', $_POST['nom_article']);
        $consulta->bindParam(':nom_fournisseur', $_POST['nom_fournisseur']);
        $consulta->bindParam(':machat', $_POST['machat']);
        $consulta->bindParam(':mvente', $mvente);
        $consulta->bindParam(':quantite', $_POST['quantite']);
        $consulta->bindParam(':nette', $netValue);  // Use the calculated net value
        $consulta->execute();
    
        if ($consulta->rowCount() > 0) {
            $_SESSION['MESSAGE']['TEXT'] = "Insertion successful";
            $_SESSION['MESSAGE']['TYPE'] = "success";
        } else {
            $_SESSION['MESSAGE']['TEXT'] = "Error in adding articles";
            $_SESSION['MESSAGE']['TYPE'] = "danger";
        }
    } catch (PDOException $e) {
        $_SESSION['MESSAGE']['TEXT'] = "Exception";
        $_SESSION['MESSAGE']['TYPE'] = "warning";
    }
} else {
    $_SESSION['MESSAGE']['TEXT'] = "Information not provided";
    $_SESSION['MESSAGE']['TYPE'] = "warning";
}

header("Location: ../view/article.php");
?>
