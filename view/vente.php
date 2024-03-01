<?php
include "entete.php";

if (!empty($_GET['id'])) {
    $article = getVente($_GET['id']);
    
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
        a {
    text-decoration: none;
    color: inherit; 
}

    </style>

    <div class="overview-boxes">
        <div class="box">
            <form  action="<?= !empty($_GET['id']) ? "../model/modifiervente.php" : "../model/ajoutvente.php " ?>" method="post">
                <?php  if(!empty($_GET['id']) ) { ?>
            <input value="<?= !empty($_GET['id']) ? $article['idvente'] : "" ?>" type="hidden" name="idvente" id="id">
<?php }  ?>
               
                <label for="id_article">type</label><br>
<select onchange="setPrix()" name="id_article" id="id_article">
    <?php
    $articles = getArticle();
    if (!empty($articles) && is_array($articles)) {
        foreach ($articles as $key => $value) {
            ?>
            <option data-prix="<?= $value['mvente'] ?>" nette-prix="<?= $value['nette'] ?>" 
                value="<?= $value['id_article'] ?>" 
                <?php 
                // Check if the current article's ID matches the article's id_article
                if (!empty($article) && $article['id_article'] == $value['id_article']) {
                    echo "selected";  // Mark the option as selected
                }
                ?>
            >
                <?= $value['reference']."-".$value['quantite'] ." Disponible" ?>
            </option>
            <?php
        }
    }
    ?>
</select>

                <label for="id_client">Nom de client</label><br>
<select name="id_client" id="id_client">
    <?php
    $Clients = getClient();
    if (!empty($Clients) && is_array($Clients)) {
        foreach ($Clients as $key => $value) {
            ?>
            <option value="<?= $value['id'] ?>" 
                <?php 
                // Check if the current client's ID matches the article's id_client
                if (!empty($article) && $article['id_client'] == $value['id']) {
                    echo "selected";  // Mark the option as selected
                }
                ?>
            >
                <?= $value['nom']." ".$value['prenom'] ?>
            </option>
            <?php
        }
    }
    ?>
</select>

                <label for="quantite">Quantite</label>
                <br><input 
    onkeyup="setPrix()" 
    value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" 
    type="number" 
    name="quantite" 
    id="quantite" 
    placeholder="veuillez saisir la quantite" 
    <?= !empty($_GET['id']) ? "readonly" : "" ?>>


                <label for="prix">Prix</label>
                <br><input value="<?= !empty($_GET['id']) ? $article['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder="veuillez saisir le prix">
                
                <label for="prix">nette</label>
                <br><input value="<?= !empty($_GET['id']) ? $article['prix']-$article['nette'] : "" ?>" type="number" name="nette" id="nette" placeholder="veuillez saisir le prix">

                <br><label for="prix">verser</label>
                <br><input value="<?= !empty($_GET['id']) ? $article['verser'] : "" ?>" type="number" name="verser" id="prix" placeholder="veuillez saisir le prix">

                <br>
                <label for="datevente">Date de vente</label><br>
<input type="date" name="datevente" id="datevente" 
       value="<?= !empty($_GET['id']) && !empty($article['datevente']) ? date('Y-m-d', strtotime($article['datevente'])) : "" ?>" 
       placeholder="Sélectionner la date">

                <br><button type="submit" class="btn-valide">valider</button>

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
                    <th>verser</th>
                    <th>nette</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th>etat</th>
                </tr>
                <?php
                $vente = getVente();
                if (!empty($vente) && is_array($vente)) {
                    foreach ($vente as $key => $value) {
                        ?>
                        <tr>
                            <td>
                                <a href="?id=<?= $value['idvente'] ?>" class="link-no-style"><?= $value['reference'] ?></a>
                            </td>
                            <td>
                                <?= $value['nom'] . " " . $value['prenom'] ?>
                            </td>
                            <td>
                                <?= $value['quantite'] ?>
                            </td>
                            <td>
                                <?= $value['prix'] ?>
                            </td>
                            <td>
                                <?= $value['verser'] ?>
                            </td>
                            <td>
                                <?= $value['nette'] ?>
                            </td>
                            <td>
                                <?= date('Y/m/d', strtotime($value['datevente'])) ?>
                            </td>
                            <td>
                                <a href="recuvente.php?id=<?= $value['idvente'] ?>" class="link-no-style">
                                    <i class='bx bx-printer'></i>
                                </a>
                                <a onclick="annulevente(<?=  $value['idvente']?>,<?=  $value['id_article']?>,<?=$value['quantite']?>)" style="color: red;" class="link-no-style">
                                    <i class='bx bx-stop-circle'></i>
                                </a>
                                <a onclick="effectuervente(<?=  $value['idvente']?>,<?=  $value['id_article']?>,<?=$value['quantite']?>)" style="color: green;" class="link-no-style"><i class='bx bxs-user-check'></i></a>
                            
                            </td>
                            <td>
                                <i style="color:<?=$value['vendu'] == '0' ? "green" : "red" ; ?> ;" class='bx bxs-circle '></i>
                            </td>
                        </tr>
                        <?php
                    }
                }
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
    function annulevente(idvente, idarticle, quantite) {
        if (confirm("Vous voulez vraiment modifier cette vente?")) {
            window.location.href = "../model/annulevente.php?idvente=" + idvente + "&idarticle=" + idarticle + "&quantite=" + quantite;
        }
    }

    function setPrix() {
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');
        var nette = document.querySelector('#nette');

        var prixunitaire = article.options[article.selectedIndex].getAttribute('data-prix');
        var netteunitaire = article.options[article.selectedIndex].getAttribute('nette-prix');
        prix.value = Number(quantite.value) * Number(prixunitaire);
        nette.value = Number(quantite.value) * Number(netteunitaire);
    }

    function effectuervente(idvente, idarticle, quantite) {
    if (confirm("Vous voulez vraiment modifier cette vente?")) {
        window.location.href = "../model/effectuervente2.php?idvente=" + idvente + "&idarticle=" + idarticle + "&quantite=" + quantite;
    }
}
</script>



