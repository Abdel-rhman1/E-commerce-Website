<?php
    session_start();
    if(isset($_SESSION['username'])){
        $title="Categories";
        include_once "init.php";
        $do=isset($_GET['do'])?$_GET['do']:'Manage';
        if($do=='Manage'){
            $sort='ASC';
            $sort_array=array('ASC','DESC');
            if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
                $sort=$_GET['sort'];
            }
            $stat="select * from categories3 where Parent=0 order by Ordering $sort";
            $excute=mysqli_query($con,$stat);
            $count=mysqli_num_rows($excute);
        ?>
            <h1 class="text-center">Manage Category</h1>
            <div class="container category">
                <?php
                    if($count!=0){ 
                ?>   
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class='fa fa-edit'></i>Manage Category
                        <div class="option pull-right">
                        <i class="fa fa-sort"> </i>Order By[
                            <a class='<?php if($sort=='ASC'){ echo 'active';} ?>' href="?sort=ASC">ASC</a> |
                            <a class='<?php if($sort=='DESC'){ echo 'active';} ?>'href="?sort=DESC">DESC</a>
                            ]<i class="fa fa-eye"></i>View[
                            <span data-view="full"class="active">Full</span> |
                            <span data-view="class">Classic</span>]
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                            while($row =mysqli_fetch_assoc($excute)){
                                echo "<div class='cat'>";
                                    echo "<div class='hidden-button'>";
                                        $ID=$row['ID'];
                                        echo "<a href='?do=Edit&catid=$ID' class='btn btn-xs btn-success'>
                                        <i class='fa fa-edit'></i>Etid</a>";
                                        echo "<a href='?do=Delete&catid=$ID' class='confirm btn btn-xs btn-danger'>
                                        <i class='fa fa-close'></i>Delete</a>";
                                echo "</div>";
                                    echo "<h3>".$row['Name']."</h3>";
                                    echo "<div class='option-view'>";
                                        echo "<p>" ; if($row['Description']=='') {
                                            echo "This Section Has No Description";}else{ echo $row['Description'];}
                                        echo "</p>";
                                        if($row['Visibility']==1){
                                            echo "<span class='Visi'>Hidden</span>";
                                        }
                                        if($row['Allow_Comments']==1){
                                            echo "<span class='Commenting'>Comment Displed</span>";
                                        }
                                        if($row['Allow_Ads']==1){
                                            echo "<span class='Adev'>Ads Displed</span>";
                                        }
                                    echo "</div>";
                                     $stat="select * from categories3 where Parent={$row['ID']}";
                                    $excut=mysqli_query($con,$stat);
                                    $count=mysqli_num_rows($excut);
                                    if($count>0){
                                        echo "<h4 class='child-head'>Child Category</h4>";
                                        echo "<ul class='list-unstyled child-cats'>";
                                        while($C=mysqli_fetch_assoc($excut)){
                                            $id=$C['ID']; 
                                            echo "<li class='child-class'><a href='?do=Edit&catid=$id'>".$C['Name']."</a>"." ";
                                            echo "<a class='show-delete'href='?do=Delete&catid=$id'>Delete</a>";
                                            echo "</li>";
                                        }
                                        echo "</ul>";
                                    }
                                echo "</div>";
                                echo "<hr/>";
                            }
                        ?>
                    </div>
                </div>
                <a href="categories.php?do=Add"class="pull-left Add-category btn btn-primary">
                <i class="fa fa-plus"></i>Add New Category</a>
                <a href='categories.php?do=excel' class='btn btn-success Add-category pull-right'>
                    <i class="fa fa-download" aria-hidden="true"></i>
                    Export to excel
                </a>
            <?php
                }else{
                    echo "<div class='alert alert-danger'>";
                       echo " There Is Records To Show ";
                    echo "</div>";
                    echo '<a href="categories.php?do=Add"class="Add-category btn btn-primary">
                    <i class="fa fa-plus"></i>Add New Category</a>';
                } 
            ?>
            </div>
        <?php
        }elseif($do=='Add'){?>
            <div class="container">
                <h1 class="text-center">Add New Category</h1>
                <form class="form-horizontal" action="?do=Insert" method="POST">
                    <div class="form-group form-group-lg">
                        <label class="control-label col-md-2">Name</label>
                        <div class="col-md-7">
                            <input type="text"class="form-control" name="name" placeholder="Type Category Name"
                            required="required">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="control-label col-md-2">Description</label>
                        <div class="col-md-7">
                            <input type="text"class="form-control" name="Desc" placeholder="Type Categoriy Desc">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="control-label col-md-2">Ordering</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="Ordering" placeholder="Type Ordering">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="control-label col-md-2">Parent?</label>
                        <div class="col-sm-7">
                            <select name='Parent'>
                                <option value="0" selected>None</option>
                                <?php
                                    $stat="select * from categories3 where Parent=0";
                                    $excu=mysqli_query($con,$stat);
                                    while($Cat=mysqli_fetch_assoc($excu)){
                                        $ID=$Cat['ID'];
                                        echo "<option value='$ID'>";echo $Cat['Name'];echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-2">Visible</label>
                        <div class="col-md-7">
                            <div>
                                <input id="vis-yes" type="radio" value="0"  name="vis" checked>
                                <label for="vis-yes">yes</label>
                            </div>
                            <div>
                                <input id="vis-no" type="radio" value="1" name="vis">
                                <label for="vis-no">no</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-2">Allow Comments</label>
                        <div class="col-md-7">
                            <div>
                                <input id="com-yes" type="radio" value="0"  name="com" checked>
                                <label for="com-yes">yes</label>
                            </div>
                            <div>
                                <input id="com-no" type="radio" value="1"  name="com">
                                <label for="com-no">no</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-2">Allow Ads</label>
                        <div class="col-md-7">
                            <div>
                                <input id="ads-yes" type="radio" value="0"  name="ads" checked>
                                <label for="ads-yes">yes</label>
                            </div>
                            <div>
                                <input id="ads-no" type="radio" value="1"  name="ads">
                                <label for="ads-no">no</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-primary btn-lg" 
                            value="Save">
                        </div>
                    </div>
                </form>
            </div>
        <?php
        }elseif($do=='Insert'){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                echo "<h1 class='text-center'>Add New Category</h1>";
                echo "<div class='container'>";
                $name=$_POST['name'];
                $desc=$_POST['Desc'];
                $order=$_POST['Ordering'];
                $Visible=$_POST['vis'];
                $Comments=$_POST['com'];
                $ads=$_POST['ads'];
                $Parent=$_POST['Parent'];
                echo $Parent."<br/>";
                if(!empty($name)){
                    $num=checkItem('Name','categories3',$name);
                    if($num>0){
                        $msg= "<div class='alert alert-danger'>This Category is Already exits</div>";
                        redirectIndexPage($msg,6,'categories.php?do=Add');
                    }else{
                        $stat="Insert Into categories3 (Name,Description,
                        Visibility,Allow_Comments,Allow_Ads,Ordering,Parent)
                        Values('$name','$desc','$Visible','$Comments','$ads','$order','$Parent')";
                        $excute=mysqli_query($con,$stat);
                        if($excute){
                            $msg= "<div class='alert alert-success'>1 Record Inserted</div>";
                            redirectIndexPage($msg,6,'categories.php');
                        }else{
                            $msg= "<div class='alert alert-danger'>0 Record Inserted</div>";
                            redirectIndexPage($msg,6,'categories.php?do=Add');
                        }
                    }
                }else{
                    $msg= "<div class='alert alert-danger'>This Field Must not Be Empty </div>";
                    redirectIndexPage($msg,6,'categories.php?do=Add');
                }
            }else{
                $msg= "<div class='alert alert-danger'>You Can't Browse This Page Direct </div>";
                    redirectIndexPage($msg,6,'categories.php?do=Add');
            }

        }elseif($do=='Edit'){
           $catid=isset($_GET['catid']) && is_numeric($_GET['catid'])?intval($_GET['catid']):0;
           $stat="select * from categories3 where ID='$catid'";
           $excute=mysqli_query($con,$stat);
           $count=mysqli_num_rows($excute);
           $row=mysqli_fetch_assoc($excute);
           if($count>0){ ?>
                <div class="container">
                <h1 class="text-center">Update Category Info</h1>
                <form class="form-horizontal" action="?do=Update" method="POST">
                <input type="hidden"name="ID"value="<?php echo $row['ID']; ?>">
                    <div class="form-group form-group-lg">
                        <label class="control-label col-md-2">Name</label>
                        <div class="col-md-7">
                            <input type="text"class="form-control" name="name" placeholder="Type Category Name"
                            required="required" autocomplete="off" value="<?php echo $row['Name']; ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="control-label col-md-2">Description</label>
                        <div class="col-md-7">
                            <input type="text"class="form-control" name="Desc" placeholder="Type Categoriy Desc"
                            value="<?php echo $row['Description']; ?>">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="control-label col-md-2">Ordering</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="Ordering" placeholder="Type Ordering"
                            value="<?php echo $row['Ordering'];?>">
                        </div>
                    </div>
                    <div class="form-group form-group-lg">
                        <label class="control-label col-md-2">Parent?</label>
                        <div class="col-sm-7">
                            <select name='Parent'>
                                <option value='0'>None</option>
                                <?php
                                    $stat="select * from categories3 where Parent=0";
                                    $excu=mysqli_query($con,$stat);
                                    while($Cat=mysqli_fetch_assoc($excu)){
                                        $ID=$Cat['ID'];
                                        echo "<option value='$ID'>";echo $Cat['Name'];echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-2">Visible</label>
                        <div class="col-md-7">
                            <div>
                                <input id="vis-yes" type="radio" value="0"  name="vis" <?php if($row['Visibility']==0){
                                    echo 'checked';
                                }?>>
                                <label for="vis-yes">yes</label>
                            </div>
                            <div>
                                <input id="vis-no" type="radio" value="1" <?php if($row['Visibility']==1){
                                    echo 'checked';}?> name="vis">
                                <label for="vis-no">no</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-2">Allow Comments</label>
                        <div class="col-md-7">
                            <div>
                                <input id="com-yes" type="radio" value="0"  name="com" <?php if($row['Allow_Comments']==0){
                                    echo 'checked';}?>>
                                <label for="com-yes">yes</label>
                            </div>
                            <div>
                                <input id="com-no" type="radio" value="1"  name="com" <?php if($row['Allow_Comments']==1){
                                    echo 'checked';}?>>
                                <label for="com-no">no</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-2">Allow Ads</label>
                        <div class="col-md-7">
                            <div>
                                <input id="ads-yes" type="radio" value="0"  name="ads" <?php if($row['Allow_Ads']==0){
                                    echo 'checked';}?>>
                                <label for="ads-yes">yes</label>
                            </div>
                            <div>
                                <input id="ads-no" type="radio" value="1"  name="ads" <?php if($row['Allow_Ads']==1){
                                    echo 'checked';}?>>
                                <label for="ads-no">no</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" class="btn btn-primary btn-lg" 
                            value="Save">
                        </div>
                    </div>
                </form>
            </div>
           <?php
           }else{
                $msg= "<div class='alert alert-danger'>This Category dosent exit in DataBase </div>";
                redirectIndexPage($msg,6,'categories.php?do=Edit');   
           }
        }elseif($do=='Update'){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                echo "<h1 class='text-center'> Update Category Page</h1>";
                echo "<div class='container'>";
                $ID=$_POST['ID'];
                $name=$_POST['name'];
                $desc=$_POST['Desc'];
                $order=$_POST['Ordering'];
                $Visible=$_POST['vis'];
                $Comments=$_POST['com'];
                $ads=$_POST['ads'];
                $parent=$_POST['Parent'];
                if(!empty($name)){
                    $stat="update  categories3 set Name='$name',Description='$desc',
                    Visibility='$Visible',Allow_Comments='$Comments',Allow_Ads='$ads'
                    ,Ordering='$order' where ID='$ID' Parent='$parent'";
                    $excute=mysqli_query($con,$stat);
                    if($excute){
                        $msg= "<div class='alert alert-success'>1 Record Updated</div>";
                        redirectIndexPage($msg,6,'categories.php');
                    }else{
                        $msg= "<div class='alert alert-danger'>0 Record Updated</div>";
                        redirectIndexPage($msg,6,"categories.php?do=Edit?catid='$ID'");
                    }
                }else{
                    $msg= "<div class='alert alert-danger'>This Field Must not Be Empty </div>";
                    redirectIndexPage($msg,6,"categories.php?do=Edit?catid='$ID'");
                }
            }else{
                $msg= "<div class='alert alert-danger'>You Can't Browse This Page Direct </div>";
                    redirectIndexPage($msg,6,'categories.php');
            }
            echo "</div>";
        }elseif($do=='Delete'){
            $catid=isset($_GET['catid']) && is_numeric($_GET['catid'])?
            $_GET['catid']:intval($_GET['catid']);
           if(checkItem('ID','categories3',$catid)){
               $stat="delete from categories3 where ID='$catid'";
               $excute=mysqli_query($con,$stat);
               if($excute){
                    $msg= "<div class='alert alert-success'>1 Record Deleted </div>";
                    redirectIndexPage($msg,6,'categories.php');
               }else{
                $msg= "<div class='alert alert-danger'>0 Record Deleted</div>";
                redirectIndexPage($msg,6,'categories.php');
               }
           }else{
            $msg= "<div class='alert alert-danger'>This Category Dosent Exist</div>";
            redirectIndexPage($msg,6,'categories.php'); 
           }
        }else if($do=='excel'){
            $stat="select * from categories3";
            $ex=mysqli_query($con,$stat);
            $output='';
            if(mysqli_num_rows($ex)>0){
                $output.='<table class="table" bordered="1">
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>parent</th>
                    </tr>';
            }
            while($row=mysqli_fetch_assoc($ex)){
                $output.='<tr>'.
                '<td>'.$row['ID'].'</td>'.
                '<td>'.$row['Name'].'</td>'.
                '<td>'.$row['Description'].'</td>'.
                '<td>'.$row['Parent'].'</td>'.'</tr>';
            }
            $output.='</table>';
            header("Content-Type:application/xls");
            header("Content-Disposition:attachment;filename=download.xls");
            echo $output;
        }
        
    }else{
        header('index.php');
    }
?>