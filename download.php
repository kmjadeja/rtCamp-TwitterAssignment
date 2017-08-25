<?php session_start();

	// Check AccessToken Is There Or NOT
		if (!isset($_SESSION['access_token']) || !isset($_SESSION["dUserScreen"])) {
			header("location: logout.php");
			exit();
		}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>rtCamp Twitter Assignment | Download Tweets</title>

	<!-- Include StyleSheets -->
		<?php require_once("includes/stylesheets.inc.php"); ?>
</head>
<body>
<!-- Wrapper Start -->
	<div class="container cus_container">

		<div class="rows">
			
			<?php require_once("includes/header.inc.php"); ?>

			<!-- BreadCrum Start -->
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<li><a href="tweets.php">Tweets</a></li>
					<li class="active">Download</li>
					<li>
					</li>
				</ol>
			<!-- BreadCrum End -->

					<?php require_once("includes/sidebar.inc.php"); ?>

			<!-- Download Continer Start -->
				<div class="col-md-9">
					
					<!-- Download Header Start -->
						<div class="rows well  text-center">
							
								<div class="col-sm-9">
									<h3>
										Recent Tweets <i class="text-info fa fa-twitter"></i>
									</h3>
								</div>
								<div class="col-sm-3">
									<a class="btn btn-info btn-sm full-width btn-block" href="logout.php">Logout &nbsp; <i class="fa fa-unlock"></i> </a>
								</div>
								<span class="clearfix"></span>
						</div>
					<!-- Download Header End -->

					<div class="rows well">
						
						<!-- Excel Download Start -->
							<div class="col-md-4 col-sm-4 col-xs-12">
								<a class="btn btn-sm btn-success btn-block" href="downloadExcel.php">
									Download As Excel &nbsp; <i class="fa fa-file-excel-o"></i>
								</a>
								<hr class="clearfix">
							</div>
						<!-- Excel Download End -->

						<!-- Generate JSON Start -->
							<div class="col-md-4 col-sm-4 col-xs-12">
								<a class="btn btn-sm btn-success btn-block" href="downloadJSON.php">
									Generate JSON &nbsp; <i class="fa fa-file-code-o"></i>
								</a>
								<hr class="clearfix">
							</div>
						<!-- Generate JSON End -->

						<!-- Download CSV Start -->
							<div class="col-md-4 col-sm-4 col-xs-12">
								<a class="btn btn-sm btn-success btn-block" href="downloadCSV.php">
									Download As CSV &nbsp; <i class="fa fa-table"></i>
								</a>
								<hr class="clearfix">
							</div>
						<!-- Download CSV End -->
						
						<span class="clearfix"></span>
					</div>
				</div>

			<!-- Download Continer End -->

		</div>
	</div>
<!-- Wrapper End -->

	<?php require_once("includes/javascripts.inc.php"); ?>
</body>
</html>