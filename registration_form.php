<div class="container my-4 ">

    <h1 class="text-center">Registration Form</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
        </div>

        <div class="form-group">
            <label>Profile Photo</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture" required>
        </div>
        <br>
        <hr>
        <h4 >Complete Address</h4>
        <hr>
        <br>
        <div class="form-group">
            <label>Full Address</label>
            <input type="text" class="form-control" id="full_address" name="full_address" placeholder="Type Address Here" required>
        </div>

        <div class="form-group">
            <label>City</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
        </div>
        <div class="form-group">
            <label>State</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
        </div>
        <div class="form-group">
            <label>Country</label>
            <input type="text" class="form-control" id="country" name="country" placeholder="Country" required>
        </div>

        <div class="form-group">
            <label>Post Code</label>
            <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Post Code" required>
        </div>

        <button type="submit" class="btn btn-primary">
            SignUp
        </button>
    </form>
</div>