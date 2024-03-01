<?php
include "entete.php";

if (!empty($_GET['id'])) {
    $vente = getVente($_GET['id']);
   
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
    </style>
    <button id="btnprint" class="btn-valide hiddenprint" style="position:relative;left:26%;">
        imprimer
    </button>
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
        <style>
            body {
        margin: 0;
        padding: 0;
        background-color: #FAFAFAj;        
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 21cm;
        min-height: 29.7cm;
        padding: 2cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
       
    }
    
   
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
    
    
        </style>
        <style>
    /* Add a CSS media query to hide the button during printing */
    @media print {
        #btnprint,#sidebar,#nav {
            display: none;
        }
    }
</style>

        <style>
          .cote-a-cote {
    display: flex;
    flex-wrap: nowrap; /* Prevent wrapping to a new line */
    align-items: flex-start; /* Align children to the top */
    margin: 5px 0; /* Add vertical margin for separation */
}

.right-aligned {
    margin-left: auto; /* Push the element to the right side */
    text-align: right; /* Right-align the content */
}
        </style>
   <div class="page">
    <div class="subpage">
        <div class="labelData">
            <div class="side-by-side">
                <h2>موسم المفروشات</h2>
                <div class="right-aligned">
                    <p>رقم الإيصال: <?= $vente['idvente'] ?></p>
                    <p>التاريخ: <?= date('d/m/y H:i:s', strtotime($vente['datevente'])) ?></p>
                </div>
            </div>
            <div class="side-by-side">
                <div class="name">
                    <p>الاسم: <?= $vente['nom'] . " " . $vente['prenom'] ?></p>
                </div>
            </div>
            <div class="side-by-side">
                <div class="name">
                    <p>رقم الهاتف 1: <?= $vente['telephone1'] ?></p>
                </div>
            </div>
            <div class="side-by-side">
                <div class="name">
                    <p>رقم الهاتف 2: <?= $vente['telephone2'] ?></p>
                </div>
            </div>
            <div class="side-by-side">
                <div class="name">
                    <p>العنوان: <?= $vente['adresse'] ?></p>
                </div>
            </div>

            <style>
              .note-box {
    width: 70%; /* Adjust the width as per your preference */
    margin: 50px auto; /* This will center the box horizontally and give it a margin from the top */
    padding: 20px;
    border: 2px solid #0d3073; /* You can change the color as per your preference */
    border-radius: 8px; /* To give rounded corners */
    text-align: center; /* To center the text inside the box */
    font-size: 18px; /* Adjust the font size as per your preference */
    line-height: 1.6; /* Adjust the line height as per your preference */
    background-color: #f9f9f9; /* Add a background color to indicate it's editable */
}


            </style>
            <div class="cote-a-cote">
            <div class="note-box" contenteditable="true">
            <strong>ملاحظة: </strong>
</div>

</div>

</div>
</div>
<br>
<table class="mtable">
    <tr>
        <th>التسمية</th>
        <th>الكمية</th>
        <th>السعر الوحدة</th>
        <th>السعر الإجمالي</th>

                    
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
            
                        <tr>
                            <td>
                                <a href="recuvente.php?id=<?= $vente['idvente'] ?>" class="link-no-style"><?= $vente['nomproduit'] ?></a>
                            </td>
                            <td>
                                <?= $vente['quantite'] ?>
                            </td>
                            <td>
                                <?= $vente['prix'] ?>
                            </td>
                                <?php
                                  $prixtotal= $vente['quantite'] * $vente['prix'];
                                ?>
                            <td>
                                <?=$prixtotal ?>
                            </td>
                        </tr>
                       

            </table>
</div>


</div>
</section>
<?php
include "pied.php";
?>
<script>
 var btnprint = document.querySelector('#btnprint'); 
    btnprint.addEventListener('click',  ()=> {
        btnprint.disabled = true;
    window.print();
        });
function setPrix() {
    var article = document.querySelector('#id_article');
    var quantite = document.querySelector('#quantite');
    var prix = document.querySelector('#prix');

    
    var prixunitaire = article.options[article.selectedIndex].getAttribute('data-prix');

   
    prix.value = Number(quantite.value) * Number(prixunitaire);
}

</script>