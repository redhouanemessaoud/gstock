<?php
include "connexion.php"; // Include your database connection file
function getArticle($id = null, $searchdata = array()) {
    if (!empty($id)) {
        $sql = "SELECT a.id as id_article, c.id as id_commande, reference,
         nomproduit, id_categorie, nomfourn, machat, mvente,
          quantite, date, lebele ,nette
          FROM article as a, categorie as c WHERE a.id_categorie=c.id AND a.id=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } elseif (!empty($searchdata)) {
        var_dump($searchdata);
        $search = "";
        extract($searchdata);
        if (!empty($nom_article)) {
            $search .= " AND a.nomproduit LIKE '%$nom_article%'";
        }
        if (!empty($categorie)) {
            $search .= " AND a.id_categorie = $categorie";
        }
        if (!empty($reference)) {
            $search .= " AND a.reference LIKE '%$reference%'";
        }

        $sql = "SELECT a.id as id_article, c.id as id_commande, reference,nette, nomproduit, id_categorie, nomfourn, machat, mvente, quantite, date, lebele FROM article as a, categorie as c WHERE a.id_categorie=c.id $search ORDER BY reference ASC";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    } else {
        $sql = "SELECT a.id as id_article, c.id as id_commande, reference,nette, nomproduit, id_categorie, nomfourn, machat, mvente, 
         quantite, date, lebele FROM article as a, categorie as c WHERE a.id_categorie=c.id ORDER BY reference ASC";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}



function getClient($id=null) {
    if (!empty($id)) {
        $sql = "SELECT * FROM client where id=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    }else {
        $sql = "SELECT * FROM client ORDER BY nom ASC";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getVente($id = null) {
    if (!empty($id)) {
        $sql = "SELECT v.id as idvente, nomproduit,reference, a.nette, v.vendu, v.verser, nom, prenom,
        v.quantite, v.prix, datevente, mvente,id_client,id_article, adresse,verser, telephone1, telephone2, v.nette, a.id AS id_article 
        FROM client AS c, vente AS v, article AS a 
        WHERE v.id_article = a.id AND v.id_client = c.id AND v.id = ? AND etat = 1 
        ORDER BY datevente DESC";
    
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->bindParam(1, $id, PDO::PARAM_INT); // Assuming $id is an integer, adjust the type accordingly
    $req->execute();

    return $req->fetch();
    } else {
        $sql = "SELECT v.id as idvente, nomproduit,reference, v.verser, v.nette, v.vendu, nom, prenom, 
        v.quantite, v.prix, datevente,id_client,id_article, mvente,verser, adresse, telephone1, telephone2, a.id AS id_article  
        FROM client AS c, vente AS v, article AS a 
        WHERE v.id_article = a.id AND v.id_client = c.id AND etat = ? 
        ORDER BY datevente DESC";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute([1]); // Pass the value as an array
        return $req->fetchAll();
    }
}



function getVentetoday($id = null) {
    $todayDate = date("Y-m-d"); // Get today's date in the format 'YYYY-MM-DD'

    if (!empty($id)) {
        $sql = "SELECT v.id as idvente, nomproduit,v.verser as ver,v.nette as net, nom, prenom, v.quantite, v.prix, datevente, mvente, adresse, telephone1, telephone2, a.id AS id_article 
        FROM client AS c, vente AS v, article AS a 
        WHERE v.id_article = a.id 
        AND v.id_client = c.id AND v.id = ? AND etat = ? AND vendu = ? AND DATE(datevente) = ? ORDER BY nomproduit ASC";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute([$id, 1, 1, $todayDate]); // Pass the values as an array
        return $req->fetch();
    } else {
        $sql = "SELECT v.id as idvente, nomproduit, nom, prenom,v.verser as ver,v.nette as net,v.quantite, v.prix, datevente, mvente, adresse, telephone1, telephone2, a.id AS id_article  
        FROM client AS c, vente AS v, article AS a 
        WHERE v.id_article = a.id AND v.id_client = c.id AND etat = ? AND vendu = ? AND DATE(datevente) = ? ORDER BY nomproduit ASC";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute([1, 1, $todayDate]); // Pass the value as an array
        return $req->fetchAll();
    }
}








function getCommandes($id = null) {
    if (!empty($id)) {
        

        $sql = "SELECT co.id as idco,co.id_article as id_article,co.id_fourniseur,
        co.quantite as quantite,co.prix as prix ,
        co.datecommande as dateco,f.nom as fournisseur_nom ,f.prenom as prenomfourn,
         a.nomproduit as nomproduit ,a.id 
           From commande as co,fourniseur as f,article as a 
           where  co.id_fourniseur=f.id and co.id_article=a.id and co.etat= ?
        ";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id, 0)); 
        return $req->fetch();
    } else {
        $sql = "SELECT co.id as idco,co.id_article,co.id_fourniseur,co.quantite,co.prix as prix ,
        co.datecommande as dateco ,f.nom as fournisseur_nom,f.prenom as prenomfourn,a.nomproduit,a.id 
        From commande as co,fourniseur as f,article as a where  co.id_fourniseur=f.id and co.id_article=a.id and co.etat= ?
     ";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array(1)); 
        return $req->fetchAll();
    }
}


function getFournisseur($id=null) {
    if (!empty($id)) {
        $sql = "SELECT * FROM fourniseur where id=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    }else {
        $sql = "SELECT * FROM fourniseur ORDER BY nom ASC";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}
function getallcommande($start_date = null, $end_date = null) {
    $conditions = [];
    $params = [];

    if ($start_date && $end_date) {
        $conditions[] = "DATE(datecommande) BETWEEN :start_date AND :end_date";
        $params[':start_date'] = $start_date;
        $params[':end_date'] = $end_date;
    } elseif ($start_date) {
        $conditions[] = "DATE(datecommande) >= :start_date";
        $params[':start_date'] = $start_date;
    } elseif ($end_date) {
        $conditions[] = "DATE(datecommande) <= :end_date";
        $params[':end_date'] = $end_date;
    } else {
        $today = date("Y-m-d");
        $conditions[] = "DATE(datecommande) = :today";
        $params[':today'] = $today;
    }

    $sql = "SELECT COUNT(*) AS nbre FROM commande WHERE " . implode(' AND ', $conditions) . " AND etat='1'";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute($params);
    return $req->fetch();
}

function getallvente($start_date = null, $end_date = null) {
    $conditions = [];
    $params = [];

    if ($start_date && $end_date) {
        $conditions[] = "DATE(datevente) BETWEEN :start_date AND :end_date";
        $params[':start_date'] = $start_date;
        $params[':end_date'] = $end_date;
    } elseif ($start_date) {
        $conditions[] = "DATE(datevente) >= :start_date";
        $params[':start_date'] = $start_date;
    } elseif ($end_date) {
        $conditions[] = "DATE(datevente) <= :end_date";
        $params[':end_date'] = $end_date;
    } else {
        $today = date("Y-m-d");
        $conditions[] = "DATE(datevente) = :today";
        $params[':today'] = $today;
    }

    $sql = "SELECT COUNT(*) AS nbre FROM vente WHERE " . implode(' AND ', $conditions) . " AND etat = 1 AND vendu = '0'";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute($params);
    return $req->fetch();
}

function getallc($start_date = null, $end_date = null) {
    $sql = "SELECT COUNT(*) AS nbre FROM client";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
}







function getprofit() {
    $sql = "SELECT COUNT(*) AS nbre FROM vente where etat=?";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute(array(1));
    return $req->fetch();
}
function getrevenue() {
    $sql = "SELECT COUNT(*) AS nbre FROM vente where etat=?";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute(array(1));
    return $req->fetch();
}

function getca($start_date = null, $end_date = null) {
    $conditions = [];
    $params = [];

    if ($start_date && $end_date) {
        $conditions[] = "DATE(datevente) BETWEEN :start_date AND :end_date";
        $params[':start_date'] = $start_date;
        $params[':end_date'] = $end_date;
    } else {
        $today = date("Y-m-d");
        $conditions[] = "DATE(datevente) = :today";
        $params[':today'] = $today;
    }

    $sql = "SELECT SUM(prix) AS nbre FROM vente WHERE " . implode(' AND ', $conditions) . " AND etat = 1 AND vendu = '0'";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute($params);
    return $req->fetch();
}

function getcom($start_date = null, $end_date = null) {
    $conditions = [];
    $params = [];

    if ($start_date && $end_date) {
        $conditions[] = "DATE(datecommande) BETWEEN :start_date AND :end_date";
        $params[':start_date'] = $start_date;
        $params[':end_date'] = $end_date;
    } else {
        $today = date("Y-m-d");
        $conditions[] = "DATE(datecommande) = :today";
        $params[':today'] = $today;
    }

    $sql = "SELECT SUM(prix) AS nbre FROM commande WHERE " . implode(' AND ', $conditions) . " AND etat = '1'";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute($params);
    return $req->fetch();
}

function getallnette($start_date = null, $end_date = null) {
    $conditions = [];
    $params = [];

    if ($start_date && $end_date) {
        $conditions[] = "DATE(datevente) BETWEEN :start_date AND :end_date";
        $params[':start_date'] = $start_date;
        $params[':end_date'] = $end_date;
    } else {
        $today = date("Y-m-d");
        $conditions[] = "DATE(datevente) = :today";
        $params[':today'] = $today;
    }

    $sql = "SELECT SUM(nette) AS nbre FROM vente WHERE " . implode(' AND ', $conditions) . " AND etat = 1 AND vendu = '0'";
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute($params);
    return $req->fetch();
}



function getlastVente() {
    
        $sql = "SELECT v.id, nomproduit, nom, prenom, v.quantite, v.prix, datevente, mvente, reference,
        adresse, telephone1, telephone2,
         a.id AS id_article  FROM client AS c, vente AS v, article AS a WHERE v.id_article = a.id AND v.id_client = c.id
        
          AND etat = ? ORDER BY datevente desc limit 10";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array(1));
        return $req->fetchAll();
    
}

function getmostvente() {
    $sql = "SELECT  nomproduit, SUM(prix) AS prix,a.reference as reference
            FROM client AS c
            JOIN vente AS v ON v.id_client = c.id
            JOIN article AS a ON v.id_article = a.id
            WHERE etat = ?
            GROUP BY nomproduit
            ORDER BY prix DESC
            LIMIT 10";
    
    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute(array(1));
    return $req->fetchAll();
}


function getcategorie($id=null) {
    if (!empty($id)) {
        $sql = "SELECT lebele as categorie,id FROM categorie where id=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    }else {
        $sql = "SELECT lebele as categorie ,id FROM categorie ";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function getval($id=null) {
    if (!empty($id)) {
        $sql = "SELECT min,max,id,val FROM val where id=?";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    }else {
        $sql = "SELECT min,max,id,val FROM val ";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

function net($mvente = null) {
    if (!empty($mvente)) {
        $sql = "SELECT val FROM val WHERE :mvente BETWEEN min AND max";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->bindParam(':mvente', $mvente);
        $req->execute();
        return $req->fetch();
    } else {
        $sql = "SELECT val FROM val WHERE :mvente BETWEEN min AND max";
        $req = $GLOBALS['connexion']->prepare($sql);
        $req->bindParam(':mvente', $mvente);
        $req->execute();
        return $req->fetchAll();
    }
}



?>

