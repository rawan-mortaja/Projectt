<?PHP
require "../config/config.php";
require "../includes/header.php";



$select = $conn->query("SELECT * FROM users WHERE type = 'Company'");
$select->execute();

$allCompanies = $select->fetchAll(PDO::FETCH_OBJ);






?>

<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('<?php echo APPURL; ?>/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Workers</h1>
                <div class="custom-breadcrumbs">
                    <a href="<?php echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Workers</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section " id="home-section">
    <div class="container">
        <div class="row">
            <?PHP foreach ($allCompanies as $company) : ?>
                <div class="col-md-4">
                    <div class="card" style="width: 17rem; height: 25rem;">
                        <img class="card-img-top"  style="width: 200px; height: 200px;margin-left: 27px;" src="../users/user-images/<?Php echo $company->img; ?>" alt="<?Php echo $company->img; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?Php echo $company->username; ?></h5>
                            <p class="card-text"><?Php echo substr($company->bio, 0, 50); ?></p>
                            <a target="" href="../users/public-profile.php?id=<?Php echo $company->id; ?>" class="btn btn-primary">Go to Profile</a>
                        </div>

                    </div>
                    <br>

                </div>
                <br>
            <?PHP endforeach; ?>
        </div>
    </div>
    </div>
</section>






<?PHP require "../includes/footer.php"; ?>