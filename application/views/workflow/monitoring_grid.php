<?php
  // print_r($datamon);
  // exit;

  for ($i=1; $i < count($datamon); $i++) { 
      print_r($datamon[$i]->rs_output);
      exit;


  }

?>
<div class="col-md-12">
      <div class="portlet light bordered" id="form_wizard_1">
             <div class="portlet-title">
                 <div class="caption">
                     <i class=" icon-layers font-red"></i>
                     <span class="caption-subject font-red bold uppercase"> Monitoring
                     </span>
                 </div>
             </div>
             <div class="table-responsive">
                <table  id="grid-basic" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <?php 
                            
                            for ($i=1; $i <count($header); $i++) {
                              echo "<td>".$header[$i]."</td>";
                            }
                        ?>
                      </tr>
                    </thead>
                    <tbody>                      

                    </tbody>
                </table>
            </div>
         </div>
    </div>
</div>

