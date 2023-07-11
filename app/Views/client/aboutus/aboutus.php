<?php 
include(APPPATH . 'Views/client-layout/header.php');
include(APPPATH . 'Views/client-layout/navbar.php');
include(APPPATH . 'Views/client-layout/aboutus/view-aboutus-banner.php');
?>

	<!-- Main container start -->

	<section id="main-container">
		<div class="container">

        <?php include(APPPATH . 'Views/client-layout/aboutus/view-company.php');?>

		</div><!--/ 1st container end -->

			
		<div class="gap-60"></div>


		<?php include(APPPATH . 'Views/client-layout/counter.php');?>

		<div class="gap-60"></div>

        <?php include(APPPATH . 'Views/client-layout/team.php');?>
		
	 </section><!--/ Main container end -->
	


	<div class="gap-40"></div>

	<?php include(APPPATH . 'Views/client-layout/footer.php');?>