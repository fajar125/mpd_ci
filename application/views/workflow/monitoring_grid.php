<div class="col-md-12">
      <div class="portlet light bordered" id="form_wizard_1">
             <div class="portlet-title">
                 <div class="caption">
                     <i class=" icon-layers font-red"></i>
                     <span class="caption-subject font-red bold uppercase"> Monitoring
                     </span>
                 </div>
             </div>
             <div class="table-responsive" style="max-height: 400px;overflow-y: scroll;">
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
                        <?php
                        
                        for ($i=1; $i < count($datamon); $i++) { 

                            echo "<tr>";
                            $exp = explode('|', $datamon[$i]->rs_output);

                            for ($j=1; $j < count($exp); $j++) { 
                                echo "<td>".$exp[$j]."</td>";
                            }
                            
                            echo "</tr>";


                        }

                      ?>
                    </tbody>
                </table>
            </div>
         </div>
    </div>
</div>

