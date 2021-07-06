<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Add Role</h1>
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
                    <form action="addRoleProcess" method="POST" id="formRole">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role Name</label>
                            <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter Role ">
                        </div>
                        <div class="button">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a href="../../../Role/listRole" class="btn btn-primary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>