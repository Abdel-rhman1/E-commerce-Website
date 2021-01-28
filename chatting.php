<?php 
    ob_start();
    ini_set('disply_errors',1);
    session_start();
    include "init.php";
?>
<div class="container">
    <h1 class="text-center">Online Chatting</h1>
    <div class="col-sm-3 pepole">
        <?php 
            $currenttId=isset($_SESSION['User_ID'])?$_SESSION['User_ID']:0;
            $stat="select * from users3 where user_id<>'$currenttId'";
            $ex=mysqli_query($con,$stat);
            while($member = mysqli_fetch_assoc($ex)){
                $id=$member['user_id'];
                echo "<a href='?do=specified&id=$id'><div class='member-box'>";
                if(empty($member['avatar'])){
                    echo "<img src='img.png'>";
                }else{
                echo "<img src='admin\Uploads\Avatars\\".$member['avatar']."'>";
                }
                echo "<span>";echo $member['user_name'];echo "</span>";
                if($member['Online']==1){
                    echo "<br><span>Online</span>";
                }else{
                    $Last=$member['Last'];
                    echo "<br><span>Last: $Last</span>"; 
                }
                echo "</div></a>";
            }

        ?>
    </div>
    <script>
        function myfunction(){
            this.select();
            document.execCommand('copy');
        }
    </script>
    <div class="col-sm-8 chatarea">
        <?php 
            $do=isset($_GET['do']) ? $_GET['do']:'all';
            if($do=='main'){
                echo "<div class='text-center'>
                    <img class='img-responsive secure' src='layout/images/815004-HPE-Gen10-BLOG.jpg'></img>
                    <h1>Secure Transition</h1>
                    <p class='lead'>Secure your Message from attack by using encryption</p>
                    <input type='submit' class='btn btn-success' value='Invite Your Friend'onclick='myfunction'>
                </div>";
            }else if($do=='specified'){
                 $id=isset($_GET['id'])?$_GET['id']:0;
                 $stat1="select * from users3 where user_id='$id'";
                 $exc1=mysqli_query($con,$stat1);
                 $from=isset($_SESSION['User_ID'])?$_SESSION['User_ID']:0;
                 $stat2="select * from chatting where (FormUser='$from' && toUser='$id') || (FormUser='$id' && toUser='$from')  order by date";
                 $exc2=mysqli_query($con,$stat2);
                 $Res=mysqli_fetch_assoc($exc1);
                 $img=$Res['avatar'];
                 $name=$Res['user_name'];
                 $Last=$Res['Last'];
                 echo "<div class='main-top'>";
                 if(!empty($img)){
                 echo "
                    <img 
                    class='img-responsive img-circle' 
                    src='admin/Uploads/Avatars/$img'>";
                 }else{
                    echo "<img 
                    class='img-responsive img-circle' 
                    src='img.png'>";
                 }
                    echo" <h2>$name</h2>
                     <span>$Last</span>
                </div>";
                echo "<div class='message-body'>";
                 while($Message=mysqli_fetch_assoc($exc2)){
                     if($Message['FormUser']==$from){
                        $message=$Message['Text'];
                        echo "<div class='' style='margin-top:20px'>";
                        $date=$Message['date'];
                            echo "<span class='pull-right message'>$message <br/>$date</span>";
                        echo "</div>";
                     }else if($Message['FormUser']){
                        $message=$Message['Text'];
                        echo "<div class='messagefromuser'>";
                        $date=$Message['date'];
                            echo "<div class='pull-left'>";
                                
                                echo "<span class='message messagefrom'>
                                $message</span>";

                            echo "</div>";
                        echo "</div>";      
                     }
                 }
                echo "</div>";
                $var=$_SERVER['PHP_SELF']."?do=sending&id=$id";
                echo "<div class='main-bottom row'>
                    <form action='$var'method='POST'>
                        <input 
                            type='text'
                            class='col-sm-8 col-sm-offset-1
                            'placeholder='Type Your Message Here'
                            name='mess'>
                        <input type='submit' class='btn btn-primary col-sm-3 send' value='send'>
                    </form>
                </div>";
            }else if($do=='sending'){
                $to=isset($_GET['id'])?$_GET['id']:0;
                if(isset($_POST['mess'])){
                    echo $_POST['mess'].'<br/>';
                    $message=$_POST['mess'];
                    $from=$_SESSION['User_ID'];
                    $stat="insert into chatting(FormUser,toUser,Text,date) values('$from','$to','$message',now())";
                    $ex=mysqli_query($con,$stat);
                    header("Location:chatting.php?do=specified&id=$to");
                }
            }
        ?>
    </div>
</div>
<?php 
    include_once $tbl.'footer.php';
    include "End.php";
    ob_end_flush();
?>
<script type="text/javascript"> 
        window.addEventListener('beforeunload', function (e) { 
            e.preventDefault(); 
            e.returnValue = ''; 
            <?php 
                header('Location:category.php?Page_ID=1&Cat_Name=Computers');
            ?>
        }); 
</script> 