<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= $page_title; ?></h2>
                <a href="<?= base_url('clients/create') ?>" class="btn btn-primary pull-right"> New Client</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Client Number</th>
                            <th>Name</th>
                            <th>Total Investment</th>
                            <th>Register Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clients as $key => $value) { ?>
                            <tr>
                                <td><?= $value['username'] ?></td>
                                <td><?= $value['first_name'] . ' ' . $value['middle_name'] . ' ' . $value['last_name'] ?></td>
                                <td><?= format_currency($value['total_investment']) ?></td>
                                <td><?= date('d-m-y', strtotime($value['created_date'])) ?></td>
                                <td>
                                    <a href="<?= base_url('clients/edit/' . $value['id']) ?>" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                    <a href="<?= base_url('investments/index/' . $value['id']) ?>" class="btn btn-default"><i class="fa fa-line-chart"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>