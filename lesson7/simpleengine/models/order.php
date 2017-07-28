<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 20:29
 */

namespace simpleengine\models;

use \simpleengine\core\Application;

class Order implements DbModelInterface
{

    private $orders;
    private $order;

    /**
     * @return mixed
     */
    public function getOrder($userId)
    {
        $app = Application::instance();
        $orderId = $_POST['edit'];
        if ($orderId != NULL) {

            $_SESSION['orderId'] = $orderId;

        }


        var_dump("EDIT ==", $_POST['edit']);
        var_dump("useid ==", $userId);


        $this->order = $app->db()->getArrayBySqlQuery("SELECT basket.product_price, basket.id AS pId ,basket.id_order, basket.datetime_insert, p.product_name from basket INNER JOIN products AS p ON basket.id_product = p.id
          where basket.id_user=" . (int)($userId) . " AND basket.id_order=" . (int)($_SESSION['orderId']));


        $sql = 'SELECT COUNT(*) from basket where id_order =' . (int)($_SESSION['orderId']);

        $count = $app->db()->getArrayBySqlQuery($sql);


        if ($count[0][0] == 0) {
            $this->order["empty"] = 1;
            $app->db()->getArrayBySqlQuery("UPDATE orders SET `id_order_status`='5' WHERE  `id`=" . (int)($_SESSION['orderId']) . " AND `id_user`=" . $userId);
        }

        var_dump("this-order == ", $this->order);


        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getOrders($userId)
    {

        $app = Application::instance();
        $this->orders = $app->db()->getArrayBySqlQuery("select orders.id, orders.amount, orders.datetime_create, orders.datetime_update, status_name, orders.id_order_status from orders 
INNER JOIN order_statuses s ON orders.id_order_status = s.id where id_user = " . $userId . " AND orders.id_order_status != 5");

        var_dump('this-ORDERS == ', $this->orders);
        return $this->orders;
    }

    public function removeOrder($userId)
    {

        $app = Application::instance();


        $order_id = $_POST["remove"];

        $app->db()->getArrayBySqlQuery("UPDATE orders SET `id_order_status`='5' WHERE  `id`=" . $order_id . " AND `id_user`=" . $userId);


        return true;

    }


    public function removeFromOrder($userId)
    {

        $app = Application::instance();
        $product_id = (int)($_POST["removeFromOrder"]);
        $dbName = $app->get("DB")["DB_NAME"];
        $sql = "DELETE FROM `" . $dbName . "`.`basket` WHERE  `id`=" . $product_id . " AND `id_user`=" . (int)$_SESSION['id'];
        $app->db()->getArrayBySqlQuery($sql);


        return true;

    }

    public function payOrder($userId)
    {

        $app = Application::instance();


        $order_id = $_POST["pay"];

        $app->db()->getArrayBySqlQuery("UPDATE orders SET `id_order_status`='3' WHERE  `id`=" . $order_id . " AND `id_user`=" . $userId);


        return true;

    }


    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function save()
    {
        // TODO: Implement save() method.
    }


}