<?PHP
require "../layouts/header.php";
require "../../config/config.php";





if(!isset($_SESSION['adminname'])){
header("location: ".ADMINURL."/admins/login-admins.php");
}

$select = $conn->query("SELECT * FROM admins");
$select->execute();

$admins = $select->fetchAll(PDO::FETCH_OBJ);

$select = $conn->query("SELECT * FROM catogories");
$select->execute();

$categories = $select->fetchAll(PDO::FETCH_OBJ);


$report_admin = $conn->prepare("SELECT admins.id AS id , admins.adminname AS adminname , catogories.name 
AS name , catogories.created_at As created_at FROM admins JOIN catogories ON admins.id = catogories.admin_id");
$report_admin->execute();

$reports = $report_admin->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline">Reports</h5>


                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Admin</th>
                            <th scope="col">category</th>
                            <th scope="col">Created date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?PHP foreach ($reports as $report) : ?>
                            <tr>
                                <th scope="row"><?PHP echo $report->id; ?></th>
                                <td><?PHP echo $report->adminname; ?></td>
                                 <td><?PHP echo $report->name; ?></td>
                                 <td><?PHP echo $report->created_at; ?></td>
                               
                            </tr>
                        <?PHP endforeach; ?>
                    </tbody>
                </table>
                <!-- <a href="reports-print.php" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
                <!-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                </button> -->
                <a href="pdf-generate.php?id=<?php echo $_SESSION['id'];?>&ACTION=VIEW" class="btn btn-success" ><i class="fa fa-file-pdf-o"></i>View DPF</a>

                <a href="pdf-generate.php?id=<?PHP  echo $_SESSION['id'];?>" target="_thape" class="btn btn-danger float-right" style="margin-right: 5px;"><i class="fa fa-download"></i>Download PDF</a>
            </div>
        </div>
    </div>
    <?PHP
    require "../layouts/footer.php";
    ?>
