<?php
include "entete.php";

if (!empty($_GET['id'])) {
    $categorie = getval($_GET['id']);
   
  
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
    <form action="<?= !empty($_GET['id']) ? "../../model/modifierval.php" : "../../model/ajouteval.php" ?>" method="post">
        <label for="min">الحد الأدنى</label><br>
        <input value="<?= !empty($_GET['id']) ? $categorie['min'] : "" ?>" type="text" name="min" id="min" placeholder="يرجى إدخال الاسم">
        
        <label for="max">الحد الأقصى </label><br>
        <input value="<?= !empty($_GET['id']) ? $categorie['max'] : "" ?>" type="text" name="max" id="max" placeholder="يرجى إدخال الاسم">
        
        <label for="val"> القيمة</label><br>
        <input value="<?= !empty($_GET['id']) ? $categorie['val'] : "" ?>" type="text" name="val" id="val" placeholder="يرجى إدخال الاسم">
        
        <input value="<?= !empty($_GET['id']) ? $categorie['id'] : "" ?>" type="hidden" name="id" id="id">

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
                <th>الحد الأدنى</th>
<th>الحد الأقصى</th>
<th>القيمة</th>

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
$categories = getval(); // Assuming you have a function getCategories to fetch the data

if (!empty($categories) && is_array($categories)) {
    foreach ($categories as $key => $value) {
        ?>
        <tr>
            <td>
                <a href="?id=<?= $value['id'] ?>" class="link-no-style"><?= $value['min'] ?></a>
            </td>
            <td>
                <a href="?id=<?= $value['id'] ?>" class="link-no-style"><?= $value['max'] ?></a>
            </td>
            <td>
                <a href="?id=<?= $value['id'] ?>" class="link-no-style"><?= $value['val'] ?></a>
            </td>
            <td>
                <a href="?id=<?= $value['id'] ?>" class="link-no-style"><i class='bx bx-edit-alt'></i></a>
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
