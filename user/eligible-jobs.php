<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
if (empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
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
    include 'header.php'
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px;">

      <section id="candidates" class="content-header">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div id="star" class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="edit-profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
                    <li><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
                    <li class="active"><a href="eligible-jobs.php"><i class="fa fa-address-card -o"></i> Eligible Jobs</a></li>
                    <!-- <li><a href="../jobs.php"><i class="fa fa-list-ul"></i> Active Drives</a></li> -->
                    <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
                    <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                    <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                  </ul>

                </div>
              </div>
            </div>
            <div class="col-md-9 bg-white padding-2">

              <!-- <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-info"></i> Update your profile, if you are a new user.
              </div> -->


              <h2>Eligible Jobs</h2>
              <p>Below you will find jobs that you are eligible to apply for.</p>

              <!-- // Step 1: Extract the 'ug' value from the 'users' table for the current user -->
              <?php
                $sql = "SELECT ug, stream FROM users WHERE id_user='$_SESSION[id_user]'";

                // Execute the query
                $result = $conn->query($sql);

                // Check if the query returned a result
                if ($result->num_rows > 0) {
                    // Fetch the associative array from the result set
                    $row = $result->fetch_assoc();

                    // Store the 'ug' value in a variable
                    $ugValue = $row['ug'];
                    $userStream = $row['stream'];
                    // echo $userStream;

                    // Step 2: Query to find jobs where 'minimummarks' is greater than or equal to the 'ug' value
                    $jobQuery = "SELECT * FROM job_post WHERE minimummarks <= '$ugValue' AND FIND_IN_SET('$userStream', streams) > 0";

                    // Execute the job query
                    $jobResult = $conn->query($jobQuery);

                    // echo $jobResult->num_rows;

                    // Check if any jobs match the criteria
                    if ($jobResult->num_rows > 0) {
                      // Check if the user is already placed
                      $placedQuery = "SELECT id_apply FROM apply_job_post WHERE id_user = " . $_SESSION['id_user'] . " AND status = 0";
                      $placedResult = $conn->query($placedQuery);
                      $isPlaced = $placedResult->num_rows > 0;

                      if ($isPlaced) {
                        ?>
                          <div class="alert alert-info alert-dismissible">
                            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                            <i class="icon fa fa-info"></i> You have been already placed. Please don't apply to other jobs.
                          </div>
                      
                      <?php
                      }
                      
                      // echo $_SESSION['id_user'];
                      // echo $placedQuery;
                      // echo $placedResult->num_rows;
                      
                      while ($jobRow = $jobResult->fetch_assoc()) { ?>
                          <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                              <h2 class="text-xl font-semibold text-gray-800"><?php echo $jobRow['jobtitle']; ?></h2>
                              <p class="text-gray-600 mt-2"><strong>Description:</strong> <?php echo $jobRow['description']; ?></p>
                              <p class="text-gray-600 mt-2"><strong>Minimum Marks:</strong> <?php echo $jobRow['minimummarks']; ?></p>
                              <p class="text-gray-600 mt-2"><strong>Qualification:</strong> <?php echo $jobRow['qualification']; ?></p>
                              <p class="text-gray-600 mt-2"><strong>Job Post ID:</strong> <?php echo $jobRow['id_jobpost']; ?></p>
                              <p class="text-gray-600 mt-2"><strong>Eligible Branch:</strong> <?php echo $jobRow['streams']; ?></p>
                              
                              <?php
                              // Check if the user has already applied for this job
                              $checkQuery = "SELECT id_apply FROM apply_job_post WHERE id_jobpost = " . $jobRow['id_jobpost'] . " AND id_company = " . $jobRow['id_company'] . " AND id_user = " . $_SESSION['id_user'];
                              $checkResult = $conn->query($checkQuery);

                              if ($checkResult->num_rows > 0) {
                                if($isPlaced){ ?>
                                  <span class="bg-primary text-white" style="padding: 8px 16px;">Applied (Placed)</span>
                                <?php
                                }else{
                                  ?>
                                  <span class="bg-primary text-white" style="padding: 8px 16px;">Applied</span>
                                <?php
                                }

                              }else {
                                  // User has not applied for this job
                                  if($isPlaced){ ?>
                                  
                                    <a href="#" class="btn btn-flat btn-warning">
                                      Already Placed
                                    </a>

                                  <?php }else { ?>

                                    <a href="apply-for-job.php?id_user=<?php echo $_SESSION['id_user']; ?>&id_jobpost=<?php echo $jobRow['id_jobpost']; ?>&id_company=<?php echo $jobRow['id_company']; ?>" class="btn btn-flat btn-success">
                                      Apply
                                    </a>

                                  <?php }
                                
                                  
                              }
                              ?>
                              <hr>
                          </div>
                      <?php }
                    } else {
                        echo "No job posts found matching your qualifications.";
                    }
                } else {
                    echo "No UG marks found for the user.";
                }
            ?>


              <!-- <?php
              $sql = "SELECT * FROM job_post INNER JOIN apply_job_post ON job_post.id_jobpost=apply_job_post.id_jobpost WHERE apply_job_post.id_user='$_SESSION[id_user]'";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
              ?>
                  <?php

                  if ($row['status'] == 0) {
                  ?>
                    <div class="alert alert-info alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <i class="icon fa fa-info"></i> Congratulations, you have been placed in <?php echo $row['jobtitle']; ?>.
                    </div>
                  <?php
                  }
                  ?>
                  <div class="attachment-block clearfix padding-2">
                    <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a></h4>
                    <div class="attachment-text padding-2">
                      <div class="pull-left"><i class="fa fa-calendar"></i> <?php echo $row['createdat']; ?></div>
                      <?php

                      if ($row['status'] == 0) {
                        echo '<div class="pull-right"><strong class="text-orange">Placed</strong></div>';
                      } else if ($row['status'] == 1) {
                        echo '<div class="pull-right"><strong class="text-red">Rejected</strong></div>';
                      } else if ($row['status'] == 2) {
                        echo '<div class="pull-right"><strong class="text-green">Applied</strong></div> ';
                      }
                      ?>

                    </div>
                  </div>

              <?php
                }
              }
              ?> -->

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

<style>
  /* my css  */

  .box {

    font-size: medium;
    font-family: sans-serif;
  }


  li {
    color: aqua;
  }


  @media only screen and (max-width: 989px) {
    .box {
      margin: auto;
      text-align: center;
    }
  }
</style>


<script src="../js/sweetalert.js"></script>

<?php
if (isset($_SESSION['status1'])  && $_SESSION['status1'] != '') {

?>

  <script>
    swal({
      title: "<?php echo $_SESSION['status1']; ?>",
      text: " You have successfully applied for the drive.",
      icon: "<?php echo $_SESSION['status_code1']; ?>",
      button: "Okay",
    });
  </script>

<?php

  unset($_SESSION['status1']);
}

?>