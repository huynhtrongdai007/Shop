<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/customer.php';?>
<?php 
    $cus = new Customer();
    if(!isset($_GET['customerid'])|| $_GET['customerid']==NULL)
    {
        echo "<script>window.location = 'inbox.php'</script>";

    } else {
        $id = $_GET['customerid'];
    }

    $getCustomer =  $cus->showCustomer($id);
    $item =  $getCustomer->fetch_assoc();

 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $item['name'] ?>" class="medium"></td>
                        </tr>
						 <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $item['address'] ?>"class="medium"></td>
                        </tr>
                         <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $item['city'] ?>"class="medium"></td>
                        </tr>
                         <tr>
                            <td>County</td>
                            <td>:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $item['country'] ?>"class="medium"></td>
                        </tr>
                         <tr>
                            <td>Zip-Code</td>
                            <td>:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $item['zipcode'] ?>"class="medium"></td>
                        </tr>
                         <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $item['phone'] ?>"class="medium"></td>
                        </tr>
                         <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="text" readonly="readonly" value="<?php echo $item['email'] ?>"class="medium"></td>
                        </tr>
                    </table>

                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>