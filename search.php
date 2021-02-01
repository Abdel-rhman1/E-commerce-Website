<?php
	$val = $_POST['value'];
	$con = mysqli_connect("localhost:3307", "root" , "" , "shop");
	$stat = "select
					* 
			from 
				item3 
			where 
				Name like '%$val%'
			or 
				Name like '$val%'
			or
				Name like '%$val'
			or
				Description like '%$val%'
			or 
				Description like '$val%'
			or
				Description like '%$val'
			or
				Country_made like '%$val%'
			or
				Country_made like '$val%'
			or
				Country_made like '$val'
			or 
				Country_made like '%$val'
			";
		$excute = mysqli_query($con , $stat);
	    echo "<div id='item'>";
        echo "<div class='row'>";
        while($Cat=mysqli_fetch_assoc($excute)){
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
?>