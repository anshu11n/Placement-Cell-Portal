<?php

session_start();

if (empty($_SESSION['id_admin'])) {
  header("Location: index.php");
  exit();
}

require_once("../db.php");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Placement Portal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="../css/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
  <div class="wrapper">

    <?php

    include 'header.php';

    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px;">

      <section id="candidates" class="content-header">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Welcome <b>Admin</b></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="active-jobs.php"><i class="fa fa-briefcase"></i> Active Drives</a></li>
                    <li><a href="applications.php"><i class="fa fa-address-card-o"></i> Students Profile</a></li>
                    <!-- <li><a href="companies.php"><i class="fa fa-building"></i> Companies</a></li> -->
                    <li><a href="companies.php"><i class="fa fa-arrow-circle-o-right"></i> Co - Ordinators</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-9 bg-white padding-2">

              <h3>Placement Cell Statistics</h3>
              <div class="row">
                <div class="col-md-6">
                  <div class="info-box bg-c-yellow">
                    <span class="info-box-icon bg-red"><i class="ion ion-briefcase"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Co-Ordinators</span>
                      <?php
                      $sql = "SELECT * FROM company WHERE active='1'";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                      ?>
                      <span class="info-box-number"><?php echo $totalno; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box bg-c-yellow">
                    <span class="info-box-icon bg-red"><i class="ion ion-briefcase"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Pending Coordinators Approval</span>
                      <?php
                      $sql = "SELECT * FROM company WHERE active='2'";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                      ?>
                      <span class="info-box-number"><?php echo $totalno; ?></span>

                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box bg-c-yellow">
                    <span class="info-box-icon bg-green"><i class="ion ion-person-stalker"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Registered Students</span>
                      <?php
                      $sql = "SELECT * FROM users WHERE active='1'";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                      ?>
                      <span class="info-box-number"><?php echo $totalno; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box bg-c-yellow">
                    <span class="info-box-icon bg-green"><i class="ion ion-person-stalker"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Pending Students Confirmation</span>
                      <?php
                      $sql = "SELECT * FROM users WHERE active='0'";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                      ?>
                      <span class="info-box-number"><?php echo $totalno; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box bg-c-yellow">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-person-add"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Drive Posts</span>
                      <?php
                      $sql = "SELECT * FROM job_post";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                      ?>
                      <span class="info-box-number"><?php echo $totalno; ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box bg-c-yellow">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-browsers"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total DRIVE Applications</span>
                      <?php
                      $sql = "SELECT * FROM apply_job_post";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                      ?>
                      <span class="info-box-number"><?php echo $totalno; ?></span>
                    </div>
                  </div>
                </div>

                <?php 
                  $top3pay = "SELECT * FROM job_post ORDER BY CAST(minimumsalary AS UNSIGNED) DESC LIMIT 3";
                  $result = $conn->query($top3pay);
                ?>

                <div><h1>Top Paying Companies</h1></div>
                  <table class="table">
                      <thead>
                          <tr>
                              <th>Company</th>
                              <th>Role</th>
                              <th>CTC</th>
                              <th>View Details</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                          if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                          ?>
                                  <tr>
                                      <td><?php echo $row['jobtitle']; ?></td>
                                      <td><?php echo $row['experience']; ?></td>
                                      <td><?php echo $row['minimumsalary']; ?></td>
                                      <td><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><i class="fa fa-address-card-o"></i></a></td>
                                  </tr>
                          <?php
                              }
                          } else {
                              echo "<tr><td colspan='2'>No job posts available</td></tr>";
                          }
                          ?>
                      </tbody>
                  </table>

                  <?php
                    $sql = "SELECT job_post.*, company.companyname 
                            FROM job_post 
                            INNER JOIN company ON job_post.id_company = company.id_company 
                            WHERE YEAR(job_post.createdat) = 2024";

                    $result = $conn->query($sql);
                  ?>
                  
                    <div><h1>Companies in 2024</h1></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Date</th>
                                <th>View</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $row['jobtitle']; ?></td>
                                    <td><?php echo date("d-M-Y", strtotime($row['createdat'])); ?></td>
                                    <td><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><i class="fa fa-address-card-o"></i></a></td>
                                    <td><a href="delete-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                        <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>No job posts available for the year 2024</td></tr>";
                    }
                    ?>


              </div>

            </div>
          </div>
        </div>
      </section>



    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer" style="margin-left: 0px;">
      <div class="text-center">
        <strong>Copyright &copy; 2022 <a href="learningfromscratch.online">Placement Portal</a>.</strong> All rights
        reserved.
      </div>
    </footer>

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../js/adminlte.min.js"></script>
</body>

</html>