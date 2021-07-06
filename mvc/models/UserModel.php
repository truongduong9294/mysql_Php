<?php
    class UserModel extends DB
    {
        /**
         * get ListUser
         * @param integer $pageIn
         * @param
         * @return array
         */

        public function listUser($page_in)
        {
            $paginate = [];
            $query = "SELECT * FROM user";
            $rows = mysqli_query($this->con,$query);
            $count = mysqli_num_rows($rows);
            $numberPage = 2;
            $pages = ceil($count / $numberPage);
            $start = ($page_in * $numberPage) - $numberPage;
            $sql = "SELECT * FROM user ORDER BY id desc LIMIT $start,$numberPage";
            $querytext = mysqli_query($this->con,$sql);
            $paginate['listUser'] = $querytext;
            $paginate['numberPage'] = $pages;
            return $paginate;
        }

        /**
         * Check User exit
         * @param string $user
         * @param
         * @return boolean
         */

        public function checkUsername($user)
        {
            $userName = $user;
            $query = "SELECT id FROM user WHERE user_name = '$userName'";
            $rows = mysqli_query($this->con,$query);
            $result = false;
            if (mysqli_num_rows($rows) > 0) {
                $result = true;
            }
            return $result;
        }

        /**
         * Add user to database
         * @param array $user
         * @param
         * @return boolean
         */

        public function addUser($user)
        {
            $userName = $user['user_name'];
            $password = $user['password'];
            $fullName = $user['full_name'];
            $avatar = $user['avatar'];
            $roleId = $user['role_id'];
            $email = $user['email'];
            $create_at = date("Y-m-d H:i:s", time());
            $update_at = date("Y-m-d H:i:s", time());
            $result = false;
            $stmt = $this->con->prepare("INSERT INTO user VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssisss', $userName, $password, $fullName, $avatar, $roleId, $email, $create_at, $update_at);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }

        /**
         * Find User in database
         * @param integer $user
         * @param
         * @return object
         */

        public function findUser($user)
        {

            $dataUser = [];
            $userId = (int)$user;
            $stmt = $this->con->prepare("SELECT * from user WHERE id = ? ");
            $stmt->bind_param('i',$userId);
            if ($stmt->execute()) {
                $dataUser = $stmt->get_result()->fetch_assoc();
            }
            $stmt->close();
            return $dataUser;
        }

        /**
         * Delete User in database
         * @param integer $user
         * @param
         * @return boolean
         */

        public function deleteUser($user)
        {
            $result = false;
            $userId = (int)$user;
            $stmt = $this->con->prepare("DELETE FROM user WHERE id = ? ");
            $stmt->bind_param('i',$userId);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }

        
        /**
         * Edit User in database
         * @param array $data
         * @param
         * @return boolean
         */

        public function editUser($data)
        {
            $userId = $data['id'];
            $userName = $data['user_name'];
            $password = $data['password'];
            $fullName = $data['full_name'];
            $avatar = $data['avatar'];
            $roleId = $data['role_id'];
            $email = $data['email'];
            $update_at = date("Y-m-d H:i:s", time());
            $stmt = $this->con->prepare("UPDATE user SET user_name = ?, password = ?, full_name = ?, avatar = ?, role_id = ?, email = ?, update_at = ? WHERE id = ? ");
            $stmt->bind_param('ssssissi', $userName, $password, $fullName, $avatar, $roleId, $email, $update_at ,$userId);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }

        /**
         * User Login
         * @param array $user
         * @param
         * @return object
         */

        public function loginUser($user)
        {
            $user_name = $user['user_name'];
            $password = $user['password'];
            $query = "SELECT * FROM user WHERE user_name = '$user_name' AND password = '$password'";
            $rows = mysqli_query($this->con,$query);
            $row = [];
            if (mysqli_num_rows($rows) > 0) {
                $row = mysqli_fetch_array($rows);
            }
            return $row;
        }

        /**
         * Insert Token to database
         * @param string $token
         * @param string $emailTo
         * @return boolean
         */

        public function insertToken($token,$emailTo)
        {
            $tokenMail = $token;
            $email = $emailTo;
            $result = false;
            $query = "INSERT INTO password_resets VALUES(null,'$tokenMail','$email')";
            if (mysqli_query($this->con,$query)) {
                $result = true;
            }
            return $result;
        }

        /**
         * Check Token in database
         * @param string $token
         * @param
         * @return object
         */

        public function checkToken($token)
        {
            $tokenMail = $token;
            $query = "SELECT email FROM password_resets WHERE token = '$tokenMail'";
            $result = mysqli_query($this->con,$query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {
                    $email = $row;
                }
                return $email;
            } else {
                return false;
            }
        }
        
        /**
         * reset password
         * @param string $email
         * @param string password
         * @return boolean
         */

        public function passwordReset($email,$password)
        {
            $emailTo = $email;
            $passwordNew = $password;
            $query = "UPDATE user SET password ='$passwordNew' WHERE email ='$emailTo' ";
            $result = false;
            if (mysqli_query($this->con,$query)) {
                $result = true;
            }
            return $result;
        }

        /**
         * delete Token in database
         * @param string $token
         * @param
         * @return boolean
         */

        public function deleteToken($token)
        {
            $tokenDel = $token;
            $query = "DELETE FROM password_resets WHERE token = '$tokenDel'";
            $result = false;
            if (mysqli_query($this->con,$query)) {
                $result = true;
            }
            return $result;
        }

        /**
         * get TotalPage
         * @param
         * @param
         * @return integer 
         */

        public function totalPage()
        {
            $query = "SELECT * FROM user";
            $rows = mysqli_query($this->con,$query);
            $count = mysqli_num_rows($rows);
            $numberPage = 2;
            $pages = ceil($count / $numberPage);
            return $pages;
        }
    }
?>