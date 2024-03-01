<?php
include "entete.php";

if (!empty($_GET['id'])) {
    $client = getClient($_GET['id']);
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
        <form action="<?= !empty($_GET['id']) ? "../../model/modifierclient.php" : "../../model/ajoutclient.php" ?>" method="post">
    <label for="nom">اسم العميل</label><br>
    <input value="<?= !empty($_GET['id']) ? $client['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder="يرجى إدخال الاسم">
    <input value="<?= !empty($_GET['id']) ? $client['id'] : "" ?>" type="hidden" name="id" id="id">
    <br>

    <label for="prenom">الاسم الأول</label><br>
    <input value="<?= !empty($_GET['id']) ? $client['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder="يرجى إدخال الاسم الأول">

    <br><label for="telephone1">الهاتف 1</label><br>
    <input value="<?= !empty($_GET['id']) ? $client['telephone1'] : "" ?>" type="text" name="telephone1" id="telphone1" placeholder="يرجى إدخال رقم الهاتف">

    <br><label for="telephone2">الهاتف 2</label><br>
    <input value="<?= !empty($_GET['id']) ? $client['telephone2'] : "" ?>" type="text" name="telephone2" id="telephone2" placeholder="يرجى إدخال رقم هاتف آخر">

    <br><label for="address">العنوان</label><br>
    <input value="<?= !empty($_GET['id']) ? $client['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder="يرجى إدخال عنوان العميل">

    <button type="submit" class="btn-valide">تأكيد</button>
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
    /* General Table Styles */
    table.mtable {
        width: 100%;
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
        margin-bottom: 20px; /* Add margin for better spacing */
    }

    th, td {
        text-align: left;
        padding: 16px;
    }

    table.mtable, td {
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

    /* Responsive Styles */
    @media (max-width: 600px) {
        table.mtable, th, td {
            font-size: 14px; /* Adjust font size for small screens */
        }

        table.mtable th, table.mtable td {
            padding: 10px; /* Adjust padding for small screens */
        }
    }

    @media (max-width: 400px) {
        table.mtable th, table.mtable td {
            padding: 8px; /* Further adjust padding for smaller screens */
        }
    }
</style>

        <div class="box">
            <table class="mtable">
                <tr>
                <th>الاسم</th>
<th>الاسم الأول</th>
<th>الهاتف 1</th>
<th>الهاتف 2</th>
<th>العنوان</th>

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
                   $clients = getClient();
                   if (!empty($clients) && is_array($clients)) {
                       foreach ($clients as $key => $value) {
                ?>
                    <tr>
                        <td>
                            <a href="?id=<?= $value['id'] ?>" class="link-no-style"><?= $value['nom'] ?></a>
                        </td>
                        <td>
                            <?= $value['prenom'] ?>
                        </td>
                        <td>
                            <?= $value['telephone1'] ?>
                        </td>
                        <td>
                            <?= $value['telephone2'] ?>
                        </td>
                        <td>
                            <?= $value['adresse'] ?>
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
