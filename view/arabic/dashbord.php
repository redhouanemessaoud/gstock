<?php
include "entete.php";

?>


<style>
    .overview-boxes .boxdash {
  display: flex;
  align-items: center;
  justify-content: center;
  width: calc(100/ 4 + 15px);
  background: #fff;
  padding: 15px 14px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
</style>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">الطلب</div>
                <div class="number"><?php echo  getallcommande()['nbre'] ?></div>
                <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">منذ أمس</span>
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
                    <span class="text">منذ أمس</span>
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
                    <span class="text">منذ أمس</span>
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

    <div class="sales-boxes">
        <div class="recent-sales box">
            <div class="title">المبيعات الأخيرة</div>
            <?php
                $vente = getlastVente();
            ?>
            <div class="sales-details">
                <ul class="details">
                    <li class="topic">التاريخ</li>
                    <?php
                        foreach ($vente as $key => $value) {
                    ?>
                    <li><a href="#"><?php echo date('d/M/Y ',strtotime($value['datevente'])) ?></a></li>
                    <?php
                        }
                    ?>
                </ul>
                <ul class="details">
                    <li class="topic">العميل</li>
                    <?php
                        foreach ($vente as $key => $value) {
                    ?>
                    <li><a href="#"><?php echo ($value['nom'].' '. $value['prenom'])?></a></li>
                    <?php
                        }
                    ?>
                </ul>
                <ul class="details">
                    <li class="topic">المنتج</li>
                    <?php
                        foreach ($vente as $key => $value) {
                    ?>
                    <li><a href="#"><?php echo ($value['reference'])?></a></li>
                    <?php
                        }
                    ?>
                </ul>
                <ul class="details">
                    <li class="topic">السعر</li>
                    <?php
                        foreach ($vente as $key => $value) {
                    ?>
                    <li><a href="#"><?php echo number_format($value['prix'],0,',',' ')?></a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <div class="button">
                <a href="vente.php">عرض الكل</a>
            </div>
        </div>
        <div class="top-sales box">
            <div class="title">المنتج الأكثر مبيعًا</div>
            <?php
                $article = getmostvente();
            ?>
            <ul class="top-sales-details">
                <?php
                    foreach ($article as $key => $value) {
                ?>
                <li>
                    <a href="#">
                        <!--<img src="images/sunglasses.jpg" alt="">-->
                        <span class="product"><?php echo ($value['reference'])?></span>
                    </a>
                    <span class="price"><?php echo number_format($value['prix'],0,',',' ') ?></span>
                </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</div>
</section>

    
    <?php
include "pied.php"
?>