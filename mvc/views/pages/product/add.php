<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Add Product</h1>
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
                    <form action="addProductProcess" method="POST" enctype="multipart/form-data" id="formProduct">
                        <div class="form-group">
                            <label for="username" class="cols-sm-2 control-label">Category Name</label>
                            <div class="cols-sm-10">
                                <select name="category_id" id="" class="form-control">
                                <?php
                                    while ($row = $data['listCategory']->fetch_assoc()) { 
                                ?>
                                    <option value="<?php echo $row['id'] ?>"><?Php echo $row['category_name'] ?></option>
                                <?php
                                    } 
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter Price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Picture</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" placeholder="Enter email">
                        </div>
                        <div class="button">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a href="../../../Product/listProduct" class="btn btn-primary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>