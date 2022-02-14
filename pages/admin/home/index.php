<?php
// sau khi đăng nhập thành công thì sẽ chạy vào file pages/admin/home/index.php

session_start();
require_once '../../../controllers/AdminController.php';

// tạo 1 đối tượng AdminController để gọi hàm index
$auth = new AdminController();
$auth->index();

//print_r($_SESSION['auth']);