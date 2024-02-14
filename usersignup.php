<!doctype html>
<html lang="en">

<head>
    <title>Sign up to Fun Olympic Games</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        // Password strength checking function
        function checkPasswordStrength(password) {
            const passwordStrengthDiv = document.getElementById('passwordStrength');
            
            // Define regex patterns for different strength levels
            const weakRegex = /^(?=.*[a-zA-Z]).{4,}$/; // At least one letter, 4 characters or more
            const moderateRegex = /^(?=.*[a-zA-Z])(?=.*\d).{6,}$/; // At least one letter and one digit, 6 characters or more
            const strongRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/; // At least one letter, one digit, and one special character, 8 characters or more

            if (strongRegex.test(password)) {
                passwordStrengthDiv.textContent = 'Strong';
                passwordStrengthDiv.style.color = 'green';
            } else if (moderateRegex.test(password)) {
                passwordStrengthDiv.textContent = 'Moderate';
                passwordStrengthDiv.style.color = 'orange';
            } else if (weakRegex.test(password)) {
                passwordStrengthDiv.textContent = 'Weak';
                passwordStrengthDiv.style.color = 'red';
            } else {
                passwordStrengthDiv.textContent = '';
            }
        }
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="container ">
            <div class="row">
                <div class="col-md-6 mt-4 pt-4">
                    <h1 class="display-1">Sign Up</h1>
                    <h2 class="display-3">to be connected </h2>
                    <h3 class="display-4">with us.</h3>
                    <img src=" assets/img/slide1.jpg" alt="" class="img-thumbnail">
                </div>
                <div class="col-md-6"
                    style="margin-top: 50px;  padding: 20px; border-radius: 10px; background-color: honeydew;">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="username">
                        </div>
                        <div class="form-group">
                            <label for="Password">Password: <span id="passwordStrength" class="mt-2"></label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="password"   oninput="checkPasswordStrength(this.value)">
                        </div>
                        <div class="form-group">
                            <label for="Password">Confirm Password:</label>
                            <input type="password" class="form-control" name="cpassword" id="password"
                                placeholder="password">
                        </div>

                        <div class="g-recaptcha" data-sitekey="6Leei2AoAAAAAFcQOfwIcx4kCHg8FbHdMOKexmZB"></div> 
                        <br>

                        <button type="submit" class="btn  btn-warning" name="submit">Sign Up</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                        <a href="userlogin.php" class="btn btn-success">Log in</a>

                    </form>


                    <?php
                    include "connection.php";
                    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['g-recaptcha-response'])) {
                        $secretkey="6Leei2AoAAAAAIhxCM6r-o5TquBrZyHWQyLYAQtg";
                        $ip=$_SERVER['REMOTE_ADDR'];
                        $response=$_POST['g-recaptcha-response'];
                        $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
                        $request=file_get_contents($url);
                        $data=json_decode($request);
                        $a = $_POST['fname'];
                        $b = $_POST["lname"];
                        $c = $_POST["username"];
                        $d = md5($_POST["password"]); //md5 is used to make the text cipher 
                        $e = md5($_POST["cpassword"]);

                        if($data->success==false)
                        {
                            echo "<div class='alert alert-danger mt-3'>Fill Recaptcha</div>";
                        }
                        if ($a == "" || $b == "" || $c == "" || $d == "" || $e == "") {
                            //echo "Please fill all fields.";
                            echo "<div class='alert alert-danger mt-3'>Some fields are empty</div>";
                            //echo "<script>window.alert('Some fields are empty!')</script>";
                    
                        } else if ($d != $e) {
                            echo "<div class='alert alert-danger mt-3'>Password do not match</div>";
                        } else {

                            $query = "insert into users(first_name, last_name, username, password)
                             values('$a','$b','$c','$d')";
                            $run = mysqli_query($conn, $query);
                            if ($run) {
                                echo "<div class='alert alert-success mt-3'>Sign up successfull</div>";
                            } else {
                                echo "<div class='alert alert-success mt-3'>Error found! </div>";
                            }
                        }

                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>