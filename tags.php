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
                echo "<div class='col-sm-6 col-md-3'>";
                    echo "<div class='thumbnail Item-box'>";
                        echo "<span class='Price'>". $Cat['Price']."</span>";
                        echo "<img class='img-responsive'src='img.png'alr='Item-Image'>";
                    echo "</div>";
                    echo "<div class='caption'>";
                        $ID=$Cat['ID'];
                        echo "<h3><a href='item.php?Item_ID=$ID'>".$Cat['Name']."</a></h3>";
                        echo "<p>".$Cat['Description']."</p>";
                    echo "</div>";
                echo "</div>";
            } 
       ?>
        </div>
    </div>
<?php include $tbl.'footer.php';?>