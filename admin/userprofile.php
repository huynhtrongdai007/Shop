<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/User.php'; ?>
<?php 
    $user = new User();
    $username = $_GET['user'];
    $getprofile = $user->userProfile($username);
    $getUser = $getprofile->fetch_assoc();
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>User: <?php echo $getUser['adminUser'] ?></h2>
    <div class="block">               
         <form action="" method="post">
            <table class="form">     
                <tr>
                    <td>
                        <label>Tên</label>
                    </td>
                    <td>
                        <input type="text" disabled value="<?php echo $getUser['adminName'] ?>" class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                       <input type="text" disabled value="<?php echo $getUser['adminUser'] ?>" class="medium" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                       <input type="text" disabled value="<?php echo $getUser['adminEmail'] ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td><label>Password</label></td>
        
                    <td><input type="password" id="password" value="<?php echo $getUser['adminPass'] ?>" disabled class="medium" />

                    </td>

                </tr>
                  <tr>
                    <td> <td> <input type="checkbox" onclick="displayPassword()">Show Password</td></td>
                </tr>
                <tr>
                    <td><label>Level</label></td>
                    <td>
                    <input type="text" value="<?php  if($getUser['level']==1 ){echo "Admin";} else {echo"Người Thường";} ?>"  disabled  />
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

<script type="text/javascript">
function displayPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>