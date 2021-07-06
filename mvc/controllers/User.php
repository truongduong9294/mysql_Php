<?php
    require './PHPMailer/PHPMailer.php';
    require './PHPMailer/SMTP.php';
    require './PHPMailer/Exception.php';

    class User extends Controller
    {
        /**
         * Display view Register
         * @param
         * @param
         * @return array
         */

        public function register()
        {
            $roleModel = $this->model("RoleModel");
            $listRole = $roleModel->roleList();
            $this->view('pages/register' , ['listRole' => $listRole]);
        }

        /**
         * Display view Register
         * @param
         * @param
         * @return array
         */

        public function listUser()
        {
            $url = $_SERVER['REQUEST_URI'];
            $parts = parse_url($url);
            if (array_key_exists('query', $parts)) {
                parse_str($parts['query'], $query);
                $pageIn = (int)$query['page'];
            } else {
                $pageIn = 1;
            }
            $userModel = $this->model("UserModel");
            $paginate = $userModel->listUser($pageIn);
            $this->view('master' , ['page' => 'user/list' , 'paginate' => $paginate , 'pageIn' => $pageIn]);
        }

        public function create()
        {
            $roleModel = $this->model("RoleModel");
            $listRole = $roleModel->roleList();
            $this->view('master' , ['page' => 'user/add', 'listRole' => $listRole]);
        }

        /**
         * Add User
         * @param
         * @param
         * @return object
         */

        public function registerProcess()
        {
            $userModel = $this->model("UserModel");
            $user = [];
            $checkValidate = 1;
            if (isset($_POST['register'])) {
                $user['user_name'] = $_POST['user_name'];
                if (strlen($user['user_name']) < 6 && $user['user_name'] >20 ) {
                    echo "User Name is between 6 and 20 characters";
                    $checkValidate = 0;
                }
                $user['email'] = $_POST['email'];
                if (strlen($user['user_name']) < 6 && $user['user_name'] >20 ) {
                    echo "Email is between 6 and 30 characters";
                    $checkValidate = 0;
                }
                $user['full_name'] = $_POST['full_name'];
                if (strlen($user['full_name']) < 6 && $user['full_name'] >20 ) {
                    echo "Full Name is between 6 and 30 characters";
                    $checkValidate = 0;
                }
                $user['password'] = $_POST['password'];
                if (strlen($user['full_name']) < 6 && $user['full_name'] >20 ) {
                    echo "Password is between 6 and 20 characters";
                    $checkValidate = 0;
                }
                $user['role_id'] = $_POST['role_id'];
                if (($_FILES['avatar']['name']) != "") {
                    $image = explode('.', $_FILES['avatar']['name']);
                    $nameImage = $image[0].'-'.time().'.'.$image[1];
                    $user['avatar'] = $nameImage;
                }else {
                    echo "File is not blank";
                    die();
                }
            }
            $checkUser = $userModel->checkUsername($user['user_name']);
            if ($checkUser) {
                echo "Username already exists";
            } else {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($user['avatar']);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if (isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
                    if ($check !== false) {
                        echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                if (file_exists($target_file)) {
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
                        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                            echo "The file ". htmlspecialchars( basename( $_FILES["avatar"]["name"])). " has been uploaded.";
                        } else {
                        echo "Sorry, there was an error uploading your file.";
                        }
                    }
                if ($uploadOk == 1 && $checkValidate == 1) {
                    $user = $userModel->addUser($user);
                    if ($user) {
                        $_SESSION['message'] = 'Register Success';
                        $page = (string)$userModel->totalPage();
                        header("Location: /User/listUser?page=$page");
                    }
                }
            }
        }
        
        /**
         * Delete User
         * @param integer $user
         * @param integer $currentPage
         * @return object
         */

        public function deleteUser($user,$currentPage)
        {
            $userModel = $this->model("UserModel");
            $userDelete = $userModel->findUser($user);
            if ($userDelete) {
                $avatar = $userDelete['avatar'];
                unlink("uploads/".$avatar);
                if ($userModel->deleteUser($user)) {
                    $_SESSION['message'] = 'Delete User Success';
                    header("Location: /User/listUser?page=$currentPage");
                }
            }
        }

        /**
         * Display view edit User
         * @param integer $user
         * @param integer $currentPage
         * @return object
         */

        public function editUser($user,$currentPage)
        {
            $roleModel = $this->model("RoleModel");
            $listRole = $roleModel->roleList();
            $userModel = $this->model("UserModel");
            $user = $userModel->findUser($user);
            $this->view('master' , [ 'page' => 'user/edit', 'listRole' => $listRole,'user' => $user , 'currentPage' => $currentPage]);
        }

        /**
         * Edit User
         * @param integer $user
         * @param integer $currentPage
         * @return object
         */

        public function editUserProcess($user,$currentPage)
        {
            $userModel = $this->model("UserModel");
            $userEdit = $userModel->findUser($user);
            $dataUser = [];
            $checkValidate = 1;
            if (isset($_POST['register'])) {
                $dataUser['id'] = $user;
                $dataUser['user_name'] = $_POST['user_name'];
                if (strlen($dataUser['user_name']) < 6 && $dataUser['user_name'] >20 ) {
                    echo "User Name is between 6 and 20 characters";
                    $checkValidate = 0;
                }
                $dataUser['email'] = $_POST['email'];
                if (strlen($dataUser['email']) < 6 && $dataUser['email'] >20 ) {
                    echo "Email is between 6 and 30 characters";
                    $checkValidate = 0;
                }
                $dataUser['full_name'] = $_POST['full_name'];
                if (strlen($dataUser['full_name']) < 6 && $dataUser['full_name'] >20 ) {
                    echo "Email is between 6 and 20 characters";
                    $checkValidate = 0;
                }
                $dataUser['password'] = $_POST['password'];
                if (strlen($dataUser['password']) < 6 && $dataUser['password'] >20 ) {
                    echo "password between 6 and 20 characters";
                    $checkValidate = 0;
                }
                if ($_POST['password']) {
                    $dataUser['password'] = $_POST['password'];
                } else {
                    $dataUser['password'] = $userEdit['password'];
                }
                $dataUser['role_id'] = $_POST['role_id'];
                if ($_FILES['avatar']['name']) {
                    $image = explode('.', $_FILES['avatar']['name']);
                    $nameImage = $image[0].'-'.time().'.'.$image[1];
                    $dataUser['avatar'] = $nameImage;
                } else {
                    $dataUser['avatar'] = $userEdit['avatar'];
                }
            }
            if ($userEdit) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($dataUser['avatar']);
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
                    if ($userModel->editUser($dataUser)) {
                        $avatar = $userEdit['avatar'];
                        unlink("uploads/".$avatar);
                        $_SESSION['message'] = 'Edit User Success';
                        header("Location: /User/listUser?page=$currentPage");
                    }
                }
            }
        }

        /**
         * Display view login
         * @param
         * @param
         * @return
         */

        public function login()
        {
            $this->view('pages/login');
        }

        /**
         * Login User
         * @param
         * @param
         * @return object
         */

        public function loginProcess()
        {
            $userModel = $this->model("UserModel");
            $user = [];
            if (isset($_POST['login'])) {
                $user['user_name'] = $_POST['user_name'];
                $user['password'] = $_POST['password'];
            }
            $userLogined = $userModel->loginUser($user);
            if ($userLogined) {
                $_SESSION['user_name'] = $userLogined['user_name'];
                switch ($userLogined['role_id']) {
                    case "1":
                        header("Location: /User/listUser");
                        break;
                    default:
                        echo "hiển thị trang user";
                }
            } else {
                $_SESSION['message'] = 'Login Failed';
                header("Location: /User/login");
            }
        }

        /**
         * Logout User
         * @param
         * @param
         * @return
         */

        public function logout()
        {
            session_start();
            unset($_SESSION["user_name"]);
            unset($_SESSION["role_id"]);
            header("Location: /User/login");
        }

        /**
         * Display view Email
         * @param
         * @param
         * @return
         */

        public function resetPassword()
        {
            $this->view('pages/check_email');
        }

        /**
         * Insert Token and Send Mail
         * @param
         * @param
         * @return object
         */

        public function resetPasswordProcess()
        {
            if (isset($_POST['email'])) {
                $emailTo = $_POST['email'];
                $token = uniqid();
                $userModel = $this->model("UserModel");
                $insertToken = $userModel->insertToken($token,$emailTo);
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                try {                
                    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = '';                 // SMTP username
                    $mail->Password = '';                           // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port to connect to
                
                    //Recipients
                    $mail->setFrom('', 'Mailer');
                    $mail->addAddress($emailTo, 'Joe User');     // Add a recipient
                    //Content
                    $url = "http://".$_SERVER['HTTP_HOST']."/User/resetForm/$token";
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Your password reset link';
                    $mail->Body    = "<h1>Your requested a password reset</h1> Click <a href='$url'>This link </a>";
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            }
        }

        /**
         * Display view resetPassword with token
         * @param string $token
         * @param
         * @return object
         */

        public function resetForm($token)
        {
            $userModel = $this->model("UserModel");
            $email = $userModel->checkToken($token);
            if ($email) {
                $delete_token = $userModel->deleteToken($token);
                $this->view('pages/resetform',['email' => $email['email']]);
            } else {
                echo "token has been delete";
            }
        }

        /**
         * Change Password
         * @param string $email
         * @param
         * @return object
         */

        public function changePassword($email)
        {
            $userModel = $this->model("UserModel");
            $password = $_POST['password'];
            $password_reset = $userModel->passwordReset($email,$password);
            if ($password_reset) {
                header("Location: /User/listUser");
            } else {
                header("Location: /User/login");
            }
        }
    }
?>