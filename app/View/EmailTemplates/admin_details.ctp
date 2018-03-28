<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"><h3>Email Template Details</h3></div>
        <div class="col-md-8 top_space">

        </div>
    </div>
    <br/>
</div>

    <table class="table table-hover email_template_tbl">
        <tr>
            <td>Template Name</td>
            <td>:</td>
            <td><?php echo $template['EmailTemplate']['template_name'] ?></td>
        </tr>

        <tr>
            <td>Url</td>
            <td>:</td>
            <td><a href="<?php echo $template['EmailTemplate']['url'] ?>"><?php echo $template['EmailTemplate']['url'] ?></a></td>
        </tr>

        <tr>
            <td>Subject</td>
            <td>:</td>
            <td><?php echo $template['EmailTemplate']['subject'] ?></td>
        </tr>

        <tr>
            <td>Message</td>
            <td>:</td>
            <td><?php echo $template['EmailTemplate']['message'] ?></td>
        </tr>

        <tr>
            <td>Special Note</td>
            <td>:</td>
            <td><?php echo $template['EmailTemplate']['special_note'] ?></td>
        </tr>

    </table>