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
.overview-boxes {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px; /* adjust this value as per your requirement */
}

.custom-boxes .overview-boxes {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px; /* adjust this value as per your requirement */
}

.container {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}

/* Form Styles */
form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

input[type="date"] {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-success {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}

.btn-success:hover {
    background-color: #45a049;
}

</style>




      <div class="home-content">
      <div style="display:block;" class="box">
    <!-- Form for Category Search -->
    <form action="" method="get">
        <!-- ... (Existing table and other form elements) ... -->
        
        <!-- Date Input Fields -->
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date">
        
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date">
        
        <br>
        <button type="submit" class="btn btn-success">valider</button>
    </form>
    <br><br><br>

    
</div>

<?php 
$start_date = !empty($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = !empty($_GET['end_date']) ? $_GET['end_date'] : null;
?>
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Commande</div>
              <div class="number"><?php echo  getallcommande($start_date,$end_date )['nbre'] ?></div>
              
            </div>
            <i class="bx bx-cart-alt cart"></i>
          </div>
          
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Vente</div>
              <div class="number"><?php echo  getallvente($start_date,$end_date)['nbre'] ?></div>
              
            </div>
            <i class="bx bxs-cart-add cart two"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Profit</div>
              <div class="number"><?php echo number_format(getca($start_date,$end_date)['nbre'],0,',',' ')  ?></div>
            
            </div>
            <i class="bx bx-cart cart three"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">perte</div>
              <div class="number"><?php echo number_format(getcom($start_date,$end_date)['nbre'],0,',',' ')  ?></div>
              
            </div>
            <i class="bx bxs-cart-download cart four"></i>
          </div>
        </div>
        
        
        <div class="home-content">
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">nette</div>
              <div class="number"><?php echo  getallnette($start_date,$end_date)['nbre'] ?></div>
              
            </div>
            <i class="bx bx-cart-alt cart"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Nombre de client</div>
              <div class="number"><?php echo number_format(getallc($start_date,$end_date)['nbre'],0,',',' ')  ?></div>
            
            </div>
            <i class="bx bx-cart cart three"></i>
          </div>
          
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Revenue apart</div>
              <div class="number"><?php echo number_format(getca($start_date, $end_date)['nbre'] - getallnette($start_date, $end_date)['nbre']); ?></div>

              
            </div>
            <i class="bx bxs-cart-add cart two"></i>
          </div>
          
        </div>
        </div>
        
        

    
   

    
      </div>
    </section>
    
    <?php
include "pied.php"
?>