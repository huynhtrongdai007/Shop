<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/User.php'; ?>
<?php 
    $user = new User();
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
       $createUser = $user->insert($_POST);
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
                        <input type="text" name="adminName" placeholder="Enter Name..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                       <input type="text" name="adminUser" placeholder="Enter Username..." class="medium" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                       <input type="text"  name="adminEmail" placeholder="Enter Email..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
                    <td><input type="password" name="adminPass" placeholder="Enter Password..." class="medium" /></td>
                </tr>
                <tr>
                    <td><label>Level</label></td>
                    <td>
                        <select name="level">
                            <option value="0">Người Thường</option>
                            <option value="1">Admin</option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <?php 
                            if (isset($createUser)) {
                                echo $createUser;
                            }
                         ?>
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