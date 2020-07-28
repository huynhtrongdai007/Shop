<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Slider.php'; ?>
<?php 
		$sl = new Slider();
		if(isset($_GET['id']) && isset($_GET['status']))
		{
			$id = $_GET['id'];
			$status = $_GET['status'];
			$sl->updateStatus($id,$status);
		}

 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
		
			 $data = $sl->getAllSlider(); ?>
			<?php foreach ($data as $items):?>
				<tr class="odd gradeX">

					<td><?php echo $items['slider_id'] ?></td>
					<td><?php echo $items['title'] ?></td>
					<td><img src="./sliders/<?php echo $items['image']; ?>" height="80px"/></td>
					<td>
						<?php if($items['status']==1){?>
						<a href="?id=<?php echo $items['slider_id'] ?>&status=0">On</a>
						<?php }else{ ?>
							<a href="?id=<?php echo $items['slider_id'] ?>&status=1">Off</a>
						<?php } ?>
					</td>				
					<td>
						<a href="editslider.php?id=<?php echo $items['slider_id'] ?>">Edit</a> || 
						<a onclick="return confirm('Are you sure to Delete!');" href="delslider?id=<?php echo $items['slider_id'] ?>">Delete</a> 
					</td>
				</tr>	
			<?php endforeach; ?>
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
