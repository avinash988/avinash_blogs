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
							<h6 class="card-title">Add Blogs</h6>
						</div>
						<div class="card-body">
							<form action="<?php echo base_url().'add_blog/add_new_blog_process'; ?>" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label>Category: </label>
								    <select name="category" data-placeholder="Select" class="form-control form-control-select2" data-fouc>
										<option></option>
										<optgroup label="Select">
											<option value="PHP"<?php echo set_select("category", "PHP"); ?> >PHP</option>
											<option value="JavaScript"<?php echo set_select("category", "JavaScript"); ?> >JavaScript</option>
											<option value="Java"<?php echo set_select("category", "Java"); ?> >Java</option>
											<option value="Python"<?php echo set_select("category", "Python"); ?> >Python</option>
										</optgroup>
									</select>
									<span class="text-danger"><?php echo form_error('category'); ?></span>
								</div>

								<div class="form-group">
									<label>Title: </label>
									<input type="text" class="form-control" placeholder="Enter title" name="title" value="<?php echo set_value('title'); ?>">
									<span class="text-danger"><?php echo form_error('title'); ?></span>
								</div>

								<div class="form-group">
									<label>Description: </label>
									<textarea class="form-control" rows="4" cols="50" name="description"><?php echo set_value('description'); ?></textarea>
									<span class="text-danger"><?php echo form_error('description'); ?></span>
								</div>

								<div class="form-group">
									<label>Image: </label>
									<input type="file" name="browse">
								</div>

								<div class="form-group">
									<input type="submit" class="form-control btn btn-success" id="submit" name="submit" value="Submit">
								</div>
							</form>
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