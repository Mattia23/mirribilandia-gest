<?php
require("model/DbManager.php");
require("model/Hotel.php");
if(!isset($_COOKIE["loggedIn"])){
  header('location: index.php');
  exit;
}
if(!isset($_GET["id"])){
	header('location: hotels.php');
	exit;
} else {
	$conn = new DbManager();
	$h = $conn->getHotelById($_GET["id"]);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mirribilandia - Hotels</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- my style -->
  <link rel="stylesheet" href="dist/css/my.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div id="waiting"><i class="fa fa-spin fa-refresh"></i></div>
  <div class="alert alert-danger alert-dismissible" id="errorAjax">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                There were some problems during the request!
  </div>
  <div class="alert alert-success alert-dismissible" id="successAjax">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                Your request went fine! :)
  </div>
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="admin.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ''.$_COOKIE["loggedIn"] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo ''.$_COOKIE["loggedIn"] ?>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right" >
                  <p class="btn btn-default btn-flat" id="logout">Sign out</p>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ''.$_COOKIE["loggedIn"] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="admin.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="events.php" >
            <i class="fa fa-th"></i> <span>Eventi</span>
          </a>
        </li>
        <li>
          <a href="attractions.php">
            <i class="fa fa-gamepad"></i> <span>Attrazioni</span>
          </a>
        </li>
		<li>
          <a href="photos.php">
            <i class="fa fa-photo"></i> <span>Foto</span>
          </a>
        </li>
		<li>
          <a href="restaurants.php">
            <i class="fa fa-cutlery"></i> <span>Ristoranti</span>
          </a>
        </li>
		<li class="active">
          <a href="hotels.php">
            <i class="fa fa-hotel"></i> <span>Hotel</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="mirribilandiaContent">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hotels
        <small>manager</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Hotels</li>
		<li class="active">Modify hotel</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Update hotel <?php echo $h->nome ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
			<!-- text input -->
               <div class="form-group">
                  <label>Hotel name</label>
                  <input type="text" class="form-control" placeholder="Enter name..." id="hotelName" value="<?php echo $h->nome ?>">
              </div>
              <!-- phone mask -->
              <div class="form-group">
                <label>Phone:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" id="hotelTel" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $h->tel ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
			<div class="form-group">
                <label>Distance from Mirribilandia (km)</label>
                <input type="text" class="form-control" placeholder="Distance..." id="hotelDist" value="<?php echo $h->distanza ?>">
             </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
			<div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="3" placeholder="Enter description..." id="hotelDescription"><?php echo $h->descrizione ?></textarea>
             </div>
            <div class="form-group">
                  <label for="exampleInputFile">Image</label>
                  <input type="file" accept="image/png" id="hotelInputFile">

                  <p class="help-block">Insert image</p>
                </div>
              </div>
            </div>
			
            <!-- /.col -->
            <div class="box-footer">
              <button type="submit" class="btn btn-info pull-right" id="updateHotel">Submit</button>
            </div>
          </div>
          <!-- /.row -->
        </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
	<div id="oldPic" style="display: none;"><?php echo $h->immagine ?></div>
	<div id="id" style="display: none;"><?php echo $h->id ?></div>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.1
    </div>
    <strong>Copyright &copy;  Mirribilandia.</strong>
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="dist/js/myscript.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

   $('#example1').DataTable()

  })
</script>
</body>

</html>
