<?php
    $showAlert = false;
    $showError = false;
    $exists=false;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database Connection.

    $host='localhost';
    $user='root';
    $password='';
    $dbms='nxm_partb';

    // Create a connection
    $conn = mysqli_connect($host, $user, $password, $dbms);
    $name = $_POST["name"];
    $date_of_birth=$_POST["date_of_birth"];
    $sql = "Select * from users where name='$name' and date_of_birth='$date_of_birth'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    // This sql query is use to check if
    // the username is already present
    // or not in our Database
    if($num == 0) {

        $full_address=$_POST["full_address"];
        $city=$_POST["city"];
        $state=$_POST["state"];
        $country=$_POST["country"];
        $post_code=$_POST["post_code"];


        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);


        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

            // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

            // Check file size
        if ($_FILES["profile_picture"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

            // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

            // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                $profile_picture=$target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }


            $sql = "INSERT INTO `users`(`name`,`profile_picture`,`date_of_birth`) VALUES
                           ('$name','$profile_picture','$date_of_birth')";

            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;

                $sql_address="INSERT INTO `address`(`user_id`,`full_address`,`city`,`state`,`country`,`post_code`) VALUES
                           ('$last_id','$full_address','$city','$state','$country','$post_code')";

                $conn->query($sql_address);

                $showAlert = true;
            }

    }// end if

    if($num>0)
    {
        $exists="Username not available";
    }

}//end if

?>

<!doctype html>

<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content=
    "width=device-width, initial-scale=1,
		shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=
    "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity=
          "sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
          crossorigin="anonymous">

</head>

<body>

<?php

    if($showAlert) {

        echo ' <div class="alert alert-success
                alert-dismissible fade show" role="alert">
        
                <strong>Success!</strong> Your account is
                now created and you can login.
                <button type="button" class="close"
                    data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div> ';
    }

    if($showError) {

        echo ' <div class="alert alert-danger
                alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $showError.'
        
        <button type="button" class="close"
                data-dismiss="alert aria-label="Close">
                <span aria-hidden="true">×</span>
        </button>
        </div> ';
    }

    if($exists) {
        echo ' <div class="alert alert-danger
                alert-dismissible fade show" role="alert">
        
            <strong>Error!</strong> '. $exists.'
            <button type="button" class="close"
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div> ';
    }

    include 'registration_form.php'

?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="
https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="
sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous">
</script>

<script src="
https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity=
        "sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous">
</script>

<script src="
https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity=
        "sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous">
</script>
</body>
</html>
