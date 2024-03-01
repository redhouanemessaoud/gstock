<?php
include "entete.php";

if (!empty($_GET['id'])) {
    $article = getCommandes($_GET['id']);
   
}
?>

<style>
    <?php include "../public/css/style.css" ?>
</style>

<div class="home-content">
    <style>
        .btn-valide {
            color: #fff;
            background: #0d3073;
            padding: 4px 12px;
            font-size: 15px;
            font-weight: 400;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
            width: 30%;
            justify-content: flex-end;
            align-items: center;
            margin-left: 90px;
            margin-top: 20px;
        }

        table.mtable,
        tr:nth-child(even),
        tr {
            background: #ffffff;
        }
    </style>
   
    <div class="overview-boxes">
        <div class="box">
            <form action=" <?= !empty($_GET['id']) ? "../model/modifiercommande.php" : "../model/ajoutcommande.php " ?> " method="post">
                <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">
                <label for="id_article">type</label><br>
                <select onchange="setPrix()" name="id_article" id="id_article">
                     
                <?php

                   $articles = getArticle();
                   if (!empty($articles) && is_array($articles)) {
                     foreach ($articles as $key => $value) {
                        ?>
                        <option data-prix="<?= $value['machat'] ?>"  value="<?= $value['id_article'] ?>"><?=$value['nomproduit']."-".$value['quantite'] ." Disponoble" ?></option>
                        <?php
                     }
                   }
   
   

                ?>
                </select>
                <label for="id_client">Nom de Fournisseur</label><br>
                <select name="id_client" id="id_client">
                     
                     <?php
     
                        $Clients = getFournisseur();
                        if (!empty($Clients) && is_array($Clients)) {
                          foreach ($Clients as $key => $value) {
                             ?>
                             <option value="<?= $value['id'] ?>"><?=$value['nom']." ".$value['prenom'] ?></option>
                             <?php
                          }
                        }
        
        
     
                     ?>
     
                     </select>
               

               
                <label for="quantite">Quantite</label>
                <br><input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="veuillez saisir la quantite">

                <label for="prix">Prix</label>
                <br><input value="<?= !empty($_GET['id']) ? $article['prixa'] : "" ?>" type="number" name="prix" id="prix" placeholder="veuillez saisir le prix">
                <button type="submit" class="btn-valide">valider</button>
                <?php 
                   if (!empty($_SESSION["MESSAGE"]["TEXT"])) {
                ?>
                <div class="alert <?= $_SESSION["MESSAGE"]["TYPE"] ?>">
                    <?= $_SESSION["MESSAGE"]["TEXT"] ?>
                </div>
                <?php
                   }
                ?>
            </form>
        </div>
        <style>
            table.mtable,
            tr:nth-child(even),
            tr {
                width: 100%;
            }
            table.mtable,
            td {
                padding: 10px;
            }
            ul.mtable,
            ol.mtable {
                padding: 0;
                margin: 0;
                list-style: none;
            }
            ul.mtable li,
            ol.mtable li {
                padding: 10px;
            }
        </style>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Article</th>
                    <th>Client</th>
                    <th>Quantite</th>
                    <th>prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <style>
                    a.link-no-style {
                        text-decoration: none;
                        color: inherit;
                    }

                    .container a.link-no-style {
                        text-decoration: none;
                        color: inherit;
                    }
                </style>
             <?php
                $commande = getCommandes();
                if (!empty($commande) && is_array($commande)) {
                    foreach ($commande as $key => $value) {
                        ?>
                        <tr>
                            <td>
                              <?= $value['nomproduit'] ?>
                            </td>
                            <td>
                                <?= $value['fournisseur_nom']." ".$value['prenomfourn'] ?>
                            </td>
                            <td>
                                <?= $value['quantite'] ?>
                            </td>
                            <td>
                            <?= $value['prix'] ?>
                            </td>
                            <td>
                            <?= $value['dateco'] ?>
                            </td>
                            <td>
                            <a onclick="annulecommande(<?= $value['idco'] ?>, <?= $value['id_article'] ?>, <?= $value['quantite'] ?>)" style="color: red;" class="link-no-style"><i class='bx bx-stop-circle'></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                <?php
                
                ?>

            </table>
        </div>
    </div>
</div>
</section>
<?php
include "pied.php";
?>
<script>
function annulecommande(idcommande, idarticle, quantite) {
    if (confirm("Vous voulez vraiment modifier cette commande?")) {
        window.location.href = "../model/annulecommande.php?idcommande=" + idcommande + "&idarticle=" + idarticle + "&quantite=" + quantite;
    }
}

function setPrix() {
    var article = document.querySelector('#id_article');
    var quantite = document.querySelector('#quantite');
    var prix = document.querySelector('#prix');

    
    var prixunitaire = article.options[article.selectedIndex].getAttribute('data-prix');

   
    prix.value = Number(quantite.value) * Number(prixunitaire);
}

</script>