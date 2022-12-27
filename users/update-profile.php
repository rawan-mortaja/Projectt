<?php


require "../config/config.php";
require "../includes/header.php";



if (!isset($_SESSION['username'])) {

    header("location: " . APPURL . "");
}




if (isset($_GET['upd_id'])) {

    $id =  $_GET['upd_id'];


    if ($_SESSION['id'] !== $id) {

        header("location: " . APPURL . "");
    }

    $select = $conn->query("SELECT * FROM users WHERE id = '$id'");
    $select->execute();

    $row = $select->fetch(PDO::FETCH_OBJ);


    if (isset($_POST['submit'])) {

        if (empty($_POST['username']) or empty($_POST['email'])) {
            echo "<scrip>alert('username or email are empty')</script>";
        } else {

            $username = $_POST['username'];
            $email = $_POST['email'];
            $title = $_POST['title'];
            $bio = $_POST['bio'];
            $facebook = $_POST['facebook'];
            $twitter = $_POST['twitter'];
            $linkedin = $_POST['linkedin'];
            $img = $_FILES['img']['name'];
            // $cv = $_FILES['cv']['name'];

            if ($_SESSION['type'] == 'Worker') {
                $cv = $_FILES['cv']['name'];
            } else {
                $cv = 'NULL';
            }

            // $row->type == "Worker" ? $cv = $_FILES['cv']['name'] : $cv = 'NULL';

            $dir_img = 'user-images/' . basename($img);
            $dir_cv = 'user-cvs/' . basename($cv);

            $update = $conn->prepare("UPDATE users SET  username = :username , email = :email , title = :title, bio = :bio,
            facebook = :facebook ,twitter = :twitter ,linkedin = :linkedin , img = :img , cv = :cv WHERE id = '$id'");


            if ($img !== '' and $cv !== '') {

                // unlink('user-images/' . $row->img . "");
                // unlink('user-cvs/' . $row->cv . "");

                $update->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':title' => $title,
                    ':bio' => $bio,
                    ':facebook' => $facebook,
                    ':twitter' => $twitter,
                    ':linkedin' => $linkedin,
                    ':img' => $img,
                    ':cv' => $cv,
                ]);
            } elseif ($img !== '') {
                // unlink('user-cvs/' . $row->cv . "");


                $update->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':title' => $title,
                    ':bio' => $bio,
                    ':facebook' => $facebook,
                    ':twitter' => $twitter,
                    ':linkedin' => $linkedin,
                    ':img' => $img,
                    ':cv' => $row->cv,
                ]);
            } elseif ($cv !== '') {
                // unlink('user-images/' . $row->img . "");

                $update->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':title' => $title,
                    ':bio' => $bio,
                    ':facebook' => $facebook,
                    ':twitter' => $twitter,
                    ':linkedin' => $linkedin,
                    ':img' => $row->img,
                    ':cv' => $cv,
                ]);
            } else {
                $update->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':title' => $title,
                    ':bio' => $bio,
                    ':facebook' => $facebook,
                    ':twitter' => $twitter,
                    ':linkedin' => $linkedin,
                    ':img' => $row->img,
                    ':cv' => $row->cv,
                ]);
            }


            if (move_uploaded_file($_FILES['img']['tmp_name'], $dir_img) or move_uploaded_file($_FILES['cv']['tmp_name'], $dir_cv)) {
                header("location: " . APPURL . "");
            }
        }
    }
} else {

    echo "404";
}
?>
<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('<?php echo APPURL; ?>/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Update Profile</h1>
                <div class="custom-breadcrumbs">
                    <a href="<?PHP echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Update Profile</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section" id="next-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <form action="update-profile.php?upd_id=<?PHP echo $id; ?> " method="POST" enctype="multipart/form-data" class="">

                    <div class="row form-group">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="text-black" for="fname">User name</label>
                            <input type="text" id="fname" name="username" value="<?php echo $row->username ?>" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="text-black" for="lname">Email</label>
                            <input type="text" id="lname" name="email" value="<?php echo $row->email ?>" class="form-control">
                        </div>
                    </div>

                    <?PHP if (isset($_SESSION['type']) and $_SESSION['type'] == 'Worker') : ?>
                        <div class="row form-group">

                            <div class="col-md-12">
                                <label class="text-black" for="email">Title</label>
                                <input type="text" id="" name="title" value="<?php echo $row->title ?>" class="form-control">
                            </div>
                        </div>

                    <?PHP else : ?>
                        <div class="row form-group">

                            <div class="col-md-12">
                                <input type="hidden" id="" name="title" value="NULL" class="form-control">
                            </div>
                        </div>

                    <?PHP endif; ?>


                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="message">Bio</label>
                            <textarea name="bio" id="" name="bio" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."><?PHP echo $row->bio ?></textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="subject">Facebook</label>
                            <input type="subject" value="<?php echo $row->facebook ?>" name="facebook" id="subject" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="subject">Twitter</label>
                            <input type="subject" value="<?php echo $row->twitter ?>" name="twitter" id="subject" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="subject">Linkedin</label>
                            <input type="subject" value="<?php echo $row->linkedin ?>" name="linkedin" id="subject" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label class="text-black" for="subject">Image</label>
                            <input type="file" name="img" id="" class="form-control">
                        </div>
                    </div>


                    <?PHP if (isset($_SESSION['type']) and $_SESSION['type'] == 'Worker') : ?>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="subject">CV</label>
                                <input type="file" name="cv" id="" class="form-control">
                            </div>
                        </div>
                    <?PHP else : ?>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="hidden" value="NULL" name="cv" id="" class="form-control">
                            </div>
                        </div>
                    <?PHP endif; ?>


                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" name="submit" value="Update" class="btn btn-primary btn-md text-white">
                        </div>
                    </div>


                </form>
            </div>

        </div>
    </div>
</section>

<?php
require "../includes/footer.php";
?>