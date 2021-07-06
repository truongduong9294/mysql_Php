<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Edit User</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">General Form</li>
        </ol>
        </div>
    </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary card-form">
                    <form action="../../editUserProcess/<?php echo $data['user']['id'] ?>/<?php echo $data['currentPage'] ?>" method="POST" enctype="multipart/form-data" id="formRegister">
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $data['user']['user_name'] ?>" placeholder="Enter your username">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $data['user']['email'] ?>" placeholder="Enter your Email">
                        </div>
                        <div class="form-group">
                            <label for="">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $data['user']['full_name'] ?>" placeholder="Enter your Fullname">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password">
                        </div>
                        <div class="form-group">
                            <label for="">Avatar</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" placeholder="Enter your Password">
                        </div>
                        <div class="form-group">
                            <label for="username" class="cols-sm-2 control-label">Role</label>
                            <div class="cols-sm-10">
                                <select name="role_id" id="" class="form-control">
                                <?php
                                    while ($row = $data['listRole']->fetch_assoc()) { 
                                ?>
                                    <option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == $data['user']['role_id']) { echo 'selected="selected"'; } ?>><?Php echo $row['role_name'] ?></option>
                                <?php
                                    } 
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="button">
                            <button type="submit" class="btn btn-primary" name="register">Submit</button>
                            <a href="../../../User/listUser" class="btn btn-primary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>