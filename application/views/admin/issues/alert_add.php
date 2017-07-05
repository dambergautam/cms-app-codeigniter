

<h3 class="table-caption">Add Alerts</h3>
<hr/>
<form class="form-add-alerts" name="frm_add_alerts" method="post" action="<?php echo base_url(); ?>index.php/admin/process_add_alerts">

    <div class="row">
        <div class="col-md-4">Classification</div>
        <div class="col-md-8"><input type="text" id="classification" name="classification" class="form-control" placeholder="classification" required autofocus></div>
    </div>

    <div class="row">
        <div class="col-md-4">Resource</div>
        <div class="col-md-8"><input type="text" id="resource" name="resource" class="form-control" placeholder="resource"></div>
    </div>

    <div class="row">
        <div class="col-md-4">Parameter</div>
        <div class="col-md-8"><input type="text" id="parameter" name="parameter" class="form-control" placeholder="parameter"></div>
    </div>

    <div class="row">
        <div class="col-md-4">Method</div>
        <div class="col-md-8"><input type="text" id="method" name="method" class="form-control" placeholder="method"></div>
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
                <option value="solved">Solved</option>
                <option value="unable">Won't Fix</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">Description</div>
        <div class="col-md-8"> <textarea name="description" rows="7" class="form-control"></textarea></div>
    </div>

    <div class="row">
        <div class="col-md-4">Remediation</div>
        <div class="col-md-8"> <textarea name="remediation" rows="7" class="form-control"></textarea></div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <button style="width: 48%; float: right; margin-top: 5px;" class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
            <a style="width: 50%; float: left;" class="btn btn-lg btn-primary btn-block" href="<?php echo base_url(); ?>index.php/admin">Cancel</a>
        </div>
    </div>


</form>
