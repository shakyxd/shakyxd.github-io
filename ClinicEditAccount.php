<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Dentist dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

    

    

<link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dist/css/dashboard.css" rel="stylesheet">
  </head>
<?php

$loginID = $_SESSION["userID"];

// Create database connection

$conn = new mysqli('localhost', 'root', '', 'fyp');

if(! $conn ) {
    die('Could not connect: ' . mysqli_error($conn));
}

$sql = "SELECT * FROM clinic WHERE clinicID = $loginID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $column1 = $row["clinicID"];
        $column2 = $row["emailClinic"];
        $column3 = $row["passwordClinic"];
        $column4 = $row["nameClinic"];
        $column5 = $row["phoneNum"];
        $column6 = $row["address"];
        $column7 = $row["area"];
        $column8 = $row["specialisation"];
        $column9 = $row["rating"];
    }
} else {
    echo "0 results";
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    $column2= $_POST["email"];
    $column5= $_POST["phone"];
    $column6= $_POST["address"];
    $column8= $_POST["specialisation"];
    do{
        if(empty($column2) or empty($column5) or empty($column6) or empty($column8)){
            echo '<script>alert("Missing Fields")</script>';
            break;
        }
            $sql="UPDATE clinic 
                SET emailClinic='$column2',
                    phoneNum='$column5',
                    address='$column6',
                    specialisation='$column8'
                WHERE clinicID=$loginID";
            mysqli_query($conn,$sql);
            echo '<script>alert("Edit Success!")</script>';

    }while(false);
 
  }

?>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">ToothScanner</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="unset.php">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="ClinicDashboard.php">
              <span data-feather="home" class="align-text-bottom"></span>
              Clinic Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addStaff.php">
              <span data-feather="pie-chart" class="align-text-bottom"></span>
              View Dentists/Add Staff
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="ClinicEditAccount.php">
              <span data-feather="settings" class="align-text-bottom"></span>
              Clinic Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ClinicAddTreatment.php">
              <span data-feather="thermometer" class="align-text-bottom"></span>
              Add Treatment
            </a>
          </li>
        </ul>   
      </div>
    </nav>

    <section style="background-color: #eee;">
       
       <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lorem Ipsum</h1>     
        <div class="container py-5">
        <form method="post">
        <div class="row">
          <div class="col-lg-4">
            <img src="images/avatardentist.jpg" alt="Avatar" class="avatar">
          </div>
          <div class="col-lg-8">
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Name Of Clinic</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $column4?></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Email</p>
                  </div>
                  <div class="col-sm-9">
                    <input id="email" size="40" type="text" name="email" value="<?php echo $column2;?>"></input>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Phone</p>
                  </div>
                  <div class="col-sm-9">
                    <input id="phone" type="text" name="phone" value="<?php echo $column5;?>"></input>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Address</p>
                  </div>
                  <div class="col-sm-9">
                    <input id="address" size="40" type="text" name="address" value="<?php echo $column6;?>"></input>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Area</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $column7?></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Specialisation</p>
                  </div>
                  <div class="col-sm-9">
                    <input id="specialisation" size="40" type="text" name="specialisation" value="<?php echo $column8;?>"></input>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <p class="mb-0">Rating</p>
                  </div>
                  <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $column9?></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-10">
                    <p class="mb-0"></p>
                  </div>
                  <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>   
          </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</div>


    <script src="dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dist/js/dashboard.js"></script>
  </body>
</html>