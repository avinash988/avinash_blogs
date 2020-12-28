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

				<?php foreach($res as $row){ ?>
					<?php 
						$sr = $row['sr'];
					?>

				<div class="row">
					<div class="col-md-8">
						<div class="card">
							<div class="row">
								<div class="col-md-2">
									<?php 
										if($row['image'] == "")
										{
									?>
										<img src="<?php echo base_url().'global_assets/images/placeholders/placeholder.jpg'; ?>" class="img-rounded" width="100" height="100" alt="">
									<?php
										}
										else
										{
									?>
										<img class="img-rounded" src="<?php echo base_url().'uploads/'.$row['image']; ?>" width="100" height="100" alt="">
									<?php 
										} 
									?>
								</div>
								<div class="col-md-6">
									<div class="row">
										<h5><?=$row['category']." = ".$row['title']; ?></h5>
									</div>
									<div class="row mt-2">
										<div class="col-md-3">
											<a class="btn btn-secondary" href="<?php echo base_url()."users/view/".$row['sr'];?>">View</a>
										</div>
										<div class="col-md-3">
											<a class="btn btn-primary" id="edit" href="<?php echo base_url()."users/edit/".$row['sr'];?>">Edit</a>
										</div>
										<div class="col-md-3">
											<a class="btn btn-danger" id="delete" href="<?php echo base_url()."users/delete/".$row['sr'];?>">Delete</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php } ?>
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