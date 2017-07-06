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
                WHERE b.id_user = ".(int)$id_user."
                AND b.id_order IS NULL";
        $result = $app->db()->getArrayBySqlQuery($sql);

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

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function getProductsArray() : array{
        return $this->productsArray;
    }
}