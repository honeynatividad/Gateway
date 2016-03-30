<div class="col-md-9">
  
    <div class="panel panel-philcare">
        <div class="panel-heading">
            <div class="pull-right main-title">ECU Result</div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                   
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="ecu">APE Result</p>
                </div>
                <div class="col-md-12">
                    <p>Date Availed: <?php echo $medinfo->DateOfAvailment ?></p>
                </div>                
                <div class="col-md-12">
                    <p>Patient Code:<?php echo $medinfo->PatientCode ?></p>
                </div>
                <div class="col-md-12">
                    <p>Place of Service:<?php echo $medinfo->PlaceOfService ?></p>
                </div>
                <div class="col-md-12">                     
                    <p class="bg-success"><?php echo $medinfo->APEResult ?></p>
                </div>
                <div class="col-md-12">
                    <p class="ecu">ECG</p>
                </div>
                <div class="col-md-12">
                    <p ><?php echo $medinfo->ECG ?></p>
                </div>
                <div class="col-md-12">
                    <p class="ecu">Ultrasound</p>
                </div>
                <div class="col-md-12">
                    <p ><?php echo $medinfo->UltraSound ?></p>
                </div>
                <div class="col-md-12">
                    <p class="ecu">Urinalysis</p>
                </div>
                <div class="col-md-12">
                    <p ><?php echo $medinfo->Urinalysis ?></p>
                </div>
                <div class="col-md-12">
                    <p class="ecu">Xray</p>
                </div>
                <div class="col-md-12">
                    <p ><?php echo $medinfo->Xray ?></p>
                </div>
            </div>
        </div>
    </div>   
</div>