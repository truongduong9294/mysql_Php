<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <?php
                        if (!empty($_SESSION['message'])) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['message'] ?>
                        </div>
                    <?php
                        unset($_SESSION['message']); 
                    }?>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="loginProcess" enctype="multipart/form-data" id="loginForm">
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">User Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter your username" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="login">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<style>
    .container {
        margin-top: 50px;
    }
    .error {
        border: 2px solid red;
    }
    #user_name {
        width: 100%;
        margin-bottom: 10px
    }
    #user_name-error {
        border: unset;
        color: red;
        font-weight: bold;
    }
    #password {
        width: 100%;
        margin-bottom: 10px
    }

    #password-error {
        border: unset;
        color: red;
        font-weight: bold;
    }
</style>
<script>
    $(document).ready(function() {
        $('#loginForm').validate({
            rules: {
                user_name : {
                    required : true,
                },
                password: {
                    required : true,
                }
            }
        });
    });
</script>