
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <form  style="width: 30%;float: right "  class="form-group" method="get" action="/pages/admin/category/index.php">
                <input style="border: 1px solid cornflowerblue;" class="form-control" type="text" name="keyword">
                <input  class="form-control" value="<?php echo $_GET['page'];?>" type="hidden" name="page">
                <button style="margin-top: 5px ;float: right" class="btn btn-success" type="submit">Search</button>
            </form>
            <br>
            <br>
            <a href="/pages/admin/category/add.php" type="button" class="btn btn-success waves-effect w-md waves-light m-b-5">ADD</a>
            <br>
            <br>

            <div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">
                    <?php if(count($dataSendView['orders'])>0){ ?>
                    <table id="tech-companies-1" class="table  table-striped">
                        <thead>
                        <tr>
                            <th >ID</th>
                            <th >Tên</th>
                            <th >Số Điện Thoại</th>
                            <th >Địa chỉ</th>
                            <th >Trạng Thái</th>
                            <th >Ngày Tạo</th>
                        </tr>
                        </thead>
                        <tbody>
  <?php foreach ($dataSendView['orders'] as $item): ?>
                        <tr>

                            <td><?php echo $item->id?></td>
                            <td><?php echo $item->name?></td>
                            <td><?php echo $item->phone?></td>
                            <td><?php echo $item->address?></td>
                            <td>
                                <?php
                                if($item->status == 'waiting_confirm') echo "<label class='label label-warning'>Đợi Xác Nhận</label>";
                                if($item->status == 'confirmed') echo "<label class='label label-primary'>Đã Xác Nhận</label>";
                                if($item->status == 'successfully') echo "<label class='label label-success'>Hoàn Tất</label>";
                                ?>
                                </td>
                            <td> <?php echo $item->create_at?></td>
                            <td>
                                <button onclick="order_view(<?php echo $item->id?>)" id="btn_order_view" data-toggle="modal" data-target="#myModal" class="btn btn-icon waves-effect waves-light btn-primary m-b-5"> <i class="fas fa-eye"></i> </button>
                            </td>
                        </tr>
                        <?php  endforeach; ?>
                        </tbody>
                    </table>

                    <div style="float:right" class="btn-group m-b-10">
                        <?php for($i=1;$i<=$dataSendView['total_page'];$i++){ ?>
                            <a href="/pages/admin/order/?page=<?php echo $i;?>"
                               type="button"
                               class="btn btn-default"><?php echo $i;?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End row -->

<?php }else{echo '<h1>No data</h1>';} ?>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script>
    function order_view(id){
        ///
        //
        $.post('/pages/admin/order/ajaxOrderDetail.php',{order_id:id}).then(result=>{
            $('.modal-body').text(JSON.stringify(result))
            console.log(result);
        })

    }

</script>