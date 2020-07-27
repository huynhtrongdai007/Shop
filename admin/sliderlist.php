<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Slider.php'; ?>
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
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sl = new Slider();
			 $data = $sl->getAllSlider(); ?>
			<?php foreach ($data as $items):?>
				<tr class="odd gradeX">
					<td><?php echo $items['slider_id'] ?></td>
					<td><?php echo $items['title'] ?></td>
					<td><img src="./sliders/<?php echo $items['image']; ?>" height="80px"/></td>				
					<td>
						<a href="">Edit</a> || 
						<a onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
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
