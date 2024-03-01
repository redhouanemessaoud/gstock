<?php
include "entete.php";

if (!empty($_GET['id'])) {
    $article = getVente($_GET['id']);
   
}
?>

<style>
    <?php include "../../public/css/style.css" ?>
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
        <div class="right-side">
            <div class="box-topic">الطلبات</div>
            <div class="number"><?php echo  getallcommande()['nbre'] ?></div>
            <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">منذ الأمس</span>
            </div>
        </div>
        <i class="bx bx-cart-alt cart"></i>
    </div>
    <div class="box">
        <div class="right-side">
            <div class="box-topic">المبيعات</div>
            <div class="number"><?php echo  getallvente()['nbre'] ?></div>
            <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">منذ الأمس</span>
            </div>
        </div>
        <i class="bx bxs-cart-add cart two"></i>
    </div>
    <div class="box">
        <div class="right-side">
            <div class="box-topic">الربح</div>
            <div class="number"><?php echo number_format(getca()['nbre'],0,',',' ')  ?></div>
            <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">منذ الأمس</span>
            </div>
        </div>
        <i class="bx bx-cart cart three"></i>
    </div>
    <div class="box">
        <div class="right-side">
            <div class="box-topic">الخسارة</div>
            <div class="number"><?php echo number_format(getcom()['nbre'],0,',',' ')  ?></div>
            <div class="indicator">
                <i class="bx bx-down-arrow-alt down"></i>
                <span class="text">اليوم</span>
            </div>
        </div>
        <i class="bx bxs-cart-download cart four"></i>
    </div>
</div>

    <div class="overview-boxes">
     
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
                <th>السلع</th>
<th>العميل</th>
<th>الكمية</th>
<th>السعر</th>
<th>تحويل</th>
<th>صافي</th>
<th>التاريخ</th>
<th>الإجراء</th>
<th>إجراء البيع</th>

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
                $vente = getVentetoday();
                if (!empty($vente) && is_array($vente)) {
                    foreach ($vente as $key => $value) {
                        ?>
                        <tr>
                            <td>
                              <?= $value['nomproduit'] ?>
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
                                <?= $value['ver'] ?>
                            </td>
                            <td>
                                <?= $value['net'] ?>
                            </td>
                            <td>
                                <?= $value['datevente'] ?>
                            </td>
                            <td>
                            <a href="recuvente.php?id=<?= $value['idvente'] ?>" class="link-no-style"> <i class='bx bx-printer'></i></a>
                            <a onclick="annulevente(<?=  $value['idvente']?>,<?=  $value['id_article']?>,<?=$value['quantite']?>)" style="color: red;" class="link-no-style"><i class='bx bx-stop-circle'></i></a>
                            </td>
                            <td>
                            
                            <a onclick="effectuervente(<?=  $value['idvente']?>,<?=  $value['id_article']?>,<?=$value['quantite']?>)" style="color: green;" class="link-no-style"><i class='bx bxs-user-check'></i></a>
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
        window.location.href = "../../model/annulevente.php?idvente=" + idvente + "&idarticle=" + idarticle + "&quantite=" + quantite;
    }
}

function effectuervente(idvente, idarticle, quantite) {
    if (confirm("Vous voulez vraiment modifier cette vente?")) {
        window.location.href = "../../model/effectuervente.php?idvente=" + idvente + "&idarticle=" + idarticle + "&quantite=" + quantite;
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