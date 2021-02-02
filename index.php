<?php session_start();include "init.php";
    include "cars.php";
    $var=getCat('item3','ID','WHERE approve=1');
    echo "<div class='container Products'>";
   
    echo "<fieldset>
        <legend>Fashion</legend>";
        echo "<div class='outerClass'>";
        echo "<div class='row'>
            <div class='col-sm-6'>
                <a href='category.php?Page_ID=1'>
                <img class='img-responsive'src='Images/1608208545_1-en.jpg'>
                <span class='watchclass'>Watches</span>
                </a>
            </div>
            <div class='col-sm-3 col-xs-6'> 
                <a href='category.php?Page_ID=2'>
                <img class='img-responsive'src='Images/1608208545_2-en.jpg'>
                <span class='watch1'>kids</span>
                </a>
            </div>
            <div class='col-sm-3 col-xs-6'>
            <a href='category.php?Page_ID=3'>
                <img class='img-responsive'src='Images/1608208545_3-en.jpg'> 
                <span class='watch1'>bugs</span>
                </a>
            </div>
            <div class='col-sm-3 col-xs-6'>
                <a href='category.php?Page_ID=4'>
                <img class='img-responsive innerClass'src='Images/1608208545_4-en.jpg'>
                <span class='watch1'>Eyswear</span>
                </a>
            </div>
            <div class='col-sm-3 col-xs-6'>
            <a href='category.php?Page_ID=5'>
                <img class='img-responsive innerClass'src='Images/1608208545_5-en.jpg'>
                <span class='watch1'>jewelry</span>
            </a>
            </div>
        </div>";
        echo "<fieldset>";
        
        echo "</div>";
        echo "<fieldset>
        <legend>Fashion</legend>";
        echo "<div class='outerClass'>";
        echo "<div class='row'>
            <div class='col-sm-6'>
            <a href='category.php?Page_ID=5'>
                <img class='img-responsive'src='Images/1607791940_1-en.jpg'>
                <span class='watchclass'>Watches</span>
            </a>
            </a>
            </div>
            <div class='col-sm-3 col-xs-6'> 
            <a href='category.php?Page_ID=1'>
                <img class='img-responsive'src='Images/1607791942_3-en.jpg'>
                <span class='watch1'>kids</span>
            </a>
            </div>
            <div class='col-sm-3 col-xs-6'>
            <a href='category.php?Page_ID=1'>
                <img class='img-responsive 'src='Images/1607791942_4-en.jpg'> 
                <span class='watch1'>bugs</span>
                </a>
            </div>
            <div class='col-sm-3 col-xs-6'>
            <a href='category.php?Page_ID=1'>
                <img class='img-responsive innerClass'src='Images/1607791942_5-en.jpg'>
                <span class='watch1'>Eyswear</span>
            </a>
            </div>
            <div class='col-sm-3 col-xs-6'>
            <a href='category.php?Page_ID=1'> 
                <img class='img-responsive innerClass'src='Images/1607791942_2-en.jpg'>
                <span class='watch1'>jewelry</span>
                </a>
            </div>
        </div>";
        echo "<fieldset>";
        echo "</div>";
         echo "<div class='row'>";
            echo "<div class='form-group form-group-lg col-sm-8 col-xs-11'>
                    <input type='text' id='search'
                    class='col-sm-8 col-xs-10 col-sm-offset-5 col-xs-offset-2'placeholder='Type to search'>
                </div>";
        echo "</div>";
        echo "<div id='item'>";
        echo "<div class='row'>";
        while($Cat=mysqli_fetch_assoc($var)){
            echo "<div class='col-sm-3 col-md-2 col-xs-6'>";
                echo "<div class='golaph'>";
                echo "<div class='thumbnail Item-box'>";
                    echo "<span class='Price'>". $Cat['Price']."</span>";
                    echo "<span class='pull-right head'> 
                        <i class='fa fa-heart-o' aria-hidden='true'></i>        
                        </span>";
                    if(!empty($Cat['Image'])){
                        echo "<img class='img-responsive Item-image'
                        src='admin\Uploads\Item_Images\\".$Cat['Image']."'alt=''/>";
                    }else{
                        echo "<img class='img-responsive Item-image'
                        src='new-feature-product-badge-symbol-600w-618521990.jpg'alt=''/>";
                    }    
                    if($Cat['Cat_ID']==6){
                        echo "<div class='download'>";
                            $ID=$Cat['ID'];
                            echo "<span class='Download'><a href='Download.php?do=Down&ID=$ID'>
                                <i class='fa fa-download' aria-hidden='true'></i>
                            </a></span>";
                            echo "<span class='View'><a href='Download.php?do=View&ID=$ID'>
                                <i class='fa fa-eye' aria-hidden='true'></i>
                            </a></span>";
                        echo "</div>";
                    }          
                echo "</div>";
                echo "<div class='caption'>";
                    $ID=$Cat['ID'];
                    echo "<h3><a href='item.php?Item_ID=$ID'>".$Cat['Name']."</a></h3>";
                
                    echo "<p class='desc'>".$Cat['Description']."</p>";
                    echo "<span>";
                    for($i=0;$i<5;$i++){
                        echo '★';
                    }
                    echo "</span>";
                     echo "<div class='AddToCart'>";
                         echo "<a href='ordering.php?do=Add&ID=$ID'>Add To Card</a>";
                     echo "</div>";
                echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    echo "</div>";
?>
<div id="scroll-top">
    <i class="fa fa-comments fa-3x" aria-hidden="true"></i>
</div>
<div id="online-chatting">
    <div class="exiting">
        <span class="support">Shop Support</span>
        <span class="x">X</span>
    </div>
    <div class="chatting-bady">
        <p>Hala ! How we can help you ?</p>
            <form class="form-horizontal conform" onsubmit=""action="chatting.php?do=main" method="post">
                <div class="form-group form-group-md">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10 cla">
                        <input 
                            type="text"
                            class="form-control ConName"
                            name="ConName"
                            required="required"
                        >
                    </div>
                    <span class="ErrorMess col-sm-offset-2"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Please Enter valid Name</span>
                </div>
                <div class="form-group form-group-md">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10 cla">
                        <input 
                            type="email"
                            class="form-control ConMail"
                            name="ConMail"
                            required="required"
                        >
                    </div>
                    <span class="ErrorMess col-sm-offset-2"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Please Enter valid Address</span>
                </div>
                <div class="form-group form-group-md">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10 cla">
                        <input 
                            type="phone"
                            class="form-control ConPhone"
                            name="ConPhone"
                            required="required"
                        >
                    </div>
                    <span class="ErrorMess col-sm-offset-2"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Please Enter valid Phone</span>
                </div>
                <div class="form-group form-group-md">
                    <label class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10 cla">
                        <textarea type="phone" class="form-control ConMessage" name="ConMessage" rows="6" required="required" placeholder="Message"></textarea>
                    </div>
                    <span class="ErrorMess col-sm-offset-2"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Please Enter valid Message</span>
                </div>
                <div class="form-group form-group-md">
                    <div class="col-sm-offset-2 text-center cla">
                        <input 
                            type="submit"
                            class="btn btn-success"
                            value="Start Chat"
                            >
                    </div>
                </div>
            </form>
    </div>
</div>
<script>
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "gethint.php?q=" + str, true);
            xmlhttp.send();
        }
    }
</script>
<?php 
    include_once $tbl.'footer.php';
    include "End.php";
?>