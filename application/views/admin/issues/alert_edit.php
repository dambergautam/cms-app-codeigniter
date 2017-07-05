

<h3 class="table-caption">Edit Alerts</h3>
<hr/>
<form class="form-add-alerts" name="frm_add_alerts" method="post" action="<?php echo base_url(); ?>index.php/admin/process_edit_alerts">

    <div class="row">
        <div class="col-md-4">Classification</div>
        <div class="col-md-8"><input type="text" id="classification" value="<?php echo $edit_data->classification; ?>" name="classification" class="form-control" placeholder="classification" required autofocus></div>
    </div>

    <div class="row">
        <div class="col-md-4">Resource</div>
        <div class="col-md-8"><input type="text" id="resource" value="<?php echo $edit_data->resource; ?>" name="resource" class="form-control" placeholder="resource"></div>
    </div>

    <div class="row">
        <div class="col-md-4">Parameter</div>
        <div class="col-md-8"><input type="text" id="parameter" value="<?php echo $edit_data->parameter; ?>" name="parameter" class="form-control" placeholder="parameter"></div>
    </div>

    <div class="row">
        <div class="col-md-4">Method</div>
        <div class="col-md-8"><input type="text" id="method" name="method" value="<?php echo $edit_data->method; ?>" class="form-control" placeholder="method"></div>
    </div>

    <div class="row">
        <div class="col-md-4">Risk</div>
        <div class="col-md-8">
            <select class="form-control" name="risk" required>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
                <option value="unknown">Unknown</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">Flag</div>
        <div class="col-md-8">
            <select class="form-control" name="flag" required>
                <option selected value="open">Open</option>
                <option <?php echo ($edit_data->flag == "solved") ? "selected" : ""; ?> value="solved">Solved</option>
                <option <?php echo ($edit_data->flag == "unable") ? "selected" : ""; ?> value="unable">Won't Fix</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">Description</div>
        <div class="col-md-8"> <textarea name="description" rows="7" class="form-control"><?php echo $edit_data->description; ?></textarea></div>
    </div>

    <div class="row">
        <div class="col-md-4">Remediation</div>
        <div class="col-md-8"> <textarea name="remediation" rows="7" class="form-control"><?php echo $edit_data->remediation; ?></textarea></div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>">
            <button style="width: 48%; float: right; margin-top: 5px;" class="btn btn-lg btn-primary btn-block" type="submit">Edit</button>
            <a style="width: 50%; float: left;" class="btn btn-lg btn-primary btn-block" href="<?php echo base_url(); ?>index.php/admin">Cancel</a>
        </div>
    </div>


</form>
