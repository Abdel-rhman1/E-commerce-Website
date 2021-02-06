<?php 
     ob_start();
    session_start();
    $title="Profile";
    include "init.php";
    if(isset($_SESSION['User'])){
        $ID=isset($_GET['ID'])?$_GET['ID']:$_SESSION['User_ID'];
        $User=$_SESSION['User'];
        $stat="select * from users3 where user_id='$ID'";
        $excute=mysqli_query($con,$stat);
        $res=mysqli_fetch_assoc($excute);
?>
<div class="information">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Your information
            </div>
            <div class="panel-body">
                <ul class="list-unstyled">
                    <li>
                        <i class='fa fa-unlock-alt fa-fw'></i>
                       <span>Login Name:</span> <?php echo $res['user_name']; ?>
                    </li>
                    <li>
                    <i class='fa fa-envelope-o fa-fw'></i>
                        <span>Email:</span><?php echo $res['user_email'];?>
                    </li>
                    <li>
                    <i class='fa fa-user fa-fw'></i>
                    <span>User Name:</span> <?php echo $res['user_fullName'];?>
                    </li>
                    <li>
                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                        <span>Whattsap:</span> <a href='https://api.whatsapp.com/send?phone=<?php echo $res['Number']; ?>'> <?php echo $res['Number']?></a>
                    </li>
                    <li>
                    <i class='fa fa-calendar fa-fw'></i>
                    <span>Register Date:</span>  <?php echo $res['Date']."<br/>"?>
                    </li>
                    <li>
                    <i class='fa fa-tags fa-fw'></i>
                    <span>Faveiort Item:</span>
                    </li>
                </ul>
                <a class="btn btn-primary" href="#">Edit Information</a>
                <div class="img-profile">
                <?php
                    $image;
                    if(isset($res['avatar'])){
                        $image=$res['avatar'];
                    }
                    if(!empty($image)){
                        echo "<img class='img-responsive strylingImage'
                        src='admin/Uploads/Avatars/$image'>";
                    }else{
                        echo "<img class='img-responsive strylingImage'src='img.png'>";
                    }
                    if($res['Online']==1){
                        echo "<span></span><span>Online</span>";
                    }else{
                        echo "<span>Offline</span> <br/>";
                        $last=$res['Last'];
                        $dd=explode(' ',$last);
                        echo "<span>Last existing : $dd[0]</span><br/>";
                        echo "<span>At: ";echo $dd['1']; echo"</span>";
                    }
                    ?>
        </div>
            </div>
        </div>
    </div>
</div>
<div id="My_Items"class="my-ads">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Your Ads
            </div>
            <div class="panel-body">
                <?php 
                    $Items=GETITEMS('Member_ID',$res['user_id']);
                    while($Cat=mysqli_fetch_assoc($Items)){
                 echo "<div  
                        style='box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); height:365px'class='col-xs-6 col-md-2 col-sm-3'>";
                    
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
    </div>
</div>
<div class="my-comment">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Leatest Comments
            </div>
            <div class="panel-body">
                <?php
                    $ID=$res['user_id'];
                    $stat="select Comment from comments where Member_ID='$ID'";
                    $excute=mysqli_query($con,$stat);
                    $count=mysqli_num_rows($excute);
                    if($count>0){
                        while($Comment=mysqli_fetch_assoc($excute)){
                            echo $Comment['Comment']."<br/>";
                        }
                    }else{
                        echo "<div class='alert alert-danger'>There's No Comment To show It</div>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php } else{
    header('Location:login.php');
}
include $tbl.'footer.php'; 
ob_end_flush();
?>