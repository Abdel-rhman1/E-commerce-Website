<?php
    session_start();
    if(isset($_SESSION['username'])){
        include "init.php";
        $do=isset($_GET['do'])?$_GET['do']:'Manage';
        if($do=='Manage'){
            $query='';
            if(isset($_GET['page']) && $_GET['page']=='Pending'){
                $query='And regstatus = 0';
            }
            $stat="Select * from users3 where user_groubId !=1 $query
            order by user_id DESC";
            $excute=mysqli_query($con,$stat);
            $count=mysqli_num_rows($excute);
            
            ?>
            <div class="container">
                <h1 class="text-center">Manage Members</h1>
                <?php 
                        if($count!=0){
                ?>
                <div class="table-responsive">
                   
                    <table class="table table-bordered memeber-mana text-center">
                        <tr>
                            <th>#ID</th>
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Full Name</th>
                            <th>Whattsap</th>
                            <th>Registered adte</th>
                            <th>Control</th>
                        </tr>
                        <?php
                            while($row = mysqli_fetch_assoc($excute)){
                                echo "<tr>";
                                    echo "<td>" .$row['user_id']."</td>";
                                    echo "<td>";
                                        if(!empty($row['avatar'])){
                                            echo "<img src='Uploads/Avatars/".$row['avatar']. "' alt=''/>";
                                        }else{
                                            echo "<img src='img.png'alt=''>";
                                        }
                                    echo "</td>";
                                    echo "<td>" .$row['user_name']."</td>";
                                    echo "<td>".$row['user_email']."</td>";
                                    echo "<td>".$row['user_fullName']."</td>";
                                    // https://api.whatsapp.com/send?phone=15551234567
                                    $phone=$row['Number'];
                                    echo "<td><a href=' https://api.whatsapp.com/send?phone=$phone'>".$row['Number']."</a></td>";
                                    echo "<td>" .$row['Date']."</td>";
                                    $id=$row['user_id'];
                                    echo "<td>". "<a href='member.php?do=Edit&user_id=$id' class='btn btn-success'>
                                    <i class='fa fa-edit'></i> Edit</a>".' '.
                                    "<a href='member.php?do=Delete&user_id=$id' class='btn btn-danger confirm'>
                                    <i class='fa fa-close' ></i> Delete</a>"." ";
                                    if($row['regstatus']==0){
                                        echo "<a href='member.php?do=Active&user_id=$id' class='btn btn-info Active'>
                                        <i class='fa fa-close' ></i>Activate</a>"."</td>";
                                    }
                                echo "</tr>";            
                            }
                        ?>
                    </table>
                </div>
                <a href="member.php?do=Add"class="btn btn-primary">new Member</a>
                <?php
                        }else{
                            echo "<div class='alert alert-danger'>";
                                echo " There Is Records To Show ";
                            echo "</div>";
                            echo '<a href="member.php?do=Add"class="btn btn-primary">new Member</a>';
                        }
                ?>
            </div>
    <?php
    }elseif($do=='Add'){?>
        <div class="container">
            <h1 class="text-center">Add New Member</h1>
                <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                        <!-- Start username input -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-8">
                            <input class="form-control"type="text"name="Username"required="required"
                            autocomplete="off" placeholder="Type your Username for login">
                        </div>
                    </div>
                        <!-- End username input -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-8">
                                <input class="form-control Password"type="password"name="Password"
                                autocomplete="new-password" required='required'
                                placeholder="Type Complex Password" >
                                <i class="show-pass fa fa-eye fa-2x"></i>
                            </div>
                        </div>
                        <!-- End username input -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="email"name="Email"required="required"
                                autocomplete="off"placeholder="Type Your Email">
                            </div>
                        </div>
                        <!-- End username input -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">gender</label>
                            <div class="col-sm-4">
                                <select name="gender" class="form-control">
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                    <option value="2">other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Full name</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text"name="Full"required="required"
                                autocomplete="off"placeholder="Type Your Full Name(First_Name + Last_Name)">
                            </div>
                        </div>
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">WhatsapNum</label>
                            <div class="col-sm-8">
                                <input type="tel" id="phone" name="phone"
                                    pattern="[0-9]{11}"
                                    required
                                    class="form-control"
                                    placeholder="Type Whattsap Number">
                            </div>
                        </div>
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Avatar</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" required="required" name="avatar">
                            </div>
                        </div>
                        <!-- End Full input -->
                        <div class="form-group">
                            <div class=" col-sm-offset-2 col-sm-8">
                                <input type="submit"class="btn btn-primary btn-lg" value="Save"name="Update">
                            </div>
                        </div>
                        <!-- End username input -->
                    </form>
                </div>          
    <?php
        }
        elseif($do=='Insert'){
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                echo "<h1 class='text-center'>Insert New Member</h1>";
                $username=$_POST['Username'];
                $Email=$_POST['Email'];
                $full=$_POST['Full'];
                $pass=$_POST['Password'];
                $avatarName=$_FILES['avatar']['name'];
                $avatarSize=$_FILES['avatar']['size'];
                $avatarType=$_FILES['avatar']['type'];
                $avatarTmp=$_FILES['avatar']['tmp_name'];
                $Phone=$_POST['phone'];
                $allowedExten=array("jpeg",'jpg','png','gif');
                $avatarEx=explode('.' , $avatarName);
                $avatarExten=strtolower(end($avatarEx));
                $hashpass=sha1($pass);
                $formerror=array();
                echo "<div class='container'>";
                if(!empty($avatarName) && !in_array($avatarExten,$allowedExten)){
                    $formerror[]='This Extension Is Not<strong>Allowed</strong>';
                }
                if(empty($avatarName)){
                    $formerror[]='Avatar IS<strong>Required</strong>';
                }
                if($avatarSize > 4194304){
                    $formerror[]='Avatar Size Is Larger Than<strong>4GB</strong>';
                }
                if(empty($username)){
                    $formerror[]='UserName Can\'t Be <strong>Empty</strong>';
                }
                if(strlen($username) < 4){
                    $formerror[]='UserName Can\'t Be less than<strong>4 Charachters</strong>';
                }
                if(strlen($username)>20){
                    $formerror[]='UserName Can\'t Be greater than<strong>20 Characters</strong>';
                }
                if(empty($pass)){
                    $formerror[]='Password Can\'t Be <strong>Empty</strong>';
                }
                if(empty($Email)){
                    $formerror[]='Email Can\'t Be <strong>Empty</strong>';
                }
                if(empty($full)){
                    $formerror[]='Full Name Can\'t Be <strong>Empty</strong>';
                }
                if(!is_numeric($Phone) || strlen($Phone)<11){
                    $formerror[]='Phone Number Can\'t Be Less Than <strong>11 Characters</strong>';
                }
                foreach ($formerror as  $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }                
                if(empty($formerror)){
                    if(checkItem('user_name','users3',$username)==0){
                        $avatar=rand(0,100000000).'_'.$avatarName;
                        move_uploaded_file($avatarTmp,"Uploads\Avatars\\".$avatar);
                    $stat="insert into users3(user_name,user_password,user_email,user_fullName,regstatus,Date,avatar,Number)
                    values('$username','$hashpass','$Email','$full',1,now(),'$avatar','$Phone')";
                    $excute=mysqli_query($con,$stat);
                    if($excute){
                        $msg= "<div class='alert alert-success'>1 record Inserted</div>";
                        redirectIndexPage($msg,5,'member.php');
                    }else{
                        $msg ="<div class='alert alert-danger'>0 record Inserted'</div>";
                        redirectIndexPage($msg,5,'member.php?do=Add');
                    }
                }else{
                    $var ='<div class="alert alert-danger">this is Username is already exist</div>';
                    redirectIndexPage($var,6,'member.php?do=Add');
                }
            }
            }
            else{
                $error="<div class='alert alert-danger'>You Cant Browse This Page Directly";
                redirectIndexPage($error,6,'member.php');
            }
            echo "</div>";
        }elseif($do=='Edit'){
            $user=isset($_GET['user_id'])&&is_numeric($_GET['user_id'])?intval($_GET['user_id']):0;            
            $stat="select * from users3 where user_id='$user' limit 1";
            $excute=mysqli_query($con,$stat);
            $count=mysqli_num_rows($excute);
            $res=mysqli_fetch_array($excute);
            if($count>0){ ?>
                <div class="container">
                    <h1 class="text-center">Edit Member</h1>
                    <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                        <!-- Start username input -->
                        <input type="hidden" name="user_id" value="<?php echo $user?>">
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-8">
                                <input class="form-control"type="text"name="Username"required="required"
                                autocomplete="off" value="<?php echo $res['user_name'] ?>">
                            </div>
                        </div>
                        <!-- End username input -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-8">
                            <input type="hidden"name="oldPassword"
                            value="<?php echo $res['user_password'] ;?>">
                                <input class="form-control"type="password"name="NewPassword"
                                autocomplete="new-password">
                            </div>
                        </div>
                        <!-- End username input -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="email"name="Email"required="required"
                                autocomplete="off"value="<?php echo $res['user_email']?>">
                            </div>
                        </div>
                        <!-- End username input -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Full name</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text"name="Full"required="required"
                                autocomplete="off" value="<?php echo $res['user_fullName']?>">
                            </div>
                        </div>
                        <!-- End Full input -->
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">WhatsapNum</label>
                            <div class="col-sm-8">
                                <input type="tel" id="phone" name="phone"
                                    pattern="[0-9]{11}"
                                    required="required"
                                    class="form-control"
                                    placeholder="Type Whattsap Number"
                                    value="<?php echo $res['Number'] ?>"
                                >
                            </div>
                        </div>
                        <div class="form-group form-group-lg">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-7">
                                <input type="file"
                                        class="form-control"
                                        name="Image"
                                        required
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" col-sm-offset-2 col-sm-8">
                                <input type="submit"class="btn btn-primary btn-lg" value="update"name="Update">
                            </div>
                        </div>
                        <!-- End username input -->
                    </form>
                </div>          
        <?php 
            }
            else{
                $error="<div class='alert alert-danger'This User dosen't exist in website database";
                redirectIndexPage($error,6,'member.php');
            }
        }elseif($do=='Update'){
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                echo "<h1 class='text-center'>Update Member</h1>";
                $user_id=$_POST['user_id'];
                $username=$_POST['Username'];
                $Email=$_POST['Email'];
                $full=$_POST['Full'];
                $pass='';
                $Phone=$_POST['phone'];
                // $ImageInfo=$_FILES['Image'];
                $ImageName=$_FILES['Image']['name'];
                $ImageSize=$_FILES['Image']['size'];
                $ImageType=$_FILES['Image']['type'];
                $ImageTem=$_FILES['Image']['tmp_name'];
                $formerror=array();
                echo "<div class='container'>";
                if(empty($username)){
                    $formerror[]='Name Can\'t Be <strong>Empty</strong>';
                }
                if(strlen($username)<4){
                    $formerror[]='Name Can\'t Be less than<strong>4 Charachters</strong>';
                }
                if(strlen($username)>20){
                    $formerror[]='Name Can\'t Be greater than<strong>20 Characters</strong>';
                }
                if(empty($Email)){
                    $formerror[]='Email Can\'t Be <strong>Empty</strong>';
                }
                if(empty($full)){
                    $formerror[]='Full Name Can\'t Be <strong>Empty</strong>';
                }
                if(!is_numeric($Phone) || strlen($Phone)<11){
                    $formerror[]='Phone Number Can\'t Be Less Than <strong>11 Characters</strong>';
                }
                foreach ($formerror as  $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                if(isset($_POST['NewPassword'])){
                    $pass=sha1($_POST['NewPassword']);
                }else{
                    $pass=sha1($_POST['oldPassword']);
                }
                if(empty($formerror)){
                    $stat1="select * from users3 where 
                    user_name='$username' and user_id!='$user_id'";
                    $excute1=mysqli_query($con,$stat1);
                    $Res=mysqli_fetch_assoc($excute1);
                    $count1=mysqli_num_rows($excute1);
                    if($count1==0){
                        $image=rand(0,100000).'_'. $ImageName;
                        move_uploaded_file($ImageTem,"Uploads\Avatars\\".$image);
                        $stat2="select avatar from users3 where 
                        user_id='$user_id'";
                        $excute2=mysqli_query($con,$stat2);
                        $Res=mysqli_fetch_assoc($excute2);
                        $OldImage=$Res['avatar'];
                        if(file_exists("Uploads\Avatars\\".$OldImage) && !empty($OldImage)){
                            unlink("Uploads\Avatars\\".$OldImage);
                        }
                    $stat="update users3 set user_name='$username', 
                    user_email='$Email',
                    user_fullName='$full',
                    user_password='$pass',
                    avatar='$image',
                    Number='$Phone'
                    where user_id='$user_id'";
                    $excute=mysqli_query($con,$stat);
                    if($excute){
                        $msg = "<div class='alert alert-success'>DataBase has Updated</div>";
                        redirectIndexPage($msg,5,'member.php');
                    }else{
                        $msg = "<div class='alert alert-danger'>error in Updating</div>";
                        redirectIndexPage($msg,5,'member.php');
                    }
                }else{
                    $msg = "<div class='alert alert-danger'>This User Already exist</div>";
                    redirectIndexPage($msg,5,'member.php');
                }
            }
        }
            echo "</div>";
        }elseif ($do=='Delete') {
            echo "<h1 class='text-center'>Delete Member Data</h1>";
            echo "<div class='container'>";
            $user=isset($_GET['user_id'])&&is_numeric($_GET['user_id'])?intval($_GET['user_id']):0;            
            $stat="select * from users3 where user_id='$user' limit 1";
            $excute=mysqli_query($con,$stat);
            $count=mysqli_num_rows($excute);
            $res=mysqli_fetch_array($excute);
            if($count>0){ 
                $stat2="select avatar from users3 where 
                user_id='$user'";
                $excute2=mysqli_query($con,$stat2);
                $Res=mysqli_fetch_assoc($excute2);
                $OldImage=$Res['avatar'];
                if(file_exists("Uploads\Avatars\\".$OldImage) && !empty($OldImage)){
                    unlink("Uploads\Avatars\\".$OldImage);
                }
                $stat="delete from users3 where user_id='$user'";
                $excute=mysqli_query($con,$stat);
                if($excute){
                    $msg ="<div class='alert alert-success'>1 Recoder Delete</div>";
                    redirectIndexPage($msg,7,'member.php?do=Update&user_id=$user');
                }else{
                    $msg ="<div class='alert alert-danger'>0 Recoder Deleted</div>";
                    redirectIndexPage($msg,7,'member.php');
                }
            }
            echo "</div>";
        }elseif($do=='Active'){
            echo "<h1 class='text-center'>Ative Member Data</h1>";
            echo "<div class='container'>";
            $user=isset($_GET['user_id'])&&is_numeric($_GET['user_id'])?intval($_GET['user_id']):0;            
            $stat="select * from users3 where user_id='$user' limit 1";
            $excute=mysqli_query($con,$stat);
            $count=mysqli_num_rows($excute);
            $res=mysqli_fetch_array($excute);
            if($count>0){ 
                $stat="update users3 set regstatus=1 where user_id='$user'";
                $excute=mysqli_query($con,$stat);
                if($excute){
                    $msg ="<div class='alert alert-success'>1 Recoder Activate</div>";
                    redirectIndexPage($msg,7,'member.php');
                }else{
                    $msg ="<div class='alert alert-danger'>0 Recoder Activate</div>";
                    redirectIndexPage($msg,7,'member.php');
                }
            }
            echo "</div>";
        }
        include_once $tbl.'footer.php';
    } else{
        header('Location:index.php');
    }
?>