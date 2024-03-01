<?php session_start();
include_once "../model/fonction.php";

if (!empty($_GET['id'])) {
    $article = getArticle($_GET['id']);
    $article['reference'] = preg_replace('/[^0-9]/', '', $article['reference']);
}

?>

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

    table.mtable th,
    table.mtable td {
        text-align: left;
    }

    a.link-no-style {
        text-decoration: none;
        color: inherit;
    }

    .container a.link-no-style {
        text-decoration: none;
        color: inherit;
    }

    table.mtable,
    tr:nth-child(even),
    tr {
        background: #ffffff;
    }

    table.mtable,
    td {
        padding: 10px;
    }

    table.mtable th,
    table.mtable td {
        text-align: left;
    }
    .entete {
    margin-left: 0;
}

.box form table.mtable td {
    text-align: center;
}

    
</style>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرئيسية</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>


    <section class="home-section">
        <div class="home-content">
            <div style="display:block;" class="box">
                <form action="" method="get">
                    <table class="mtable">
                        <tr>
                            <th>المرجع</th>
                            <th>اسم المادة</th>
                            <th>الفئة</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="reference" id="reference" placeholder="يرجى إدخال المرجع">
                            </td>
                            <td>
                                <input type="text" name="nom_article" id="nom_article" placeholder="يرجى إدخال الاسم">
                            </td>
                            <td>
                            <select name="categorie" id="categorie">
    <?php
    $categorie = getcategorie();
    if (!empty($categorie) && is_array($categorie)) {
        foreach ($categorie as $key => $value) {
    ?>
            <option value="<?= $value['id'] ?>" <?= !empty($_GET['id']) && $article['id_categorie'] == $value['id'] ? 'selected' : '' ?>>
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
                    <br><button type="submit" class="btn-valide">تأكيد</button>
                </form>
                <br>
                <table class="mtable">
                    <tr>
                        <th>المرجع</th>
                        <th>اسم المادة</th>
                        <th>الكمية</th>
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
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>

    <?php include "pied.php"; ?>
</body>
</html>


