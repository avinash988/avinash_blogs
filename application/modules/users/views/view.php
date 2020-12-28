<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- lib include --> 
	<?php $this->load->view("home/header_lib") ?>

</head>

<body>
	<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
	
	<!-- top bar start here -->
	<?php $this->load->view("home/top_header") ?>
	<!-- top bar end here -->

	<!-- Page content Start here -->
	<div class="page-content">

		<!-- top bar start here -->
		<?php $this->load->view("home/left_nav_bar") ?>
		<!-- top bar end here -->

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">

				<!-- Top Page Header start here -->
				<?php $this->load->view("home/page_header"); ?>
				<!-- Top Page Header end here -->

			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">
				<div class="col-md-6 offset-3">
					<div class="card">
						<div class="card-header bg-white header-elements-inline">
							<h6 class="card-title">View Blogs</h6>
						</div>
						<div class="card-body">
								<div class="form-group">
									<label>Category: </label>
									<input type="text" class="form-control" placeholder="Enter title" name="category" value="<?php echo $res['category']; ?>" readonly>
								</div>

								<div class="form-group">
									<label>Title: </label>
									<input type="text" class="form-control" placeholder="Enter title" name="title" value="<?php echo $res['title']; ?>" readonly>
								</div>

								<div class="form-group">
									<label>Description: </label>
									<input type="text" class="form-control" placeholder="Enter title" name="description" value="<?php echo $res['description']; ?>" readonly>
								</div>

								<div class="form-group">
									<label>Image: </label>
									<!-- <input type="file" name="browse"> -->
									<?php 
										if($res['image'] == "")
										{
									?>
										<img src="<?php echo base_url().'global_assets/images/placeholders/placeholder.jpg'; ?>" class="img-rounded" width="100" height="100" alt="">
									<?php
										}
										else
										{
									?>
										<img class="img-rounded" src="<?php echo base_url().'uploads/'.$res['image']; ?>" width="100" height="100" alt="">
									<?php 
										} 
									?>
								</div>
								<div class="form-group">
									<a class="btn btn-primary" href="<?php echo base_url()."users";?>">Back</a>
								</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /content area -->

			<!-- Footer Start here -->
			<?php $this->load->view("home/footer") ?>
			<!-- Footer End here -->

		</div>
		<!-- /main content -->

	</div>
	<!-- Page content End here -->

</body>
</html>