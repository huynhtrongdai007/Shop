<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include'../classes/User.php'; ?>
<?php 
    
    $changepassword = new User();
 
   if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
        $oldpass = $_POST['oldpass'];
        $newPass = $_POST['newPass'];
        $action = $changepassword->changePassword($oldpass,$newPass);
    }   

 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">               
         <form action="changepassword.php" method="POST">
      
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldpass" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newPass" class="medium" />
                    </td>
                </tr>
				   <tr>
                    <td></td>
                       <td>
                    <?php 
                        if (isset($action)) {
                            echo $action;
                        }
                     ?>
                
                       </td>
                   </tr>
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>