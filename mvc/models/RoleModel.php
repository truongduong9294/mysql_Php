<?php
    class RoleModel extends DB
    {
        /**
         * get ListRole
         * @param integer $pageIn
         * @param
         * @return array
         */

        public function listRole($pageIn)
        {
            $paginate = [];
            $query = "SELECT * FROM role";
            $rows = mysqli_query($this->con,$query);
            $count = mysqli_num_rows($rows);
            $numberPage = 2;
            $pages = (int)ceil($count / $numberPage);
            $start = ($pageIn * $numberPage) - $numberPage;
            $stmt = $this->con->prepare("SELECT * FROM role ORDER BY id desc LIMIT ? , ? ");
            $stmt->bind_param('ii',$start,$numberPage);
            if ($stmt->execute()) {
                $paginate['listRole'] = $stmt->get_result();
                $paginate['numberPage'] = $pages;
            }
            $stmt->close();
            return $paginate;
        }

        /**
         * Get List Role
         * @param integer
         * @param integer
         * @return object
         */
        function roleList() 
        {
            $query = "SELECT * FROM role";
            $rows = mysqli_query($this->con,$query);
            return $rows;
        }

        /**
         * Add Role to database
         * @param string $role
         * @param
         * @return boolean
         */

        public function addRole($role)
        {
            $result = false;
            $create_at = date("Y-m-d H:i:s", time());
            $update_at = date("Y-m-d H:i:s", time());
            $stmt = $this->con->prepare("INSERT INTO role VALUES(null , ?, ?, ?)");
            $stmt->bind_param('sss',$role, $create_at, $update_at);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }

        /**
         * Find Role in database
         * @param integer $role
         * @param
         * @return array
         */

        public function findRole($role)
        {
            $dataRole = [];
            $roleId = (int)$role;
            $stmt = $this->con->prepare("SELECT * from Role WHERE id = ?");
            $stmt->bind_param('i',$roleId);
            if ($stmt->execute()) {
                $dataRole = $stmt->get_result()->fetch_assoc();
            }
            $stmt->close();
            return $dataRole;
        }

        /**
         * Edit Product in database
         * @param integer $id
         * @param string $name
         * @return boolean
         */

        public function editRole($id,$name)
        {
            $update_at = date("Y-m-d H:i:s", time());
            $result = false;
            $stmt = $this->con->prepare("UPDATE role SET role_name = ?, update_at = ? WHERE id = ? ");
            $stmt->bind_param('ssi',$name, $update_at, $id);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }

        /**
         * Delete Role in database
         * @param integer $role
         * @param
         * @return object
         */

        public function deleteRole($role)
        {
            $roleId = (int)$role;
            $stmt = $this->con->prepare("DELETE FROM role WHERE id = ? ");
            $stmt->bind_param('i',$roleId);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }
        
        /**
         * Check User contain Role in database
         * @param
         * @param
         * @return object
         */

        public function checkUser()
        {
            $checkUser = [];
            $query = "SELECT DISTINCT(role.id) FROM role INNER JOIN user ON role.id = user.role_id";
            $result = mysqli_query($this->con,$query);
            while ($row = $result->fetch_array()) {
                array_push($checkUser,$row['id']);
            }
            return $checkUser;
        }

        /**
         * get TotalPage
         * @param
         * @param
         * @return integer 
         */

        public function totalPage()
        {
            $query = "SELECT * FROM role";
            $rows = mysqli_query($this->con,$query);
            $count = mysqli_num_rows($rows);
            $numberPage = 2;
            $pages = ceil($count / $numberPage);
            return $pages;
        }
    }
?>