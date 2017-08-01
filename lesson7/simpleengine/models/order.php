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


        if  ((int)($user->getRoles()) == 1){


        $app = Application::instance();
        $this->allOrders = $app->db()->getArrayBySqlQuery("select users.firstname,   orders.id, orders.amount, orders.datetime_create, orders.datetime_update, status_name, orders.id_order_status from orders 
INNER JOIN order_statuses s ON orders.id_order_status = s.id INNER JOIN users ON orders.id_user = users.id");

        var_dump('this-allORDERS == ', $this->allOrders);


        return $this->allOrders;
        }
    }








    public function getAdmOrder(){
        $app = Application::instance();
        $user = new User();

        if ((int)($user->getRoles()) && isset($_GET['order'])){

            $orderId = (int)($_GET['order']);
            $sql = "SELECT basket.product_price, basket.id AS pId ,basket.id_order, basket.datetime_insert, p.product_name from basket INNER JOIN products AS p ON basket.id_product = p.id
            where  basket.id_order=" . $orderId;
            $this->admOrder = $app->db()->getArrayBySqlQuery($sql);

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

            $sql = 'SELECT id from orders where orders.id_order_status=1 AND orders.id_user=' . $userId;
            $result = $app->db()->getArrayBySqlQuery($sql);
            /*var_dump('RESULT == ', $result);
            var_dump('EMPTY ==', empty($result));*/

            $sql= "SELECT COUNT(*) FROM basket WHERE basket.id_user=". $userId ." AND basket.id_order is NULL";
            $isEmpty = $app->db()->getArrayBySqlQuery($sql);

           /* var_dump('isEMPTY == ', (int)($isEmpty[0][0]));*/

            if ((int)($isEmpty[0][0]) > 0) {  // Если корзина пуста - идём дальше.

                if (empty($result)) {  // Если нового зазказа нет - создать и добавить текущую корзину в него

                    $sql = "INSERT INTO orders (`id_user`, `id_order_status`) VALUES (" . $userId . ",'1')";
                    $app->db()->getArrayBySqlQuery($sql);

                    $sql = 'SELECT id from orders where orders.id_order_status=1 AND orders.id_user=' . $userId;
                    $result = $app->db()->getArrayBySqlQuery($sql);

                    $sql = "UPDATE basket SET id_order= " . (int)($result[0]["id"]) . " WHERE  basket.id_user= " . $userId . " AND basket.id_order is NULL";
                    $app->db()->getArrayBySqlQuery($sql);

                    $sql = "SELECT SUM(basket.product_price) FROM basket WHERE basket.id_order=". (int)($result[0]['id']);
                    $sum=$app->db()->getArrayBySqlQuery($sql);

                    $sql="UPDATE orders SET amount=".(int)($sum[0][0])." WHERE  id=".(int)($result[0]["id"]);
                    $app->db()->getArrayBySqlQuery($sql);

                    $_SESSION['orderId'] = (int)($result[0]["id"]);


                } else { // Если новый заказ уже есть - просто добавить корзину в этот заказ

                    $sql = "UPDATE basket SET id_order= " . (int)($result[0]["id"]) . " WHERE  basket.id_user= " . $userId . " AND basket.id_order is NULL";
                    $app->db()->getArrayBySqlQuery($sql);

                    $sql = "SELECT SUM(basket.product_price) FROM basket WHERE basket.id_order=". (int)($result[0]['id']);
                    $sum=$app->db()->getArrayBySqlQuery($sql);

                    $sql="UPDATE orders SET amount=".(int)($sum[0][0])." WHERE  id=".(int)($result[0]["id"]);
                    $app->db()->getArrayBySqlQuery($sql);

                    $_SESSION['orderId'] = (int)($result[0]["id"]);

                }
            }

            $_SESSION['orderId'] = (int)($result[0]["id"]);
        }

        if (isset($_POST['edit'])){
            $_SESSION['orderId'] = $_POST['edit'];
        }
        /*echo "<pre>";
        var_dump('GET == ',$_GET['order']);
        echo "</pre>";*/


        if (isset($_GET['order'])) {
            $_SESSION['orderId'] = (int)($_GET['order']);

        }


       /* echo "<pre>";
        var_dump('SESSION orderid', $_SESSION['orderId']);
        echo "</pre>";*/

         if ((int)($result[0]["id"])>0){
             $_SESSION['orderId'] = (int)($result[0]["id"]);
         }


      /*  var_dump("EDIT ==", $_POST['edit']);
        var_dump("useid ==", $userId);*/

        $this->order = $app->db()->getArrayBySqlQuery("SELECT basket.product_price, basket.id AS pId ,basket.id_order, basket.datetime_insert, p.product_name from basket INNER JOIN products AS p ON basket.id_product = p.id
          where basket.id_user=" . (int)($userId) . " AND basket.id_order=" . (int)($_SESSION['orderId']));


        $sql = 'SELECT COUNT(*) from basket where id_order =' . (int)($_SESSION['orderId']);

        $count = $app->db()->getArrayBySqlQuery($sql);

        if ($count[0][0] == 0) {
            $this->order["empty"] = 1;
            $app->db()->getArrayBySqlQuery("UPDATE orders SET `id_order_status`='5' WHERE  `id`=" . (int)($_SESSION['orderId']) . " AND `id_user`=" . $userId);
        }

       /* var_dump("this-order == ", $this->order);*/

       /* $_SESSION['orderId']= NULL ;*/
        /*$result = NULL;*/
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

       /* var_dump('this-ORDERS == ', $this->orders);*/
        return $this->orders;
    }

    public function removeOrder($userId)
    {

        $app = Application::instance();


        $order_id = $_POST["remove"];

        $app->db()->getArrayBySqlQuery("UPDATE orders SET `id_order_status`='5' WHERE  `id`=" . $order_id . " AND `id_user`=" . $userId);


        return true;

    }


    public function removeFromOrder($userId) // Удаление позиции из заказа и корзины.
    {

        $app = Application::instance();
        $product_id = (int)($_POST["removeFromOrder"]);
        $dbName = $app->get("DB")["DB_NAME"];
        $sql = "DELETE FROM `" . $dbName . "`.`basket` WHERE  `id`=" . $product_id . " AND `id_user`=" . (int)$_SESSION['id'];
        $app->db()->getArrayBySqlQuery($sql);

        echo "<pre>";
       /* var_dump('THIS->ORDER from removeFromOrder == ', $this->order);*/
        echo "</pre>";



        // Корректируем сумму заказа после удаления из него товара.
        $sql = 'SELECT id from orders where orders.id_order_status=1 AND orders.id_user=' . $userId;
        $resultRemove = $app->db()->getArrayBySqlQuery($sql);

        $sql = "SELECT SUM(basket.product_price) FROM basket WHERE basket.id_order=". (int)($resultRemove[0]['id']);
        $sum=$app->db()->getArrayBySqlQuery($sql);

        $sql="UPDATE orders SET amount=".(int)($sum[0][0])." WHERE  id=".(int)($resultRemove[0]['id']);
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


    public function deliverOrder()
    {

        $app = Application::instance();


        if (isset($_POST["deliver"])){

            $orderid = (int)($_POST["deliver"]);
            $app->db()->getArrayBySqlQuery("UPDATE orders SET `id_order_status`='4' WHERE  `id`=" . $orderid );


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

        $app->db()->getArrayBySqlQuery("UPDATE orders SET `id_order_status`='2' WHERE  `id`=" . $order_id . " AND `id_user`=" . $userId);


        return true;





        // TODO: Implement save() method.
    }


}