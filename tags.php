<?php  include "init.php"; ?>
    <div class="container">
        <h1 class="text-center"></h1>
        <div class="row">
       <?php 
           $TagName=isset($_GET['name'])?$_GET['name']:'Wrong';
           echo "<h1 class='text-center'>".$TagName ."</h1>";
           $stat="select * from item3 where Tags like '%$TagName%'and approve=1";
           $excut2=mysqli_query($con,$stat);
            while($Cat=mysqli_fetch_assoc($excut2)){
                echo "<div  
                        style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); height: 365px'class='col-xs-6 col-md-2 col-sm-3'>";
                    echo "<div class='thumbnail Item-box'>";
                        echo "<span class='Price'>". $Cat['Price']."</span>";
                        if(!empty($Cat['Image'])){
                            echo "<img class='img-responsive Item-image'
                            src='admin\Uploads\Item_Images\\".$Cat['Image']."'alt=''/>";
                        }else{
                            echo "<img class='img-responsive Item-image'
                            src='new-feature-product-badge-symbol-600w-618521990.jpg'alt=''/>";
                        }      
                    echo "</div>";
                    echo "<div class='caption'>";
                        $ID=$Cat['ID'];
                        echo "<h3><a href='item.php?Item_ID=$ID'>".$Cat['Name']."</a></h3>";
                        // echo "<p>".$Cat['Description']."</p>";

                        if(strlen($Cat['Description']) > 17){
                            echo "<p class='text-center'>".substr($Cat['Description'],0,17)."...</p>";
                        }else{
                            echo "<p class='text-center'>".$Cat['Description']."</p>";
                        }
                         echo "<div class='AddToCart'>";
                         echo "<a href='ordering.php?do=Add&ID=$ID'>Add To Card</a>";
                     echo "</div>";
                    echo "</div>";
                echo "</div>";
            } 
       ?>
        </div>
    </div>
<?php include $tbl.'footer.php';?>