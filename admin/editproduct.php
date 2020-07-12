<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/Category.php'; ?>
<?php include_once '../classes/Brand.php'; ?>
<?php include_once '../classes/Product.php'; ?>
<?php 
    $product = new Product();
   if(!isset($_GET['id'])|| $_GET['id']==NULL)
    {
        echo "<script>window.location = 'productlist.php'</script>";

    } else {
        $id = $_GET['id'];
    }
   if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
        $updateProduct = $product->updateProduct($_POST,$_FILES,$id);
    }
    $data_pro = $product->fetchById($id);
     $item = $data_pro->fetch_assoc();

 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit New Product</h2>
        <div class="block">     
            <?php if(isset($updateProduct)){echo $updateProduct;} ?>
          
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $item['product_name'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                             <option value="0">Select Category</option>
                            <?php 
                                $cat = new Category();
                                $catlist = $cat->fetchAll();
                             ?>
                             <?php foreach ($catlist as $data_cat):?>
                             <option
                               <?php if($data_cat['category_id']==$item['category_id']){echo"selected";}?> 
                              value="<?php echo $data_cat['category_id'];?>"><?php echo $data_cat['name'];?></option>
                             <?php endforeach; ?>
                        </select>   
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option value="0">Select Brand</option>
                            <?php 
                                $brand = new Brand();
                                $branlist = $brand->fetchAll();
                             ?>
                             <?php foreach ($branlist as $data_brand):?>
                             <option
                               <?php if($data_brand['brand_id']==$item['brand_id']){echo"selected";} ?> 
                              value="<?php echo $data_brand['brand_id'];?>"><?php echo $data_brand['brand_name']; ?></option>
                             <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="desc"><?php echo $item['description']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $item['price']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>Hình Cu</td>
                    <td><img src="./uploads/<?php echo $item['image']; ?>" alt="image"></td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                        <?php  if($item['type']==1) {?>
                        <option selected value="1">Featured</option>
                        <option selected value="0">Non-Featured</option>
                        <?php
                         } else{
                         ?> 
                          <option selected value="0">Non-Featured</option>
                          <option selected value="1">Featured</option>
                         <?php 
                            }

                          ?>          
                        </select>
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


