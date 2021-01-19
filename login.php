<?php
    ob_start();
    session_start();
    include "init.php";
    $title="Login";
    setcookie('user_name',"",time()-24*60*60);
    setcookie('password',"",time()-24*60*60);    
    if(isset($_SESSION['User'])){
        header('Location:index.php');
        exit();
        
     }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['login'])){
                $username=$_POST['username'];
                $password=$_POST['password'];
                $hashpass=sha1($password);
                $stat="Select user_id , user_name , user_password
                from users3 where user_name='$username' and user_password='$hashpass'";
                $excute=mysqli_query($con,$stat);
                $Res=mysqli_fetch_assoc($excute);
                $count=mysqli_num_rows($excute);
                if($count>0){
                    $_SESSION['User']=$username;
                    $_SESSION['User_ID']=$Res['user_id'];
                    $ID=$_SESSION['User_ID'];
                    if(isset($_POST['cookie']) && !isset($_COOKIE['user_name'])){
                        setcookie('user_name',$username,time()+86400*30);
                        setcookie('password',$_POST['password'],time()+86400*30);
                    }
                    $stat="update users3 set Online=1 where user_id='$ID'";
                    $ex=mysqli_query($con,$stat);
                    if($ex){
                        echo "GOOD";
                    }else{
                        echo "Bad";
                    }
                    header('Location: index.php');
                    exit();
            }
        }else{
            $formError=array();
            $username=$_POST['username'];
            $password1=$_POST['password'];
            $password2=$_POST['password2'];
            $email=$_POST['email'];
            if(isset($username)){
                $filterInput=filter_var($username,FILTER_SANITIZE_STRING);
                if(strlen($filterInput)<4){
                    $formError[]='Username Must Be Greater Than 4 Characters';
                }
            }
            if(isset($_POST['cookie'])){
                setcookie('user_name',$username,time()+86400*30);
                setcookie('password',$_POST['password'],time()+86400*30);
            }
            if(isset($password1) && isset($password2)){
                if(empty($password1)){
                    $formError[]='Password Can\'t Be Empty';
                }
                $pass1=sha1($password1);
                $pass2=sha1($password2);
                if($pass1!==$pass2){
                    $formError[]='Password1 and Password2 Nust Be indentical';
                }
            }
            if(isset($email)){
                $filterMail=filter_var($email,FILTER_SANITIZE_EMAIL);
                if(filter_var($filterMail,FILTER_VALIDATE_EMAIL)!=true){
                    $formError[]='Mail Must Be Valid Email';
                }
            }
            if(empty($formError)){
                $count=checkItem('user_name','users3',$username);
                if($count>0){
                    $formError[]='Sorry, This User Is Exit';
                }else{
                    $stat=" INSERT INTO users3(user_name,user_password,user_email,Date)
                    VALUES('$username','$pass1','$email',now())";
                    $excute=mysqli_query($con,$stat);
                    if($excute){
                        $suc="Congrat for Succeful Registeration";
                    }else{
                        $formError[]='Can\'t Complete As DataBase Error';
                    }
                }
            }
        }
    }
?>
<div class='container login-page'>
    <h1 class="text-center">
        <span data-class="login" class="active">Login</span>| <span data-class="singup">Singup</span>
    </h1>
    <form class="login" action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <input type="text"name="username"placeholder='Type Your Username'
            class="form-control" required="required"
            autocomplete="off"
        >
        <input type="password"name="password"placeholder='Type Your Password'
            class="form-control" required="required"
            autocomplete="new-password"
        >
        <div class='text-center'>
            <div class='form-group'>
                <input type="checkbox" value='1' name='cookie'>
                <span class='lead'>Member My for One Month</span>
            </div>
        </div>
        <input type="submit"
            class="btn btn-primary btn-block" 
            required="required"
            value="Login"
            name="login"
        >
    </form>
    <form class="singup"action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <input 
            pattern=".{4,}"
            title="Useranme Must Be Greater Than 4 Characters"
            type="text"
            name="username"
            placeholder='Type Your Username'
            class="form-control" 
            required="required"
            autocomplete="off"
        >
        <input 
                type="email"
                name="email"
                placeholder='Type A Valid Mail'
                class="form-control" 
                required="required"
                autocomplete="off"
        >
        <input
                minlength="4" 
                type="password"
                name="password"
                placeholder='Type Complex Password'
                class="form-control" 
                required="required"
                autocomplete="new-password"
        >
       
        <input  
                minlength="4" 
                type="password"
                name="password2"
                placeholder='Retype Password again'
                class="form-control" 
                required="required"
                autocomplete="new-password"
        >
        <div class='text-center'>
            <div class='form-group'>
                <input type="checkbox" value='1' name='cookie'>
                <span class='lead'>Member My for One Month</span>
            </div>
        </div>
        <input 
            type="submit"
            class="btn btn-success btn-block"
            value="Singup"
        >
    </form>
    <div class='form-error text-center'>
        <?php
            if(!empty($formError)){
                foreach($formError as $erro){
                    echo "<p class='msg'>". $erro ."</p>";
                }
            }
            if(isset($suc)){
                echo "<p class='msg'>".$suc."</p>";
            }
        ?>
    </div>
</div>

<?php  
    include $tbl.'footer.php';
    ob_end_flush();
?>