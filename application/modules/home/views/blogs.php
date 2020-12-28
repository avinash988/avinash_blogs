<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- lib include --> 
	<?php $this->load->view("home/header_lib") ?>

	<style>
		@media screen and (max-width: 700px) 
		{
			.nav-link{
				height: 50px !important;
				padding-top: 0 !important;
				padding-bottom: 0 !important;
			}
			.pie-chart{
				height: 280px !important;
			}
			.canvas{
				top: -20px !important;
			}
	    }
	</style>

</head>

<body>
	<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

	<!-- Page content Start here -->
	<div class="page-content">

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
				<div class="row mb-3">
					<a href="<?php echo base_url().'login'?>">Login</a>
				</div>
				<div class="flex-fill overflow-auto">
                        <div class="form-group col-md-4">
                            <label>Category</label><br>
                            <select class="form-control" id="cat_change">
                                <option value="all" selected>All</option>
                                <?php
                                    
                                    foreach($cat_list as $cat)
                                    {
                                        $selected = '';
                                        if($cat_type == $cat['category'])
                                        {
                                            $selected = 'selected';
                                        }
                                ?>

                                <option value="<?php echo $cat['category']; ?>" <?php echo $selected; ?>><?php echo $cat['category']; ?></option>

                                <?php        

                                    }
                                ?>
                                
                            </select>
                        </div>

						<!-- List layout -->
			            <div class="card">
							<div class="card-header bg-white header-elements-inline">
								<h6 class="card-title">Blogs</h6>
								
							</div>

							<ul class="media-list">

								<?php foreach($blog_list as $row){ ?>
								<?php 
									$sr = $row['sr'];
								?>
								<li class="media card-body flex-column flex-sm-row">
									<div class="mr-sm-3 mb-2 mb-sm-0">
										<?php 
											if($row['image'] == "")
											{
										?>
											<img src="<?php echo base_url().'global_assets/images/placeholders/placeholder.jpg'; ?>" class="img-rounded" width="44" height="44" alt="">
										<?php
											}
											else
											{
										?>
											<img class="img-rounded" src="<?php echo base_url().'uploads/'.$row['image']; ?>" width="44" height="44" alt="">
										<?php 
											} 
										?>
									</div>

									<div class="media-body">
										<h6 class="media-title font-weight-semibold">
											<!-- <a href="#">Interaction UX/UI Industrial Designer</a> -->
											<h3><?=$row['category']; ?></h3>
										</h6>

										<ul class="list-inline list-inline-dotted text-muted mb-2">
											<li class="list-inline-item"><?=$row['title']; ?></li>
										</ul>

										<?=$row['description']; ?>
									</div>

									<div class="ml-sm-3 mt-2 mt-sm-0">
										<span class="badge bg-blue"><?=$row['added_on']; ?></span>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
						<!-- /list layout -->


						<!-- Pagination -->
						<div class="d-flex justify-content-center pt-3 mb-3">
							<ul class="pagination">
                                <?php
                                    for($i = 1; $i <= $page_records; $i++)
                                    {
                                        $active_link = '';
                                        if($page_num_lbl == $i)
                                        {
                                            $active_link = 'active';
                                        }
                                ?>
                                    <li class="page-item <?php echo $active_link; ?>"><a href="<?php echo base_url()."home/blogs/".$cat_type."/".$i; ?>" class="page-link"><?php echo $i; ?></a></li>
                                <?php        
                                    }
                                ?>
							</ul>
						</div>
						<!-- /pagination -->

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

    <script>
    var base_url = $('#base_url').val();
        $('#cat_change').change(() => {
            var cat_change = $('#cat_change').val();
            //alert(cat_change);
            //window.location.replace();
            window.location.href = base_url+"home/blogs/"+cat_change;
        });
    </script>

</body>
</html>

