<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Edit Role</h1>
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
                <div class="card card-primary">
                    <form action="../../editRoleProcess/<?php echo $data['role']['id'] ?>/<?php echo $data['currentPage'] ?>" method="POST" id="formRole">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Role Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Role Name" value="<?php echo $data['role']['role_name'] ?>">
                            </div>
                            <span id="error_role" style="color:red;"></span>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a href="../../../Role/listRole" class="btn btn-primary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>