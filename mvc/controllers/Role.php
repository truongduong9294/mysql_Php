<?php
    class Role extends Controller
    {
        /**
         * Getlist Role
         * @param
         * @param
         * @return object
         */

        function listRole()
        {
            $url = $_SERVER['REQUEST_URI'];
            $parts = parse_url($url);
            if (array_key_exists('query', $parts)) {
                parse_str($parts['query'], $query);
                $pageIn = (int)$query['page'];
            } else {
                $pageIn = 1;
            }
            $roleModel = $this->model("RoleModel");
            $paginate = $roleModel->listRole($pageIn);
            $checkUser = $roleModel->checkUser();
            $this->view('master' , ['page' => 'role/list' , 'paginate' => $paginate , 'pageIn' => $pageIn , 'checkUser' => $checkUser]);
        }

        /**
         * Display view edit Role
         * @param integer $roleId
         * @param integer $currentPage
         * @return object
         */

        function editRole($roleId,$currentPage)
        {
            $roleModel = $this->model("RoleModel");
            $role = $roleModel->findRole($roleId);
            $this->view('master' , ['page' => 'role/edit' , 'role' => $role, 'currentPage' => $currentPage]);
        }

        /**
         * Edit Role
         * @param integer $role
         * @param integer $currentPage
         * @return object
         */

        function editRoleProcess($role,$currentPage)
        {
            $checkValidate = 1;
            $roleModel = $this->model("RoleModel");
            $role = $roleModel->findRole($role);
            if (isset($_POST['submit'])) {
                $roleId = $role['id'];
                $roleName = $_POST['role_name'];
                if (strlen($roleName) < 6 &&  strlen($roleName) > 20){
                    echo "Role Name is between 6 and 20 characters";
                    $checkValidate = 0;
                }
            }
            if ($checkValidate == 1) {
                if ($roleModel->editRole($roleId,$roleName)) {
                    $_SESSION['message'] = 'Edit Role Success';
                    header("Location: /Role/listRole?page=$currentPage");
                }
            }
        }

        /**
         * Delete Role
         * @param integer $role
         * @param integer $currentPage
         * @return object
         */

        function deleteRole($role,$currentPage)
        {
            $roleModel = $this->model("RoleModel");
            $roleDelete = $roleModel->findRole($role);
            if ($roleDelete) {
                if ($roleModel->deleteRole($role)) {
                    $_SESSION['message'] = 'Delete Role Success';
                    header("Location: /Role/listRole?page=$currentPage");
                }
            }
        }

        /**
         * Display view add Role
         * @param 
         * @param
         * @return
         */

        function addRole()
        {
            $this->view('master',['page' => 'Role/add']);
        }

        /**
         * Add Role
         * @param
         * @param
         * @return object
         */

        function addRoleProcess()
        {
            $checkValidate = 1;
            $roleModel = $this->model("RoleModel");
            if (isset($_POST['submit'])) {
                $roleName = $_POST['role_name'];
                if (strlen($roleName) < 6 &&  strlen($roleName) > 20){
                    echo "Category Name is between 6 and 20 characters";
                    $checkValidate = 0;
                }
            }
            if($checkValidate) {
                $role = $roleModel->addRole($roleName);
            }
            if ($role) {
                $page = (string)$roleModel->totalPage();
                $_SESSION['message'] = 'Add Role Success';
                header("Location: /Role/listRole?page=$page");
            }
        }
    }
?>