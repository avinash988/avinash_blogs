<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand" style="padding :5px 0px !important;">
			<a href="<?php echo base_url(); ?>home" class="d-inline-block">
				<span style="color: #fff !important; font-size:24px;"> 
					<span style="color:#E62E7F !important;"> Blogs</span> <small style="font-size: 12px !important; color: #d6d6d6 !important;">v1.0.0</small>
				</span>
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>

				<!-- Left Bell Icon -->
				<li class="nav-item dropdown">
					<div id="noti_bell" data-toggle="dropdown">
						<a href="#" class="navbar-nav-link dropdown-toggle caret-0">
							<i class="icon-bell2"></i>
							<span class="badge badge-pill badge-mark bg-orange-400 border-orange-400 ml-auto ml-md-0"></span>
						</a>
					</div>

					<div class="dropdown-menu dropdown-content wmin-md-350">
						<div class="dropdown-content-header">
							<span class="font-weight-semibold">Notification</span>
							<a href="javascript:void(0);" onclick="call_notification();" class="text-default"><i class="icon-sync"></i></a>
						</div>

						<div class="dropdown-content-body dropdown-scrollable">
							<ul class="media-list" id="notifi_alert">
								
							</ul>
						</div>

						<div class="dropdown-content-footer bg-light">
							<a href="#" class="text-grey mr-auto">All activity</a>
							<div>
								<a href="#" class="text-grey" data-popup="tooltip" title="Clear list"><i class="icon-checkmark3"></i></a>
								<a href="#" class="text-grey ml-2" data-popup="tooltip" title="Settings"><i class="icon-gear"></i></a>
							</div>
						</div>
					</div>
				</li>
				<!-- Left Bell Icon -->

			</ul>

			<ul class="navbar-nav ml-md-auto">

				<li class="nav-item dropdown dropdown-user">
					<?php 
						$sr = $this->session->userdata('bh_u_sr');
						$user_image = $this->session->userdata('bh_user_image');
					?>
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url().'global_assets/images/placeholders/placeholder.jpg'; ?>" class="rounded-circle mr-2" height="34" width="34" alt="">
						<span><?=$this->session->userdata('bh_full_name');?></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="<?php echo base_url(); ?>profile/" class="dropdown-item"><i class="icon-user"></i> My profile</a>
						<div class="dropdown-divider"></div>
						<a href="<?php echo base_url(); ?>logout/" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
				</li>

			</ul>
		</div>
	</div>
	<!-- /main navbar -->