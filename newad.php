<?php
    ob_start();
    session_start();
    include "init.php";
    $title='Ads';
    // print_r($_SESSION);
    if(isset($_SESSION['User'])){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $Name=FILTER_VAR($_POST['Name'],FILTER_SANITIZE_STRING);
            $Desc=FILTER_VAR($_POST['Desc'],FILTER_SANITIZE_STRING);
            $Price=FILTER_VAR($_POST['Price'],FILTER_SANITIZE_STRING);
            $Country=FILTER_VAR($_POST['Country'],FILTER_SANITIZE_STRING);
            $Status=FILTER_VAR($_POST['Status'],FILTER_SANITIZE_STRING);
            $Category=FILTER_VAR($_POST['category'],FILTER_SANITIZE_STRING);
            $Member=$_SESSION['User_ID'];
            $Tag=FILTER_VAR($_POST['Tag'],FILTER_SANITIZE_STRING);
            $formError=array();
            if(strlen($Name)<4){
                $formError[]="UserName Must Be Larger Than 4 Characters";
            }
            if(strlen($Desc)<10){
                $formError[]="Description Must Be Larger Than 4 Characters";
            }
            if(empty($Price)){
                $formError[]="Price Must Not Be Empty";
            }
            if(empty($Country)){
                $formError[]="Country Must Not Be Empty";
            }
            if(empty($Category)){
                $formError[]="Category Must Not Be Empty";
            }
            if(empty($formError)){
                $ID=$_SESSION['User_ID'];
                $stat2="insert into item3 (Name,Description,Price,Add_Date,
                Country_made,Status,Cat_ID,Member_ID,Tags)
                values('$Name','$Desc','$Price',now(),'$Country','$Status',
                '$Category','$ID','$Tag')";
                $excut2=mysqli_query($con,$stat2);
                if($excut2){
                   $success="Your New Item Is Added";
                }else{
                    $formError[]= '0 Record Inserted';
                } 
            }
        }
?>
<div class="information">
    <div class=" container">
        <h1 class="text-center">Create New Ad</h1>
        <div class="panel panel-primary">
            <div class="panel-heading">
                Create New Ad
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8 form-horizontal">
                        <div class="form-group form-group-lg">
                            <span class="control-label col-sm-6">first Step: adding basics Information</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <form  class="form-horizontal"action="<?php $_SERVER['PHP_SELF'] ?>"method="post" enctype="multipart/form-data">
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input 
                                        class="form-control live_name"
                                        name="Name"
                                        placeholder="Type Ad Name"
                                        required="required"
                                        type="text"
                                    >
                                </div>
                            </div>
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-9">
                                    <input 
                                        class="form-control live_desc"
                                        name="Desc"
                                        placeholder="Type Ad Description"
                                        required="required"
                                        type="text"
                                    >
                                </div>
                            </div>
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-9">
                                    <input 
                                        class="form-control live_price"
                                        name="Price"
                                        placeholder="Type Ad Price"
                                        required="required"
                                    >
                                </div>
                            </div>
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Country</label>
                                <div class="col-sm-9">
                                    <input 
                                        class="form-control"
                                        name="Country"
                                        placeholder="Type Country Made"
                                        required="required"
                                    >
                                </div>
                            </div>
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="Status">
                                        <option value=''selected>....</option>
                                        <option value="1">New</option>
                                        <option Value="2">Like New</option>
                                        <option value="3">Used</option>
                                        <option value="4"> Very Old</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-7">
                                    <input 
                                        type="file"
                                        class="form-control"
                                        id="Choice_Image"  
                                        name="Image"   
                                    >
                                </div>
                                <span 
                                class="btn btn-primary col-sm-2"
                                style="margin-top: 6px;"
                                id="SetImage">Show</span>

                            </div>
                            
                            <div class="form-group form-group-lg">
                                <label class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category">
                                        <option vlaue=''selected>....</option>
                                    <?php
                                        $stat="Select * from categories3";
                                        $excute=mysqli_query($con,$stat);
                                        echo "<option value='0' selected>...</option>";
                                        while($row=mysqli_fetch_assoc($excute)){
                                            $id=$row['ID'];
                                            $username=$row['Name'];
                                            echo "<option style='text-align:center'value='$id'>$username</option>";
                                    }  
                                ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Tags</label>
                        <div class="col-sm-9">
                            <input 
                                class="form-control"
                                type="text"
                                name="Tag"
                                placeholder="Separated Tags With Comma(,)"
                                
                                >
                        </div>
                    </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-7">
                                    <input class='btn btn-success btn-sm'type="submit"value="Save">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <div class='thumbnail Item-box live_preview'>
                            <span class='Price'>$0</span>
                            <img class='img-responsive'src='img.png'alr='Item-Image'>
                            <div class='caption'>
                                <h3>Item Name</h3>
                                <p>Item Description</p>
                            </div>
                    </div>
                </div>
            </div>
            <?php 
                if(!empty($formError)){
                    foreach ($formError as $value) {
                        echo "<div class='alert alert-danger'>".$value."</div>";
                    }
                }
                if(isset( $success)){
                    echo "<div class='alert alert-success'>".$success."</div>";
                }
            ?>
        </div>
    </div>
</div>
<?php
    include $tbl.'footer.php';
    }else{
        header('Location:login.php');
    }  
    ob_end_flush();
?>