<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= $page_title; ?></h2>
                <a href="<?= base_url('shares/create') ?>" class="btn btn-primary pull-right"> New Share</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($shares) > 0) { ?>
                            <?php foreach ($shares as $key => $value) { ?>
                                <tr>
                                    <td><?= $value['name'] ?></td>
                                    <td>
                                        <a href="<?= base_url('shares/edit/' . $value['id']) ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>