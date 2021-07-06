<?php
    class Product extends Controller
    {
        /**
         * Getlist Product
         * @param
         * @param
         * @return object
         */
        public function listProduct()
        {
            $url = $_SERVER['REQUEST_URI'];
            $parts = parse_url($url);

            // var_dump($parts['query']);
            // $arrayUrl = explode('&',$parts['query']);
            // $x = explode('=',$arrayUrl[0]);
            // var_dump($parts['query'],'&');
            // die();

            // var_dump($parts['query']);
            // die();
            // if (array_key_exists('query', $parts)) {

            // if (strpos($parts['query'],'search')) {
            //     $arrayUrl = explode('&',$parts['query']);
            //     $searchString = explode('=',$arrayUrl[1]);
            //     $search = $searchString[1];
            //     $pageString = explode('=',$arrayUrl[0]);
            //     $pageIn = $pageString[1];
            // } else {
            //     if (array_key_exists('query', $parts)) {
            //         parse_str($parts['query'], $query);
            //         $pageIn = (int)$query['page'];
            //     } else {
            //         $pageIn = 1;
            //     }
            //     $search = '';
            // }
            // }

            if (array_key_exists('query', $parts)) {
                parse_str($parts['query'], $query);
                $pageIn = (int)$query['page'];
            } else {
                $pageIn = 1;
            }
            $productModel = $this->model("ProductModel");
            $paginate = $productModel->getList($pageIn);
            $this->view('master' , ['page' => 'product/list' , 'paginate' => $paginate , 'pageIn' => $pageIn]);
        }

        /**
         * Display view add Product
         * @param
         * @param
         * @return object
         */
        public function addProduct()
        {
            $categoryModel = $this->model("CategoryModel");
            $listCategory = $categoryModel->categoryList();
            $this->view('master' , ['page' => 'product/add' , 'listCategory' => $listCategory]);
        }

        /**
         * Add Product
         * @param
         * @param
         * @return object
         */

        public function addProductProcess()
        {
            $productModel = $this->model("ProductModel");
            $product = [];
            $checkValidate = 1;
            if (isset($_POST['submit'])) {
                $product['category_id'] = $_POST['category_id'];
                $product['product_name'] = $_POST['product_name'];
                if (strlen($product['product_name']) < 6 && $product['product_name'] >20 ) {
                    echo "Product Name is between 6 and 20 characters";
                    $checkValidate = 0;
                }
                $product['price'] = $_POST['price'];
                if ($product['price'] < 0) {
                    echo "Price can't be negative";
                    $checkValidate = 0;
                }
                if (($_FILES['avatar']['name']) != "") {
                    $image = explode('.', $_FILES['avatar']['name']);
                    $nameImage = $image[0].'-'.time().'.'.$image[1];
                    $product['picture'] = $nameImage;
                }else {
                    echo "File is not blank";
                    die();
                }
            }
            $target_dir = "uploads/";
            $targetFile = $target_dir . basename($product['picture']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["avatar"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                }else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            if (file_exists($targetFile)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
                
                // Check file size
            if ($_FILES["avatar"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
                
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
                
                // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " has been uploaded.";
                } else {
                echo "Sorry, there was an error uploading your file.";
                }
            }
            if ($uploadOk == 1 && $checkValidate == 1) {
                $product = $productModel->addProduct($product);
                if ($product) {
                    $page = (string)$productModel->totalPage();
                    $_SESSION['message'] = 'Add Product Success';
                    header("Location: /Product/listProduct?page=$page");
                }
            }
        }

        /**
         * Display view Edit Product
         * @param integer $product
         * @param integer $currentPage
         * @return object
         */

        public function editProduct($product,$currentPage)
        {
            $categoryModel = $this->model("CategoryModel");
            $listCategory = $categoryModel->categoryList();
            $productModel = $this->model("ProductModel");
            $product = $productModel->findProduct($product);
            $this->view('master' , ['page' => 'product/edit' , 'product' => $product , 'listCategory' => $listCategory , 'currentPage' => $currentPage]);
        }

        /**
         * Edit Product
         * @param integer $product
         * @param integer $currentPage
         * @return object
         */

        public function editProductProcess($product,$currentPage)
        {
            $checkValidate = 1;
            $productModel = $this->model("ProductModel");
            $productEdit = $productModel->findProduct($product);
            $dataProduct = [];
            $checkImg = false;
            if (isset($_POST['submit'])) {
                $dataProduct['id'] = $product;
                $dataProduct['category_id'] = $_POST['category_id'];
                $dataProduct['product_name'] = $_POST['product_name'];
                if (strlen($dataProduct['product_name']) < 6 && $dataProduct['product_name'] >20 ) {
                    echo "Product Name is between 6 and 20 characters";
                    $checkValidate = 0;
                }
                $dataProduct['price'] = $_POST['price'];
                if ($dataProduct['price'] < 0) {
                    echo "Price can't be negative";
                    $checkValidate = 0;
                }
                if ($_FILES['avatar']['name']) {
                    $image = explode('.', $_FILES['avatar']['name']);
                    $name_image = $image[0].'-'.time().'.'.$image[1];
                    $dataProduct['picture'] = $name_image;
                    $checkImg = true;
                } else {
                    $dataProduct['picture'] = $productEdit['picture'];
                }
            }
            
            if ($productEdit) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($dataProduct['picture']);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if (isset($_POST["submit"])) {
                    if ($_FILES["avatar"]["tmp_name"] != "") {
                        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
                        if ($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "File is not an image.";
                            $uploadOk = 0;
                        }
                    }
                }                  
                // Check file size
                if ($_FILES["avatar"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                  
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                  
                  // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                    } else {
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " has been uploaded.";
                    } else {
                    echo "Sorry, there was an error uploading your file.";
                    }
                }
                if ($uploadOk == 1 && $checkValidate == 1) {
                    if ($productModel->editProduct($dataProduct)) {
                        if ($checkImg) {
                            $picture = $product_edit['picture'];
                            unlink("uploads/".$picture);
                        }
                        $_SESSION['message'] = 'Edit Product Success';
                        header("Location: /Product/listProduct?page=$currentPage");
                    }
                }
            }
        }

        /**
         * Delete Product
         * @param integer $product
         * @param integer $currentPage
         * @return object
         */

        public function deleteProduct($product,$currentPage)
        {
            $productModel = $this->model("ProductModel");
            $productDelete = $productModel->findProduct($product);
            if ($productDelete) {
                $picture = $productDelete['picture'];
                unlink("uploads/".$picture);
                if ($productModel->deleteProduct($product)) {
                    $_SESSION['message'] = 'Delete Product Success';
                    header("Location: /Product/listProduct?page=$currentPage");
                }
            }
        }
    }
?>