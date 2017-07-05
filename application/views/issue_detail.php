<section class="detailpage">
    <h3>#<?php echo $issue_detail->id; ?></h3>
    <table class="table "> 
        
        <tr> 
            <th>Title</th> <td><?php echo $issue_detail->classification; ?></td>
        </tr>
        <tr>
            <th>URL</th> <td><?php echo $issue_detail->resource; ?></td>
        </tr>
        <tr>
            <th>Parameter</th> <td><?php echo $issue_detail->parameter; ?></td>
        </tr>
        <tr>
            <th>Method</th><td><?php echo $issue_detail->method; ?></td>
        </tr>
        <tr>
            <th>Risk</th> <td><?php echo $issue_detail->risk; ?></td>
        </tr>
        <tr>
            <th>Flag</th> <td><?php echo $issue_detail->flag; ?></td>
        </tr>
        <tr>
            <th>Description</th> <td><?php echo nl2br($issue_detail->description); ?></td>
        </tr>
        <tr>
            <th>Remediation</th> <td><?php echo nl2br($issue_detail->remediation); ?></td>
        </tr>
        <tr>
            <th>Last update</th><td><?php echo $issue_detail->last_update; ?></td>
        </tr>
        

    </table> 

</section>

