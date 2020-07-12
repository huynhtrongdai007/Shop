<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/Category.php';?>
<?php 
    $cat = new Category();
    if(!isset($_GET['id'])|| $_GET['id']==NULL)
    {
        echo "<script>window.location = 'catlist.php'</script>";

    } else {
        $id = $_GET['id'];
    }

    $data_cat = $cat->fetchById($id);
    $items = $data_cat->fetch_assoc();
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $cateName = $_POST['name'];
          $id = $_GET['id'];
        $editcat = $cat->updateCategory($cateName,$id);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                     <?php if(isset($editcat)){echo $editcat;} ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $items['name']; ?>" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Eidt" />
                            </td>
                        </tr>
                    </table>

                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>