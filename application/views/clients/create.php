<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><?= $page_title; ?></h2>
                <a href="<?= base_url('clients/index') ?>" class="btn btn-primary pull-right"> Back to Listing</a>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php echo form_open(base_url('clients/create'), array("id" => "client_form", "class" => "form-horizontal")); ?>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">First Name <span class="required">*</span></label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" name="first_name" id="first_name" required="required" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Middle Name</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" name="middle_name" id="middle_name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Last Name <span class="required">*</span></label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" name="last_name" id="last_name" required="required" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Client Number <span class="required">*</span></label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" name="username" id="username" required="required" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Total Investment <span class="required">*</span></label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="number" name="total_investment" id="total_investment" required="required" class="form-control" step="any">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="<?= base_url('clients/index') ?>" class="btn btn-primary">Cancel</a>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>