<?PHP
require "../layouts/header.php";
require "../../config/config.php";


if(!isset($_SESSION['adminname'])){
    header("location: ".ADMINURL."/admins/login-admins.php");
}


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $delete = $conn->prepare("DELETE FROM catogories WHERE id = '$id'");
    $delete->execute();


    header("location: " . ADMINURL . "/categories-admins/show-categories.php");
} else {
    header("location: http://localhost:8080/jobboard/404.php");
}

?>


<?PHP
require "../layouts/footer.php";

?>