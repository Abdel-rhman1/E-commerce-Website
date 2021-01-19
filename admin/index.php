<?php
    // Start Session
    session_start();
    $nonavbar='yes';//isset nonavbar
    $title="Login";// title
    // if username is isset this user login
    // otherwise he need to login
    if(isset($_SESSION['username'])){
        header('Location:home.php');
    }
    include "init.php";
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $username=filter_var($_POST['username']);
        $pass=filter_var($_POST['password']);
        $hashPass=sha1($pass);
        $stmt="select user_id , user_name , user_password 
        from users3
        where user_name='$username' and 
        user_password='$hashPass' and user_groubId=1";
        $excute=mysqli_query($con,$stmt);
        if($excute){
            $count=mysqli_num_rows($excute);
            $res=mysqli_fetch_array($excute);
            print_r($res);
            if($count==1){
                $_SESSION['username']=$username;
                $_SESSION['id']=$res['user_id'];
                header('Location:home.php');
                exit();
            }
            else{

            }
        }
        else{
            echo "falied to select user from database";
        }
        
    }
?>
    <form class="login" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
        <h4 class="text-center">Admin Login</h4>
        <input 
        class="form-control"type="text"name="username"
        placeholder="username" autocomplete="off"/>
        <input class="form-control"type="password"name="password"
        placeholder="password"autocomplete="new-password"/>
        <input class="btn btn-primary btn-block"type="submit" value="Login">
    </form>
<?php 
    include $tbl.'footer.php';
?>