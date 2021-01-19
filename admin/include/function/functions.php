<?php 
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