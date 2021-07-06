<?php
    class Category extends Controller
    {
        /**
         * GetList Category
         * @param
         * @param
         * @return object
         */
        public function listCategory()
        {
            $url = $_SERVER['REQUEST_URI'];
            $parts = parse_url($url);
            if (array_key_exists('query', $parts)) {
                parse_str($parts['query'], $query);
                $pageIn = (int)$query['page'];
            } else {
                $pageIn = 1;
            }
            $categoryModel = $this->model("CategoryModel");
            $paginate = $categoryModel->getList($pageIn);
            $checkProduct = $categoryModel->checkProduct();
            $this->view('master' , ['page' => 'category/list' , 'paginate' => $paginate , 'pageIn' => $pageIn , 'checkProduct' => $checkProduct]);
        }

        /**
         * Display view add category
         * @param
         * @param
         * @return 
         */

        public function addCategory()
        {
            $this->view('master',['page' => 'category/add']);
        }

        /**
         * Add Category
         * @param
         * @param
         * @return object
         */

        public function addCategoryProcess()
        {
            $checkValidate = 1;
            $categoryModel = $this->model("CategoryModel");
            if (isset($_POST['submit'])) {
                $categoryName = $_POST['category_name'];
                if (strlen($categoryName) < 6 &&  strlen($categoryName) > 20){
                    echo "Category Name is between 6 and 20 characters";
                    $checkValidate = 0;
                }
            }
            if($checkValidate) {
                $category = $categoryModel->addCategory($categoryName);
            }
            if ($category) {
                $_SESSION['message'] = 'Add Category Success';
                $page = (string)$categoryModel->totalPage();
                header("Location: /Category/listCategory?page=$page");
            }
        }

        /**
         * Display view edit category
         * @param integer $categoryId
         * @param integer $currentPage
         * @return object 
         */

        public function editCategory($categoryId,$currentPage)
        {
            $categoryModel = $this->model("CategoryModel");
            $category = $categoryModel->findCategory($categoryId);
            $this->view('master' , ['page' => 'category/edit' , 'category' => $category, 'currentPage' => $currentPage]);
        }

        /**
         * Edit Category
         * @param integer $category
         * @param integer $currentPage
         * @return object 
         */
        public function editCategoryProcess($category,$currentPage)
        {
            $checkValidate = 1;
            $categoryModel = $this->model("CategoryModel");
            $category = $categoryModel->findCategory($category);
            if (isset($_POST['submit'])) {
                $categoryId = $category['id'];
                $categoryName = $_POST['category_name'];
                if (strlen($categoryName) < 6 &&  strlen($categoryName) > 20){
                    echo "Category Name is between 6 and 20 characters";
                    $checkValidate = 0;
                }
            }
            if ($checkValidate == 1) {
                if ($categoryModel->editCategory($categoryId,$categoryName)) {
                    $_SESSION['message'] = 'Edit Category Success';
                    header("Location: /Category/listCategory?page=$currentPage");
                }
            }
        }

        /**
         * Delete category
         * @param integer $category
         * @param integer $currentPage
         * @return object
         */
        public function deleteCategory($category,$currentPage)
        {
            $categoryModel = $this->model("CategoryModel");
            $categoryDelete = $categoryModel->findCategory($category);
            if ($categoryDelete) {
                if ($categoryModel->deleteCategory($category)) {
                    $_SESSION['message'] = 'Delete Category Success';
                    header("Location: /Category/listCategory?page=$currentPage");
                }
            }
        }
    }
?>