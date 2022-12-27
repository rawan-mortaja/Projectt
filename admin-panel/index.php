<?PHP
require "layouts/header.php";
require "../config/config.php";

if(!isset($_SESSION['adminname'])){
    header("location: ".ADMINURL."/admins/login-admins.php");
}

$jobs = $conn->query("SELECT COUNT(*)AS count_jobs FROM jobs ");
$jobs->execute();

$counJobs = $jobs->fetch(PDO::FETCH_OBJ);



$categories = $conn->query("SELECT COUNT(*)AS count_cat FROM catogories ");
$categories->execute();

$counCategories = $categories->fetch(PDO::FETCH_OBJ);




$admins = $conn->query("SELECT COUNT(*)AS count_admins FROM admins ");
$admins->execute();

$counAdmins = $admins->fetch(PDO::FETCH_OBJ);

?>
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Jobs</h5>
        <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
        <p class="card-text">Number of jobs: <?PHP  echo $counJobs->count_jobs;?></p>

      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Categories</h5>

        <p class="card-text">Number of categories: <?PHP  echo $counCategories->count_cat;?></p>

      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Admins</h5>

        <p class="card-text">Number of admins: <?PHP  echo $counAdmins->count_admins;?></p>

      </div>
    </div>

    <!--  <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->

    <?PHP
    require "layouts/footer.php";
    ?>