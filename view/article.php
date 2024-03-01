<?php
include "entete.php";


if (!empty($_GET['id'])) {
    $article = getArticle($_GET['id']);
    $article['reference'] = preg_replace('/[^0-9]/', '', $article['reference']);
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
            <form action="<?= !empty($_GET['id']) ? "../model/modifierarticle.php" : "../model/ajoutarticle.php " ?>" method="post">
                <label for="nom_article">Nom de l'article</label><br>
                <input value="<?= !empty($_GET['id']) ? $article['nomproduit'] : "" ?>" type="text" name="nom_article" id="nom_article" placeholder="veuillez saisir le nom">
                <input value="<?= !empty($_GET['id']) ? $article['id_article'] : "" ?>" type="hidden" name="id" id="id">
                <br>
                <label for="categorie">type</label><br>
                <select name="categorie" id="categorie">
                    <?php
                    $categorie = getcategorie();
                    if (!empty($categorie) && is_array($categorie)) {
                        foreach ($categorie as $key => $value) {
                    ?>
                            <option value="<?= $value['id'] ?>" <?= !empty($_GET['id']) && $article['id_categorie'] === 'chambre' ? 'selected' : '' ?>>
                                <?= $value['categorie'] ?>
                            </option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <label for="reference">reference</label>
                <br><input value="<?= !empty($_GET['id']) ? $article['reference'] : "" ?>" type="text" name="reference" id="reference" placeholder="veuillez saisir la reference">

                <br><label for="nom_fournisseur">Nom de fournisseur</label>
                <br><input value="<?= !empty($_GET['id']) ? $article['nomfourn'] : "" ?>" type="text" name="nom_fournisseur" id="nom_fournisseur" placeholder="veuillez saisir le nom">

                <br><label for="machat">montant d'achat</label>
                <br><input value="<?= !empty($_GET['id']) ? $article['machat'] : "" ?>" type="number" name="machat" id="machat" placeholder="veuillez saisir le montant d'achat">

                <br><label for="mvente">montant de vente</label>
                <br><input value="<?= !empty($_GET['id']) ? $article['mvente'] : "" ?>" type="number" name="mvente" id="mvente" placeholder="veuillez saisir le montant de vente">

                <br><label for="quantite">Quantite</label>
                <br><input value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder="veuillez saisir la quantite">
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
        <div style="display:block;" class="box">
            <form action="" method="get">
                <table class="mtable">
                    <tr>
                        <th>reference</th>
                        <th>nom de l'article</th>
                        <th>categorie</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="reference" id="reference" placeholder="veuillez saisir la reference">
                        </td>
                        <td>
                            <input type="text" name="nom_article" id="nom_article" placeholder="veuillez saisir le nom">
                        </td>
                        <td>
                            <select name="categorie" id="categorie">
                                <?php
                                $categorie = getcategorie();
                                if (!empty($categorie) && is_array($categorie)) {
                                    foreach ($categorie as $key => $value) {
                                ?>
                                        <option value="<?= $value['id'] ?>" <?= !empty($_GET['id']) && $article['id_categorie'] === 'chambre' ? 'selected' : '' ?>>
                                            <?= $value['categorie'] ?>
                                        </option>
                                <?php

                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <style>
                    .btn {
    font-size: 14px;
    font-weight: bold;
    padding: 6px 12px;
    border: none;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    margin: 4px 2px;
    transition-duration: 0.4s;
    border-radius: 50px;
    margin-left: auto;
    margin-right: auto;
    display: block;
}

.btn-success {
    color: white;
    background-color: green;
}

.btn-success:hover {
    background-color: #45a049;
}
                </style>
                <br><button type="submit" class="btn btn-success">valider</button>
            </form>
            <br>
            <table class="mtable">
                <tr>
                    <th>reference</th>
                    <th>nom article</th>
                    <th>Quantite</th>
                    <th>prix d'achat</th>
                    <th>prix de vente</th>
                    <th>Date d'achat</th>
                </tr>
                <?php
                if (!empty($_GET)) {
                    $article = getArticle(null, $_GET);
                } else {
                    $article = getArticle();
                }

                if (!empty($article) && is_array($article)) {
                    foreach ($article as $key => $value) {
                ?>
                        <tr>
                            <td>
                                <a href="?id=<?= $value['id_article'] ?>" class="link-no-style"><?= $value['reference'] ?></a>
                            </td>
                            <td>
                                <?= $value['nomproduit'] ?>
                            </td>
                            <td>
                                <?= $value['quantite'] ?>
                            </td>
                            <td>
                                <?= $value['machat'] ?>
                            </td>
                            <td>
                                <?= $value['mvente'] ?>
                            </td>
                            <td>
                                <?= date('d/m/Y H:i', strtotime($value['date'])) ?>
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
