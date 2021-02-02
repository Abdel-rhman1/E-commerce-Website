<?php 
    session_start();
    if(isset($_SESSION['username'])){
        include_once "init.php";
        $title="Item";
        $do=isset($_GET['do'])?$_GET['do']:"Manage";
        if($do=="Manage"){
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
                    ID";
            $excute=mysqli_query($con,$stat);
            $count=mysqli_num_rows($excute);
            ?>
            <h1 class="text-center">Manage Item</h1>
            <div class="container">
                <?php
                    if($count!=0){ 
                ?>
                <div class="table-responsive" id="item-table">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th><a class="column_sort" id="ID" data-order="desc">#ID</a></th>
                            <th><a class="column_sort" id="ID" data-order="desc">Image</a></th>
                            <th> <a class="column_sort" id="Name" data-order="desc">Name</a>
                            </th>
                            <th><a class="column_sort" id="Description" data-order="desc"   >Description</a></th>
                            <th><a class="column_sort" id="Price" data-order="desc">Price</a></th>
                            <th><a class="column_sort" id="Add_Date" data-order="desc"   >Adding Date</a></th>
                            <th><a class="column_sort" id="Member_ID" data-order="desc"   >Item Owner</a></th>
                            <th><a class="column_sort" id="Cat_ID" data-order="desc"   >Item Category</a></th>
                            <th>Control</th>
                        </tr>
                        <?php
                            //$res = mysqli_fetch_assoc($excute);
                            while($row=mysqli_fetch_assoc($excute)){
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
                        ?>
                    </table>
                </div>
                <a href="Item.php?do=Add" class="btn btn-primary btn-sm">
                <i class='fa fa-plus'></i>Add New Item</a>
                <div class='pull-right'>
                    <a href="Item.php?action=puls">
                        <i class="fa fa-fast-backward" aria-hidden="true"></i>
                    </a> || 
                    <a href='#'>
                        <i class="fa fa-fast-forward" aria-hidden="true"></i>
                    </a>
                </div>
                <div>
                    <?php
                        $offset = 5;
                        $num = getnumber("item3");
                        $num = ceil($num/$offset);
                        echo ""
                     ?>
                </div>
                <?php 
                    }else{
                        echo "<div class='alert alert-danger'>";
                            echo " There Is No Records To Show ";
                        echo "</div>";
                        echo '<a href="Item.php?do=Add" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>Add New Item</a>';
                        
                    }
                ?>
            </div>
            <?php 
        }elseif($do=='Add'){?>
            <div class="container">
                <h1 class="text-center">Add New Item</h1>
                <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                                                                                
                    <div class="form-group form-group-lg">
                        <label class=" col-sm-2 control-label">Name</label>
                        <div class="col-sm-7">
                            <input type="text"name="name"class="form-control form-control-lg"
                            placeholder="type Your Item Name"required="required">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class=" col-sm-2 control-label">Description</label>
                        <div class="col-sm-7">
                            <input type="text"name="Desc"class="form-control form-control-lg"
                            placeholder="type Your Item Description"required="required">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class=" col-sm-2 control-label">Price</label>
                        <div class="col-sm-7">
                            <input type="text"name="Price"class="form-control form-control-lg"
                            placeholder="type Your Item Price"required="required">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class=" col-sm-2 control-label">Country</label>
                        <div class="col-sm-7">
                            <input type="text"name="Country"class="form-control form-control-lg"
                            placeholder="type Country Made">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-7">
                            <select name="Status">
                                <option value="0">....</option>
                                <option value="1">New</option>
                                <option Value="2">Like New</option>
                                <option value="3">Used</option>
                                <option value="4"> Very Old</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Members</label>
                        <div class="col-sm-7">
                            <select name="Member">
                                <?php 
                                    $stat="Select * from users3";
                                    $excute=mysqli_query($con,$stat);
                                    echo "<option value='0' selected>...</option>";
                                    while($row=mysqli_fetch_assoc($excute)){
                                        $id=$row['user_id'];
                                        $username=$row['user_name'];
                                        echo "<option value='$id'>$username</option>";
                                    }  
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-5">
                            <select name="Category">
                                <?php
                                    $stat="Select * from categories3 where Parent=0";
                                    $excute=mysqli_query($con,$stat);
                                    echo "<option value='0' selected>...</option>";
                                    while($row=mysqli_fetch_assoc($excute)){
                                        $id=$row['ID'];
                                        $username=$row['Name'];
                                        echo "<option value='$id'> $username </option>";
                                        $stat2="select * from categories3 where Parent=$id";
                                        $excut2=mysqli_query($con,$stat2);
                                        while($Child=mysqli_fetch_assoc($excut2)){
                                            echo "<option>";
                                                echo "<span class='child-Cat'>". $Child['Name'].' Chaild From '.$row['Name']."</span>";
                                            echo "</option>";
                                        }
                                    }  
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input type="file"class="form-control" name="pdf">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Tags</label>
                        <div class="col-sm-7">
                            <input 
                                class="form-control"
                                type="text"
                                name="Tag"
                                placeholder="Separated Tags With Comma(,)"
                                >
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="Item_Image">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <div class="col-sm-3 col-sm-offset-2">
                            <input type="submit"class="btn btn-primary btn-primary-xs"
                            value="Save">
                        </div>
                    </div>
                </form>      
            </div>
        <?php
        }elseif($do=='Insert'){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                echo "<h1 class='text-center'>Insert New Item</h1>";
                echo "<div class='container'>";
                    $Name=$_POST['name'];
                    $desc=$_POST['Desc'];
                    $Price=$_POST['Price'];
                    $Country=$_POST['Country'];
                    $Status=$_POST['Status'];
                    $Cat_ID=$_POST['Category'];
                    $Member_ID=$_POST['Member'];
                    $Tag=filter_var($_POST['Tag'],FILTER_SANITIZE_STRING);
                    // Image Variables
                    $imageName=$_FILES['Item_Image']['name'];
                    $imageSize=$_FILES['Item_Image']['size'];
                    $imageType=$_FILES['Item_Image']['type'];
                    $imageTem=$_FILES['Item_Image']['tmp_name'];
                    $allowedEsten=array('jpeg','jpg','png','gif','jfif');
                    $Esten=explode('.',$imageName);
                    $imageEst=strtolower(end($Esten));
                    // pdf Variables
                    if(isset($_FILES['pdf'])){
                        $name=$_FILES['pdf'];               
                        $pdfName=$name['name'];
                        $pdfSize=$name['size'];
                        $pdfype=$name['type'];
                        $pdfTem=$name['tmp_name'];
                        $allowedPdfs=array('pdf','docx');
                        $pdfExt=explode('.',$pdfName);
                        $pdfExt1=strtolower(end($pdfExt));
                    }
                    $count=checkItem('Name','item3',$Name);
                    $formError=array();
                    if(!empty($pdfName) && !in_array($pdfExt1,$allowedPdfs)){
                        $formError[]='This Estension is Not <strong>Allowed</strong>';
                    }
                    if($pdfSize > 10*1024*1024)
                        $formError[]='This Size is Larger Than <strong>10MG</strong>';   
                    if(!empty($imageName) && !in_array($imageEst,$allowedEsten)){
                        $formError[]="This Is Exention Not <strong>Allowed</strong>";
                    }
                    if(empty($imageName)){
                        $formError="Item Image Is <strong>Required</strong>";
                    }
                    if($imageSize >4194304 ){
                        $formError[]="This Size Is Larger Than <strong>4MB</strong>";
                    }
                    if(empty($Name)){
                        $formError[]="Name Musn't Be <strong>Empty</strong>";
                    }
                    if(empty($desc)){
                        $formError[]="Description Musn't Be <strong>Empty</strong>";
                    }
                    if(empty($Price)){
                        $formError[]="Price Musn't Be <strong>Empty</strong>";
                    }
                    if(empty($Status)){
                        $formError[]="Status Musn't Be <strong>Empty</strong>";
                    }
                    if($Cat_ID==0){
                        $formError[]="Please Select The  <strong>Category</strong>";
                    }
                    if($Member_ID==0){
                        $formError[]="Please Select The  <strong>Member</strong>";
                    }
                    if($count>0){
                        $msg= "<div class='alert alert-danger'>This Item Already Exist</div>";
                        redirectIndexPage($msg,6,'Item.php?do=Add');
                    }
                    else{
                        if(!empty($formError)){
                            foreach ($formError as $value) {
                                echo "<div class='alert alert-danger'>
                                $value</div>";
                            }
                        }else{
                             $Image=rand(0,100000000) . '_' .$imageName;
                             move_uploaded_file($imageTem,"Uploads\Item_Images\\".$Image);
                             $pdf=' ';
                             if(isset($pdfName)){
                                $pdf=rand(0,1000) .'_' . $pdfName;
                                move_uploaded_file($pdfTem,"Uploads\Pdfs\\".$pdf);
                             }
                              $stat="Insert Into item3(Name,Description,Price,Add_Date
                              ,Country_made,Status,Cat_ID,Member_ID,Image,pdf,Tags)
                              value('$Name','$desc','$Price',now(),'$Country'
                              ,'$Status','$Cat_ID','$Member_ID','$Image','$pdf','$Tag')";
                              $excute=mysqli_query($con,$stat);
                              if($excute){
                                  $msg= "<div class='alert alert-success'>1 Record Insered</div>";
                                  redirectIndexPage($msg,6,'Item.php');
                              }else{
                                  $msg= "<div class='alert alert-danger'> 0 Record Insered</div>";
                                  redirectIndexPage($msg,6,'Item.php?do=Add');
                              }
                     }
                }
                echo "</div>";
            }else{
                $msg= "<div class='alert alert-danger'>You Cant Browse this Page Direct</div>";
                redirectIndexPage($msg,6,'Item.php?do=Add');
            }
        }elseif ($do=='Edit') {
            $Item_ID=isset($_GET['Item_ID'])&& is_numeric($_GET['Item_ID'])?intval($_GET['Item_ID']):0;
            $stat="select * from item3 where ID='$Item_ID'";
            $excute=mysqli_query($con,$stat);
            $res=mysqli_fetch_assoc($excute);
        ?>
            <h1 class="text-center">Edit Item Info</h1>
            <div class="container">
                <form class="form-horizontal" action="?do=Update"method="POST"enctype="multipart/form-data">
                                                                                            
                    <input name='ID' type="hidden" value="<?php echo $Item_ID?>">
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-7">
                            <input class="form-control"type="text"placeholder="type item Name"
                            name="name" required="required"
                            value="<?php echo $res['Name'] ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-7">
                            <input class="form-control"type="text"placeholder="type Item Description"
                            name="Desc" required="required"
                            value="<?php echo $res['Description'] ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-7">
                            <input class="form-control"type="text"placeholder="type Item Price"
                            name="Price" required="required"
                            value="<?php echo $res['Price'] ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Country</label>
                        <div class="col-sm-7">
                            <input class="form-control"type="text"placeholder="type Item Country Made"
                            name="Country" required="required"
                            value="<?php echo $res['Country_made']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-7">
                            <select name="Status">
                                <option value="0" >....</option>
                                <option value="1"
                                <?php 
                                    if($res['Status']==1){
                                        echo "selected";
                                    }    
                                ?>
                                    >New</option>
                                <option Value="2"
                                <?php 
                                    if($res['Status']==2){
                                        echo "selected";
                                    }    
                                ?>>
                                    Like New
                                </option>
                                <option value="3"
                                <?php 
                                    if($res['Status']==3){
                                        echo "selected";
                                    }    
                                ?>>
                                Used</option>
                                <option value="4"
                                <?php 
                                    if($res['Status']==4){
                                        echo "selected";
                                    }    
                                ?>
                                >Very Old</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Members</label>
                        <div class="col-sm-7">
                            <select name="Member">
                                <?php 
                                    $stat="Select * from users3";
                                    $excute=mysqli_query($con,$stat);
                                    while($row=mysqli_fetch_assoc($excute)){
                                        $id=$row['user_id'];
                                        $username=$row['user_name'];
                                        echo "<option value='$id'";
                                        if($id==$res['Member_ID']){
                                            echo "selected";
                                        } 
                                       echo ">";
                                       echo $username; echo "</option>";
                                    }  
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-7">
                            <select name="Category">
                                <?php
                                    $stat="Select * from categories3 where Parent=0";
                                    $excute=mysqli_query($con,$stat);          
                                    while($row=mysqli_fetch_assoc($excute)){
                                        $name=$row['Name'];
                                        $id=$row['ID'];
                                        echo "<option value='$id'";
                                        if($id==$res['Cat_ID']){
                                            echo "selected";
                                        } 
                                       echo ">".
                                       $name;"</option>";
                                    }  
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Tags</label>
                        <div class="col-sm-7">
                            <input 
                                class="form-control"
                                type="text"
                                name="Tag"
                                placeholder="Separated Tags With Comma(,)"
                                value="<?php  echo $res['Tags']; ?>"
                                >
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-7">
                            <input type="file"
                                    class="form-control"
                                    name="Image"
                                    required="required"
                            >
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <div class="col-sm-3 col-sm-offset-2">
                            <input type="submit"class="btn btn-primary btn-primary-xs"
                            value="Save">
                        </div>
                    </div>
                </form>
                <?php
                    $stat="select comments.*,users3.user_name from comments 
                    inner join users3 on (comments.Member_ID=users3.user_id) where Item_ID='$Item_ID'";
                    $excute=mysqli_query($con,$stat);
                    $count=mysqli_num_rows($excute);
                    if($count!=0){
                ?>
                <div class='table-responsive'>
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>Comment</th>
                            <th>Username</th>
                            <th>Added Date</th>
                            <th>Control</th>
                        </tr>
                        <?php
                            while($row=mysqli_fetch_assoc($excute)){
                                echo "<tr>";
                                    $ID=$row['Comment_ID'];
                                    echo"<td>";echo $row['Comment'];echo"</td>";
                                    echo"<td>";echo $row['user_name'];echo"</td>";
                                    echo"<td>";echo $row['Date'];echo"</td>";
                                    echo "<td><span><a href='Comment.php?do=Edit&Comment_ID=$ID'
                                    class='btn btn-success'>
                                    <i class='fa fa-edit'></i> Edit</a></span>"." ";
                                    echo "<span><a href='Comment.php?do=Delete&Comment_ID=$ID'
                                    class='btn btn-danger'><i class='fa fa-close'></i>
                                     Delete</a></span>"." ";
                                     if($row['Status']==0){
                                        echo "<span><a href='Comment.php?do=Approve&Comment_ID=$ID'
                                        class='btn btn-info'><i class='fa fa-check'></i>
                                        Approve</a></span>";
                                     }
                                    echo "</td>";
                                echo "</tr>";
                            }
                        }        
                        ?>
                    </table>
                </div>
            </div>
        <?php
        }elseif ($do=='Update') {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                echo "<h1 class='text-center'>Update Item Info</h1>";
                echo "<div class='container'>";
                $ID=$_POST['ID'];
                $Name=$_POST['name'];
                $desc=$_POST['Desc'];
                $Price=$_POST['Price'];
                $Country=$_POST['Country'];
                $Status=$_POST['Status'];
                $Cat_ID=$_POST['Category'];
                $Member_ID=$_POST['Member'];
                $Tag=filter_var($_POST['Tag'],FILTER_SANITIZE_STRING);
                $ImageInfo=$_FILES['Image'];
                $ImageName=$_FILES['Image']['name'];
                $ImageSize=$_FILES['Image']['size'];
                $ImageType=$_FILES['Image']['type'];
                $ImageTmp=$_FILES['Image']['tmp_name'];
                $AllowedEsten=array('jpeg','jpg','png','gif');
                $Esten=explode('.',$ImageName);
                $Esten=end($Esten);
                // echo $Esten;
                // echo "<pre>";
                //     print_r($ImageInfo);
                // echo "</pre>";
                $formError=array();
                if(empty($ImageName)){
                    $formError[]="Item Image is <strong>Required</strong>";
                }
                if(!empty($ImageName) && !in_array($Esten,$AllowedEsten)){
                    $formError[]="Item Exstension is <strong>Not Comptabile</strong>";
                }
                if($ImageSize>4194304){
                    $formError[]="Item Size  Must Not Be Larger Than<strong>4GB</strong>";
                }
                if(empty($Name)){
                    $formError[]="Name Musn't Be <strong>Empty</strong>";
                }
                if(empty($desc)){
                    $formError[]="Description Musn't Be <strong>Empty</strong>";
                }
                if(empty($Price)){
                    $formError[]="Price Musn't Be <strong>Empty</strong>";
                }
                if(empty($Country)){
                    $formError[]="Country Musn't Be <strong>Empty</strong>";
                }
                if(empty($Status)){
                    $formError[]="Status Musn't Be <strong>Empty</strong>";
                }
                if($Cat_ID==0){
                    $formError[]="Please Select The  <strong>Category</strong>";
                }
                if($Member_ID==0){
                    $formError[]="Please Select The  <strong>Member</strong>";
                }
                if(empty($formError)){
                    $imageName=rand(0,110000000).'_'.$ImageName;
                    move_uploaded_file($ImageTmp,"Uploads\Item_Images\\".$imageName);
                    $st1="select Image from item3 where ID='$ID'";
                    $exst1=mysqli_query($con,$st1);
                    $Res=mysqli_fetch_assoc($exst1);
                    $oldImage=$Res['Image'];
                    if(file_exists('Uploads\Item_Images\\'.$oldImage) && !empty($oldImage)){
                        unlink('Uploads\Item_Images\\'.$oldImage);
                    }
                    $stat="update item3 set Name='$Name',
                    Description='$desc',Price='$Price',
                    Country_made='$Country',Status='$Status',
                    Cat_ID='$Cat_ID',Member_ID='$Member_ID',
                    Tags='$Tag',
                    Image='$imageName'
                    where ID='$ID'";
                    $excute=mysqli_query($con,$stat);
                    if($excute){
                        $msg= "<div class='alert alert-success'>1 Record Updated</div>";
                        redirectIndexPage($msg,6,'Item.php');
                    }else{
                        $msg= "<div class='alert alert-danger'>0 Record Updated</div>";
                        redirectIndexPage($msg,6,'Item.php?do=Update');
                    }
                }else{
                    foreach($formError as $error){
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }
                echo "</div>";
            }else{
                $msg= "<div class='alert alert-danger'>You Cant Browse this Page Direct</div>";
                redirectIndexPage($msg,6,'Item.php');
            }
        }elseif ($do=='Delete') {
            $Item_ID=isset($_GET['Item_ID'])&& is_numeric($_GET['Item_ID'])?intval($_GET['Item_ID']):0;
            echo "<h1 class='text-center'>Delete Item Info </h1>";
            echo "<div class='container'>";
            if(checkItem('ID','item3',$Item_ID)>0){
                $st1="select Image from item3 where ID='$Item_ID'";
                $exst1=mysqli_query($con,$st1);
                $Res=mysqli_fetch_assoc($exst1);
                $oldImage=$Res['Image'];
                if(file_exists('Uploads\Item_Images\\'.$oldImage) && !empty($oldImage)){
                    unlink('Uploads\Item_Images\\'.$oldImage);
                }
                $stat="delete from item3 where ID='$Item_ID'";
                $excute=mysqli_query($con,$stat);
                if($excute){
                    $msg= "<div class='alert alert-success'> 1 Record Deleted </div>";
                    redirectIndexPage($msg,6,'Item.php');
                }else{
                    $msg= "<div class='alert alert-danger'> 0 Record Deleted </div>";
                    redirectIndexPage($msg,6,'Item.php');
                }
            }else{
                $msg= "<div class='alert alert-danger'>This iD dosent exist</div>";
                redirectIndexPage($msg,6,'Item.php');
            }   
            echo "</div>";
      }elseif($do=='approve'){
        $Item_ID=isset($_GET['Item_ID'])&& is_numeric($_GET['Item_ID'])?intval($_GET['Item_ID']):0; 
        echo "<h1 class='text-center'>Approve Item</h1>";
            echo "<div class='container'>";
            if(checkItem('ID','item3',$Item_ID)>0){
                $stat="update item3 set approve=1 where ID='$Item_ID'";
                $excute=mysqli_query($con,$stat);
                if($excute){
                    $msg= "<div class='alert alert-success'> 1 Record Approved </div>";
                    redirectIndexPage($msg,6,'Item.php');
                }else{
                    $msg= "<div class='alert alert-danger'> 0 Record Approved </div>";
                    redirectIndexPage($msg,6,'Item.php');
                }
            }else{
                $msg= "<div class='alert alert-danger'>This iD dosent exist</div>";
                redirectIndexPage($msg,6,'Item.php');
            }   
            echo "</div>";
    }
    }else{
        header('index.php');
    }
    include_once $tbl.'footer.php';
?>