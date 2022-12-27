<?PHP
require "../layouts/header.php";
require "../../config/config.php";

if (!isset($_SESSION['adminname'])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}

$select = $conn->query("SELECT * FROM admins");
$select->execute();

$admins = $select->fetchAll(PDO::FETCH_OBJ);


?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Admins</h5>
        <a href="<?PHP echo ADMINURL;?>/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">username</th>
              <th scope="col">email</th>
            </tr>
          </thead>
          <tbody>
            <?PHP foreach ($admins as $admin) : ?>
              <tr>
                <th scope="row"><?PHP echo $admin->id; ?></th>
                <td><?PHP echo $admin->adminname; ?></td>
                <td><?PHP echo $admin->email; ?></td>
              </tr>
            <?PHP endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <?PHP
    require "../layouts/footer.php";
    ?>