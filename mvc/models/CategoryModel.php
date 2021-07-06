<?php
    class CategoryModel extends DB
    {
        /**
         * GetList Category
         * @param
         * @param integer $pageIn
         * @return array
         */

        public function getList($pageIn)
        {
            $paginate = [];
            $query = "SELECT * FROM category";
            $rows = mysqli_query($this->con,$query);
            $count = mysqli_num_rows($rows);
            $numberPage = 2;
            $pages = (int) ceil($count / $numberPage);
            $start = ($pageIn * $numberPage) - $numberPage;
            $stmt = $this->con->prepare("SELECT * FROM category ORDER BY id desc LIMIT ? , ? ");
            $stmt->bind_param('ii',$start,$numberPage);
            if ($stmt->execute()) {
                $paginate['listCategory'] = $stmt->get_result();
                $paginate['numberPage'] = $pages;
            }
            $stmt->close();
            return $paginate;
        }

        /**
         * Get List Category
         * @param
         * @param
         * @return object
         */

        public function categoryList(){
            $query = "SELECT * FROM category";
            $rows = mysqli_query($this->con,$query);
            return $rows;
        }

        /**
         * Add Category to database
         * @param string $category
         * @param
         * @return object
         */

        public function addCategory($category)
        {
            $create_at = date("Y-m-d H:i:s", time());
            $update_at = date("Y-m-d H:i:s", time());
            $result = false;
            $stmt = $this->con->prepare("INSERT INTO category VALUES(null , ? , ? , ?)");
            $stmt->bind_param('sss',$category, $create_at, $update_at);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }

        /**
         * Find Category from database
         * @param integer $category
         * @param
         * @return object
         */

        public function findCategory($category)
        {
            $categoryId = (int)$category;

            $stmt = $this->con->prepare("SELECT * from category WHERE id = ?");
            $stmt->bind_param('i',$categoryId);
            if ($stmt->execute()) {
                $dataCategory = $stmt->get_result()->fetch_assoc();
            }
            $stmt->close();
            return $dataCategory;
        }

        /**
         * Edit Category in database
         * @param integer $category_id
         * @param string $category_name
         * @return object 
         */

        public function editCategory($category_id,$category_name)
        {
            $update_at = date("Y-m-d H:i:s", time());
            $stmt = $this->con->prepare("UPDATE category SET category_name = ? , update_at = ? WHERE id = ? ");
            $stmt->bind_param('ssi',$category_name, $update_at, $category_id);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }

        /**
         * Delete Category in database
         * @param integer $category
         * @param
         * @return object
         */

        public function deleteCategory($category)
        {
            $categoryId = (int)$category;
            $stmt = $this->con->prepare("DELETE FROM category WHERE id = ? ");
            $stmt->bind_param('i',$categoryId);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }

        /**
         * CheckProduct contain Category in database
         * @param
         * @param
         * @return object
         */

        public function checkProduct()
        {
            $check_product = [];
            $query = "SELECT DISTINCT(category.id) FROM category INNER JOIN product ON category.id = product.category_id";
            $result = mysqli_query($this->con,$query);
            while ($row = $result->fetch_array()) {
                array_push($check_product,$row['id']);
            }
            return $check_product;
        }

        /**
         * getTotalPage
         * @param
         * @param
         * @return integer
         */
        public function totalPage()
        {
            $query = "SELECT * FROM category";
            $rows = mysqli_query($this->con,$query);
            $count = mysqli_num_rows($rows);
            $numberPage = 2;
            $pages = ceil($count / $numberPage);
            return $pages;
        }
    }
?>