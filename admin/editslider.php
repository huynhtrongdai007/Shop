<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Slider.php'; ?>
<?php 
 $sl = new Slider();
    if(!isset($_GET['id'])|| $_GET['id']==NULL)
    {
        echo "<script>window.location = 'sliderlist.php'</script>";

    } else {
        $id = $_GET['id'];
    }

   $getsliderById = $sl->getBYId($id)->fetch_assoc();
   if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
        $updateSlider = $sl->updateSlider($_POST,$_FILES,$id);
    }
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
        <?php if (isset($updateSlider)) {
           echo $updateSlider;
        } ?>
    <div class="block">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $getsliderById['title']; ?>" placeholder="Enter Slider Title..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image"/>
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