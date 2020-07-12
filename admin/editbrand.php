<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/Brand.php';?>
<?php 

    $brand = new Brand();

    if(!isset($_GET['id']) || $_GET['id']==NULL)
    {
         echo "<script>window.location = 'brandlist.php'</script>";

    }
    else 
    {
        $id = $_GET['id'];
    }
    $data_brand = $brand->fetchById($id);
    $item = $data_brand->fetch_assoc();
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $brandName = $_POST['name'];
        $updateBrand = $brand->updateBrand($id,$brandName);
    }

 ?> 
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock"> 
                 <form method="POST">
                     <?php if(isset($updateBrand)){echo $updateBrand;} ?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $item['brand_name']; ?>" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Edit" />
                            </td>
                        </tr>
                    </table>

                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>