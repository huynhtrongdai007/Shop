<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/User.php';?>
<?php
$fm = new Format(); 
	$user = new User();
	$result = $user->fetchAll();
    $stt = 0;
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>ID</th>
					<th>Tên User</th>
					<th>Username</th>
					<th>Email</th>
					<th>level</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $item): $stt++;?>
				<tr>
					<td><?php echo $stt;?></td>
					<td><?php echo $item['adminId']; ?></td>
					<td><?php echo $item['adminName']; ?></td>
					<td><?php echo $item['adminUser']; ?></td>
					<td><?php echo $item['adminEmail']; ?></td>
					<td><?php echo $item['level']; ?></td>
					<td><a href="edituser.php?id=<?php echo $item['adminId'] ?>">Edit</a> | <a onclick="return acceptDelete('are you sure want category delete this') " href="deluser.php?id=<?php echo $item['adminId'] ?>">Delete</a></td>
				</tr>
				<?php endforeach ?>	
				
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
