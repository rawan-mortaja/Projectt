<?PHP
require "../layouts/header.php";
require "../../config/config.php";



if(!isset($_SESSION['adminname'])){
  header("location: ".ADMINURL."/admins/login-admins.php");
}

$select = $conn->query("SELECT * FROM jobs");
$select->execute();

$jobs = $select->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Jobs</h5>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">job title</th>
              <th scope="col">category</th>
              <th scope="col">company</th>
              <th scope="col">status</th>
              <th scope="col">delete</th>
            </tr>
          </thead>
          <tbody>
            <?PHP foreach ($jobs as $job) : ?>
              <tr>
                <th scope="row"><?PHP echo $job->id; ?></th>
                <td><?PHP echo $job->job_title; ?></td>
                <td><?PHP echo $job->job_category; ?></td>
                <td><?PHP echo $job->company_name; ?></td>
                <?PHP if ($job->status == 1) : ?>
                  <td><a href="<?PHP echo ADMINURL; ?>/jobs-admins/status.php?id=<?PHP echo $job->id; ?>&status=<?PHP echo $job->status; ?>" class="btn btn-danger  text-center ">unverfied</a></td>
                <?PHP else : ?>
                  <td><a href="<?PHP echo ADMINURL; ?>/jobs-admins/status.php?id=<?PHP echo $job->id; ?>&status=<?PHP echo $job->status; ?>" class="btn btn-success  text-center ">verfied</a></td>
                <?PHP endif; ?>
                <td><a href="<?PHP echo ADMINURL; ?>/jobs-admins/delete-job.php?id=<?PHP echo $job->id; ?>" class="btn btn-danger  text-center ">delete</a></td>
              </tr>
            <?PHP endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?PHP
  require "../layouts/footer.php";
  ?>