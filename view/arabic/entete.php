<?php
session_start();
include_once "../../model/fonction.php";
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title><?php
 
 echo   ucfirst(str_replace(".php","",basename($_SERVER["PHP_SELF"])));
 


?></title>
    <link rel="stylesheet" href="../../public/css/style.css" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    
    <div id="sidebar" class="sidebar">
      <div class="logo-details">
        <i class="bx bxl-c-plus-plus"></i>
        <span class="logo_name">موسم الأثاث</span>
      </div>
      <ul class="nav-links">
      <div style="text-align: center;">
    <a href="../dashbord.php" style="color: white;">fr</a> | <a href="" style="color: white;">ع</a>
</div>

        <li>
          <a href="dashbord.php" class=" <?php  basename($_SERVER["PHP_SELF"])== "dashbord.php"? "active" : ""?>">
          <i class=""><img src="../../public/img/dash.svg" alt=""></i>
            <span class="links_name">لوحة التحكم</span>
          </a>
        </li>
        <li>
          <a href="article.php" class="<?php  basename($_SERVER["PHP_SELF"])== "article.php"? "active" : ""?>">
          <i class="" ><img src="../../public/img/bx--box.svg" alt=""></i>
            <span class="links_name">المنتجات</span>
          </a>
        </li>
        <li>
    <a href="Vente.php" class="<?php  basename($_SERVER["PHP_SELF"])== "Vente.php"? "active" : ""?>">
    <i class=''><img src="../../public/img/bx--shopping-bag.svg" alt=""></i>
        <span class="links_name">المبيعات</span>
    </a>
</li>
<li>
    <a href="client.php"  class="<?php  basename($_SERVER["PHP_SELF"])== "client.php"? "active" : ""?>">
    <i class="bx--user.svg"><img src="../../public/img/bx--user.svg" alt=""></i>
        <span class="links_name">العملاء</span>
    </a>
</li>
<li>
    <a href="fournisseur.php">
    <i class="bx--user.svg"><img src="../../public/img/bx--user.svg" alt=""></i>
        <span class="links_name">الموردين</span>
    </a>
</li>
<li>
    <a href="commandes.php">
    <i class=""><img src="../../public/img/bx--list-ul.svg" alt=""></i>
        <span class="links_name">الطلبات</span>
    </a>
</li>
<li>
    <a href="categorie.php"  class="<?php  basename($_SERVER["PHP_SELF"])== "categorie.php"? "active" : ""?>">
    <i class="bx--cog.svg"><img src="../../public/img/bx--cog.svg" alt=""></i>
        <span class="links_name">الفئات</span>
    </a>
</li>
<li>
    <a href="dashbordd.php" class=" <?php  basename($_SERVER["PHP_SELF"])== "dashbord.php"? "active" : ""?>">
    <i class="bx--grid-alt.svg"><img src="../../public/img/bx--grid-alt.svg" alt=""></i>
        <span class="links_name">التحليلات</span>
    </a>
</li>
       

        </li>
       
        <li>
          <a href="stock.php">
          <i class=""><img src="../../public/img/bx--coin-stack.svg" alt=""></i>
            <span class="links_name">مخزون</span>
          </a>
        </li>
        <li>
          <a href="tableaux.php">
          <i class="bx--book-alt.svg"><img src="../../public/img/bx--book-alt.svg" alt=""></i>
            <span class="links_name">فائدة</span>
          </a>
        </li>
        
        <!-- <li>
          <a href="#">
            <i class="bx bx-message" ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-heart" ></i>
            <span class="links_name">Favrorites</span>
          </a>
        </li> -->
      
      
      </ul>
    </div>
    <section class="home-section">
      <nav id="nav">
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard"><?php
 
              echo   ucfirst(str_replace(".php","",basename($_SERVER["PHP_SELF"])));
              


              ?>


          </span>

                  <!--</div>
                  <div class="search-box">
                    <input type="text" placeholder="Recherche..." />
                    <i class="bx bx-search"></i>
                  </div>-->

                  <style>
    .highlight {
        color: white !important;
    }

    .highlight-red {
        background-color: #FF6F61 !important; /* Coral color */
    }

    .highlight-green {
        background-color: #77DD77 !important; /* Pastel green color */
    }

    .active .profile-details {
        /* Adjust margin or positioning as needed */
        margin-left: 750px;
    }

    .notactive {
        display: none;
    }

    .button-container {
    width: auto;
    height: auto;
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
}

.my-button {
    font-size: 14px;
    color: #ffffff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-family: 'Roboto', sans-serif;
    transition: background-color 0.3s;
    border-radius: 5px;
}

.my-button:hover {
    
}
</style>

<?php
$venteToday = getVentetoday();
?>

<div class="<?= basename($_SERVER["PHP_SELF"]) == "dashbord.php" ? 'active' : 'notactive'; ?>">
<div class="button-container">
    
        <div class="profile-details <?= !empty($venteToday) ? 'highlight highlight-red' : 'highlight highlight-green'; ?>">
        <a href="today.php" class="my-button" style="text-decoration: none;">    
        <span style='color:white;'style="justify-element:center" >طلبات اليوم</span>
        </a>
        </div>
  
</div>
</div>
         


      </nav>
      