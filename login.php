<?php include_once 'lib/session.php'; ?>
	
<?php include 'inc/header.php'; ?>

<?php 

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
    {
        $insertCustomer = $cus->insertCustomer($_POST);
    }
 ?>
<?php 
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login']))
	{
		$loginCustomer = $cus->loginCustomer($_POST);
	}
 ?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<?php if (isset($loginCustomer)){echo $loginCustomer;}?>
        	<form action="" method="POST" id="member">
                	<input  type="text" name="email" class="field" placeholder="Enter E-Mail">
                    <input  type="password" name="password" class="field" placeholder="Enter Password">
                 
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><input type="submit" class="grey" name="login" value="Sign In"></div>
                </div>
            </form>
         </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php 
    			if(isset($insertCustomer)){echo $insertCustomer;}
    		 ?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter Name">
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Enter City">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Enter Zip-Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter E-Mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter Address">
						</div>
		    		<div>
						<select id="country" name="country" class="frm-field required">
							<option value="null">Select a Country</option> 
							<?php $getCountries =  $cus->getCountries(); ?>    
							   <?php foreach ($getCountries as $item): ?>
							    	<option value="<?php echo $item['TwoCharCountryCode'] ?>"><?php echo $item['CountryName']; ?></option>
							    <?php endforeach ?>    
							
							

		       		  </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Enter Phone">
		          </div>
				  
				  <div>
					<input type="password" name="password" placeholder="Enter Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Create Account"></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>

<?php include 'inc/footer.php'; ?>
