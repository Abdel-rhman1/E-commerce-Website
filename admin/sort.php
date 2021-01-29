<?php
	// include_once "init.php";
	 //include 'include/templates/header.php';
	$con = mysqli_connect('localhost:3307','root','','shop');
	$output = '';
	$order  = $_POST['Order'];
	$by = $_POST['columnName'];
	if($order=='desc'){
		$order = 'asc';
	}else{
		$order = 'desc';
	}
	$start=0;
	$stat="
	    Select 
	        item3.*,users3.user_name,categories3.Name as Name2
	    from 
	        item3
	    inner join 
	        users3 
	    on 
	        (users3.user_id=item3.Member_ID)
	    inner join 
	        categories3 
	    on
	        (categories3.ID=item3.Cat_ID)
	    where 
	        item3.ID >='$start' 
	    order by
	        $by $order";
	$result = mysqli_query($con,$stat);
	echo '
		<table class="table table-bordered text-center">
	        <tr>
	            <th><a class="column_sort" id="ID" data-order="'.$order.'">#ID</a></th>
	            <th><a class="column_sort" id="ID" data-order="'.$order.'">Image</a></th>
	            <th> <a class="column_sort" id="Name"data-order="'.$order.'">Name</a>
	            </th>
	            <th><a class="column_sort" id="Description" data-order="'.$order.'"   >Description</a></th>
	            <th><a class="column_sort" id="Price" data-order="'.$order.'">Price</a></th>
	            <th><a class="column_sort" id="Add_Date" data-order="'.$order.'"   >Adding Date</a></th>
	            <th><a class="column_sort" id="Member_ID" data-order="'.$order.'"   >Item Owner</a></th>
	            <th><a class="column_sort" id="Cat_ID" data-order="'.$order.'"   >Item Category</a></th>
	            <th>Control</th>
	        </tr>
	';
	while($row = mysqli_fetch_assoc($result)){
		// $Id= $row["ID"];
		echo "<tr>";
	        $Id=$row['ID'];
	        echo "<td>". $row['ID']."</td>";
	        echo "<td>";
	            if(!empty($row['Image'])){
	                echo "<img class='styleImage'src='Uploads/Item_Images/".$row['Image']."'alt=''\>";
	            }else{
	                echo "No Image";
	            }
	        echo "</td>";
	        echo "<td>". $row['Name']."</td>";
	        echo "<td>". $row['Description']."</td>";
	        echo "<td >". $row['Price']."</td>";
	        echo "<td style='width:100px'>". $row['Add_Date']."</td>";
	        echo "<td>". $row['user_name']."</td>";
	        echo "<td>". $row['Name2']."</td>";
	        echo "<td style='width:150px'>". "<span><a href='Item.php?do=Edit&Item_ID=$Id'class='btn btn-success btn-sm'>
	        <i class='fa fa-edit'></i>Edit</a></span>"." ".
	        "<span><a href='Item.php?do=Delete&Item_ID=$Id'class='btn btn-danger btn-sm'>
	        <i class='fa fa-close'></i>Delete</span></a>"." ";
	        if($row['approve']==0){
	            echo "<span><a href='?do=approve&Item_ID=$Id' class='btn btn-primary btn-sm'>
	            <i class='fa fa-check'></i>
	            Approve</a></span>";
	        }
	        echo "</td>";
	    echo "</tr>";
	}
	echo "</table>";
	// include_once "layout/js/footer.php";
?>
