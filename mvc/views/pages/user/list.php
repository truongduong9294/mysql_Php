<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>List User</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a class="btn btn-primary" href="create">Add</a>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
                <?php
                    if (!empty($_SESSION['message'])) {
                 ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['message'] ?>
                    </div>
                <?php
                    unset($_SESSION['message']); 
                }?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Avatar</th>
                            <th>Date Created</th>
                            <th>Date Updated</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($row = $data['paginate']['listUser']->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['user_name'] ?></td>
                            <td><?php echo $row['full_name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td style="width: 10%;"><img src="<?php echo '../uploads/'.$row['avatar'] ?>" alt="" style="width: 100%;"></td>
                            <td><?php echo $row['create_at'] ?></td>
                            <td><?php echo $row['update_at'] ?></td>
                            <td><a href="editUser/<?php echo $row['id']; ?>/<?php echo $data['pageIn']; ?>">Edit</a></td>
                            <td>
                                <a onclick="return confirm('Are you want to delete?')" href="deleteUser/<?php echo $row['id'] ?>/<?php echo $data['pageIn']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php
                        }
                     ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example" style="margin-top: 30px;">
                    <ul class="pagination">
                        <?php
                            if ($data['pageIn'] > 1) {
                                $previous = $data['pageIn'] - 1;
                            }
                            if ($data['pageIn'] < $data['paginate']['numberPage']){
                                $next = $data['pageIn'] + 1;
                            }
                        ?>
                        <li class="page-item <?php if ($data['pageIn'] <= 1){ echo 'previos_disble'; } else{ echo 'previos_enable'; }  ?>"><a class="page-link" href="listUser?page=<?php echo $previous ?>">Previous</a></li>
                        <?php
                             for ($i = 1; $i<= $data['paginate']['numberPage']; $i++) {
                        ?>
                            <li class="page-item"><a class="page-link <?php if ($data['pageIn'] === $i) {echo "selected"; } ?>" href="listUser?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php } ?>
                        <li class="page-item <?php if ($data['pageIn'] >= $data['paginate']['numberPage']) { echo 'next_disable'; } else { echo "next_enable"; } ?>"><a class="page-link" href="listUser?page=<?php echo $next ?>">Next</a></li>
                    </ul>
                </nav>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<style>
    .next_disable , .previos_disble {
        pointer-events: none;
    }
    .next_enable , .previos_enable {
        pointer-events: unset;
    }
</style>