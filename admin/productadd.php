﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/Category.php'; ?>
<?php include_once '../classes/Brand.php'; ?>
<?php include_once '../classes/Product.php'; ?>
<?php 
     $product = new Product();
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
        $insertProduct = $product->insertProduct($_POST,$_FILES);
    }

 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">     
            <?php if(isset($insertProduct)){echo $insertProduct;} ?>
          
         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" placeholder="Enter Product Name..." class="medium" />
                    </td>
                   
                </tr>
                <tr>
                     <td>
                        <label>Code</label>
                    </td>
                    <td>
                        <input type="text" name="product_code" placeholder="Enter Product Code..." class="medium">
                    </td>
                </tr>
                 <tr>
                     <td>
                        <label>Quantity</label>
                    </td>
                    <td>
                        <input type="text" name="productQuantity" placeholder="Enter Quantity Product..." class="medium">
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
                             $data_cat = $cat->fetchAll();
                             ?>
                           <?php foreach ($data_cat as $items): ?>
                            <option value="<?php echo $items['catId']; ?>"><?php echo $items['catName']; ?></option>
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
                                $data_brand = $brand->fetchAll();
                             ?>
                             <?php foreach ($data_brand as $items2):?>
                            <option value="<?php echo $items2['brandId']; ?>"><?php echo $items2['brandName']; ?></option>
                          
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="desc"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
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
                            <option>Select Type</option>
                            <option value="1">Featured</option>
                            <option value="0">Non-Featured</option>
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


