<?php
	session_start();
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Learning</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link href='dist/css/fullcalendar.css' rel='stylesheet' />
  <link rel="stylesheet" href="dist/css/AdminLTE.css">

  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <script src="samples/js/sample.js"></script>
  <link rel="stylesheet" href="samples/toolbarconfigurator/lib/codemirror/neo.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>WS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Workspace </b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"></li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                        <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <!-- The message -->
                      <p></p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 0 notifications</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i>
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks Menu -->
          <li class="dropdown tasks-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 0 tasks</li>
              <li>
                <!-- Inner menu: contains the tasks -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <!-- Task title and progress text -->
                      <h3>

                        <small class="pull-right">100</small>
                      </h3>
                      <!-- The progress bar -->
                      <div class="progress xs">
                        <!-- Change the css width attribute to simulate progress -->
                        <div class="progress-bar progress-bar-aqua" style="width: 100%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">100% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="dist/img/avatar5.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">
			  <?php
			  echo $_SESSION['name'];

			  ?>
			  </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['name']; ?> - <small><?php echo $_SESSION['jabatan']; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                 <!-- <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> !-->
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php
			$name=explode(" ", $_SESSION['name']);
			//echo $name[0]." ".$name[1]
      echo $_SESSION['name'];
		  ?>
		  </p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">Navigation</li>
        <!-- Optionally, you can add icons to the links -->
      <li class="active"><a onclick="home()" href="#"><i class="fa fa-home"></i> <span>Home</span></a></li>

      <li class="treeview">
        <a onclick="#" href="#"><i class="fa fa-calendar"></i> <span>Calendar</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="#"><i class="fa fa-user"></i> <span>Calendar Event</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
            <?php
              if ($_SESSION['monarch']=="wsn"){
                ?>
              <li><a onclick="calendar_event('wsn')" href="#"><i class="fa fa-calendar-check-o"></i><span>Yayasan</br>Widhi Sastra Nugraha</span></a></li>
            <?php } ?>
            <?php
              if ($_SESSION['monarch']=="wsn" || $_SESSION['monarch']=="01"){
                ?>
              <li><a onclick="calendar_event('01')" href="#"><i class="fa fa-calendar-check-o"></i><span>Monarch Dalung</span></a></li>
            <?php } ?>
            <?php
              if ($_SESSION['monarch']=="wsn" || $_SESSION['monarch']=="02"){
                ?>
              <li><a onclick="calendar_event('02')" href="#"><i class="fa fa-calendar-check-o"></i><span>Monarch Candidasa</span></a></li>
            <?php } ?>
            <?php
              if ($_SESSION['monarch']=="wsn" || $_SESSION['monarch']=="03"){
                ?>
              <li><a onclick="calendar_event('03')" href="#"><i class="fa fa-calendar-check-o"></i><span>Monarch Singaraja</span></a></li>
            <?php } ?>
            <?php
              if ($_SESSION['monarch']=="wsn" || $_SESSION['monarch']=="04"){
                ?>
              <li><a onclick="calendar_event('04')" href="#"><i class="fa fa-calendar-check-o"></i><span>Monarch Gianyar</span></a></li>
            <?php } ?>
            <?php
              if ($_SESSION['monarch']=="wsn" || $_SESSION['monarch']=="05"){
                ?>
              <li><a onclick="calendar_event('05')" href="#"><i class="fa fa-calendar-check-o"></i><span>Monarch Negara</span></a></li>
              <?php } ?>
            </ul>
          </li>
        </ul>
      </li>

  		<li class="treeview">
  			<a onclick="foundation()" href="#"><i class="fa fa-university"></i> <span>Foundation / Quality </br>
  				Assurance Monarch Bali</span>
  				<span class="pull-right-container">
  				  <i class="fa fa-angle-left pull-right"></i>
  				</span>
  			</a>
  			<ul class="treeview-menu">
  				<li>
  					<a href="#"><i class="fa fa-user"></i> <span>Ketua</span>
  						<span class="pull-right-container">
  						  <i class="fa fa-angle-left pull-right"></i>
  						</span>
  					</a>
  					<ul class="treeview-menu">
  						<li><a onclick="foundation_content('ketua-1')" href="#"><i class="fa fa-folder-o"></i><span>Informasi</span></a></li>
  						<li><a onclick="foundation_content('ketua-2')" href="#"><i class="fa fa-folder-o"></i><span>Surat Keputusan</span></a></li>
  						<li><a onclick="foundation_content('ketua-3')" href="#"><i class="fa fa-folder-o"></i><span>Surat Penugasan</span></a></li>
  						<li><a onclick="foundation_content('ketua-4')" href="#"><i class="fa fa-folder-o"></i><span>Surat Rekomendasi</span></a></li>
  					</ul>
  				</li>
  				<li>
  					<a href="#"><i class="fa fa-user"></i> <span>MD</span>
  						<span class="pull-right-container">
  						  <i class="fa fa-angle-left pull-right"></i>
  						</span>
  					</a>
  					<ul class="treeview-menu">
  						<li><a onclick="foundation_content('md-1')" href="#"><i class="fa fa-folder-o"></i><span>Information</span></a></li>
  						<li><a onclick="foundation_content('md-2')" href="#"><i class="fa fa-folder-o"></i><span>Other Concern</span></a></li>
  					</ul>
  				</li>
  				<li>
  					<a href="#"><i class="fa fa-user"></i> <span>ADC</span>
  						<span class="pull-right-container">
  						  <i class="fa fa-angle-left pull-right"></i>
  						</span>
  					</a>
  					<ul class="treeview-menu">
  						<li><a onclick="foundation_content('adc-1')" href="#"><i class="fa fa-folder-o"></i><span>Akademik</span></a></li>
  						<li><a onclick="foundation_content('adc-2')" href="#"><i class="fa fa-folder-o"></i><span>Kemahasiswaan</span></a></li>
  						<li><a onclick="foundation_content('adc-3')" href="#"><i class="fa fa-folder-o"></i><span>Informasi Lainnya</span></a></li>
  					</ul>
  				</li>
  				<li>
  					<a href="#"><i class="fa fa-user"></i> <span>GAA</span>
  						<span class="pull-right-container">
  						  <i class="fa fa-angle-left pull-right"></i>
  						</span>
  					</a>
  					<ul class="treeview-menu">
  						<li><a href="#"><i class="fa fa-folder-o"></i><span>Eksternal Audit</br>Report</span></a>
  							<ul class="treeview-menu">
  								<li><a onclick="foundation_content('gaa-1a')" href="#"><i class="fa fa-folder-o"></i><span>Monarch Dalung</span></a></li>
  								<li><a onclick="foundation_content('gaa-1b')" href="#"><i class="fa fa-folder-o"></i><span>Monarch Candidasa</span></a></li>
  								<li><a onclick="foundation_content('gaa-1c')" href="#"><i class="fa fa-folder-o"></i><span>Monarch Gianyar</span></a></li>
  								<li><a onclick="foundation_content('gaa-1d')" href="#"><i class="fa fa-folder-o"></i><span>Monarch Singaraja</span></a></li>
  								<li><a onclick="foundation_content('gaa-1e')" href="#"><i class="fa fa-folder-o"></i><span>Monarch Negara</span></a></li>
  							</ul>
  						</li>
  						<li><a onclick="foundation_content('gaa-2')" href="#"><i class="fa fa-folder-o"></i><span>Invoice</span></a></li>
  					</ul>
  				</li>
  				<li>
  					<a href="#"><i class="fa fa-user"></i> <span>IT</span>
  						<span class="pull-right-container">
  						  <i class="fa fa-angle-left pull-right"></i>
  						</span>
  					</a>
  					<ul class="treeview-menu">
  						<li><a onclick="foundation_content('it-1')" href="#"><i class="fa fa-folder-o"></i><span>Information</span></a></li>
  						<li><a onclick="foundation_content('it-2')" href="#"><i class="fa fa-folder-o"></i><span>Requisition</span></a></li>
  						<li><a onclick="foundation_content('it-3')" href="#"><i class="fa fa-folder-o"></i><span>Other Concern</span></a></li>
  					</ul>
  				</li>
  				<li>
  					<a href="#"><i class="fa fa-user"></i> <span>LSP</span>
  						<span class="pull-right-container">
  						  <i class="fa fa-angle-left pull-right"></i>
  						</span>
  					</a>
  					<ul class="treeview-menu">
  						<li><a onclick="foundation_content('lsp-1')" href="#"><i class="fa fa-folder-o"></i><span>Informasi</span></a></li>
  						<li><a onclick="foundation_content('lsp-2')" href="#"><i class="fa fa-folder-o"></i><span>Data Peserta Uji</span></a></li>
  						<li><a onclick="foundation_content('lsp-3')" href="#"><i class="fa fa-folder-o"></i><span>Jadwal UJK</span></a></li>
  						<li><a onclick="foundation_content('lsp-4')" href="#"><i class="fa fa-folder-o"></i><span>RAB dan LPJ</span></a></li>
  						<li><a onclick="foundation_content('lsp-5')" href="#"><i class="fa fa-folder-o"></i><span>Surat Keputusan</span></a></li>
  						<li><a onclick="foundation_content('lsp-6')" href="#"><i class="fa fa-folder-o"></i><span>Surat Penugasan</span></a></li>
  						<li><a onclick="foundation_content('lsp-7')" href="#"><i class="fa fa-folder-o"></i><span>Surat Rekomendasi</span></a></li>
  					</ul>
  				</li>
  			</ul>
      </li>

      <li class="treeview">
  			<a href="#"><i class="fa fa-trophy"></i> <span>Sistem Manajemen Mutu</br>Monarch Bali</span>
  				<span class="pull-right-container">
  					<i class="fa fa-angle-left pull-right"></i>
  				</span>
  			</a>
  			<ul class="treeview-menu">
  				<li>
  					<a href="#"><i class="fa fa-star-o"></i> <span>6 Fokus Manajemen</span>
  						<span class="pull-right-container">
  						  <i class="fa fa-angle-left pull-right"></i>
  						</span>
  					</a>
  					<ul class="treeview-menu">
  						<li>
  							<a href="dist/php/smm6/sdm/index.php" target="_blank"><i class="fa fa-folder-o"></i> <span>Manajemen SDM</span></a>
  						</li>
  						<li>
  							<a href="dist/php/smm6/Kurikulum/index.php" target="_blank"><i class="fa fa-folder-o"></i> <span>Manajemen Kurikulum</span></a>
  						</li>
  						<li>
  							<a href="dist/php/smm6/Kesiswaan/index.php" target="_blank"><i class="fa fa-folder-o"></i> <span>Manajemen Kesiswaan</span></a>
  						</li>
  						<li>
  							<a href="dist/php/smm6/sarpras/index.php" target="_blank"><i class="fa fa-folder-o"></i> <span>Manajemen SARPRAS</span></a>
  						</li>
  						<li>
  							<a href="dist/php/smm6/humas/index.php" target="_blank"><i class="fa fa-folder-o"></i> <span>Manajemen HUMAS</span></a>
  						</li>
  						<li>
  							<a href="dist/php/smm6/Keuangan/index.php" target="_blank"><i class="fa fa-folder-o"></i> <span>Manajemen Keuangan</span></a>
  						</li>
  					</ul>
  				</li>
  				<li>
  					<a href="#"><i class="fa fa-star"></i> <span>4 Fokus Manajemen</span>
  						<span class="pull-right-container">
  						  <i class="fa fa-angle-left pull-right"></i>
  						</span>
  					</a>
  					<ul class="treeview-menu">
  						<li>
                <a href="dist/php/smm4/admin/index.php" target="_blank"><i class="fa fa-folder-o"></i> <span>Manajemen </br>Administrasi dan Keuangan</span></a>
              </li>
              <li>
                <a href="dist/php/smm4/si/index.php" target="_blank"><i class="fa fa-folder-o"></i> <span>Manajemen </br>Sistem Informasi</span></a>
              </li>
              <li>
                <a href="dist/php/smm4/pelatihan/index.php" target="_blank"><i class="fa fa-folder-o"></i> <span>Manajemen </br> Pelatihan dan Sertifikasi</span></a>
              </li>
              <li>
                <a href="dist/php/smm4/stratejik/index.php" target="_blank"><i class="fa fa-folder-o"></i> <span>Manajemen Stratejik</span></a>
              </li>
  					</ul>
  				</li>
  			</ul>
      </li>

		<li class="treeview">
			<a href="#"><i class="fa fa-shopping-bag"></i> <span>Monarch Shop</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			</a>
			<ul class="treeview-menu">
				<li>
					<a href="#"><i class="fa fa-shopping-cart"></i> <span>Order</span>
						<span class="pull-right-container">
						  <i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
            <?php
              if ($_SESSION['monarch']=='01' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/dalung/shop/order/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/shop/order/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Dalung</span></a></li>
                <?php }
                ?>
						<?php
              if ($_SESSION['monarch']=='02' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/candidasa/shop/order/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/shop/order/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Candidasa</span></a></li>
            <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='03' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/singaraja/shop/order/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/shop/order/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Singaraja</span></a></li>
            <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='04' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/gianyar/shop/order/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/shop/order/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Gianyar</span></a></li>
            <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='05' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/negara/shop/order/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/shop/order/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Negara</span></a></li>
            <?php }
                ?>
					</ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-check-square-o"></i> <span>Laporan Penerimaan</span>
						<span class="pull-right-container">
						  <i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
            <?php
              if ($_SESSION['monarch']=='01' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/dalung/shop/laporan/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/shop/laporan/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Dalung</span></a></li>
                <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='02' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/candidasa/shop/laporan/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/shop/laporan/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Candidasa</span></a></li>
            <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='03' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/singaraja/shop/laporan/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/shop/laporan/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Singaraja</span></a></li>
            <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='04' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/gianyar/shop/laporan/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/shop/laporan/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Gianyar</span></a></li>
            <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='05' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/negara/shop/laporan/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/shop/laporan/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Negara</span></a></li>
            <?php }
                ?>
          </ul>
				</li>
				<li>
					<a href="#"><i class="fa fa-credit-card"></i> <span>Invoice</span>
						<span class="pull-right-container">
						  <i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
            <?php
              if ($_SESSION['monarch']=='01' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/dalung/shop/invoice/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/shop/invoice/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Dalung</span></a></li>
                <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='02' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/candidasa/shop/invoice/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/shop/invoice/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Candidasa</span></a></li>
            <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='03' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/singaraja/shop/invoice/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/shop/invoice/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Singaraja</span></a></li>
            <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='04' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/gianyar/shop/invoice/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/shop/invoice/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Gianyar</span></a></li>
            <?php }
                ?>
            <?php
              if ($_SESSION['monarch']=='05' || $_SESSION['monarch']=="wsn"){
                ?>
                <li><a href="dist/php/negara/shop/invoice/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/shop/invoice/ " target="_blank"><i class="fa fa-folder-o"></i><span>Monarch Negara</span></a></li>
            <?php }
                ?>
          </ul>
				</li>
			</ul>
    </li>

        <?php
      if ($_SESSION['monarch']=='01' || $_SESSION['monarch']=="wsn"){
        ?>
          <li class="treeview">
            <a href="#"><i class="fa fa-cogs"></i> <span>Operational Monarch Bali</br>Dalung</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Annual Program</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/dalung/ap/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/ap/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/dalung/ap/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/ap/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a ohref="dist/php/dalung/ap/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/ap/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Quarterly</br>Budget</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/dalung/qb/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/qb/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/dalung/qb/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/qb/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/dalung/qb/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/qb/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>

              <?php
                }
              ?>

              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Monthly Objective</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/dalung/mo/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mo/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/dalung/mo/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mo/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/dalung/mo/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mo/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Event Proposal</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Budgeting (RAB)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/dalung/bg/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=dalung/bg/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/dalung/bg/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=dalung/bg/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/dalung/bg/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=dalung/bg/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Event Report (LPJ)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/dalung/er/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/er/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/dalung/er/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/er/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/dalung/er/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/er/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>

              <?php
                }
              ?>

              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Manning Guide and </br>Organizational Chart</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/dalung/mg/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mg/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/dalung/mg/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mg/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/dalung/mg/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mg/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>

              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>MOM </br>(Notulen Rapat)</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/dalung/mom/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mom/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/dalung/mom/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mom/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/dalung/mom/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mom/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                }
              ?>

              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>

                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Report</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Mid-Month</br>Accounting Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/dalung/mm/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mm/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/dalung/mm/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mm/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/dalung/mm/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/mm/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Evaluation Quarterly </br>Budget</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/dalung/eq/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/eq/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/dalung/eq/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/eq/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/dalung/eq/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/eq/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Operational </br>Weekly Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/dalung/ow/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/ow/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/dalung/ow/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/ow/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/dalung/ow/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/ow/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Operational </br>Monthly Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/dalung/om/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/om/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/dalung/om/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/om/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/dalung/om/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/om/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Summary Internal</br>Audit SMM</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/dalung/su/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/su/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/dalung/su/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/su/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/dalung/su/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/su/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Summary of </br>Event Evaluation</br>(Hasil Kaji</br>Ulang Kegiatan)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/dalung/se/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/se/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/dalung/se/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/se/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/dalung/se/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=dalung/se/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <?php
                }
              ?>


            </ul>
          </li>
        <?php
      }
    ?>

        <?php
      if ($_SESSION['monarch']=='01' || $_SESSION['monarch']=="wsn"){
        ?>
          <li class="treeview">
            <a href="#"><i class="fa fa-cogs"></i> <span>Operational Monarch Bali</br>Candidasa</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Annual Program</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/candidasa/ap/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/ap/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/candidasa/ap/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/ap/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a ohref="dist/php/candidasa/ap/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/ap/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Quarterly</br>Budget</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/candidasa/qb/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/qb/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/candidasa/qb/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/qb/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/candidasa/qb/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/qb/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>

              <?php
                }
              ?>

              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Monthly Objective</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/candidasa/mo/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mo/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/candidasa/mo/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mo/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/candidasa/mo/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mo/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Event Proposal</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Budgeting (RAB)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/candidasa/bg/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=candidasa/bg/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/candidasa/bg/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=candidasa/bg/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/candidasa/bg/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=candidasa/bg/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Event Report (LPJ)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/candidasa/er/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/er/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/candidasa/er/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/er/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/candidasa/er/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/er/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>

              <?php
                }
              ?>

              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Manning Guide and </br>Organizational Chart</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/candidasa/mg/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mg/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/candidasa/mg/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mg/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/candidasa/mg/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mg/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>

              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>MOM </br>(Notulen Rapat)</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/candidasa/mom/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mom/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/candidasa/mom/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mom/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/candidasa/mom/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mom/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                }
              ?>

              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>

                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Report</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Mid-Month</br>Accounting Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/candidasa/mm/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mm/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/candidasa/mm/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mm/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/candidasa/mm/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/mm/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Evaluation Quarterly </br>Budget</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/candidasa/eq/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/eq/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/candidasa/eq/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/eq/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/candidasa/eq/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/eq/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Operational </br>Weekly Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/candidasa/ow/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/ow/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/candidasa/ow/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/ow/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/candidasa/ow/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/ow/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Operational </br>Monthly Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/candidasa/om/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/om/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/candidasa/om/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/om/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/candidasa/om/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/om/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Summary Internal</br>Audit SMM</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/candidasa/su/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/su/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/candidasa/su/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/su/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/candidasa/su/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/su/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Summary of </br>Event Evaluation</br>(Hasil Kaji</br>Ulang Kegiatan)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/candidasa/se/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/se/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/candidasa/se/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/se/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/candidasa/se/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=candidasa/se/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <?php
                }
              ?>


            </ul>
          </li>
        <?php
      }
    ?>

        <?php
      if ($_SESSION['monarch']=='01' || $_SESSION['monarch']=="wsn"){
        ?>
          <li class="treeview">
            <a href="#"><i class="fa fa-cogs"></i> <span>Operational Monarch Bali</br>Singaraja</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Annual Program</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/singaraja/ap/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/ap/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/singaraja/ap/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/ap/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a ohref="dist/php/singaraja/ap/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/ap/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Quarterly</br>Budget</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/singaraja/qb/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/qb/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/singaraja/qb/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/qb/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/singaraja/qb/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/qb/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>

              <?php
                }
              ?>

              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Monthly Objective</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/singaraja/mo/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mo/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/singaraja/mo/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mo/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/singaraja/mo/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mo/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Event Proposal</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Budgeting (RAB)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/singaraja/bg/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=singaraja/bg/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/singaraja/bg/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=singaraja/bg/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/singaraja/bg/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=singaraja/bg/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Event Report (LPJ)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/singaraja/er/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/er/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/singaraja/er/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/er/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/singaraja/er/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/er/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>

              <?php
                }
              ?>

              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Manning Guide and </br>Organizational Chart</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/singaraja/mg/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mg/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/singaraja/mg/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mg/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/singaraja/mg/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mg/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>

              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>MOM </br>(Notulen Rapat)</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/singaraja/mom/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mom/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/singaraja/mom/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mom/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/singaraja/mom/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mom/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                }
              ?>

              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>

                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Report</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Mid-Month</br>Accounting Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/singaraja/mm/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mm/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/singaraja/mm/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mm/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/singaraja/mm/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/mm/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Evaluation Quarterly </br>Budget</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/singaraja/eq/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/eq/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/singaraja/eq/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/eq/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/singaraja/eq/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/eq/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Operational </br>Weekly Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/singaraja/ow/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/ow/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/singaraja/ow/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/ow/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/singaraja/ow/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/ow/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Operational </br>Monthly Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/singaraja/om/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/om/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/singaraja/om/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/om/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/singaraja/om/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/om/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Summary Internal</br>Audit SMM</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/singaraja/su/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/su/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/singaraja/su/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/su/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/singaraja/su/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/su/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Summary of </br>Event Evaluation</br>(Hasil Kaji</br>Ulang Kegiatan)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/singaraja/se/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/se/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/singaraja/se/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/se/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/singaraja/se/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=singaraja/se/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <?php
                }
              ?>


            </ul>
          </li>
        <?php
      }
    ?>

        <?php
      if ($_SESSION['monarch']=='01' || $_SESSION['monarch']=="wsn"){
        ?>
          <li class="treeview">
            <a href="#"><i class="fa fa-cogs"></i> <span>Operational Monarch Bali</br>gianyar</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Annual Program</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/gianyar/ap/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/ap/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/gianyar/ap/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/ap/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a ohref="dist/php/gianyar/ap/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/ap/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Quarterly</br>Budget</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/gianyar/qb/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/qb/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/gianyar/qb/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/qb/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/gianyar/qb/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/qb/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>

              <?php
                }
              ?>

              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Monthly Objective</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/gianyar/mo/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mo/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/gianyar/mo/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mo/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/gianyar/mo/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mo/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Event Proposal</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Budgeting (RAB)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/gianyar/bg/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=gianyar/bg/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/gianyar/bg/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=gianyar/bg/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/gianyar/bg/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=gianyar/bg/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Event Report (LPJ)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/gianyar/er/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/er/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/gianyar/er/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/er/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/gianyar/er/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/er/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>

              <?php
                }
              ?>

              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Manning Guide and </br>Organizational Chart</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/gianyar/mg/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mg/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/gianyar/mg/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mg/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/gianyar/mg/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mg/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>

              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>MOM </br>(Notulen Rapat)</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/gianyar/mom/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mom/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/gianyar/mom/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mom/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/gianyar/mom/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mom/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                }
              ?>

              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>

                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Report</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Mid-Month</br>Accounting Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/gianyar/mm/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mm/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/gianyar/mm/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mm/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/gianyar/mm/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/mm/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Evaluation Quarterly </br>Budget</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/gianyar/eq/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/eq/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/gianyar/eq/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/eq/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/gianyar/eq/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/eq/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Operational </br>Weekly Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/gianyar/ow/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/ow/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/gianyar/ow/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/ow/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/gianyar/ow/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/ow/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Operational </br>Monthly Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/gianyar/om/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/om/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/gianyar/om/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/om/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/gianyar/om/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/om/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Summary Internal</br>Audit SMM</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/gianyar/su/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/su/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/gianyar/su/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/su/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/gianyar/su/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/su/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Summary of </br>Event Evaluation</br>(Hasil Kaji</br>Ulang Kegiatan)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/gianyar/se/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/se/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/gianyar/se/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/se/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/gianyar/se/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=gianyar/se/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <?php
                }
              ?>


            </ul>
          </li>
        <?php
      }
    ?>


		<?php
      if ($_SESSION['monarch']=='05' || $_SESSION['monarch']=="wsn"){
        ?>
          <li class="treeview">
            <a href="#"><i class="fa fa-cogs"></i> <span>Operational Monarch Bali</br>Negara</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Annual Program</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/negara/ap/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/ap/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/negara/ap/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/ap/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a ohref="dist/php/negara/ap/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/ap/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Quarterly</br>Budget</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/negara/qb/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/qb/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/negara/qb/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/qb/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/negara/qb/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/qb/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>

              <?php
                }
              ?>

              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Monthly Objective</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/negara/mo/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mo/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/negara/mo/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mo/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/negara/mo/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mo/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Event Proposal</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Budgeting (RAB)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/negara/bg/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=negara/bg/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/negara/bg/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=negara/bg/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/negara/bg/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload_rab.php?dir=negara/bg/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Event Report (LPJ)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/negara/er/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/er/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/negara/er/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/er/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/negara/er/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/er/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>

              <?php
                }
              ?>

              <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Manning Guide and </br>Organizational Chart</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/negara/mg/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mg/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/negara/mg/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mg/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/negara/mg/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mg/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>

              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>
                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>MOM </br>(Notulen Rapat)</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="dist/php/negara/mom/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mom/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                  <li><a href="dist/php/negara/mom/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mom/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                  <li><a href="dist/php/negara/mom/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mom/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                </ul>
              </li>
              <?php
                }
              ?>

              <?php
                if ($_SESSION['level']=='1' || $_SESSION['monarch']=="wsn"){
                  ?>

                  <li>
                <a href="#"><i class="fa fa-cog"></i> <span>Report</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Mid-Month</br>Accounting Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/negara/mm/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mm/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/negara/mm/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mm/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/negara/mm/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/mm/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Evaluation Quarterly </br>Budget</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/negara/eq/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/eq/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/negara/eq/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/eq/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/negara/eq/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/eq/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Operational </br>Weekly Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/negara/ow/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/ow/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/negara/ow/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/ow/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/negara/ow/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/ow/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Operational </br>Monthly Report</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/negara/om/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/om/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/negara/om/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/om/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/negara/om/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/om/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Summary Internal</br>Audit SMM</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/negara/su/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/su/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/negara/su/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/su/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/negara/su/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/su/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="fa fa-folder-o"></i><span>Summary of </br>Event Evaluation</br>(Hasil Kaji</br>Ulang Kegiatan)</span></a>
                    <ul class="treeview-menu">
                      <li><a href="dist/php/negara/se/2016/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/se/2016/" target="_blank"><i class="fa fa-folder-o"></i><span>2016</span></a></li>
                      <li><a href="dist/php/negara/se/2017/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/se/2017/" target="_blank"><i class="fa fa-folder-o"></i><span>2017</span></a></li>
                      <li><a href="dist/php/negara/se/2018/index.php?upload_dir=http://localhost/workspace.monarchbali.com/dist/php/upload.php?dir=negara/se/2018/" target="_blank"><i class="fa fa-folder-o"></i><span>2018</span></a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <?php
                }
              ?>

            </ul>
          </li>
        <?php
      }
    ?>

	</ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="ws_content">

  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Workspace
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="#">YAYASAN WIDHI SASTRA NUGRAHA - MONARCH BALI</a>. </strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading"> Birthday</h4>

                <p>Will be 23 on June 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Workspace Progress
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">80%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
              </div>
            </a>

			        <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Academic Progress
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">95%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 95%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/fullcalendar/fullcalendar.min.js"></script>

<script src="dist/js/home_ws.js"></script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
