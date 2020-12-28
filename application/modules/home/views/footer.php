<!-- Footer -->
			<div class="top_arrow" style="position: fixed;bottom: 50px;right: 50px;z-index: 9999;">
				<a id="top_arrow" href="top_arrow" style="color: #1b7c94;display: none;">
					<i class="icon-arrow-up52" style="font-size: 30px;"></i>
				</a>
			</div>
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; <?php echo date('Y'); ?>. <a href="#">Blogs </a> created by <a href="" target="_blank">Avinash</a>
					</span>
				</div>
			</div>
			<input type="hidden" id="f_base_url" value="<?php echo base_url(); ?>">
			<!-- /footer -->

<script>
	
	$(window).scroll(function() {
		if ($(window).scrollTop() > 250) 
		{
			$('#top_arrow').show();
		} 
		else 
		{
			$('#top_arrow').hide();
		}
	});

	$("a[href='top_arrow']").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});


</script>		