<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <form style="width: 30%;float: right " class="form-group" method="get"
                  action="/pages/admin/category/index.php">
                <input style="border: 1px solid cornflowerblue;" class="form-control" type="text" name="keyword">
                <input class="form-control" value="<?php echo $_GET['page']; ?>" type="hidden" name="page">
                <button style="margin-top: 5px ;float: right" class="btn btn-success" type="submit">Search</button>
            </form>
            <br>
            <br>
            <a href="/pages/admin/category/add.php" type="button"
               class="btn btn-success waves-effect w-md waves-light m-b-5">ADD</a>
            <br>
            <br>
            <?php if (count($dataSendView['cate_list']) > 0){ ?>
            <div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">

                    <table id="tech-companies-1" class="table  table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Kind</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dataSendView['cate_list'] as $item): ?>
                            <tr>

                                <td><?php echo $item->id ?></td>
                                <td><?php echo $item->name ?></td>
                                <td><?php echo $item->kind_name ?></td>
                                <td><?php echo $item->status ?></td>
                                <td><?php echo $item->create_at ?></td>
                                <td>
                                    <a href="/pages/admin/category/edit.php?id=<?php echo $item->id ?>"
                                       class="btn btn-icon waves-effect waves-light btn-primary m-b-5"> <i
                                                class="fa fa-wrench"></i> </a>
                                    <a href="/pages/admin/category/delete.php?id=<?php echo $item->id ?>"
                                       class="btn btn-icon waves-effect waves-light btn-danger m-b-5"> <i
                                                class="fa fa-remove"></i> </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End row -->
<div style="float:right" class="btn-group m-b-10">
    <?php for ($i = 1; $i <= $dataSendView['total_page']; $i++) { ?>
        <a href="/pages/admin/category/?page=<?php echo $i; ?>"
           type="button"
           class="btn btn-default"><?php echo $i; ?></a>
    <?php } ?>
</div>
<?php } else {
    echo '<h1>No data</h1>';
} ?>