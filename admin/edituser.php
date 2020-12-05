<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/User.php'; ?>
<?php 
    $user = new User();
    $id = $_GET['id'];
    $getbyid = $user->getById($id);
    $item =  $getbyid->fetch_assoc();


    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
         $updateUser = $user->updateData($_POST,$id);
    }   


 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
        <?php if (isset($insertcategory)) {
           echo $insertcategory;
        } ?>
    <div class="block">               
         <form action="" method="post">
            <table class="form">     
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input type="text" name="adminName" value="<?php echo $item['adminName'] ?>" placeholder="Enter Name..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                       <input type="text" name="adminUser" value="<?php echo $item['adminUser'] ?>" placeholder="Enter Username..." class="medium" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                       <input type="email" disabled   value="<?php echo $item['adminEmail'] ?>" placeholder="Enter Email..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td><label>Level</label></td>
                    <td>
                        <select name="level">
                            <?php if($item['level']==1) {?>
                            <option  value="2">Người Thường</option>
                            <option selected value="1">Admin</option>
                            <?php }else { ?>   
                            <option  value="2">Người Thường</option>
                            <option selected value="1">Admin</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <?php 
                           if (isset($updateUser)) {
                               echo $updateUser;
                           }

                         ?>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>