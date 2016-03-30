<article id="post-<?php the_ID() ?>" <?php post_class() ?>>
</article>


    
<script src="http://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>
    <!--<div class="philcontainer">
    
    </div>		-->	
  <style>
.ndropdown option {
    text-transform: uppercase;
}

#availm > option {
    text-transform: uppercase;
}
.lloading {
    color: #ffffff;
}
.list-group {
    margin-top: -15px;
}
.list-group-item {
    background-color: #0d7542;
    border: medium none;
    display: block;
    margin-bottom: -1px;
	border-radius: 0 !important;
    padding: 10px 15px;
    position: relative;
}
</style>  

<div class="panel panel-philcare">
   
    <div class="panel-body">
        <div >
            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="panel-body">
                    <ul class="list-group row">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-6 col-lg-5">
                                    <div class="form-group">
                                        <div class="metro">
                                            <input class="form-control" type="text" id="cert_no" placeholder="CERTIFICATE NO">
                                        </div>     
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 --><div class="col-sm-6 col-lg-5">
                                    <div class="form-group" id="cert">
                                        <div class="metro">
                                            <input class="form-control" type="text" id="cert_name" placeholder="FULL NAME" disabled>
                                        </div>     
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                                <div class="col-sm-6 col-lg-5">
                                    <div class="form-group">
                                        <div class="metro">
                                            <select class="form-control" id="availm">
                                                <option value="" class="label">TYPE OF AVAILMENT</option>
                                                <option value="IP">Inpatient/Hospitalization Care</option>
                                                <option value="OP">Outpatient Care</option>
                                                <option value="ER">Emergency care</option>
                                                <option value="DIALYSIS">Dialysis</option>
                                                <option value="PHYSICAL%THERAPY">Physical Therapy</option>

                                            </select>
                                        </div>   
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                                <div class="col-sm-6 col-lg-5">
                                            
                                    <div class="form-group">
                                        <div class="metro">
                                            <select class="form-control" id="area_name" data-settings='{"cutOff":10}'>
                                                <option value="0">PROVINCE/METRO MANILA/ALL</option>
                                                
                                                <?php 
                                                $providers = array();
                                                $providers = getCities();


                                                foreach($providers as $p){
                                                       
                                                    $namespaces = $providers->getNameSpaces(true);
                                                    $list = $p->children($namespaces['a']);
                                                    foreach($list as $li){
                                                        $prov = $li->children($namespaces['a']);
                                                    ?>
                                                    <option value="<?php echo urlencode($prov->City);?>"><?php echo $prov->City;?></option>
                                                    <?php }

                                                    }?>
                                            </select>
                                        </div>  
                                    </div><!-- /input-group -->
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-6 col-lg-5">
                                    <div class="form-group">
                                        <div class="">
                                            <input class="form-control" type="text" id="loc_name" placeholder="HOSPITAL/CLINIC NAME">
                                        </div>     
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                                <div class="col-sm-6 col-lg-5">
                                    <div class="form-group" id="distrct_rep">
                                        <div class="metro">
                                            <select class="districtvalue form-control" id="districtvalue" name="district">
                                                <option value="0" >DISTRICT/CITY</option>   
                                                <option value="0" ></option>
                                            </select>
                                        </div>   
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                                <input type="hidden" id="certno" name="certno" value="<?php echo $userid ?>">
                                <div class="col-sm-12 col-lg-2">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default-orange" type="button" id="startfinding">
                                            SEARCH
                                        </button>
                                    </span>
                                </div>

                            </div><!-- /.row -->						
                        </li>
                    </ul>
                    <div class="loaderphil" id="thisanchor">
                        
                        <div class="row"><img src="<?php bloginfo('template_directory'); ?>/img/ajax-loader.gif ?>"></div>
                    </div>   
                            
                    <div class="">
                        <p>
                            To find a provider:<br />Step 1: Type your Certificate No.<br /> Step 2: Choose TYPE OF AVAILMENT<br />Step 2: Click SEARCH<br/>You may do an advanced search by choosing a location or specifying the clinic or hospital name. 
                            For further assistance, please call our Customer Service Hotline: +63 (2) 462-1800 or for outside Metro Manila (Toll Free for PLDT): 1-800-1888-3230.
                        </p>            
                    </div>  		  
                            
                    <div class="row gmap"></div>
                    <div class="loadcontent"></div>  
                </div>
            </div>
        </div>
    </div>
</div>