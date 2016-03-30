<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">
<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">Report</div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                   
                </div>
            </div>
            <div class="row">&nbsp;</div>
            
            <?php if ($this->session->flashdata('msg')) { ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('msg') ?> </div>
            <?php } ?>
            <div class="row">
                <div id="newsfeedlist" class="newsfeedlistclass">
                    
                        <table id="report" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Agreement No</th>
                                    <th>Date Accessed</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <?php                             
                            foreach($login as $l){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $l->agreement_no ?>
                                </td>
                                <td>
                                   <?php 
                                   echo $l->created
                                   ?>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href=<?php echo base_url("reports/login/".$l->agreement_no) ?>>View Report</a>
                                </td>
                               
                             
                            </tr>
                            <?php
                            }
                            ?>
                            
                        </table>
                   
                </div>
            </div>
        </div>
    </div>   
</div>