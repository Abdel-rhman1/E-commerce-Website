<?php
    function getUserId($username,$password){
        global $con;
        $stat="Select user_id
        from users3 where user_name='$username' and user_password='$password'";
        $exc=mysqli_query($con,$stat);
        $Res=mysqli_fetch_assoc($exc);
        return $Res['user_id'];
    }
    function getIP(){
        if(isset($_SERVER['HTTP_CLIENT_IP'])){
            return $_SERVER['HTTP_CLIENT_IP'];
        }elseif(isset($_SERVER['HTTP_X_FORWAROED_FOR'])){
            return $_SERVER['HTTP_X_FORWAROED_FOR'];
        }else{
            return (isset($_SERVER['REMOTE_ADDR']) ?$_SERVER['REMOTE_ADDR'] : '' );
        }
    }
    function delteitem(int $id){
        global $con;
        $stat="delete from ordering where ID = '$id'";
        $ex=mysqli_query($con,$stat);
        if($ex){
            echo "Deleted";
        }else{
            echo "Error In Deleting";
        }
        
    }
    function getLocation(){
        $IP=getIP();
        $query=@unserialize(file_get_contents('http://ip-api.com/php'));
        if($query && $query['status']=='success'){
            return $query;
        }
    }
    function GETITEMS($where,$value,$Approve=NULL){
        global $con;
        $stat1="select * from item3 where $where='$value'$Approve  order by ID DESC ";
        $excute1=mysqli_query($con,$stat1);
        return $excute1;
    }
    function CheckUserStatus($user){
        global $con;
        $stat="Select user_name , regstatus
                from users3 where user_name='$user'
                and regstatus=0";
        $excute=mysqli_query($con,$stat);
        $count=mysqli_num_rows($excute);
        return $count;
    }
    function getCat($table,$Order_By,$approve=NULL){
        global $con;
        $stat="select * from $table $approve order by $Order_By";
        $excute=mysqli_query($con,$stat);
        return $excute;
    }
    function gettitle(){
        global $title;
        if(isset($title)){
            echo $title;
        }
        else{
            echo "Default page";
        }
    }
    function redirectIndexPage($Message,$Seconds=5,$url='index.php'){
        echo "<div class='container' style='margin-top:50px'>";
            echo $Message;
            echo "<div class='alert alert-info'>You will redirect to home page
            in $Seconds";
        echo "</div>";
        header("refresh:$Seconds;url=$url");
        exit();
    }
    function checkItem($select,$from,$value):int{
        global $con;
        $stat="select $select from $from where $select='$value'";
        $excute=mysqli_query($con,$stat);
        $count=mysqli_num_rows($excute);
        return $count;
    }
    function GetNumbers(string $field ,string $table,$where=''):int{
        global $con;
        $stat="select count($field) from $table $where";
        $result = mysqli_query($con,$stat);
        $rows = mysqli_fetch_row($result);
        return $rows[0]-1;
    }
    function getLeatest($field,$table,$order,$limit){
        global $con;
        $stat="select $field from $table order by $order ASC limit $limit";
        $excute=mysqli_query($con,$stat);
        return $excute;
    }
?>