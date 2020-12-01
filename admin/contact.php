<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/Contact.php'; ?>
<?php
 $contact = new Contact(); 
  $getAllContact = $contact->fetchAll();
$stt = 0;
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						
						<tr>
							<th>STT</th>
							<th>Tên Người Liên Hệ</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Subject</th>
							<th>Action</th>
						</tr>
				
					</thead>
					<tbody>

						<?php
						if (!empty($getAllContact)) {
						 foreach ($getAllContact as $item):

						  $stt++

						  ?>
						<tr>
							<td><?php echo $stt; ?></td>	
							<td><?php echo $item['name']; ?></td>	
							<td><?php echo $item['email']; ?></td>	
							<td><?php echo $item['phone']; ?></td>	
							<td><?php echo $item['subject']; ?></td>
							<td>

								<a onclick="return acceptDelete('are you sure want record delete this')" href="delcontact.php?id=<?php echo $item['id'];?>">Delete</a>
							</td>	
						</tr>
						<?php endforeach;} else {
							echo "";
						} ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>


