<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../../../public/css/custom.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="../../../public/js/custom.js"></script>
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="registerProcess" enctype="multipart/form-data" id="formRegister">
                            <div class="form-group">
                                <label for="name" class="cols-sm-2 control-label">User Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter your username" />
                                    </div>
                                    <span id="error_user_name" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="cols-sm-2 control-label">Email</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email" />
                                    </div>
                                </div>
                                <span id="error_email" style="color:red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Full Name</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter your Fullname" />
                                    </div>
                                </div>
                                <span id="error_full_name" style="color:red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Password</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" />
                                    </div>
                                </div>
                                <span id="error_password" style="color:red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Avatar</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                        <input type="file" class="form-control" name="avatar" id="avatar" placeholder="Enter your Username" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="cols-sm-2 control-label">Role</label>
                                <div class="cols-sm-10">
                                    <select name="role_id" id="" class="form-control">
                                    <?php
                                        while ($row = $data['listRole']->fetch_assoc()) { 
                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['role_name'] ?></option>
                                    <?php
                                        } 
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="register">Register</button>
                            </div>
                            <?php
                                if (!isset($_SESSION['user_name'])) {
                            ?>
                                <div class="login-register">
                                    <a href="../User/login">Login</a>
                                </div>
                            <?php } ?>
                            <!-- <div class="login-register">
                                <a href="../User/login">Login</a>
                            </div> -->
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
</style>
