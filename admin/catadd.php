<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/Category.php';?>
<?php 
    $cat = new Category();
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $cateName = $_POST['name'];
        $insertcategory = $cat->insertCategory($cateName);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                 <form action="catadd.php" method="POST">
                     <?php if(isset($insertcategory)){echo $insertcategory;} ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>

                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>