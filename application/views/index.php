<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/png" href="<?php echo base_url('images/phatsisa-logo-bg.png'); ?>">
        <title>Phatsisa | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!--Fontawesome core css-->
        <link href="<?php echo base_url('bootstrap/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- Your customable style sheet (optional) -->
        <link href="<?php echo base_url('bootstrap/css/styles.css'); ?>" rel="stylesheet" type="text/css"/>
        <!--Below is the toastr plugin link -->
        <link href="<?php echo base_url('bootstrap/toastr//toastr.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('bootstrap/toastr//toastr.css'); ?>" rel="stylesheet" type="text/css"/>
        <!--Font family used-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    </head>
    <body style="font-family: 'Montserrat', sans-serif;">
        <section class="text-dark">
            <div class="container-fluid mt-4">
                <div class="row justify-content-center mb-3">
                    <div class="col-sm-12 col-md-8 col-lg-6 col-xl-4">
                        <div class="mb-3">
                            <img class="img-fluid d-block m-auto" src="<?php echo base_url('images/phatsisa-logo-bg.png'); ?>" width="150" height="150">
                        </div>
                        <div class="mb-3">
                            <h2>Welcome!</h2>
                            <h4>Sign in to continue..</h4>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 600;">Username</label>
                            <input class="form-control" name="username" id="username" type="text" >
                        </div>
                        <div class="form-group">
                            <label style="font-weight: 600;">Password</label>
                            <input class="form-control mb-2" name="password" id="password" type="password">
                            <div class="custom-control custom-control-inline custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="formCheck-1">
                                <label class="custom-control-label" for="formCheck-1">Remember me.</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block" type="submit" onclick="submitform()" style="background-color: #0000ff; color: #FFFFFF;">Login</button>
                        </div>
                    </div>
                </div>
            </div> 
        </section>
        <!--JS Files-->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('bootstrap/toastr/toastr.min.js'); ?>"></script>
        <script>

                                /*Custom fucntion to validate data and submit data thorugh ajax*/
                                function submitform() {
                                    /*falg to check the data, if there is an error, flag will turn to 1*/
                                    var flag = 0;
                                    /*Checking the value of inputs*/
                                    var username = $('#username').val();
                                    var password = $('#password').val();
                                    /*Validating the values of inputs that it is neither null nor undefined.*/
                                    if (username == '' || username == undefined) {
                                        $('#username').css('border', '1px solid red');
                                        flag = 1;
                                    }
                                    if (password == '' || password == undefined) {
                                        $('#password').css('border', '1px solid red');
                                        flag = 1;
                                    }
                                    /*if there is no error, go to flag==0 condition*/
                                    if (flag == 0) {
                                        /*Ajax call*/
                                        $.ajax({
                                            url: "<?php echo base_url('login/getLogin'); ?>",
                                            method: 'POST',
                                            data: "UserName=" + username + "&Password=" + password,
                                            success: function (result) {
                                                /*result is the response from Login.php file under getLogin.php function*/

                                                if (result == 1) {
                                                    /*if response result is 1, it means it is successful.*/
                                                    $('#username').css('border', '1px solid green');
                                                    $('#password').css('border', '1px solid green');
                                                    toastr.success('Welcome to Phatsisa Inc.');
                                                    setTimeout(function () {
                                                        /*Redirect to login page after 1 sec*/
                                                        window.location.href = '<?php echo base_url('dashboard'); ?>';
                                                    }, 1000)
                                                } else if (result == 2) {
                                                    /*if response result is 2, it means, username is invalid.*/
                                                    $('#username').css('border', '1px solid red');
                                                    toastr.error('Invalid Username');
                                                } else if (result == 3) {
                                                    /*if response result is 3, it means, password is invalid.*/
                                                    $('#password').css('border', '1px solid red');
                                                    toastr.error('Invalid Password');
                                                } else if (result == 4 || result == 5) {
                                                    /*if response result is 4 or 5, it means, username & password are invalid.*/
                                                    $('#username').css('border', '1px solid red');
                                                    $('#password').css('border', '1px solid red');
                                                    toastr.error('Invalid Username & Passowrd');
                                                } else {
                                                    toastr.error('Invalid username and password!');
                                                }
                                            }
                                        });
                                    } else {
                                        toastr.error('Empty username and password!');
                                    }
                                }
        </script>
    </body>
</html>