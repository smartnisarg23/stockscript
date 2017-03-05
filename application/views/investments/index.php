<div class="row top_tiles">
    <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-user-secret"></i></div>
            <div class="count" style="font-size: 30px"><?= $client_details['first_name'] . ' ' . $client_details['middle_name'] . ' ' . $client_details['last_name'] ?></div>
            <h3 style="color: yellowgreen">Client Number : <?= $client_details['username'] ?></h3>
        </div>
    </div>
    <div class="animated flipInY col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-money"></i></div>
            <div class="count" style="font-size: 30px" id="total_stock_valuation"></div>
            <h3 style="color: yellowgreen">Final Stock Valuation</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= $page_title; ?></h2>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target=".modal-create">New Investment</button>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php $total_valuation = 0; ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Share</th>
                            <th>Total Buy Qty</th>
                            <th>Avg Buy Price</th>
                            <th>Total Sell Qty</th>
                            <th>Avg Sell Price</th>
                            <th>Qty in Stock</th>
                            <th>Stock Valuation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($investments_details as $k_i => $v_i) { ?>
                            <tr>
                                <th scope="row"><?= $k_i + 1 ?></th>
                                <td><?= $v_i['name'] ?></td>
                                <td><?= $v_i['total_buy_qty'] ?></td>
                                <?php
                                $buy_avg_price = number_format((float) $v_i['buy_average_price'], 2, '.', '');
                                $sell_avg_price = number_format((float) $v_i['sell_average_price'], 2, '.', '');
                                $stock_valution = $v_i['total_buy_valuation'] - $v_i['total_sell_valuation'];
                                $total_valuation += $stock_valution;
                                ?>
                                <td><?= format_currency($buy_avg_price) ?></td>
                                <td><?= $v_i['total_sell_qty'] ?></td>
                                <td style="color: <?= (($sell_avg_price > $buy_avg_price) ? '#26B99A' : '#D9534F') ?>"><?= format_currency($sell_avg_price) ?></td>
                                <td><?= $v_i['total_buy_qty'] - $v_i['total_sell_qty'] ?></td>
                                <td><?= format_currency($stock_valution) ?></td>
                                <td>
                                    <button type="button" class="btn btn-default" style="background-color: #26B99A;color: #FFF;font-size: 16px;font-weight: bolder" onclick="open_create_modal('B', '<?= $v_i['id'] ?>')">B</button>
                                    <button type="button" class="btn btn-default" style="background-color: #D9534F;color: #FFF;font-size: 16px;font-weight: bolder" onclick="open_create_modal('S', '<?= $v_i['id'] ?>')">S</button>
                                    <button type="button" class="btn btn-default history-btn" data-rowid="<?= $v_i['id'] ?>"><i class="fa fa-history"></i></button>
                                </td>
                            </tr>
                            <tr id="history_tr_<?= $v_i['id'] ?>" style="display: none">
                                <td colspan="9">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <h2>BUY History</h2>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Valuation</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($v_i['buy'] as $kb => $vb) { ?>
                                                        <tr id="buy_history_<?= $vb['id'] ?>">
                                                            <th scope="row"><?= $kb + 1 ?></th>
                                                            <td><?= $vb['qty'] ?></td>
                                                            <td><?= format_currency(number_format((float) $vb['price'], 2, '.', '')) ?></td>
                                                            <td><?= format_currency(number_format((float) $vb['price'] * $vb['qty'], 2, '.', '')) ?></td>
                                                            <td><?= date('m-d-Y', strtotime($vb['action_date'])) ?></td>
                                                            <td>
                                                                <button type="button" class="btn btn-default" onclick="edit_history_row('<?= $v_i['id'] ?>', '<?= $v_i['name'] ?>', '<?= $vb['id'] ?>', 'B', '<?= $vb['qty'] ?>', '<?= $vb['price'] ?>', '<?= date('d/m/Y', strtotime($vb['action_date'])) ?>')"><i class="fa fa-edit"></i></button>
                                                                <a href="<?= base_url('investments/delete/' . $client_id . '/' . $vb['id']) ?>" class="btn btn-default" ><i class="fa fa-remove"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <h2>SELL History</h2>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Valuation</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($v_i['sell'] as $kb => $vb) { ?>
                                                        <tr id="buy_history_<?= $vb['id'] ?>">
                                                            <th scope="row"><?= $kb + 1 ?></th>
                                                            <td><?= $vb['qty'] ?></td>
                                                            <td><?= format_currency(number_format((float) $vb['price'], 2, '.', '')) ?></td>
                                                            <td><?= format_currency(number_format((float) $vb['price'] * $vb['qty'], 2, '.', '')) ?></td>
                                                            <td><?= date('m-d-Y', strtotime($vb['action_date'])) ?></td>
                                                            <td>
                                                                <button type="button" class="btn btn-default" onclick="edit_history_row('<?= $v_i['id'] ?>', '<?= $v_i['name'] ?>', '<?= $vb['id'] ?>', 'S', '<?= $vb['qty'] ?>', '<?= $vb['price'] ?>', '<?= date('m/d/Y', strtotime($vb['action_date'])) ?>')"><i class="fa fa-edit"></i></button>
                                                                <a href="<?= base_url('investments/delete/' . $client_id . '/' . $vb['id']) ?>" class="btn btn-default" ><i class="fa fa-remove"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <input type="hidden" name="total_valuation" id="total_valuation" value="<?= format_currency($total_valuation) ?>">
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg modal-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open(base_url('investments/create/' . $client_id), array("id" => "investment_form", "class" => "form-horizontal")); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">New Investment</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Share <span class="required">*</span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <select name="share_id" id="share_id" class="form-control" required="required">
                            <option value="">Please select Share</option>
                            <?php foreach ($shares as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Action<span class="required">*</span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <ul class="donate-now">
                            <li>
                                <input type="radio" id="buy" name="action" value="B" checked=""/>
                                <label for="buy" id="buy_label">BUY</label>
                            </li>
                            <li>
                                <input type="radio" id="sell" name="action" value="S"/>
                                <label for="sell" id="sell_label">SELL</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Qty <span class="required">*</span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="number" name="qty" id="qty" required="required" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Price <span class="required">*</span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="number" name="price" id="price" required="required" class="form-control" step="any">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Date <span class="required">*</span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" class="form-control datepicker" name="action_date" id="action_date" required="required">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?php echo form_open(base_url(), array("id" => "investment_edit_form", "class" => "form-horizontal")); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Investment</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Share</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <div class="share_name"></div>
                        <input type="hidden" name="edit_share_id" id="edit_share_id">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Action<span class="required">*</span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <ul class="donate-now">
                            <li>
                                <input type="radio" id="buy_edit" name="action_edit" value="B" checked=""/>
                                <label for="buy" id="buy_label_edit">BUY</label>
                            </li>
                            <li>
                                <input type="radio" id="sell_edit" name="action_edit" value="S"/>
                                <label for="sell" id="sell_label_edit">SELL</label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Qty <span class="required">*</span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="number" name="qty_edit" id="qty_edit" required="required" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Price <span class="required">*</span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="number" name="price_edit" id="price_edit" required="required" class="form-control" step="any">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Date <span class="required">*</span></label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <input type="text" class="form-control datepicker" name="action_date_edit" id="action_date_edit" required="required">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#total_stock_valuation').html($('#total_valuation').val());
        $('.datepicker').datepicker({
            dateFormat: 'dd/mm/yy',
            firstDay: 1
        }).datepicker("setDate", new Date());
        $('.history-btn').on('click', function () {
            $('#history_tr_' + $(this).data('rowid')).toggle('show');
        });
    });
    function open_create_modal(action, share_id) {
        $('#share_id').val(share_id);
        if (action == 'B') {
            $("#buy").prop("checked", true);
        } else {
            $("#sell").prop("checked", true);
        }
        $('.modal-create').modal('show');
    }
    function edit_history_row(share_id, share_name, investment_id, action, qty, price, date) {
        var share_id = share_id;
        var share_name = share_name;
        var investment_id = investment_id;
        var action = action;
        var qty = qty;
        var price = price;
        var date = date;
        $('#edit_share_id').val(share_id);
        $('.share_name').html(share_name);
        if (action == 'B') {
            $("#buy_edit").prop("checked", true);
        } else {
            $("#sell_edit").prop("checked", true);
        }
        $('#qty_edit').val(qty);
        $('#price_edit').val(price);
        $('#action_date_edit').val(date);
        $("#investment_edit_form").attr("action", "<?= base_url('investments/edit/' . $client_id . '/') ?>" + investment_id);
        $('.modal-edit').modal('show');
    }
</script>
<style type="text/css">
    th.ui-datepicker-week-end,
    td.ui-datepicker-week-end {
        display: none;
    }
    .share_name{
        color: black;
        font-size: 16px;
        font-weight: bold;
        padding-top: 5px;
    }
</style>