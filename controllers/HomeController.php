<?php
require_once 'Controller.php';
require_once 'models/Home.php';
class HomeController extends Controller {



    public function ajaxProductTest(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header('Content-Type: application/json');
        $home  =  new Home();

        $data = $home->ajaxProductTest();
        echo json_encode($data);
    }

    public function index (){
        $page = 1;
        $keyword = '';
        $request = ['page'=>$page,'keyword'=>$keyword];
        $home  =  new Home();
        $this->dataSendView['menus']  = $home->getCategories();
        $this->dataSendView['slider']=$home->getSlider();

        $data = $home->getListProduct($request,$this->limit);

        $this->dataSendView['product']=$data['data'];
        $this->dataSendView['total_page']=$data['total_page'];

        $this->viewClient("views/clients/UI/home/home.php");
    }

    public function ajaxPaginationProduct(){
        //mo cross
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header('Content-Type: application/json');
        // giá trị trả về
        $response = ['success'=>false,'total'=>0,'limit'=>$this->limit,'data'=>[]];
        if(empty($_GET['page'])){$_GET['page']=1;}
        if(!empty($_GET['page'])){
            $home = new Home();
            // lấy tất cả product dựa trên page
            $products = $home->getProduct($_GET['page'],$this->limit);
            if(count($products)>0){
                $response['data']=$products['data'];
                $response['success']=true;
                $response['total']=$products['total'];
            }
            // trả về với cái header là json
            header('Content-Type: application/json');
            // chuyển array thành JSON
            echo json_encode($response);
        }else{
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function detail ($request){

        $home  =  new Home();
        $this->dataSendView['product'] = $home->getProductById($request['product_id']);
        $this->dataSendView['menus']  = $home->getCategories();
        $this->dataSendView['breadcrumb_first']  = "Detail";
//        print_r($request);
//        die('3');
        $this->dataSendView['breadcrumb_second']  =  $this->dataSendView['product']->name;
        $this->viewClient("views/clients/UI/detail/detail.php");
    }

    public function ajaxChat($request){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header('Content-Type: application/json');
        $response = ['success'=>false,'data'=>[]];
        if($request['action'] !='add_message'){

            $home  =  new Home();
            $chats = $home->ajaxChat(true);
            $response['data']=$chats;
            echo json_encode($response);
        }else{
            $home  =  new Home();
            $chats = $home->ajaxChat(false,$request['message']);
            $response['success']=true;
            echo json_encode($response);
        }
    }
    public function cart(){
        $home  =  new Home();
        $this->dataSendView['menus']  = $home->getCategories();
        $this->dataSendView['breadcrumb_first']  = "Cart";
        $this->dataSendView['breadcrumb_second']  =  "Detail";
        $this->viewClient("views/clients/UI/cart/cart.php");
    }
    public function saveCart($request){
        header('Content-Type: application/json');
        $responses = ['success'=>false,'message'=>'Đặt Hàng Thành Công'];
        // xử lí
        $home = new Home();
        $home->saveOrder($request);
        if($home){
            $responses['success']=true;
        }


        echo json_encode( $responses);
    }
}