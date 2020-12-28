<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<?php 
								$sr = $this->session->userdata('bh_u_sr');
								$user_image = $this->session->userdata('bh_user_image');
							?>
							<div class="mr-3">
								<a href="#"><img src="<?php echo base_url().'global_assets/images/placeholders/placeholder.jpg'; ?>" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">
									<?=$this->session->userdata('bh_full_name');?>		
								</div>
								<div class="font-size-xs opacity-50">
									<?=$this->session->userdata('bh_designation');?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item-header">
							<div class="text-uppercase font-size-xs line-height-xs">Main</div><i class="icon-menu" title="Main"></i>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url(); ?>home" class="nav-link"><i class="icon-home4"></i><span>Blogs</span></a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url(); ?>add_blog" class="nav-link"><i class="icon-blog"></i><span>Add Blog</span></a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url(); ?>users" class="nav-link"><i class="icon-user"></i> <span>Users</span></a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url(); ?>logout" class="nav-link"><i class="icon-switch2"></i> <span>Logout</span></a>
						</li>
						
						<!-- /page kits -->

					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->
			
		</div>
		<!-- /main sidebar -->