<?php 
    session_start();
    if(isset($_SESSION['username'])){
        include "init.php";
        $title="Home";
        ?>
        <div class="container home-stats text-center">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="stat st-members">
                        <i class="fa fa-users"></i>
                        <div class="info">
                            Total Members
                            <span><a href="member.php"><?php echo GetNumbers('user_id','users3')+1; ?>
                            </a></span>
                        </div>    
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-pending">
                        <i class="fa fa-user-plus"></i>
                        <div class="info">
                            Pending Members
                            <span><a href='member.php?page=Pending'>
                                <?php  echo GetNumbers('user_id','users3','
                                where regstatus=0')+1; ?>
                            </a></span>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-items">
                        <i class="fa fa-tag"></i>
                        <div class="info">
                            Total Item
                            <span><a href='Item.php'>
                                <?php  echo GetNumbers('ID','item3')+1; ?>
                            </a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat st-comments">
                        <i class="fa fa-comments"></i>
                        <div class="info">
                            Total Comments
                            <span ><a href='Comment.php'>
                                <?php
                                    echo GetNumbers('Comment_ID','comments')+1;
                                 ?>
                            </a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            $LeatestUser=6;
            $LeatestItem=6;
            $leatestComment=4;
         ?>
        <div class="container leatest">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                            <i class="fa fa-users"></i>
                            Leatest <?php echo $LeatestUser;?> Registered Users
                            <span class="toggle-info pull-right">
                            <i class="fa fa-plus fa-lg"></i>
                        </span>
                        </div>
                        
                        <div class="panel-body" >
                            <?php 
                        $var=getLeatest("*","users3","Date",$LeatestUser);
                        $count=mysqli_num_rows($var);
                        if($count!=0){
                        echo "<ul class='list-unstyled leatest-users'>";
                        while($row= mysqli_fetch_assoc($var)){
                            $id=$row['user_id'];
                            echo "<li>". $row['user_name'];
                            echo "<a href='member.php?do=Edit&user_id=$id'>";
                            echo "<span class='btn btn-success pull-right'>
                            <i class='fa fa-edit'></i>Edit</span></a>";
                            if($row['regstatus']==0){
                                echo "<a href='member.php?do=Active&user_id=$id' class='btn btn-info Active pull-right'>
                                        <i class='fa fa-check' ></i>Activate</a>";
                            }
                            echo"</li>";
                            
                        }
                        echo "</ul>";
                        }else{
                            echo "<div class='alert alert-danger'>";
                                echo "There Is No Record To Show";
                            echo "</div>";
                        }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tag"></i>
                            Leatest <?php echo $LeatestItem; ?> Items
                            <span class="toggle-info pull-right">
                            <i class="fa fa-plus fa-lg"></i>
                            </span>
                        </div>
                        <div class="panel-body" >
                        <?php
                             $var=getLeatest("*","item3","Add_Date",$LeatestItem);
                             if($count!=0){
                             echo "<ul class='list-unstyled leatest-users'>";
                             while($row= mysqli_fetch_assoc($var)){
                                 $id=$row['ID'];
                                 echo "<li>". $row['Name'];
                                 echo "<a href='Item.php?do=Edit&Item_ID=$id'>";
                                 echo "<span class='btn btn-success pull-right'>
                                 <i class='fa fa-edit'></i>Edit</span></a>";
                                 if($row['approve']==0){
                                     echo "<a href='Item.php?do=approve&Item_ID=$id' class='btn btn-info Active pull-right'>
                                             <i class='fa fa-check'></i>Approve</a>";
                                 }
                                 echo"</li>";
                                 
                             }
                             echo "</ul>";
                            }else{
                                echo "<div class='alert alert-danger'>";
                                    echo "There Is No Record To Show";
                                echo "</div>";
                            }
                             ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          
                            <i class="fa fa-comment-o"></i>
                            Leatest <?php echo $leatestComment; ?> Comments
                            <span class="toggle-info pull-right">
                            <i class="fa fa-plus fa-lg"></i>
                        </span>
                        </div>
                        <div class="panel-body" >
                            <?php 
                                $stat="select 
                                            comments.*, users3.user_name
                                        from 
                                            comments
                                        inner join 
                                            users3 
                                        on 
                                            (comments.Member_ID=users3.user_id)
                                        order by 
                                            Comment_ID DESC
                                        limit 
                                            4
                                        ";
                                $excute=mysqli_query($con,$stat);
                                $count=mysqli_num_rows($excute);
                                if($count!=0){
                                    while($row=mysqli_fetch_assoc($excute)){
                                        echo "<div class='comment-box'>";
                                            $ID=$row['Member_ID'];
                                            echo "<span class='member-n'
                                            ><a href='member.php?do=Edit&user_id=$ID'>";echo $row['user_name'];echo"</a></span>";
                                            echo "<span class='member-c'>"; echo $row['Comment'];echo"</span>";
                                        echo "</div>";
                                    }
                            }else{
                                echo "<div class='alert alert-danger'>";
                                    echo "There Is No Record To Show";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
        </div>
        <?php
        include_once $tbl.'footer.php';
    }else{
        echo "You Are Aouthrized To View This Page";
        sleep(2);
        header('Location:index.php');
    }
?>