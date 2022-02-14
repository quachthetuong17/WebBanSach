<?php
require_once 'helpers/Database.php';

class Home
{
    public function getCategories()
    {
        $result = [];
        $sql_kind = "select k.name,k.id from kinds as k";
        $execute_query = Database::getInstance()->prepare($sql_kind);
        $execute_query->execute();
        $kinds = $execute_query->fetchAll();

        $sql_categories = "select * from categories where kind_id = ?";


        foreach ($kinds as $item) {
            $execute_query_categories = Database::getInstance()->prepare($sql_categories);
            $execute_query_categories->bindValue(1, $item->id, PDO::PARAM_INT);
            $execute_query_categories->execute();
            $result[] = ['kind' => $item, 'categories' => $execute_query_categories->fetchAll()];
        }

        return $result;
    }


    public function ajaxProductTest()
    {
        $sql = "select * from products";
        $execute_query = Database::getInstance()->prepare($sql);

        $execute_query->execute();
        return $execute_query->fetchAll();
    }

    public function getSlider()
    {
        $sql = "select * from sliders";
        $execute_query = Database::getInstance()->prepare($sql);

        $execute_query->execute();
        return $execute_query->fetchAll();
    }

    public function getProduct($page, $limit)
    {

        $sql_count = "select count(*) from products";
        $execute_query_count = Database::getInstance()->prepare($sql_count);
        $execute_query_count->execute();
        $page_start = ($page - 1) * $limit;
        $sql = "select * from products ORDER BY  id DESC limit ?,?   ";
        $execute_query = Database::getInstance()->prepare($sql);
        $execute_query->bindValue(1, $page_start, PDO::PARAM_INT);
        $execute_query->bindValue(2, $limit, PDO::PARAM_INT);
        $execute_query->execute();
        return ['data' => $execute_query->fetchAll(), 'total' => (int)$execute_query_count->fetchColumn()];
    }

    public function getProductById($id)
    {
        $sql = "select * from products where  id=? ;";
        $execute_query = Database::getInstance()->prepare($sql);
        $execute_query->bindValue(1, $id, PDO::PARAM_INT);
        $execute_query->execute();

        return $execute_query->fetchObject();
    }

    public function getListProduct($request, $limit)
    {
        $sql_count = "select count(*) from products where name like ? ";
        $execute_query_count = Database::getInstance()->prepare($sql_count);
        $execute_query_count->bindValue(1, '%' . $request['keyword'] . '%');
        $execute_query_count->execute();
        $total_page = ceil((int)$execute_query_count->fetchColumn() / $limit);
        $page_start = ($request['page'] - 1) * $limit;

        $sql = "select * from products where name like ? ORDER BY  id DESC limit ?,? ";
        $execute_query = Database::getInstance()->prepare($sql);
        $execute_query->bindValue(1, '%' . $request['keyword'] . '%');
        $execute_query->bindValue(2, $page_start, PDO::PARAM_INT);
        $execute_query->bindValue(3, $limit, PDO::PARAM_INT);

        $execute_query->execute();

        return ['data' => $execute_query->fetchAll(), 'total_page' => $total_page];
    }


    public function ajaxChat($chat = true, $message = '')
    {
        if ($chat) {
            $sql = " select * from chats";
            $execute_query = Database::getInstance()->prepare($sql);
            $execute_query->execute();
            return $execute_query->fetchAll();
        } else {
            $sql = "INSERT INTO `chats` (`id`, `message`) VALUES (NULL, ?);";
            $execute_query = Database::getInstance()->prepare($sql);
            $execute_query->bindValue(1, $message);
            $execute_query->execute();
        }
    }


    function saveOrder($request)
    {
        // tính tổng tiền
        $total = 0;
        foreach ($request['carts'] as $item) {
            $total += $item['quantity'] * $item['price'];
        }
        // insert order
        $sql = "insert into orders(`name`,`address`,`phone`,`total`,`status`,`create_at`) values (?,?,?,?,?,now())  ";
        $execute_query = Database::getInstance()->prepare($sql);
        $execute_query->bindValue(1, $request['name']);
        $execute_query->bindValue(2, $request['address']);
        $execute_query->bindValue(3, $request['phone']);
        $execute_query->bindValue(4, $total, PDO::PARAM_INT);
        $execute_query->bindValue(5, 'waiting_confirm');
        $execute_query->execute();
        // lấy id vừa mới insert
        $order_id = Database::getInstance()->lastInsertId();
        foreach ($request['carts'] as $item) {

//
            $query_order_Detail = "INSERT INTO `order_details` (`id`, `products_id`, `quantity`, `order_id`, `status`, `create_at`) VALUES (NULL, ?,?, ?, ?, now())";
            $execute_query_od = Database::getInstance()->prepare($query_order_Detail);
            $execute_query_od->bindValue(1, $item['id'], PDO::PARAM_INT);
            $execute_query_od->bindValue(2, $item['quantity'], PDO::PARAM_INT);
            $execute_query_od->bindValue(3, $order_id, PDO::PARAM_INT);
            $execute_query_od->bindValue(4, 'publish');
            $execute_query_od->execute();
        }
        return true;
    }


}