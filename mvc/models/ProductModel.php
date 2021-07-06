<?php
    class ProductModel extends DB
    {
        /**
         * getList Product
         * @param integer $pageIn
         * @param
         * @return array
         */

        public function getList($pageIn)
        {
            $paginate = [];
            $query = "SELECT *,category.category_name AS category_name,product.id as product_id FROM product INNER JOIN category ON product.category_id = category.id";
            $rows = mysqli_query($this->con,$query);
            $count = mysqli_num_rows($rows);
            $numberPage = 2;
            $pages = (int)ceil($count / $numberPage);
            $start = ($pageIn * $numberPage) - $numberPage;
            $stmt = $this->con->prepare("SELECT *,category.category_name AS category_name,product.id as product_id FROM product INNER JOIN category ON product.category_id = category.id ORDER BY product.id desc LIMIT ?, ?");
            $stmt->bind_param('ii',$start,$numberPage);
            if ($stmt->execute()) {
                $paginate['listProduct'] = $stmt->get_result();
                $paginate['numberPage'] = $pages;
            }
            $stmt->close();
            return $paginate;
        }

        /**
         * Add Product to database
         * @param array $product
         * @param
         * @return object
         */

        public function addProduct($product)
        {
            $categoryId = $product['category_id'];
            $productName = $product['product_name'];
            $price = $product['price'];
            $picture = $product['picture'];
            $create_at = date("Y-m-d H:i:s", time());
            $update_at = date("Y-m-d H:i:s", time());
            $result = false;
            $stmt = $this->con->prepare("INSERT INTO product VALUES(null, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ississ', $categoryId, $productName, $picture, $price, $create_at, $update_at);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }

        /**
         * FindProduct in database
         * @param integer $product
         * @param
         * @return array
         */

        public function findProduct($product)
        {
            $dataProduct = [];
            $productId = (int)$product;
            $stmt = $this->con->prepare("SELECT *,product.id AS product_id,category.category_name AS category_name from product  INNER JOIN category ON product.category_id = category.id WHERE product.id = ? ");
            $stmt->bind_param('i',$productId);
            if ($stmt->execute()) {
                $dataProduct = $stmt->get_result()->fetch_assoc();
            }
            $stmt->close();
            return $dataProduct;
        }

        /**
         * Edit Product in database
         * @param array $product
         * @param
         * @return boolean
         */

        public function editProduct($product)
        {
            $update_at = date("Y-m-d H:i:s", time());
            $productId = $product['id'];
            $categoryId = $product['category_id'];
            $productName = $product['product_name'];
            $price = $product['price'];
            $picture = $product['picture'];
            $stmt = $this->con->prepare("UPDATE product SET category_id = ?, product_name = ?, picture = ?, price = ?, update_at = ? WHERE id = ? ");
            $stmt->bind_param('issisi', $categoryId, $productName, $picture, $price, $update_at ,$productId);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
            return $result;
        }

        /**
         * Delete Product in database
         * @param integer $product
         * @param
         * @return boolean
         */

        public function deleteProduct($product)
        {
            $result = false;
            $productId = (int)$product;
            $stmt = $this->con->prepare("DELETE FROM product WHERE id = ? ");
            $stmt->bind_param('i',$productId);
            if ($stmt->execute()) {
                $result = true;
            }
            $stmt->close();
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
            $query = "SELECT *,category.category_name AS category_name,product.id as product_id FROM product INNER JOIN category ON product.category_id = category.id";
            $rows = mysqli_query($this->con,$query);
            $count = mysqli_num_rows($rows);
            $numberPage = 2;
            $pages = ceil($count / $numberPage);
            return $pages;
        }
    }
?>