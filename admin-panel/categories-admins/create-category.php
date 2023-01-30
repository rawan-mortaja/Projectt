<?PHP
require "../layouts/header.php";
require "../../config/config.php";



if (!isset($_SESSION['adminname'])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}


if (isset($_POST['submit'])) {

  if (empty($_POST['name']) and isset($_GET['admin_id'])) {
    echo "<seript>alert('input is empty ')</scrip>";
  } else {

    $name = $_POST['name'];
    $admin_id = $_POST['admin_id'];

    $insert = $conn->prepare("INSERT INTO catogories (name , admin_id) VALUES (:name , :admin_id)");
    $insert->execute([
      ':name' => $name,
      ':admin_id' =>$admin_id
    ]);

    header("location: " . ADMINURL . "/categories-admins/show-categories.php");
  }
}
?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Create Categories</h5>
        <form method="POST" action="create-category.php">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
            <input type="hidden"  name="admin_id"  value="<?php echo $_SESSION['id']; ?>" id="form2Example1" class="form-control" placeholder="name" />

          </div>


          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


        </form>

      </div>
    </div>
  </div>
  <?PHP
  require "../layouts/footer.php";


  ?>
