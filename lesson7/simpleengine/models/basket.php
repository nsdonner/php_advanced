<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 20:29
 */

namespace simpleengine\models;

use simpleengine\core\Application;

class Basket implements DbModelInterface
{
    private $id_user;
    private $productsArray = [];

    public function __construct($id_user){
        if((int)$id_user > 0){
            $this->id_user = $id_user;
            $this->find($id_user);
        }
    }

    public function find($id_user)
    {
        $app = Application::instance();
        $sql = "SELECT b.*, p.product_name
                FROM basket b
                LEFT JOIN products p ON p.id = b.id_product
                WHERE b.id_user = ?
                AND b.id_order IS NULL";
        $sqlData = [(int)$id_user];
        $result = $app->db()->getArrayBySqlQuery($sql,$sqlData);

        if(!empty($result)){
            foreach($result as $item){
                $this->productsArray[] = [
                    "id_basket" => $item["id"],
                    "id_product" => $item["id_product"],
                    "product_price" => $item["product_price"],
                    "product_name" => $item["product_name"]
                ];
            }
        }
    }


    public function addToBasket(){



        if (isset($_SESSION['id']) & ((int)$_POST['add'] > 0 )){

            $app = Application::instance();

            $sql = 'SELECT products.product_price FROM products WHERE products.id = ?';
            $sqlData=[(int)$_POST['add']];
            $price = $app->db()->getArrayBySqlQuery($sql,$sqlData);
            $sql ="INSERT INTO basket (`id_user`, `id_product`, `product_price`, `datetime_insert`) VALUES ( ?,?,?,NOW())";
            $sqlData=[(int)$_SESSION['id'],(int)$_POST['add'],(int)$price[0]['product_price']];
            $app->db()->getArrayBySqlQuery($sql,$sqlData);
            $_POST['add'] = 0;

        }

    }



    public function removeFromBasket(){



        if (isset($_SESSION['id']) & ((int)$_POST['remove'] > 0 )){



            $app = Application::instance();


            $sql ="DELETE FROM basket WHERE  `id`=? AND `id_user`=?";

            $sqlData=[(int)$_POST['remove'],(int)$_SESSION['id']];
            $app->db()->getArrayBySqlQuery($sql,$sqlData);
            $_POST['remove'] = 0;



        }

    }


    public function save($userid)
    {
        // TODO: Implement save() method.
    }

    public function getProductsArray() : array{
        return $this->productsArray;
    }
}