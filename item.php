<?php
    session_start();
    include "init.php";
    
    $title="Show Item Page";
    $Item_ID=isset($_GET['Item_ID']) && is_numeric($_GET['Item_ID'])?$_GET['Item_ID']:0;
    $stat="Select
                item3.* , users3.user_name,users3.Number as phone,categories3.Name as Cat_Name
            from 
                item3 
            inner join 
                users3 
            on 
                (item3.Member_iD=users3.user_id) 
            inner join 
                categories3 
            on 
                (item3.Cat_ID=categories3.ID)
            where 
                item3.ID='$Item_ID'
            AND
            item3.approve=1
            ";
    $excute=mysqli_query($con,$stat);
    $count=mysqli_num_rows($excute);
    if($count>0){
        $Res=mysqli_fetch_assoc($excute);
?>
<h1 class='text-center'><?php if(isset($Res['Name'])){echo $Res['Name'];}?></h1>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
                if(!empty($Res['Image'])){
                    echo "<img
                        class='center-block img-responsive img-thumbnail' 
                        src='admin\Uploads\Item_Images\\".$Res['Image']."'alt=''/>";
                }else{
                    echo "<img
                        class='center-block img-responsive img-thumbnail' 
                        src='new-feature-product-badge-symbol-600w-618521990.jpg'alt=''/>";
                }
            ?>
        </div>
        <div class="col-md-9 item-info">
            <h2><?php echo $Res['Name']?></h2>
            <p> <?php echo $Res['Description']?></p>
            <ul class="list-unstyled">
                <li>
                    <i class="fa fa-calendar fa-fw"></i> 
                    <span>Added Date: </span> 
                    <?php echo $Res['Add_Date']?></li>
                <li> 
                    <i class="fa fa-money fa-fw"></i>
                    <span>Price: </span> 
                    <?php echo $Res['Price']?></li>
                <li>
                    <i class="fa fa-building fa-fw"></i> 
                    <span>Made In: </span> 
                    <?php echo $Res['Country_made']?></li>
                <li>
                    <i class="fa fa-user fa-fw"></i> 
                    <?php 
                        $ID=$Res['Cat_ID'];
                        $MID=$Res['Member_ID'];
                     ?>
                    <span>Added By: </span><?php echo "<a href='profile.php?ID=$MID'>"?>
                    <?php echo $Res['user_name']?></a>
                </li>
                <li> 
                    <i class="fa fa-tags fa-fw"></i>
                    <span>Include To: </span> <?php echo "<a href='category.php?Page_ID=$ID'?>"?>
                    <?php echo $Res['Cat_Name']?></a>
                </li>
                <li> 
                    <i class="fa fa-tags fa-fw"></i>
                    <?php $phone=$Res['phone']; ?>
                    <span>Whattsap: </span> <?php echo "<a href='https://api.whatsapp.com/send?phone=$phone'";
                    echo $Res['phone'];?></a>
                </li>
                    <li> 
                        <i class="fa fa-tags fa-fw"></i>
                        <span>Tags</span>
                        <?php
                            $alltags=explode(',',$Res['Tags']);
                            foreach ($alltags as $tag) {
                                $tag=str_replace(' ','',$tag);
                                echo "<a href='tags.php?name=$tag'>$tag</a>"."|";
                            } 
                        ?>
                    </li>
            </ul>
        </div>
    </div>
    <hr class="custom-hr">
    <?php  if(isset($_SESSION['User_ID'])){?>
        <div class="row">
            <div class="col-sm-offset-2 col-xs-offset-1">
                <div class="add-comment">
                    <h3>Add Your comment</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] .'?Item_ID=' . $Res['ID'];?>"method="post">
                        <textarea name="comment"></textarea>
                        <input type="submit"class="btn btn-primary btn-md" value="Add comment">
                    </form>
                    <?php
                        if($_SERVER['REQUEST_METHOD']=='POST'){
                            $comment=filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
                            $userid=$_SESSION['User_ID'];
                            $itemid=$Res['ID'];
                            if(!empty($comment)){
                            $stat="INSERT INTO comments(Comment,Status,Date,Item_ID,Member_ID)
                            VALUES('$comment',0,NOW(),'$itemid','$userid')";
                            $excute=mysqli_query($con,$stat);
                            if($excute){
                                echo "<div class='alert alert-success'>Added Comment</div>";
                            }else{
                                echo "<div class='alert alert-danger'>No Added Comment</div>";
                            }
                        }else{
                            echo "<div class='alert alert-danger'>Comment Must Be Larger Than 10 Characters</div>";
                        }
                        }else{

                        }
                    ?>
                </div>
            </div>
        </div>
    <?php }else{
        echo "<a href='login.php'>Login</a> Or<a href='login.php'> Register</a> To Add Your Comment";}?>
        <?php
            $ID=$Res['ID'];
            $stat="SELECT comments.*,users3.user_name
            from comments inner join users3
            on(comments.Member_ID=users3.user_id)
            where Item_ID='$ID'
            And `Status`=1";
            $excute=mysqli_query($con,$stat);
        ?>
    <hr class="custom-hr">
    <h3 class="text-center">Send Message</h3>
    <form class="form-horizontal Contact-form" action="Sending.php" method="post">
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-6">
                <input
                    type="email"
                    name="clientEmail"
                    class="form-control clientEmail"
                    placeholder="Your Email"
                    >
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label class="col-sm-2 control-label">Message</label>
            <div class="col-sm-6">
                <textarea 
                    class="form-control Message"placeholder="Your Message"name="Message">
                </textarea>
            </div>
        </div>
        <div class="form-group form-group-lg">
            <div class="col-sm-6 col-sm-offset-2">
                <input type="submit"class="btn btn-primary btn-sm" value="Send">
            </div>
        </div>
    </form>
       <?php 
            while($Res=mysqli_fetch_assoc($excute)){
                echo "<div class='row'>";
                    echo 
                    "<div class='comment-box'>".
                        "<div class='col-md-2 text-center'>";
                            echo '<img class="center-block img-responsive img-circle img-thumbnail"src="img.png">';
                            echo $Res['user_name'];
                        echo "</div>";
                        echo "<div class='col-md-10 lead'>".$Res['Comment']."</div>";
                echo "</div>"."</div>"."<hr class='custom-hr'>";
            }       
       ?>
</div>
<?php 
    }else{
        echo "<div class='container'>";
            echo "<div class='alert alert-danger text-center'>There's No Item With This ID
            OR This Item Is Not Approved Yet
            </div>";
        echo "</div>";
    }
    include_once $tbl.'footer.php'; 
?>