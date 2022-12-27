<?PHP

require "../config/config.php";
require "../includes/header.php";


if (isset($_GET['name'])) {

    $name = $_GET['name'];

    $related_jobs = $conn->query("SELECT * FROM jobs WHERE job_category = '$name' AND status = 1  ");
    $related_jobs->execute();

  $related_job = $related_jobs->fetchAll(PDO::FETCH_OBJ);
}
?>

<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Jobs in <?PHP echo ucfirst($name);?></h1>
                <div class="custom-breadcrumbs">
                    <a href="<?PHP echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
                    <a href="#">Job</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Jobs in <?PHP echo ucfirst($name) ;?></strong></span>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="site-section" id="next">
    <div class="container">
        <ul class="job-listings mb-5">
            <?PHP foreach ($related_job as $job) : ?>
                <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                    <a href="<?PHP echo APPURL; ?>/jobs/job-single.php?id=<?PHP echo $job->id; ?>"></a>
                    <div class="job-listing-logo">
                        <img src="../users/user-images/<?PHP echo $job->company_image; ?>" alt="Image" class="img-fluid">
                    </div>

                    <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                        <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                            <h2><?PHP echo $job->job_title; ?></h2>
                            <strong><?PHP echo $job->company_name; ?></strong>
                        </div>
                        <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                            <span class="icon-room"></span> <?PHP echo $job->job_region; ?>
                        </div>
                        <div class="job-listing-meta">
                            <span class="badge badge-<?PHP if ($job->job_type == 'Part Time') {
                                                            echo 'danger';
                                                        } else {
                                                            echo 'success';
                                                        } ?>"><?PHP echo $job->job_type ?></span>
                        </div>
                    </div>

                </li>
                <br>
            <?PHP endforeach; ?>
        </ul>
    </div>
</section>





<?
require "../includes/footer.php";
?>