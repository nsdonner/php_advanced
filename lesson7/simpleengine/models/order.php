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
    private $allOrders;
    private $admOrder;

    /**
     * @return mixed
     */
    public function getAllOrders()
    {


        $user = new User();


        if ((int)($user->getRoles()) == 1) {


            $app = Application::instance();
            $sql = "select users.firstname,   orders.id, orders.amount, orders.datetime_create, orders.datetime_update, status_name, orders.id_order_status from orders 
INNER JOIN order_statuses s ON orders.id_order_status = s.id INNER JOIN users ON orders.id_user = users.id";
            $this->allOrders = $app->db()->getArrayBySqlQuery($sql);


            return $this->allOrders;
        }
    }


    public function getAdmOrder()
    {
        $app = Application::instance();
        $user = new User();

        if ((int)($user->getRoles()) && isset($_GET['order'])) {

            $orderId = (int)($_GET['order']);
            $sql = "SELECT basket.product_price, basket.id AS pId ,basket.id_order, basket.datetime_insert, p.product_name from basket INNER JOIN products AS p ON basket.id_product = p.id
            where  basket.id_order=?";
            $sqlData = [$orderId];
            $this->admOrder = $app->db()->getArrayBySqlQuery($sql, $sqlData);

            return $this->admOrder;

        }

    }


    /**
     * @return mixed
     */
    public function getOrder($userId)
    {
        $app = Application::instance();


        if ($_POST['order'] == 'order') {  // добавить в заказ

            $sql = 'SELECT id from orders where orders.id_order_status=1 AND orders.id_user=?';
            $sqlData = [$userId];
            $result = $app->db()->getArrayBySqlQuery($sql, $sqlData);


            $sql = "SELECT COUNT(*) FROM basket WHERE basket.id_user=? AND basket.id_order is NULL";
            $isEmpty = $app->db()->getArrayBySqlQuery($sql, $sqlData);


            if ((int)($isEmpty[0][0]) > 0) {  // Если корзина пуста - идём дальше.

                if (empty($result)) {  // Если нового зазказа нет - создать и добавить текущую корзину в него

                    $sql = "INSERT INTO orders (`id_user`, `id_order_status`) VALUES (?,'1')";
                    $app->db()->getArrayBySqlQuery($sql, $sqlData);

                    $sql = 'SELECT id from orders where orders.id_order_status=1 AND orders.id_user=?';
                    $result = $app->db()->getArrayBySqlQuery($sql, $sqlData);

                    $sql = "UPDATE basket SET id_order= ? WHERE  basket.id_user= ? AND basket.id_order is NULL";
                    $sqlData = [(int)$result[0]["id"], $userId];
                    $app->db()->getArrayBySqlQuery($sql, $sqlData);

                    $sql = "SELECT SUM(basket.product_price) FROM basket WHERE basket.id_order=?";
                    $sqlData = [(int)($result[0]['id'])];
                    $sum = $app->db()->getArrayBySqlQuery($sql, $sqlData);

                    $sql = "UPDATE orders SET amount=? WHERE  id=?";
                    $sqlData = [(int)($sum[0][0]), (int)($result[0]["id"])];
                    $app->db()->getArrayBySqlQuery($sql, $sqlData);

                    $_SESSION['orderId'] = (int)($result[0]["id"]);


                } else { // Если новый заказ уже есть - просто добавить корзину в этот заказ

                    $sql = "UPDATE basket SET id_order= ? WHERE  basket.id_user= ? AND basket.id_order is NULL";
                    $sqlData = [(int)($result[0]["id"]), $userId];
                    $app->db()->getArrayBySqlQuery($sql, $sqlData);

                    $sql = "SELECT SUM(basket.product_price) FROM basket WHERE basket.id_order=?";
                    $sqlData = [(int)($result[0]['id'])];
                    $sum = $app->db()->getArrayBySqlQuery($sql, $sqlData);

                    $sql = "UPDATE orders SET amount=? WHERE  id=?";
                    $sqlData = [(int)($sum[0][0]), (int)($result[0]["id"])];
                    $app->db()->getArrayBySqlQuery($sql, $sqlData);

                    $_SESSION['orderId'] = (int)($result[0]["id"]);

                }
            }

            $_SESSION['orderId'] = (int)($result[0]["id"]);
        }

        if (isset($_POST['edit'])) {
            $_SESSION['orderId'] = $_POST['edit'];
        }


        if (isset($_GET['order'])) {
            $_SESSION['orderId'] = (int)($_GET['order']);

        }


        if ((int)($result[0]["id"]) > 0) {
            $_SESSION['orderId'] = (int)($result[0]["id"]);
        }


        $sql = "SELECT basket.product_price, basket.id AS pId ,basket.id_order, basket.datetime_insert, p.product_name from basket INNER JOIN products AS p ON basket.id_product = p.id
          where basket.id_user=? AND basket.id_order=?";
        $sqlData = [(int)($userId), (int)($_SESSION['orderId'])];
        $this->order = $app->db()->getArrayBySqlQuery($sql, $sqlData);


        $sql = 'SELECT COUNT(*) from basket where id_order =?';
        $sqlData = [(int)($_SESSION['orderId'])];
        $count = $app->db()->getArrayBySqlQuery($sql, $sqlData);

        if ($count[0][0] == 0) {
            $this->order["empty"] = 1;
            $sql = "UPDATE orders SET `id_order_status`='5' WHERE  `id`=? AND `id_user`=?";
            $sqlData = [(int)($_SESSION['orderId']), $userId];
            $app->db()->getArrayBySqlQuery($sql, $sqlData);
        }


        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getOrders($userId)
    {

        $app = Application::instance();

        $sql="select orders.id, orders.amount, orders.datetime_create, orders.datetime_update, status_name, orders.id_order_status from orders 
INNER JOIN order_statuses s ON orders.id_order_status = s.id where id_user = ? AND orders.id_order_status != 5";
        $sqlData = [$userId];

        $this->orders = $app->db()->getArrayBySqlQuery($sql,$sqlData);


        return $this->orders;
    }

    public function removeOrder($userId)
    {

        $app = Application::instance();


        $order_id = $_POST["remove"];


        $sql="UPDATE orders SET `id_order_status`='5' WHERE  `id`=? AND `id_user`=?";
        $sqlData = [$order_id,$userId];
        $app->db()->getArrayBySqlQuery($sql,$sqlData);


        return true;

    }


    public function removeFromOrder($userId) // Удаление позиции из заказа и корзины.
    {

        $app = Application::instance();
        $product_id = (int)($_POST["removeFromOrder"]);


        $sql = "DELETE FROM basket WHERE  `id`=? AND `id_user`=?";
        $sqlData = [$product_id,(int)$_SESSION['id']];
        $app->db()->getArrayBySqlQuery($sql,$sqlData);



        // Корректируем сумму заказа после удаления из него товара.
        $sql = 'SELECT id from orders where orders.id_order_status=1 AND orders.id_user=?';
        $sqlData = [$userId];
        $resultRemove = $app->db()->getArrayBySqlQuery($sql,$sqlData);

        $sql = "SELECT SUM(basket.product_price) FROM basket WHERE basket.id_order=?";
        $sqlData = [(int)($resultRemove[0]['id'])];
        $sum = $app->db()->getArrayBySqlQuery($sql,$sqlData);

        $sql = "UPDATE orders SET amount=? WHERE  id=?";
        $sqlData = [(int)($sum[0][0]),(int)($resultRemove[0]['id'])];
        $app->db()->getArrayBySqlQuery($sql,$sqlData);

        return true;

    }

    public function payOrder($userId)
    {

        $app = Application::instance();


        $order_id = $_POST["pay"];


        $sql="UPDATE orders SET `id_order_status`='3' WHERE  `id`=? AND `id_user`=?";
        $sqlData = [$order_id,$userId];
        $app->db()->getArrayBySqlQuery($sql, $sqlData);


        return true;

    }


    public function deliverOrder()
    {

        $app = Application::instance();
        $user = new User();


        if (isset($_POST["deliver"]) && (int)($user->getRoles()) == 1) {

            $orderId = (int)($_POST["deliver"]);

            $sql = "UPDATE orders SET `id_order_status`='4' WHERE  `id`=?";
            $sqlData = [$orderId];
            $app->db()->getArrayBySqlQuery($sql,$sqlData);


        }


        return true;

    }


    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function save($userId)
    {

        $app = Application::instance();


        $order_id = $_POST["save"];

        $sql = "UPDATE orders SET `id_order_status`='2' WHERE  `id`=? AND `id_user`=?";
        $sqlData = [$order_id,$userId];

        $app->db()->getArrayBySqlQuery($sql,$sqlData);


        return true;


        // TODO: Implement save() method.
    }


}