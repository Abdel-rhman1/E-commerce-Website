<?php 
    ob_start();
    session_start();
    include "init.php";

    if(isset($_SESSION['User_ID'])){
        $do=isset($_GET['do'])? $_GET['do']:'manage';
        if(isset($_GET['do'])){
            if($_GET['do']=='delete'){
                delteitem($_GET['id']);
                header("refresh:0;url=ordering.php");
                exit();
            }
        } 
        if($do=='manage'){
            $memberId=$_SESSION['User_ID'];
            echo "<h2>Shopping Card</h2>";
            echo "<a href='?do=Delete'>Delete All Items</a>";
            echo "<hr class='custom-hr'>";
        echo "<div class='container Products'>";
        echo "<div class='row'>";
        $stat="select ordering.*,ordering.ID as OrID , item3.* from ordering 
        inner join item3 on (ordering.CatID=item3.ID)
        where ordering.Member_ID='$memberId'";
        $var=mysqli_query($con,$stat);
        $TotalPrice=0;
        while($Cat=mysqli_fetch_assoc($var)){
             $TotalPrice+=(int)$Cat['Price'];
            echo "<div class='col-sm-3 col-md-3 itemordering'>";
                echo "<div class='thumbnail Item-box'>";
                    echo "<span class='Price'>". $Cat['Price']."</span>";
                    echo "<span class='pull-right head'> 
                        <i class='fa fa-heart-o' aria-hidden='true'></i>        
                        </span>";
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
                    $ordID=$Cat['OrID'];
                    echo "<h3><a href='item.php?Item_ID=$ID'>".$Cat['Name']."</a></h3>";
                    echo "<p>".$Cat['Description']."</p>";
                echo "</div>";
                echo "<div class='orderDe'> 
                    <a href='ordering.php?do=delete&id=$ordID'>
                        <i class='fa fa-times' aria-hidden='true'></i>
                    </a>
                </div>";        
            echo "</div>";
        }
        echo "</div>";
        echo "<hr class='custom-hr'>";
        $memberId=$_SESSION['User_ID'];
        $stat="select * from ordering where Member_ID='$memberId'";
        $exc=mysqli_query($con,$stat);
        $count=mysqli_num_rows($exc);
        echo "<span class='col-sm-offset-10'> Subtotal ($count item): $TotalPrice $ </span>";
    echo "</div>";
        }elseif($do=='Add'){
            $memberId=$_SESSION['User_ID'];
            $itemID=isset($_GET['ID']) && is_numeric($_GET['ID']) ? $_GET['ID']:0;
            $stat="insert into ordering(Member_ID,CatID,Date) values('$memberId','$itemID',now())";
            $exc=mysqli_query($con,$stat);
            header('Location: ' .$_SERVER['HTTP_REFERER']);
        }else if($do=='Delete'){
            $memberId=$_SESSION['User_ID'];
            $stat="DELETE FROM `ordering` WHERE Member_ID='$memberId'";
            $exc=mysqli_query($con,$stat);
            header('Location:ordering.php');
        }
    }else{
        header('Location:login.php');
    }
?>
<?php 
    include $tbl.'footer.php';
    ob_end_flush();
?>