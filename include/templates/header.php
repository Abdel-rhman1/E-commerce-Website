<?php
  // session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php gettitle(); ?></title>
        <link rel="stylesheet" href="<?php echo $css ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $css ?>fontawesome.min.css">
        <link rel="stylesheet" href="<?php echo $css ?>jquery-ui.css">
        <link rel="stylesheet" href="<?php echo $css ?>jquery.selectBoxIt.css">
        <link rel="stylesheet" href="<?php echo $css ?>backend.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="upper-bar">
    <i class="fa fa-bars menu col-sm-1" aria-hidden="true" style="float:left"></i>
        <div class='container'>
          <?php 
            if(isset($_SESSION['User'])){
              $ID=$_SESSION['User_ID'];
              $conn=mysqli_connect('localhost:3307','root','','shop');
              $stat="select * from users3 where user_id='$ID'";
              $ex=mysqli_query($conn,$stat);
              $row=mysqli_fetch_assoc($ex);
              $stat="select * from ordering where Member_ID='$ID'";
              $exc=mysqli_query($con,$stat);
              $count=mysqli_num_rows($exc);
              ?>
              <a href='ordering.php?do=manage' class='cart pull-right'>
              <i class="fa fa-cart-plus" style="
                  font-size: 35px;
                  margin-right: 22px;
                  line-height: 42px;
                "aria-hidden="true">
                  <span class='number'><?php echo $count; ?></span>
                </i>
              </a>
           <?php }else{?>
            
                <a href='login.php' class='styling'>
                    <span class="pull-right">
                        Login
                    </span>
                </a>
                              
            <?php 
              }
            ?>  
            
       </div>
       
    </div>
    <div class="canvas-background">
    </div>
    <div class="uppear-menu txet-center">
        <div class="Person">
            <?php if(!empty($row['avatar'])){
                    echo "<img 
                    class='my-img img-responsive img-thumbnail block-center img-circle col-xs-offset-2'
                    src='admin/Uploads/Avatars/".$row['avatar']. "' alt=''/>";
                  }else{
                      echo "<img class='my-img img-responsive img-thumbnail block-center img-circle col-xs-offset-2'
                      src='img.png'alt=''>";
                  } 
            ?>
            <span class="lead">Hello,
            <?php
              if(isset($_SESSION['User'])){
                echo $_SESSION['User'];
              }else{
                echo "<a class='lead'href='login.php'>Sing In</a>";
              }
            ?>  </span>
        </div>
        <div>
        <ul class="cat">
          <li><a href="profile.php#id=My_Items">My Ads</a></li>
          <li><a href="newad.php">New Ad</a></li>
          <?php 
            $ID=isset($_SESSION['User_ID'])?$_SESSION['User_ID']:0;
          ?>
          <li><a href="logout.php?ID=<?php echo $ID?>">Logout</a></li>
        </ul>
        <hr class="custom-hr">
          <ul class="cat">
            <li>SHOP BY CATEGORY</li>
            <?php 
                $Cats=getCat('categories3','ID','where Parent=0');
                while($Cat=mysqli_fetch_assoc($Cats)){
                    $ID=$Cat['ID'];
                    $name=$Cat['Name'];
                    echo "<li><a href='category.php?Page_ID=$ID&Cat_Name=$name'>$name <i class='fa fa-sort-desc pull-right' aria-hidden='true'></i></a></li>";
                    $childs=getCat("categories3","ID","where Parent='$ID'");
                    // $ex2=mysqli_query($con,$childs);
                    while($child=mysqli_fetch_assoc($childs)){
                      $childName=$child['Name'];
                      echo "<ul>";
                      echo "<li><a href='category.php?Page_ID=$ID&Cat_Name=$name'>$childName<i class='fa fa-sort-desc pull-right' aria-hidden='true'></i></a></li>";
                      echo "</ul>";
                    }
                   
                    // echo "<li><a href='category.php?Page_ID=$ID&Cat_Name=$name'>".$Cat['Name']."</a></li>";
                } 
            ?>
          </ul>
          <hr class="custom-hr">
          <ul class="cat">
            <li>HELP & SETTING </a></li>
            <li> <a href="profile.php"> Your Account </a> </li>
            <li><a href="#"><i style="font-size: 18px;cursor: pointer;margin-right: 6px;" class="fa fa-globe" aria-hidden="true"></i> English</a></li>
            <li><img src="Cars/203024.svg" class="img"><a href="#">Egypt</a></li>
            <li> <a href="#"><i style="font-size: 18px;cursor: pointer;margin-right: 6px;"class="fa fa-question-circle" aria-hidden="true"></i>Help</a></li>
            <li> <a href="#"><i style="font-size: 18px;cursor: pointer;margin-right: 6px;" class="fa fa-cogs" aria-hidden="true"></i>Setting</a></li>
          </ul>
        </div>
    </div>
    <span class="exit">X</span>
    <nav class="navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
          <?php echo lang('Home_Admin'); ?>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
            <?php 
                $Cats=getCat('categories3','ID','where Parent=0');
                while($Cat=mysqli_fetch_assoc($Cats)){
                    $ID=$Cat['ID'];
                    $name=$Cat['Name'];
                    if($ID==2){
                      echo "<li class='hoverLink'><a href='category.php?Page_ID=$ID&Cat_Name=$name'>".$Cat['Name']."</a></li>";
                    }
                    else{
                        echo "<li><a href='category.php?Page_ID=$ID&Cat_Name=$name'>".$Cat['Name']."</a></li>";
                    }
                }
               
            ?>
      </ul>
     
    </div><!-- /.navbar-collapse -->
    <div class='Hover'>
          <ul class='list-unstyled'>
              <h5>Shop By Brand</h5>
              <li>Dell</li>
              <li>Lenovo</li>
              <li>HP</li>
              <li>Acier</li>
              <li>Asus</li>
              <li>Sumsung</li>
              <li>Apple</li>
          </ul>
          <ul class='list-unstyled'>
              <h5>Shop By Price</h5>
              <li>Dell</li>
              <li>Lenovo</li>
              <li>HP</li>
              <li>Acier</li>
              <li>Asus</li>
              <li>Sumsung</li>
              <li>Apple</li>
          </ul>
          <ul class='list-unstyled'>
              <h5>Tablets</h5>
              <li>Dell</li>
              <li>Lenovo</li>
              <li>HP</li>
              <li>Acier</li>
              <li>Asus</li>
              <li>Sumsung</li>
              <li>Apple</li>
          </ul>
          <img src='Images/Best-Sellers.jpg' class='img-responsive imga'></img>
          <img src='Images/Feature-Phone.jpg' class='img-responsive imga'></img>
    </div>
  </div><!-- /.container-fluid -->
  <?php 
    ob_end_flush();
  ?>
</nav>