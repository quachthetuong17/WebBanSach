<?php

require_once '../../../helpers/Database.php';

class Order
{
    public function getOrders($request, $limit)
    {

        //
        $sql_count = "select count(*) from orders where (phone like ? or status like ? or name like ?)";
        $execute_query_count = Database::getInstance()->prepare($sql_count);
        $execute_query_count->bindValue(1, '%' . $request['keyword'] . '%');
        $execute_query_count->bindValue(2, '%' . $request['keyword'] . '%');
        $execute_query_count->bindValue(3, '%' . $request['keyword'] . '%');
        $execute_query_count->execute();
        $total_page = ceil((int)$execute_query_count->fetchColumn() / $limit);
        $page_start = ($request['page'] - 1) * $limit;

        $sql = "select * from orders where (phone like ? or status like ? or name like ?) ORDER BY  id DESC limit ?,?";
        $execute_query = Database::getInstance()->prepare($sql);
        $execute_query->bindValue(1, '%' . $request['keyword'] . '%');
        $execute_query->bindValue(2, '%' . $request['keyword'] . '%');
        $execute_query->bindValue(3, '%' . $request['keyword'] . '%');
        $execute_query->bindValue(4, $page_start, PDO::PARAM_INT);
        $execute_query->bindValue(5, $limit, PDO::PARAM_INT);
        $execute_query->execute();

        return ['data' => $execute_query->fetchAll(), 'total_page' => $total_page];

    }


    public function getDetailOrder($order_id)
    {
        //tee
        $sql = "SELECT o.quantity, p.* FROM order_details as o , products as p WHERE order_id  = $order_id and p.id = o.product_id";
        $execute_query = Database::getInstance()->prepare($sql);
        $execute_query->execute();
        return $execute_query->fetchObject($order_id);
//        return ['teo'=>$order_id];
    }
}