<?php 
    session_start();
    if(isset($_SESSION['username'])){
        $title="Comments";
        include "init.php";
        $do=isset($_GET['do'])?$_GET['do']:'Manage';
        if($do=='Manage'){?>
            <h1 class="text-center">Manage Comments</h1>
            <div class="container">
                <?php
                    $stat="select comments.*,item3.Name ,users3.user_name
                    from comments inner join item3 
                    on (item3.ID=comments.Item_ID)
                    inner join users3 on (comments.Member_ID=users3.user_id)
                    order by Comment_ID DESC";
                    $excute=mysqli_query($con,$stat);
                    $count=mysqli_num_rows($excute);
                    if($count!=0){
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>#ID</th>
                            <th>Comment</th>
                            <th>Item_Name</th>
                            <th>User_Name</th>
                            <th>Date</th>
                            <th>Control</th>
                        </tr>
                        <?php
                            while($row=mysqli_fetch_assoc($excute)){
                                echo "<tr>";
                                $ID=$row['Comment_ID'];
                                echo "<td>". $row['Comment_ID'] ."</td>";
                                echo "<td>".$row['Comment']."</td>";
                                echo "<td>".$row['Name']."</td>";
                                echo "<td>".$row['user_name']."</td>";
                                echo "<td>".$row['Date']."</td>";
                                echo "<td><span><a href='?do=Edit&Comment_ID=$ID'
                                class='btn btn-success btn-sm'><i class='fa fa-edit'></i> Edit</a></span>"." ";
                                echo "<span><a href='?do=Delete&Comment_ID=$ID' class='btn btn-danger btn-sm'>
                                <i class='fa fa-close'></i> Delete </a></span>"." ";
                                if($row['Status']==0){
                                    echo "<span><a href='?do=Approve&Comment_ID=$ID' 
                                    class='btn btn-primary btn-sm'>
                                    <i class='fa fa-check'></i>Approve</a>
                                    </span>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
                <?php 
                    }else{
                        echo "<div class='alert alert-danger'>";
                            echo " There Is Records To Show ";
                        echo "</div>";
                    }
                ?>
            </div>
        <?php 
        }elseif($do=='Edit'){
            $comid=isset($_GET['Comment_ID']) && is_numeric($_GET['Comment_ID'])?
            intval($_GET['Comment_ID']):0;
            $stat="select * from comments where Comment_ID='$comid'";
            $excute=mysqli_query($con,$stat);
            $res=mysqli_fetch_assoc($excute);
        ?>
            <h1 class="text-center">Edit Comment Content</h1>
            <div class="container">
                <form class="form-horizontal" action="?do=Update" method="POST">
                    <input type="hidden" name="ID" value="<?php echo $comid; ?>">
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Comment</label>
                        <div class="col-sm-7 col-md-7">
                            <textarea class="form-control" name="Comment">
                                <?php
                                    echo  $res['Comment'];
                                ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-7 ">
                            <input class="btn btn-info btn-sm"type="submit" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        <?php
        }elseif($do=='Update'){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $comid=$_POST['ID'];
                $Comment=$_POST['Comment'];
                if(checkItem('Comment_ID','comments',$comid)>0){
                    $stat="update comments set Comment='$Comment' where Comment_ID='$comid'";
                    $excute=mysqli_query($con,$stat);
                    if($excute){
                        $msg= "<div class='alert alert-success'> 1 Record Updated </div>";
                        redirectIndexPage($msg,6,'Comment.php');
                    }else{
                        $msg= "<div class='alert alert-danger'> 0 Record Updated </div>";
                        redirectIndexPage($msg,6,"Comment.php?do=Edit&Comment_ID=$comid");
                    }   
                }else{
                    $msg= "<div class='alert alert-danger'>This Comment dosent Exists</div>";
                    redirectIndexPage($msg,6,"Comment.php");
                }   
            }else{
                $msg= "<div class='alert alert-danger'>You Can\'t Browse THis Page Directly</div>";
                redirectIndexPage($msg,6,'Comment.php');
            }
        }elseif($do=='Delete'){
            $comid=isset($_GET['Comment_ID']) && is_numeric($_GET['Comment_ID'])?
            intval($_GET['Comment_ID']):0;
            echo "<h1 class='text-center'>Delete Comment Content</h1>";
            echo "<div class='container'>";
            if(checkItem('Comment_ID','comments',$comid)>0){
                $stat="delete from comments where Comment_ID='$comid'";
                $excute=mysqli_query($con,$stat);
                if($excute){
                    $msg= "<div class='alert alert-success'>1 Record Deleted</div>";
                    redirectIndexPage($msg,6,'Comment.php');
                }else{
                    $msg= "<div class='alert alert-danger'>0 Record Deleted</div>";
                    redirectIndexPage($msg,6,'Comment.php');
                }
            }else{
                $msg= "<div class='alert alert-danger'>This comment Dosent exist</div>";
                redirectIndexPage($msg,6,'Comment.php');
            }
            echo "</div>";
        }elseif($do=='Approve'){
            $comid=isset($_GET['Comment_ID']) && is_numeric($_GET['Comment_ID'])?
            intval($_GET['Comment_ID']):0;
            echo "<h1 class='text-center'>Approve Comment Content</h1>";
            echo "<div class='container'>";
            if(checkItem('Comment_ID','comments',$comid)>0){
                $stat="update comments set Status=1 where Comment_ID='$comid'";
                $excute=mysqli_query($con,$stat);
                if($excute){
                    $msg= "<div class='alert alert-success'>1 Record </div>";
                    redirectIndexPage($msg,6,'Comment.php');
                }else{
                    $msg= "<div class='alert alert-danger'>0 Record Deleted</div>";
                    redirectIndexPage($msg,6,'Comment.php');
                }
            }else{
                $msg= "<div class='alert alert-danger'>thsi comment dosent exits</div>";
                redirectIndexPage($msg,6,'Comment.php');
            }
        }
        include $tbl.'footer.php';
    }else{
        header('index.php');
    }
?>