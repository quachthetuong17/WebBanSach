
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <form  style="width: 30%;float: right "  class="form-group" method="get" action="/pages/admin/slider/index.php">
                <input style="border: 1px solid cornflowerblue;" class="form-control" type="text" name="keyword">
                <input  class="form-control" value="<?php echo $_GET['page'];?>" type="hidden" name="page">
                <button style="margin-top: 5px ;float: right" class="btn btn-success" type="submit">search</button>
            </form>
            <br>
            <br>
            <a  href="/pages/admin/slider/add.php" type="button" class="btn btn-success waves-effect w-md waves-light m-b-5">ADD</a>
            <br>
            <br>
            <div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table  table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th >Link</th>
                            <th >Image</th>
                            <th >Status</th>
                            <th >Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dataSendView['slider_list'] as $item): ?>
                            <tr>

                                <td><?php echo $item->id?></td>
                                <td><?php echo $item->link?></td>
                                <td><a target="_blank" href="/assets/uploads/slider/<?php echo $item->image?>"><img style="width: 100px;height:100px" src="/assets/uploads/slider/<?php echo $item->image?>" /></a></td>
                                <td><?php echo $item->status?></td>
                                <td><?php echo $item->create_at?></td>
                                <td>
                                    <a href="/pages/admin/slider/edit.php?id=<?php echo $item->id?>" class="btn btn-icon waves-effect waves-light btn-primary m-b-5"> <i class="fa fa-wrench"></i> </a>
                                    <a  href="/pages/admin/slider/delete.php?id=<?php echo $item->id?>" class="btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i class="fa fa-remove"></i> </a>
                                </td>
                            </tr>
                        <?php  endforeach; ?>
                        </tbody>
                    </table>
                    <div style="float:right" class="btn-group m-b-10">
                        <div class="btn-group">
                            <a href="/pages/admin/slider/?page=<?php
                            if($_GET['page']>1){
                                echo $_GET['page']-1;
                            } ?> " type="button" class="btn btn-default <?php if($_GET['page']==1) echo 'disabled'; ?>">
                                Previous
                            </a>
                        </div>
                        <?php for($i=1;$i<= $dataSendView['total_page'];$i++) { ?>
                            <a href="/pages/admin/slider/?page=<?php echo $i; ?>"
                               type="button"
                               class="btn btn-<?php if($_GET['page']==$i) {echo 'primary';}
                               ?>" waves-effect waves-light"><?php echo $i; ?></a>

                        <?php } ?>
                        <div class="btn-group">
                            <a href="/pages/admin/slider/?page=<?php
                            if($_GET['page']<$dataSendView['total_page']){
                                echo $_GET['page']+1;
                            } ?>" type="button" class="btn btn-default <?php if($_GET['page']==$dataSendView['total_page']) echo 'disabled'; ?>">
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->

