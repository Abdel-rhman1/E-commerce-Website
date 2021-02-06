<?php 
    session_start();
    include "init.php"; 
    include "cars.php";    
?>
    <div class="container Products">
        <?php 
            $Name=isset($_GET['Cat_Name']) && is_string($_GET['Cat_Name'])? $_GET['Cat_Name']:'';
            echo "<h1 class='text-center'>$Name</h1>";
        ?>
        <div class="row">
       <?php 
            $var=GETITEMS('Cat_ID',$_GET['Page_ID'],'and approve=1');
            while($Cat=mysqli_fetch_assoc($var)){
                echo "<div  
                        style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);'class='col-xs-6 col-md-2 col-sm-3'>";
                    
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
                    if($_GET['Page_ID']==6){
                        echo "<div class='download'>";
                            $ID=$Cat['ID'];
                            echo "<span class='Download'><a href='Download.php?do=Down&ID=$ID'>
                                <i class='fa fa-download' aria-hidden='true'></i>
                            </a></span>";
                            echo "<span class='View'><a href='Download.php?do=View&ID=$ID'>
                                <i class='fa fa-eye' aria-hidden='true'></i>
                            </a></span>";
                        echo "</div>";
                    }
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
            if($_GET['Page_ID']==7){
                echo '<div class="row">';
                echo '<div class="col-sm-4">';
                   echo  '<video
                   poster="Images/PHP-code-58d2d5803df78c51623a6ce2.jpg"
                            width="320" height="240" 
                            controls>
                        <source src="Images/PHPSecurity Tips.mp4" type="video/mp4">
                        <source src="Images/PHPSecurity Tips.mp4" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>';
                echo "</div>";
                echo '<div class="col-sm-4">';
                echo  '<video 
                        poster="Images/PHP-code-58d2d5803df78c51623a6ce2.jpg"
                        width="320" height="240"
                         controls>
                        <source src="Images/PHPSecurity Tips.mp4" type="video/mp4">
                        <source src="Images/PHPSecurity Tips.mp4" type="video/ogg">
                        Your browser does not support the video tag.
                </video>';
                echo '</div>';
                echo '<div class="col-sm-4">';
                echo  '<video width="320" height="240"
                        poster="Images/PHP-code-58d2d5803df78c51623a6ce2.jpg" 
                        controls>
                        <source src="Images/PHPSecurity Tips.mp4" type="video/mp4">
                        <source src="Images/PHPSecurity Tips.mp4" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>';
                    echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
            
        </div>
    </div>
<?php 
    include $tbl.'footer.php';
    include 'End.php';
?>