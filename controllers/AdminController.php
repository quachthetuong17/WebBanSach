<?php

// import để đc sủ dựng tất cả thư viện của Controller.php
require_once 'Controller.php';
require_once '../../../models/Order.php';
// kế thừa class Controller để sử dụng
class AdminController extends Controller
{
        public function index(){
            $request=['page'=>1,'keyword'=>''];
            // tạo ra 1 đối tượng Controller và gọi hàm view đã đc định nghĩa
//                echo "<pre>";
            $order = new Order();
//            print_r($order->getOrders($request,2    ));

            //gọi hàm view và mặc đinh có header và footer rồi
            return $this->view('views/admins/UI/home/index.php');
            return  $this->view('views/admins/UI/home/index.php');
        }
}