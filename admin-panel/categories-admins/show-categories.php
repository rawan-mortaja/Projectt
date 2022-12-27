<?PHP
require "../layouts/header.php";
require "../../config/config.php";


if (!isset($_SESSION['adminname'])) {
  header("location: " . ADMINURL . "/admins/login-admins.php");
}


$select = $conn->query("SELECT * FROM catogories");
$select->execute();

$categories = $select->fetchAll(PDO::FETCH_OBJ);


?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Categories</h5>
        <a href="<?PHP echo ADMINURL; ?>/categories-admins/create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">update</th>
              <th scope="col">delete</th>
            </tr>
          </thead>
          <tbody>
            <?PHP foreach ($categories as $category) : ?>
              <tr>
                <th scope="row"><?PHP echo $category->id; ?></th>
                <td><?PHP echo ucfirst($category->name); ?></td>
                <td><a href="<?PHP echo ADMINURL; ?>/categories-admins/update-category.php?id=<?PHP echo $category->id; ?>" class="btn btn-warning text-white text-center ">Update </a></td>
                <td><a href="<?PHP echo ADMINURL; ?>/categories-admins/delete-category.php?id=<?PHP echo $category->id; ?>" class="btn btn-danger  text-center ">Delete </a></td>
              </tr>
            <?PHP endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?PHP
    require "../layouts/footer.php";
    ?>