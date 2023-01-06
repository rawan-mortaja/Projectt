<?PHP

require "../config/config.php";
require "../includes/header.php";


if (isset($_GET['id'])) {

  $id = $_GET['id'];

  //getting single job info
  $select = $conn->query("SELECT * FROM jobs WHERE id = '$id'");
  $select->execute();

  $row = $select->fetch(PDO::FETCH_OBJ);

  //getting related jobs
  $related_jobs = $conn->query("SELECT * FROM jobs WHERE job_category = '$row->job_category' AND status = 1 AND id !='$id' ");
  $related_jobs->execute();

  $related_job = $related_jobs->fetchAll(PDO::FETCH_OBJ);


  //getting the count of related jobs
  $job_count = $conn->query("SELECT COUNT(*) as job_count FROM jobs WHERE job_category = '$row->job_category' AND status = 1 AND id !='$id' ");
  $job_count->execute();

  $job_num = $job_count->fetch(PDO::FETCH_OBJ);
}else{
  header("location: ".APPURL."/404.php");
}


//submitting appliaction
if (isset($_POST['submit_appliaction'])) {

  $username = $_POST['username'];
  $email = $_POST['email'];
  $cv = $_POST['cv'];
  $worker_id = $_POST['worker_id'];
  $job_id = $_POST['job_id'];
  $job_title = $_POST['job_title'];
  $company_id = $_POST['company_id'];
  $company_image = $_POST['company_image'];

  $insert = $conn->prepare("INSERT INTO job_applications (username , email , cv , worker_id , job_id , job_title , company_id , company_image) 
  VALUES (:username , :email , :cv , :worker_id , :job_id , :job_title , :company_id , :company_image )");

  $insert->execute([
    ':username' => $username,
    ':email' => $email,
    ':cv' => $cv,
    ':worker_id' => $worker_id,
    ':job_id' => $job_id,
    ':job_title' => $job_title,
    ':company_id' => $company_id,
    ':company_image' => $company_image
  ]);

  echo "<script>alert('Application sent successfully')</script>";
}


// //Saveing application
// if (isset($_POST['submit_save'])) {

//   $job_id = $_POST['job_id'];
//   $worker_id = $_POST['worker_id'];


//   $save_jobs = $conn->prepare("INSERT INTO saved_jobs (job_id , worker_id) VALUES (:job_id , :worker_id)");
//   $save_jobs->execute([
//     ':job_id' => $job_id,
//     ':worker_id' => $worker_id
//   ]);

//   echo "<script>alert('Job saved successfully')</script>";
// }



if (isset($_SESSION['id'])) {
  //checking for worker application
  $checking_for_application = $conn->query("SELECT * FROM job_applications WHERE worker_id = '$_SESSION[id]' AND job_id = '$id' ");
  $checking_for_application->execute();

  //Checking for saved jobs
  $checking_for_saved_job = $conn->query("SELECT * FROM saved_jobs WHERE worker_id = '$_SESSION[id]' AND job_id = '$id'");
  $checking_for_saved_job->execute();
}


//getting categories 

$categories = $conn->query("SELECT * FROM catogories ");
$categories->execute();

$allCategories = $categories->fetchAll(PDO::FETCH_OBJ);


?>
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold"><?PHP echo $row->job_title; ?></h1>
        <div class="custom-breadcrumbs">
          <a href="<?PHP echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
          <a href="#">Job</a> <span class="mx-2 slash">/</span>
          <span class="text-white"><strong><?PHP echo $row->job_title; ?></strong></span>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="site-section">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-lg-8 mb-4 mb-lg-0">
        <div class="d-flex align-items-center">
          <div class="border p-2 d-inline-block mr-3 rounded">
            <img src="../users/user-images/<?PHP echo $row->company_image; ?>" style="width: 150px; height: 150px;margin: -4px;padding: 0px; padding-bottom: 20p;" alt="Image">
          </div>
          <div>
            <h2><?PHP echo $row->job_title; ?></h2>
            <div>
              <span class="ml-0 mr-2 mb-2"><span class="icon-briefcase mr-2"></span><?PHP echo $row->company_name; ?></span>
              <span class="m-2"><span class="icon-room mr-2"></span><?PHP echo $row->job_region; ?></span>
              <span class="m-2"><span class="icon-clock-o mr-2"></span><span class="text-primary"><?PHP echo $row->job_type; ?></span></span>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8">
          <div class="mb-5">
            <figure class="mb-5"><img src="../images/job_single_img_1.jpg" alt="Image" class="img-fluid rounded"></figure>
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-align-left mr-3"></span>Job Description</h3>
            <p><?PHP echo $row->job_description; ?></p>
          </div>
          <div class="mb-5">
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-rocket mr-3"></span>Responsibilities</h3>
            <ul class="list-unstyled m-0 p-0">
              <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?PHP echo $row->responsibilities; ?></span></li>
            </ul>
          </div>

          <div class="mb-5">
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-book mr-3"></span>Education + Experience</h3>
            <ul class="list-unstyled m-0 p-0">
              <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?PHP echo $row->education_experience; ?></span></li>

            </ul>
          </div>

          <div class="mb-5">
            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span class="icon-turned_in mr-3"></span>Other Benifits</h3>
            <ul class="list-unstyled m-0 p-0">
              <li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span><?PHP echo $row->other_benifits; ?></span></li>

            </ul>
          </div>
          <?PHP if (isset($_SESSION['username'])) : ?>
            <?PHP if (isset($_SESSION['type']) and $_SESSION['type'] == "Worker") : ?>
              <div class="row mb-5">


                <?PHP if ($checking_for_saved_job->rowCount() == 0) : ?>
                  <div class="col-6">
                    <a href="job-save.php?job_id=<?PHP echo $id; ?>&worker_id=<?PHP echo $_SESSION['id']; ?>&status=save" class="btn btn-block btn-light btn-md"><i class="icon-heart"></i>Save Job</a>
                    <!--add text-danger to it to make it read-->
                  </div>
                <?PHP else : ?>
                  <div class="col-6">
                    <a href="job-save.php?job_id=<?PHP echo $id; ?>&worker_id=<?PHP echo $_SESSION['id']; ?>&status=delete" class="btn btn-block btn-light btn-md"><i class="icon-heart text-danger "></i>Saved Job</a>
                    <!--add text-danger to it to make it read-->
                  </div>
                <?PHP endif; ?>
                <?PHP if ($checking_for_application->rowCount() == 0) : ?>

                  <form action="job-single.php?id=<?PHP echo $id; ?>" method="post">

                    <!--job details-->

                    <div class="form-group">
                      <input type="hidden" name="username" value="<?PHP echo $_SESSION['username']; ?> " class="form-control" id="username" placeholder="User Name">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="email" value="<?PHP echo $_SESSION['email']; ?> " class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="cv" value="<?PHP echo $_SESSION['cv']; ?> " class="form-control" id="cv" placeholder="CV">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="worker_id" value="<?PHP echo $_SESSION['id']; ?> " class="form-control" id="worker_id" placeholder="User Name">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="job_id" value="<?PHP echo $id; ?> " class="form-control" id="job_id" placeholder="Job id">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="job_title" value="<?PHP echo $row->job_title; ?> " class="form-control" id="job_title" placeholder="Job title">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="company_id" value="<?PHP echo $row->company_id; ?> " class="form-control" id="company_id" placeholder="Company id">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="company_image" value="<?PHP echo $row->company_image; ?> " class="form-control" id="company_image" placeholder="company image">
                    </div>
                    <div class="col-6">
                      <button style="padding: 13px 157px; margin-top: -17px;" name="submit_appliaction" type="submit" class="btn btn-inline btn-primary btn-md">Apply </button>
                    </div>
                  </form>

                <?php else : ?>

                  <div class="col-6">
                    <h4 class="d-inline  ">You applied for this job </h4>
                  </div>

                <?PHP endif; ?>


              </div>
            <?PHP endif; ?>
          <?PHP else : ?>
            <h2>login so you can apply for this job</h2>
          <?PHP endif; ?>

          <?PHP if (isset($_SESSION['username'])) : ?>
            <?PHP if (isset($_SESSION['type']) and $_SESSION['type'] == "Company") : ?>
              <?PHP if (isset($_SESSION['id']) and $_SESSION['id'] == $row->company_id) : ?>
                <div class="row mb-5">
                  <div class="col-6">
                    <a href="<?PHP echo APPURL; ?>/jobs/job_update.php?id=<?PHP echo $row->id; ?>" class="btn btn-block btn-light btn-md">Update Job</a>
                    <!--add text-danger to it to make it read-->
                  </div>
                  <div class="col-6">
                    <a href="<?PHP echo APPURL; ?>/jobs/job_delete.php?id=<?PHP echo $row->id; ?>" class="btn btn-block btn-danger btn-md">Delete Job</a>
                  </div>
                </div>
              <?PHP endif; ?>
            <?PHP endif; ?>
          <?PHP endif; ?>


        </div>
        <div class="col-lg-4">
          <div class="bg-light p-3 border rounded mb-4">
            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
            <ul class="list-unstyled pl-3 mb-0">
              <li class="mb-2"><strong class="text-black">Published on: </strong> <?PHP echo date('M', strtotime($row->create_at)) . ',' . date('d', strtotime($row->create_at)) . ',' . date('Y', strtotime($row->create_at)); ?></li>
              <li class="mb-2"><strong class="text-black">Vacancy: </strong> <?PHP echo $row->vacancy; ?></li>
              <li class="mb-2"><strong class="text-black">Category: </strong> <?PHP echo $row->job_category; ?></li>
              <li class="mb-2"><strong class="text-black">Employment Status: </strong><?PHP echo $row->job_type; ?></li>
              <li class="mb-2"><strong class="text-black">Experience: </strong> <?PHP echo $row->experience; ?></li>
              <li class="mb-2"><strong class="text-black">Job Location: </strong> <?PHP echo $row->job_region; ?></li>
              <li class="mb-2"><strong class="text-black">Salary: </strong> <?PHP echo $row->salary; ?></li>
              <li class="mb-2"><strong class="text-black">Gender: </strong> <?PHP echo $row->gender; ?></li>
              <li class="mb-2"><strong class="text-black">Application Deadline: </strong> <?PHP echo date('M', strtotime($row->application_deadline)) . ',' . date('d', strtotime($row->application_deadline)) . ',' . date('Y', strtotime($row->application_deadline)); ?></li>
              <li class="mb-2"><strong class="text-black">Job Category: </strong> <?PHP echo ucfirst($row->job_category); ?></li>
            </ul>
          </div>

          <div class="bg-light p-3 border rounded">
            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
            <div class="px-3">
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?PHP echo APPURL; ?>/jobs/job-single.php?id=<?php $row->id; ?>&quote=<?php echo $row->job_title; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
              <a href="https://twitter.com/intent/tweet?text=<?php echo $row->job_title; ?>&url=<?PHP echo APPURL; ?>/jobs/job-single.php?id=<?php $row->id; ?>"><span class="icon-twitter"></span></a>
              <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?PHP echo APPURL; ?>/jobs/job-single.php?id=<?php $row->id; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
            </div>
          </div>


          <div class="bg-light p-3 border rounded mb-4 mt-4">
            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Categoties</h3>
            <ul class="list-unstyled pl-3 mb-0">
              <?PHP foreach ($allCategories as $category) : ?>
                <a target="_blank" style="text-decoration:none;" href="<?PHP echo APPURL; ?>/categories/show-jobs.php?name=<?PHP echo $category->name; ?>">
                  <li class="mb-2"><strong class="text-black"> <?PHP echo ucfirst($category->name); ?></li>
                </a>
              <?PHP endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
</section>

<section class="site-section" id="next">
  <div class="container">

    <div class="row mb-5 justify-content-center">
      <div class="col-md-7 text-center">
        <h2 class="section-title mb-2"><?PHP echo $job_num->job_count; ?> Related Jobs</h2>
      </div>
    </div>

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

<?PHP
require "../includes/footer.php";

?>
