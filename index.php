<?php
require "includes/header.php";
require "config/config.php";



$select = $conn->query("SELECT * FROM jobs WHERE status = 1 ORDER BY create_at DESC LIMIT 5");

$select->execute();

$jobs = $select->fetchAll(PDO::FETCH_OBJ);
?>
<!-- HOME -->
<section class="home-section section-hero overlay bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">

  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-12">
        <div class="mb-5 text-center">
          <h1 class="text-white font-weight-bold">The Easiest Way To Get Your Dream Job</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate est, consequuntur perferendis.</p>
        </div>
        <form method="post" action="search.php" class="search-jobs-form">
          <div class="row mb-5">
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
              <input name="job-title" type="text" class="form-control form-control-lg" placeholder="Job title">
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
              <select name="job-region" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Region">
                <option>Anywhere</option>
                <option>San Francisco</option>
                <option>Palo Alto</option>
                <option>New York</option>
                <option>Manhattan</option>
                <option>Ontario</option>
                <option>Toronto</option>
                <option>Kansas</option>
                <option>Mountain View</option>
              </select>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
              <select name="job-type" class="selectpicker" data-style="btn-white btn-lg" data-width="100%" data-live-search="true" title="Select Job Type">
                <option>Part Time</option>
                <option>Full Time</option>
              </select>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
              <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block text-white btn-search"><span class="icon-search icon mr-2"></span>Search Job</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 popular-keywords">
              <h3>Trending Keywords:</h3>
              <ul class="keywords list-unstyled m-0 p-0">
                <li><a href="#" class="">UI Designer</a></li>
                <li><a href="#" class="">Python</a></li>
                <li><a href="#" class="">Developer</a></li>
              </ul>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <a href="#next" class="scroll-button smoothscroll">
    <span class=" icon-keyboard_arrow_down"></span>
  </a>

</section>

<section class="py-5 bg-image overlay-primary fixed overlay" id="next" style="background-image: url('images/hero_1.jpg');">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-md-7 text-center">
        <h2 class="section-title mb-2 text-white">JobBoard Site Stats</h2>
        <p class="lead text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita unde officiis recusandae sequi excepturi corrupti.</p>
      </div>
    </div>
    <div class="row pb-0 block__19738 section-counter">

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="1930">0</strong>
        </div>
        <span class="caption">Candidates</span>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="54">0</strong>
        </div>
        <span class="caption">Jobs Posted</span>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="120">0</strong>
        </div>
        <span class="caption">Jobs Filled</span>
      </div>

      <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
        <div class="d-flex align-items-center justify-content-center mb-2">
          <strong class="number" data-number="550">0</strong>
        </div>
        <span class="caption">Companies</span>
      </div>


    </div>
  </div>
</section>



<section class="site-section">
  <div class="container">

    <div class="row mb-5 justify-content-center">
      <div class="col-md-7 text-center">
        <h2 class="section-title mb-2">43,167 Job Listed</h2>
      </div>
    </div>

    <ul class="job-listings mb-5">
      <?PHP foreach ($jobs as $job) : ?>
        <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
          <a href="jobs/job-single.php?id=<?PHP echo $job->id;?>"></a>
          <div class="job-listing-logo">
            <img src="users/user-images/<?PHP echo $job->company_image; ?>" alt="<?PHP echo $job->company_image; ?>" class="img-fluid">
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

<section class="py-5 bg-image overlay-primary fixed overlay" style="background-image: url('images/hero_1.jpg');">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h2 class="text-white">Looking For A Job?</h2>
        <p class="mb-0 text-white lead">Lorem ipsum dolor sit amet consectetur adipisicing elit tempora adipisci impedit.</p>
      </div>

      <div class="col-md-3 ml-auto">
        <a href="<?php echo APPURL; ?>/auth/login.php" class="btn btn-warning btn-block btn-lg">Sign Up</a>
      </div>
    </div>
  </div>
</section>


<section class="site-section py-4">
  <div class="container">

    <div class="row align-items-center">
      <div class="col-12 text-center mt-4 mb-5">
        <div class="row justify-content-center">
          <div class="col-md-7">
            <h2 class="section-title mb-2">Company We've Helped</h2>
            <p class="lead">Porro error reiciendis commodi beatae omnis similique voluptate rerum ipsam fugit mollitia ipsum facilis expedita tempora suscipit iste</p>
          </div>
        </div>

      </div>
      <div class="col-6 col-lg-3 col-md-6 text-center">
        <img src="images/logo_mailchimp.svg" alt="Image" class="img-fluid logo-1">
      </div>
      <div class="col-6 col-lg-3 col-md-6 text-center">
        <img src="images/logo_paypal.svg" alt="Image" class="img-fluid logo-2">
      </div>
      <div class="col-6 col-lg-3 col-md-6 text-center">
        <img src="images/logo_stripe.svg" alt="Image" class="img-fluid logo-3">
      </div>
      <div class="col-6 col-lg-3 col-md-6 text-center">
        <img src="images/logo_visa.svg" alt="Image" class="img-fluid logo-4">
      </div>

      <div class="col-6 col-lg-3 col-md-6 text-center">
        <img src="images/logo_apple.svg" alt="Image" class="img-fluid logo-5">
      </div>
      <div class="col-6 col-lg-3 col-md-6 text-center">
        <img src="images/logo_tinder.svg" alt="Image" class="img-fluid logo-6">
      </div>
      <div class="col-6 col-lg-3 col-md-6 text-center">
        <img src="images/logo_sony.svg" alt="Image" class="img-fluid logo-7">
      </div>
      <div class="col-6 col-lg-3 col-md-6 text-center">
        <img src="images/logo_airbnb.svg" alt="Image" class="img-fluid logo-8">
      </div>
    </div>
  </div>
</section>




<?php
require "includes/footer.php";
?>
