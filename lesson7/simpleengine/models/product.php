<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 09.07.2017
 * Time: 20:06
 */

namespace simpleengine\models;

use simpleengine\core\Application;

class Product implements DbModelInterface
{

    private $product = ['1' => '1',
        '2' => '2',
        'что то пошло не так раз тут данные не из БД, верно?' => '3'];

    /**
     * @return array
     */

    private $allProducts;
    private $Deleted;
    private $status;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        $app = Application::instance();
        $user = new User();

        if ((int)($user->getRoles()) == 1) {

            $sql = "SELECT * FROM products WHERE deleted is NOT NULL";

            $this->Deleted = $app->db()->getArrayBySqlQuery("$sql");


        }


        return $this->Deleted;
    }

    /**
     * @return mixed
     */
    public function getAllProducts()
    {

        $app = Application::instance();
        $user = new User();


        if ((int)($user->getRoles()) == 1) {

            $sql = "SELECT * FROM products";

            $this->allProducts = $app->db()->getArrayBySqlQuery("$sql");

        }

        return $this->allProducts;
    }

    public function getProduct()
    {
        return $this->product;
    }


    public function rmProduct()
    {

        $app = Application::instance();
        $user = new User();


        if (isset($_POST['productId'])) {

            $id = (int)($_POST['productId']);

            if ((int)($user->getRoles()) == 1) {


                $sql = "UPDATE products SET `deleted`= NOW() WHERE  `id`=?";
                $sqlData = [$id];
                $app->db()->getArrayBySqlQuery($sql, $sqlData);

            }
        }

        return true;
    }


    public function add()
    {

        $app = Application::instance();
        $user = new User();


        if (isset($_POST['addGroup'])) {

            $productName = $_POST['product_name'];
            $productSku = $_POST['product_sku'];
            $productPrice = $_POST['product_price'];

            if ((int)($user->getRoles()) == 1) {

                echo '<pre>';

                echo '</pre>';

                if (($productName == "") || ($productPrice == "") || ($productSku == "") || ($productSku > 999999) || ($productSku < 100000) || ($productPrice <= 0)) {

                    $this->status = "Все поля - обязательные для заполнения, SKU должен быть уникальным, в заданом интревале, цена должна быть больше ноля.";

                } else {


                    $sql = "INSERT INTO products (product_name, product_sku, product_price) VALUES (?, ?, ?)";
                    $sqlData = [$productName, $productSku, $productPrice];

                    $result = $app->db()->getArrayBySqlQuery($sql, $sqlData);
                    $this->catalogIndex(); //пересчет групп товаров

                    if (isset($result['err'])) {

                        $this->status = $result['err'];

                    } else {

                        $this->status = "OK";

                    }

                }
            }
        }


        if (isset($_POST['addProduct'])) {


            $productName = $_POST['product_name'];
            $productSku = $_POST['product_sku'];
            $productPrice = $_POST['product_price'];
            $idParentProduct = $_POST['id_parent_product'];
            $size = $_POST['size'];
            $color = $_POST['color'];
            $pic = $_POST['photo'];

            if ((int)($user->getRoles()) == 1) {


                if (($productName == "") || ($productPrice == "") || ($productSku == "") || ($productSku > 999999999) || ($productSku < 100000000) || ($productPrice <= 0) || ($idParentProduct <= 0) || ($idParentProduct == NULL)) {

                    $this->status = "Поля Имя, Группа, SKU и Цена - обязательные для заполнения, SKU должен быть уникальным, в заданом интревале, цена должна быть больше ноля.";

                } else {


                    $sql = "INSERT INTO products (product_name, product_sku, product_price, id_parent_product ) VALUES (?, ?, ?, ?)";
                    $sqlData = [$productName, $productSku, $productPrice, $idParentProduct];
                    $result = $app->db()->getArrayBySqlQuery($sql, $sqlData);
                    $this->catalogIndex(); //пересчет групп товаров

                    if (isset($result['err'])) {

                        $this->status = $result['err'];

                    } else {


                        $sql = "SELECT id FROM products WHERE product_sku=?";
                        $sqlDat = [$productSku];
                        $productId = $app->db()->getArrayBySqlQuery($sql, $sqlData);


                        $sql = "INSERT INTO product_properties_values (id_product, id_property, property_value) VALUES (?,'1',?); 
                                INSERT INTO product_properties_values (id_product, id_property, property_value) VALUES (?,'2',?);
                                INSERT INTO product_properties_values (id_product, id_property, property_value) VALUES (?,'3',?);
                        ";

                        $sqlData = [$productId[0]['id'],$pic,$productId[0]['id'],$size,$productId[0]['id'],$color];
                        $app->db()->getArrayBySqlQuery($sql,$sqlData);


                        $this->status = "OK";


                    }

                }
            }


        }

        return $this->status;
    }


    public function rmGroup()
    {

        $app = Application::instance();
        $user = new User();


        if (isset($_POST['groupId'])) {

            $id = (int)($_POST['groupId']);

            if ((int)($user->getRoles()) == 1) {

                $sql = "UPDATE products SET `deleted`= NOW() WHERE  `id`=? OR id_parent_product=?";
                $sqlData = [$id,$id];
                $app->db()->getArrayBySqlQuery($sql,$sqlData);

            }
        }

        return true;
    }


    private $catalog = [
        '1' => '1',
        '2' => '2',
        'что то пошло не так раз тут данные не из БД, верно?' => '3'];

    public function __construct($count = 10, $id = 0)
    {
        if ((int)$count > 0) {
            $this->catalogIndex($count);
        }

        if ((int)$id > 0) {
            $this->find($id);
        }

    }


    /**
     * @return mixed
     */
    public function getCatalog()
    {

        return $this->catalog;
    }

    public function catalogIndex($count = 10)
    {
        // TODO: Implement find() method.


        /*   $sql = 'SELECT products.id, product_name, product_price, product_sku, product_properties_values.property_value FROM `products`
                   LEFT JOIN product_properties_values ON products.id = product_properties_values.id_product AND product_properties_values.id_property=1
                   WHERE product_sku < 999999
                    LIMIT 0,' . (int)$count;*/


        /*$sql = "
        
                SET @SQL = NULL;
                SELECT
                GROUP_CONCAT(DISTINCT
                CONCAT('GROUP_CONCAT(IF(pr.product_property_name = \"', pr.`product_property_name`, '\", pp.property_value, NULL)) AS ', pr.`product_property_name`)
                 ) INTO @SQL
                FROM product_properties AS pr;
 
                SET @SQL = CONCAT(\'SELECT p.*, ', @SQL, '
                   FROM products AS p
                   LEFT JOIN product_properties_values AS pp ON (p.id = pp.id_product)
                   LEFT JOIN product_properties AS pr ON (pr.id = pp.id_property)
                 GROUP BY p.id;');
    
                PREPARE stmt FROM @SQL;
                    EXECUTE stmt;
                DEALLOCATE PREPARE stmt;
        
        
        ";*/


        $app = Application::instance();
        $sql = 'SET @SQL = NULL';
        $app->db()->getArrayBySqlQuery($sql);
        $sql = 'SELECT
                GROUP_CONCAT(DISTINCT
                CONCAT(\'GROUP_CONCAT(IF(pr.product_property_name = \"\', pr.`product_property_name`, \'\", pp.property_value, NULL)) AS \', pr.`product_property_name`)
                 ) INTO @SQL
                FROM product_properties AS pr';
        $app->db()->getArrayBySqlQuery($sql);
        $sql = 'SET @SQL = CONCAT(\'SELECT p .*, \', @SQL, \'
                   FROM products AS p
                   LEFT JOIN product_properties_values AS pp ON (p.id = pp.id_product)
                   LEFT JOIN product_properties AS pr ON (pr.id = pp.id_property)
                   WHERE product_sku < 1000000
                   AND deleted is NULL
                   GROUP BY p.id LIMIT 0, ' . (int)$count . ';\')';

        $app->db()->getArrayBySqlQuery($sql);
        $sql = 'PREPARE stmt FROM @SQL';
        $app->db()->getArrayBySqlQuery($sql);
        $sql = 'EXECUTE stmt';
        $catalog = $app->db()->getArrayBySqlQuery($sql);
        $sql = 'DEALLOCATE PREPARE stmt';
        $app->db()->getArrayBySqlQuery($sql);

        foreach ($catalog as $key => $good) {
            $catalog[$key]['Photo'] = explode(',', $catalog[$key]['Photo']);
        }
        $this->catalog = $catalog;
        return $catalog;
    }


    public function find($id = 0)
    {

        /* $sql = 'SELECT products.id , product_name, product_sku, id_property, product_properties.product_property_name , property_value, categories.category_name FROM `products`
                 LEFT JOIN product_properties_values ON products.id = product_properties_values.id_product
                 LEFT JOIN product_properties ON product_properties_values.id_property = product_properties.id
                 LEFT JOIN categories ON product_properties_values.property_value = categories.id
                 WHERE products.id = ' . (int)$id . ' OR id_parent_product = ' . (int)$id;*/

        $sql = 'SELECT products.id , product_name, categories.category_name, product_sku FROM `products`
                    INNER JOIN product_properties_values on product_properties_values.id_product = products.id
                    INNER JOIN categories on categories.id = product_properties_values.property_value
                    WHERE products.id = ?';

        $sqlData = [(int)$id];
        $app = Application::instance();
        $product['header'] = $this->catalog = $app->db()->getArrayBySqlQuery($sql,$sqlData);

        /*$sql = 'SELECT products.product_name, products.product_price, products.product_sku FROM products
                WHERE products.id_parent_product ='. (int)$id
                ;*/


        $sql = 'SET @SQL = NULL';
        $app->db()->getArrayBySqlQuery($sql);
        $sql = 'SELECT
                GROUP_CONCAT(DISTINCT
                CONCAT(\'GROUP_CONCAT(IF(pr.product_property_name = \"\', pr.`product_property_name`, \'\", pp.property_value, NULL)) AS \', pr.`product_property_name`)
                 ) INTO @SQL
                FROM product_properties AS pr';
        $app->db()->getArrayBySqlQuery($sql);
        $sql = 'SET @SQL = CONCAT(\'SELECT p .*, \', @SQL, \'
                   FROM products AS p
                   LEFT JOIN product_properties_values AS pp ON (p.id = pp.id_product)
                   LEFT JOIN product_properties AS pr ON (pr.id = pp.id_property)
                   WHERE p.id_parent_product =' . (int)$id . '
                   AND deleted is NULL
                   GROUP BY p.id ;\')';
        $app->db()->getArrayBySqlQuery($sql);
        $sql = 'PREPARE stmt FROM @SQL';
        $app->db()->getArrayBySqlQuery($sql);
        $sql = 'EXECUTE stmt';
        $product['list'] = $app->db()->getArrayBySqlQuery($sql);
        $sql = 'DEALLOCATE PREPARE stmt';
        $app->db()->getArrayBySqlQuery($sql);

        foreach ($product['list'] as $key => $good) {
            $product['list'][$key]['Photo'] = explode(',', $product['list'][$key]['Photo']);
        }


        $this->product = $product;


        return $this->product;
    }

    public function save($userid)
    {
        // TODO: Implement save() method.
    }

}