<script>
  setTimeout(function() {
  location.reload();
  }, 600000);
</script>

<?php 
use src\Classes\CardOff\CardOff as CardOff;
use src\Classes\Meta\Meta as Meta;
use src\Classes\CardOnline\CardOnline as CardOnline;
use src\Classes\Plan\Plan as Plan;
use src\Classes\FlightPlan\FlightPlan as FlightPlan;

$geography = 'GRJ';

$meta = new Meta($pdo, $geography);
$plan = new Plan($pdo, $geography);
$cardOff = new CardOff($pdo, $geography);
$cardOn = new CardOnline($pdo, $plan->getTotalPlan());

?>     
      <div class="tile_count shadow bg-write" style="background-color: #F8F8FF;">
        <div class="container-fluid">
            <div class="text-left" id="last-att">
               <strong style="color:black;">Consolidado matriz</strong> - <strong id="last-att">Atualizado em: <t id="last-date-sharepoint"></t></strong>
            </div><br/>
            <div class="row">
              <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-sign-in"></i> Total de entradas</span>
                <div class="count" id="count"><?= $cardOff->getTotalRepairs() ?></div>
                <?php if ($meta->getEntryMeta() > $cardOff->getTotalRepairsPercent()): ?>
                  <strong><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?= $cardOff->getTotalRepairsPercent() ?> </i>Percentual</span></strong>
                <?php else: ?>
                  <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?= $cardOff->getTotalRepairsPercent() ?> </i>Percentual</span></strong>
                <?php endif; ?><br/>
                <span class="count_bottom"><i class="fa fa-check-circle-o" ></i><strong> <?= $meta->getEntryMeta(); ?></strong> - Meta</span>
              </div>

              <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-warning"></i> Repetidos</span>
                <div class="count" id="count"><?=$cardOff->getTotalRepeated() ?></div>
                <?php if ($meta->getRepeatedMeta() > $cardOff->getTotalRepeatedPercent()): ?>
                  <strong><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?= $cardOff->getTotalRepeatedPercent() ?></i> Percentual</span></strong>
                <?php else: ?>
                  <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?= $cardOff->getTotalRepeatedPercent() ?></i> Percentual</span></strong>
                <?php endif; ?>
                <br/>
                <span class="count_bottom"><i class="fa fa-check-circle-o" ></i><strong> <?= $meta->getRepeatedMeta(); ?></strong> - Meta</span>
              </div>

              <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-check-square-o"></i> No prazo</span>
                <div class="count" id="count"><?= $cardOff->getTotalOnTime() ?></div>
                <?php if ($meta->getOnTimeMeta() < $cardOff->getTotalOnTimePercent()): ?>
                  <strong><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?= $cardOff->getTotalOnTimePercent() ?> </i> Percentual</span></strong>
                <?php else: ?>
                  <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?= $cardOff->getTotalOnTimePercent() ?> </i> Percentual</span></strong>
                <?php endif; ?>
                <br/>
                <span class="count_bottom"><i class="fa fa-check-circle-o" ></i><strong> <?= $meta->getOnTimeMeta(); ?></strong> - Meta</span>
              </div>

              <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-clock-o"></i> TMR</span>
                <div class="count" id="count"><?= $cardOff->getTotalTmrPercent() ?></div>
                <?php if ($meta->getTmrMeta() < $cardOff->getTotalOnTimePercent()): ?>
                  <strong><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?= $cardOff->getTotalTmrPercent() ?> </i> Total</span></strong>
                <?php else: ?>
                  <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?= $cardOff->getTotalTmrPercent() ?> </i> Total</span></strong>
                <?php endif; ?>
                <br/>
                <span class="count_bottom"><i class="fa fa-check-circle-o" ></i><strong> <?= $meta->getTmrMeta(); ?></strong> - Meta</span>
              </div>

              <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-warning"></i> Falhas massivas</span>
                <div class="count" id="count"><?= $cardOff->getTotalMassiveFailures() ?></div>
                <span class="count_bottom"><i class="red"><i class=""></i> </i> Total acumulado</span>
              </div>

              <div class="col-md-2 col-sm-4  tile_stats_count">
                <span class="count_top"><i class="fa fa-area-chart"></i> PLanta mensal</span>
                <div class="count" id="count"><?= $plan->getTotalPlan() ?></div>
                <span class="count_bottom"><i class="green"><i class=""></i> </i> Total GRJ </span>
              </div>
            </div>
          </div>
        </div>
                

      <div class="tile_count shadow bg-write" style="background-color: #F8F8FF;">
        <div class="container-fluid">
            <div class="text-left" id="last-att">
                <strong style="color:black;">Reparos online</strong> - <strong id="last-att">Ultima atualização: <t id="last-date"></t></strong>
            </div><br/>
            <div class="row">
                  
            <div class="col-md-3 col-sm-4 tile_stats_count">
              <span class="count_top bg"><i class="fa fa-warning"></i> Reparos encerrados (Atual)</span>
              <div class="count" id="bd_corr"><?= $cardOn->getTotalRepairsFinallyR1AndR2()?></div>
              <strong><span class="count_bottom" id="bdcorr_now"><?= $cardOn->bdCorrNow() ?> </span> - Encerrados hoje</strong><br/>
            <?php if($cardOn->getTotalPercentFinally() > $meta->getEntryMeta()): ?>
              <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"><?= $cardOn->getTotalPercentFinally() ?></i>Percentual</span></strong><br/>
            <?php else: ?>
              <strong><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?= $cardOn->getTotalPercentFinally() ?></i> Percentual</span></strong><br/>
            <?php endif; ?>
            <?php if($cardOn->getProjectionV2() < $meta->getEntryMeta()): ?>
              <strong><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?= $cardOn->getProjectionV2() ?> </i>Projeção</span></strong>
            <?php else: ?>
              <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?= $cardOn->getProjectionV2() ?> </i>Projeção</span></strong>
            <?php endif; ?>
            <br/>
            <span class="count_bottom"><i class="fa fa-check-circle-o" ></i><strong> <?= $meta->getEntryMeta(); ?></strong> - Meta</span>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
              <span class="count_top bg"><i class="fa fa-warning"></i> Repetidos</span>
            <?php if($cardOn->getPercentRepeated() > $meta->getRepeatedMeta()): ?>
              <div class="count" id="bd_rep"><?= $cardOn->getTotalRepairsRepeated() ?></div>
              <strong><span class="count_bottom" id="bdcorr_now"><?= $cardOn->bdCorrRepeatedNow() ?> </span> - Repetidos hoje</strong><br/>
              <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?= $cardOn->getPercentRepeated() ?></i> Percentual</span></strong><br/>
              <span class="count_bottom"><i class="fa fa-check-circle-o"></i><strong> <?= $meta->getRepeatedMeta(); ?></strong> - Meta</span>
            <?php else: ?>
              <div class="count" id="bd_rep"><?= $cardOn->getTotalRepairsRepeated() ?></div>
              <strong><span class="count_bottom" id="bdcorr_now"><?= $cardOn->bdCorrRepeatedNow() ?> </span> - Repetidos hoje</strong><br/>
              <strong><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?= $cardOn->getPercentRepeated() ?></i> Percentual</span></strong><br/>
              <span class="count_bottom"><i class="fa fa-check-circle-o"></i><strong> <?= $meta->getRepeatedMeta(); ?></strong> - Meta</span>
              <?php endif; ?>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
              <span class="count_top bg "><i class="fa fa-check-square-o"></i> No prazo</span>
            <?php if($cardOn->getPercentOnTime() < $meta->getOnTimeMeta() AND $cardOn->getPercentOnTime() != 100): //gambi?>
              <div class="count" id="bd_ontime"><?= $cardOn->getTotalRepairsOnTime() ?></div>
              <strong><span class="count_bottom" id="bdcorr_now"><?= $cardOn->bdCorrOnTimeNow() ?> </span> - No Prazo hoje</strong><br/>
              <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?= $cardOn->getPercentOnTime() ?></i> Percentual </span></strong><br/>
              <span class="count_bottom"><i class="fa fa-check-circle-o" ></i><strong> <?= $meta->getOnTimeMeta(); ?></strong> - Meta</span>
            <?php else: ?>
              <div class="count" id="bd_ontime"><?= $cardOn->getTotalRepairsOnTime() ?></div>
              <strong><span class="count_bottom" id="bdcorr_now"><?= $cardOn->bdCorrOnTimeNow() ?> </span> - No Prazo hoje</strong><br/>
              <strong><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?= $cardOn->getPercentOnTime() ?></i> Percentual </span></strong><br/>
              <span class="count_bottom"><i class="fa fa-check-circle-o" ></i><strong> <?= $meta->getOnTimeMeta(); ?></strong> - Meta</span>
              <?php endif; ?>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
              <span class="count_top bg red"><i class="fa fa-warning"></i> Reparos abertos</span>
              <div class="count" id="bd_on"><?= $cardOn->getTotalRepairsOnline(); ?></div>
              <span class="count_bottom"><i class="red"></i><strong>Tempo real <i class="fa fa-clock-o"></i></strong></span>
            </div>
          </div>    
        </div>
    </div>


    <div class="container">
      <div class="card-header" style=" border:1px dotted; border-color: #3f5165;background-color: #498eec;">
        <div class="card-header-title font-size-lg  font-weight-normal" style="color:white;"> Visão analítica de indicadores </div>
      </div>
      <span  class="meta_supervisoes" scrollamount=0 style="font-family: lighter; margin-left: 300px; font-size: 11pt;">Metas -- 
          Entrada <i class="fa fa-check-circle-o"></i><strong> (4,75%)</strong>
       |  Repetidos <i class="fa fa-check-circle-o"></i><strong> (21,00%)</strong> 
       |  Prazo <i class="fa fa-check-circle-o"></i><strong> (96,00%)</strong></span>
      
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Entrantes</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Repetidos</a>
              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">No Prazo</a>
            </div>
          </nav>
    
          
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

              <div class="table-responsive">
                <table class="align-middle text-truncate mb-0 table table-borderless table-hover">
                <thead>
                        <tr>
                          <th class="text-center" style="font-weight: lighter; color:#44688f;">Supervisor</th>
                          <th class="text-left" style="font-weight: lighter; color:#44688f;">Supervisão</th>
                          <th class="text-center" style="font-weight: lighter; color:#44688f;">Planta</th>
                          <th class="text-center" style="font-weight: lighter; color:#44688f;">Entradas</th>
                          <th class="text-center" style="font-weight: lighter; color:#44688f;">% Entrada</th>
                          <th class="text-center" style="font-weight: lighter; color:#44688f;">% Regional</th>
                          <th class="text-left" style="font-weight: lighter; color:#44688f;">Progresso</th>
                          <th class="text-left" style="font-weight: lighter; color:#44688f;">Projeção</th>
                          <th class="text-left" style="font-weight: lighter; color:#44688f;">% Projeção</th>
                          <th class="text-left" style="font-weight: lighter; color:#44688f;">Ação</th>
                        </tr>
                      </thead>


                <?php
                  $flightPlan = new FlightPlan($pdo);
                  $arraySupervisor = [];
                  foreach ($flightPlan->arraySupervision() as $value) {
                    
                    $planSupervision = $value['total'];
                    $supervision = $value['supervisao'];
                    $supervisor = $value['supervisor'];

                    if ($supervisor == 'MALU') {
                      $supervisor = 'MARIA LÚCIA';
                    }

                    
                    if (in_array($supervisor, $arraySupervisor)) {
                      $supervisor = "";
                    }
                    
                    $arraySupervisor = array($supervisor);

                    $totalEntrySupervision = $flightPlan->totalEntry($supervision);

                    $percentEntrySupervision = ($totalEntrySupervision / $planSupervision) * 100;
                    $percentEntrySupervision = substr($percentEntrySupervision,0,5)."%";

                    $planSupervisionTotal = $flightPlan->planSupervisionTotal();
                    
                    $regionalPercent = ($totalEntrySupervision / $planSupervisionTotal) * 100;
                    $regionalPercent = substr($regionalPercent,0,5)."%";
                    
                    $challenge = 0.0475;

                    $repairLimit = $planSupervision * $challenge;
                    $repairLimit = ceil($repairLimit);

                    $currentPercent = ($totalEntrySupervision / $repairLimit) * 100;
                    $currentPercent = substr($currentPercent,0,5)."%";
                    $currentPercentNumber = $currentPercent;

                    $projectionSupervision = ceil($totalEntrySupervision / date('j'));
                    
                    $array =  $flightPlan->projectionSupervision($totalEntrySupervision, $planSupervision);
                    $projectionSupervisionPercent = $array[0];
                    $projectionSupervisionEntry = $array[1];


                    if ($currentPercent <= 55) {
                      $bgProgress = "bg-success";
                    } elseif($currentPercent > 55 AND $currentPercent <= 100) {
                      $bgProgress = "bg-warning";
                    } elseif($currentPercent > 100) {
                      $bgProgress = "bg-danger";
                    }

                    if ($projectionSupervisionPercent > ($challenge * 100)) {
                      $colorProjectionPercent = "red";
                    } else {
                      $colorProjectionPercent = "green";
                    }

                    ?>
                    
                    <tr>
                    <tbody style="border:1px dotted; border-color: cornflowerblue;" >
                        <tr>
                          <?php if($supervisor != ""):?>
                          <td class="text-left" style="width: 10px;">
                            <img alt="" class="rounded-circle" src="../assets/images/supervisores/<?=$supervisor?>.jpg" width="30" height="30" style="margin-top: -7px; margin-bottom: -7px;">
                            <a href="#" style="font-size: 10px; border-bottom: 1px dotted;"><?=$supervisor?></a>
                          </td>
                          <?php else:?>
                            <td>
                            </td>
                            <?php endif; ?>
                          <td class="text-left">
                          <a style="color: #0275b8; font-weight: lighter; font-size: 10px ;border-bottom: 1px dotted;" href="#" ><?= substr($supervision,11,25) ?></a>
                          </td>
                          <td class="text-center">
                            <a href="./" style="border-bottom: 1px dotted;"><?= $planSupervision ?></a>
                          </td>
                          <td class="text-center">
                            <div class="badge badge-primary" style="font-size: 11px; background-color: #498eec;" id="entrantes_total">
                                <?= $totalEntrySupervision ?>
                                <div class="entrantes_total_div">  
                                  <!-- Analitcs / More Info -->
                                </div>
                            </div>
                          </td>
                          <td class="text-center">
                            <span class="pr- opacity-6" style="color: #3f5165; border-bottom:1px dotted;">
                              <i class="fa fa-business-time"></i><?= $percentEntrySupervision ?> 
                            </span> 
                          </td>
                          <td class="text-center">
                            <span class="pr- opacity-6" style="color: #3f5165; border-bottom: 1px dotted;">
                              <i class="fa fa-business-time"></i><?= $regionalPercent ?> 
                            </span> 
                          </td>

                          <td class="text-center">
                            <div class="widget-content p-0">
                              <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                  <div class="widget-content-left pr-2">
                                    <div class="widget-numbers fsize-1 text-secondary text-left"><?= $currentPercentNumber ?></div>
                                  </div>
                                  <div class="widget-content-right w-100" style="max-width: 100%;" >
                                    <div class="progress-bar-xs progress" style="height: 8px; background-color: #ddd;">
                                      <div  class="progress-bar-striped progress-bar-animated <?= $bgProgress ?>" role="progressbar" style="width: <?= $currentPercent ?>;"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>

                          <td class="text-center">
                            <span class="pr- opacity-6" style="color: #3f5165; border-bottom: 1px dotted;">
                              <i class="fa fa-business-time"></i><?= $projectionSupervisionEntry ?> 
                            </span> 
                          </td>
                          <td class="text-center">
                            <span class="pr- opacity-6" style="color: <?= $colorProjectionPercent ?>; border-bottom: 1px dotted;">
                              <i class="fa fa-business-time"></i><?= $projectionSupervisionPercent."%" ?> 
                            </span>   
                          </td>
                          
                          <td class="text-left">
                            <a style="font-size: 12px;" class="badge badge-primary" data-toggle="collapse" href="#collapseExample<?=$supervision?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                              Analítico
                            </a>
                          </td>
                        </tr>
                      </tbody>
                      <tr>
                      <tbody>
                        <tr class="collapse" id="collapseExample<?=$supervision?>">
                          <td>

                          </td>
                        </tr>
                      </tbody>
                  <?php
                  }
                  ?>
                      </tr>
                    </tr>
                  </table>
                </div>
            </div>
          


            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <div class="table-responsive">
                <table class="align-middle text-truncate mb-0 table table-borderless table-hover">
                <thead>
            <tr>
              <th class="text-center" style="font-weight: lighter;">Supervisor</th>
              <th class="text-left" style="font-weight: lighter;">Supervisão</th>
              <th class="text-center" style="font-weight: lighter;">Planta</th>
              <th class="text-center" style="font-weight: lighter;">Entrantes</th>
              <th class="text-center" style="font-weight: lighter;">Repetidos</th>
              <th class="text-center" style="font-weight: lighter;">% Repetidos</th>
              <th class="text-left" style="font-weight: lighter;">Progresso</th>
              <th class="text-center" style="font-weight: lighter;">% Regional</th>
              <!--<th class="text-left" style="font-weight: lighter;">Projeção</th>
              <th class="text-left" style="font-weight: lighter;">% Projeção</th>-->
              <th class="text-left" style="font-weight: lighter;">Ação</th>
            </tr>
          </thead>


              <?php
                $flightPlan = new FlightPlan($pdo);

                $arraySupervisor = [];
                foreach ($flightPlan->arraySupervision() as $value) {

                  $planSupervision = $value['total'];
                  $supervision = $value['supervisao'];
                  $supervisor = $value['supervisor'];

                  if ($supervisor == 'MALU') {
                    $supervisor = 'MARIA LÚCIA';
                  }


                  if (in_array($supervisor, $arraySupervisor)) {
                    $supervisor = "";
                  }

                  $arraySupervisor = array($supervisor);
                  $totalEntrySupervision = $flightPlan->totalEntry($supervision);
                  
                  $totalRepeatedSupervision = $flightPlan->repeatedRepairs($supervision);
                  
                  //$percentEntrySupervision = ($totalEntrySupervision / $planSupervision) * 100;
                  //$percentEntrySupervision = substr($percentEntrySupervision,0,5)."%";

                  $percentRepeatedSupervision = ($totalRepeatedSupervision / $totalEntrySupervision) * 100;
                  $percentRepeatedSupervision = substr($percentRepeatedSupervision,0,5);
                  if($percentRepeatedSupervision == 'NAN') { //gambi
                    $percentRepeatedSupervision = 0;
                  }

                  $planSupervisionTotal = $flightPlan->planSupervisionTotal();
                  
                  $regionalPercentRepeated = ($totalRepeatedSupervision / $cardOn->getTotalRepairsFinallyR1AndR2()) * 100;
                  $regionalPercentRepeated = substr($regionalPercentRepeated,0,4)."%";
                  
                  /*$challengeEntry = 0.0489;

                  $repairLimit = $planSupervision * $challengeEntry;
                  $repairLimit = ceil($repairLimit);*/

                  $challengeRepeated = 0.2100;

                  $challengeRepeated = $challengeRepeated * 100;
                  $progressRepeated = ($percentRepeatedSupervision / $challengeRepeated * 100);
                  $progressRepeated = substr($progressRepeated,0,6)."%";
                  $progressRepeatedNumber = $progressRepeated;
                

                  /*$repairLimitRepeated = $totalEntrySupervision * $challengeRepeated;
                  $repairLimitRepeated = ceil($repairLimitRepeated);
                  echo $repairLimitRepeated;*/
                  
                  /*$currentPercentRepeated = ($totalRepeatedSupervision / $repairLimitRepeated) * 100;
                  $currentPercentRepeated = substr($currentPercentRepeated,0,5)."%";
                  $currentPercentRepeatedNumber = $currentPercentRepeated;*/

                  /*$projectionSupervisionRepeated = ceil($totalRepeatedSupervision / date('j'));
                  
                  $array =  $flightPlan->projectionSupervision($totalEntrySupervision, $planSupervision);
                  $projectionSupervisionPercent = $array[0];
                  $projectionSupervisionEntry = $array[1];*/


                  if ($progressRepeated <= 55) {
                    $bgProgress = "bg-success";
                  } elseif($progressRepeated > 55 AND $progressRepeated <= 100) {
                    $bgProgress = "bg-warning";
                  } elseif($progressRepeated > 100) {
                    $bgProgress = "bg-danger";
                  }

                  /*if ($projectionSupervisionPercent > ($challenge * 100)) {
                    $colorProjectionPercent = "red";
                  } else {
                    $colorProjectionPercent = "green";
                  }*/

                  if ($percentRepeatedSupervision > $challengeRepeated) {
                    $colorRepeatedPercent = "red";
                  } else {
                    $colorRepeatedPercent = 'green';
                  }


                  ?>
                  
                  <tr>
                  <tbody style="border:1px dotted; border-color: cornflowerblue;" >
                  <tr>
                          <?php if($supervisor != ""):?>
                          <td class="text-left" style="width: 10px;">
                            <img alt="" class="rounded-circle" src="../assets/images/supervisores/<?=$supervisor?>.jpg" width="30" height="30" style="margin-top: -7px;margin-bottom: -7px;">
                            <a href="#" style="font-size: 10px; border-bottom: 1px dotted;"><?=$supervisor?></a>
                          </td>
                          <?php else:?>
                            <td>
                            </td>
                            <?php endif; ?>
                        <td class="text-left">
                        <a style="color: #0275b8; font-weight: lighter; font-size: 10px ;border-bottom: 1px dotted;" href="#" ><?= substr($supervision,11,25) ?></a>
                        </td>
                        <td class="text-center">
                          <a href="./" style="border-bottom: 1px dotted;"><?= $planSupervision ?></a>
                        </td>
                        <td class="text-center">
                          <div class="badge badge-primary" style="font-size: 11px; background-color: #498eec" id="entrantes_total">
                              <?= $totalEntrySupervision ?>
                          </div>
                        </td>
                        <td class="text-center">
                          <div class="badge badge-secondary" style="font-size: 11px;" id="entrantes_total">
                              <?= $totalRepeatedSupervision ?>
                              <div class="entrantes_total_div">  
                                <!-- Analitcs / More Info -->
                              </div>
                          </div>
                        </td>
                        <td class="text-center">
                          <span class="pr- opacity-6" style="color: <?= $colorRepeatedPercent ?>; border-bottom:1px dotted;">
                            <i class="fa fa-business-time"></i><?= $percentRepeatedSupervision."%" ?> 
                          </span> 
                        </td>
                        <td class="text-center">
                          <div class="widget-content p-0">
                            <div class="widget-content-outer">
                              <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2">
                                  <div class="widget-numbers fsize-1 text-secondary text-left"><?= $progressRepeatedNumber ?></div>
                                </div>
                                <div class="widget-content-right w-100" style="max-width: 100%;" >
                                  <div class="progress-bar-xs progress" style="height: 8px; background-color: #ddd;">
                                    <div  class="progress-bar-striped progress-bar-animated <?= $bgProgress ?>" role="progressbar" style="width: <?= $progressRepeated ?>;"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td class="text-center">
                          <span class="pr- opacity-6" style="color: #3f5165; border-bottom: 1px dotted;">
                            <i class="fa fa-business-time"></i><?= $regionalPercentRepeated ?> 
                          </span> 
                        </td>


                        <!--<td class="text-center">
                          <span class="pr- opacity-6" style="color: #3f5165; border-bottom: 1px dotted;">
                            <i class="fa fa-business-time"></i>valor
                          </span> 
                        </td>
                        <td class="text-center">
                          <span class="pr- opacity-6" style="color: #3f5165;; border-bottom: 1px dotted;">
                            <i class="fa fa-business-time"></i>valor
                          </span>   
                        </td>-->
                        
                        <td class="text-left">
                          <a style="font-size: 12px;" class="badge badge-primary" data-toggle="collapse" href="#collapseExample<?=$supervision?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Analítico
                          </a>
                        </td>
                      </tr>
                    </tbody>
                    <tr>
                    <tbody>
                      <tr class="collapse" id="collapseExample<?=$supervision?>">
                        <td>

                        </td>
                      </tr>
                    </tbody>
                <?php
                }
                ?>
                    </tr>
                  </tr>
                </table>
              </div>
              </div>



            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        
          <div class="table-responsive">
            <table class="align-middle text-truncate mb-0 table table-borderless table-hover">

          <thead>
            <tr>
              <th class="text-center" style="font-weight: lighter;">Supervisor</th>
              <th class="text-left" style="font-weight: lighter;">Supervisão</th>
              <th class="text-center" style="font-weight: lighter;">Planta</th>
              <th class="text-center" style="font-weight: lighter;">Entrantes</th>
              <th class="text-center" style="font-weight: lighter;">No prazo</th>
              <th class="text-left" style="font-weight: lighter;">Progresso</th>
              <th class="text-center" style="font-weight: lighter;">% Regional</th>
              <!--<th class="text-left" style="font-weight: lighter;">Projeção</th>
              <th class="text-left" style="font-weight: lighter;">% Projeção</th>-->
              <th class="text-left" style="font-weight: lighter;">Ação</th>
            </tr>
          </thead>


                <?php
                  $flightPlan = new FlightPlan($pdo);
                  $arraySupervisor = [];
                  foreach ($flightPlan->arraySupervision() as $value) {

                    $planSupervision = $value['total'];
                    $supervision = $value['supervisao'];
                    $supervisor = $value['supervisor'];

                    if ($supervisor == 'MALU') {
                      $supervisor = 'MARIA LÚCIA';
                    }


                    if (in_array($supervisor, $arraySupervisor)) {
                      $supervisor = "";
                    }
  
                    $arraySupervisor = array($supervisor);

                    $totalEntrySupervision = $flightPlan->totalEntry($supervision);
                    
                    $totalOnTimeSupervision = $flightPlan->onTimeRepairs($supervision);

                    $percentOnTimeSupervision = ($totalOnTimeSupervision / $totalEntrySupervision) * 100;
                    $percentOnTimeSupervision = substr($percentOnTimeSupervision,0,5);

                    $planSupervisionTotal = $flightPlan->planSupervisionTotal();
                    
                    $regionalPercentOnTime = ($totalOnTimeSupervision / $cardOn->getTotalRepairsFinallyR1AndR2()) * 100;
                    $regionalPercentOnTime = substr($regionalPercentOnTime,0,4)."%";
                  

                    $challengeOnTime = 0.9600;

                    $challengeOnTime = $challengeOnTime * 100;
                    $progressOnTime = ($totalOnTimeSupervision / $totalEntrySupervision) * 100;
                    $progressOnTime = substr($progressOnTime,0,5);
                    if ($progressOnTime == 'NAN') {
                      $progressOnTime = 100;
                    }
                    $progressOnTime = $progressOnTime."%";
                    $progressOnTimeNumber = $progressOnTime;
                  


                    if ($progressOnTime >= 97) {
                      $bgProgress = "bg-success";
                    } elseif($progressOnTime < 97 AND $progressOnTime >= 96) {
                      $bgProgress = "bg-warning";
                    } elseif($progressOnTime < 96) {
                      $bgProgress = "bg-danger";
                    }

                    if ($percentOnTimeSupervision < $challengeOnTime) {
                      $colorOnTimePercent = "red";
                    } else {
                      $colorOnTimePercent = '#3f5165';
                    }


                    ?>
                    
                    <tr>
                    <tbody style="border:1px dotted; border-color: cornflowerblue;" >
                    <tr>
                          <?php if($supervisor != ""):?>
                          <td class="text-left" style="width: 10px;">
                            <img alt="" class="rounded-circle" src="../assets/images/supervisores/<?=$supervisor?>.jpg" width="30" height="30" style="margin-top: -7px;margin-bottom: -7px;">
                            <a href="#" style="font-size: 10px; border-bottom: 1px dotted;"><?=$supervisor?></a>
                          </td>
                          <?php else:?>
                            <td>
                            </td>
                            <?php endif; ?>
                          <td class="text-left">
                          <a style="color: #0275b8; font-weight: lighter; font-size: 10px ;border-bottom: 1px dotted;" href="#" ><?= substr($supervision,11,25) ?></a>
                          </td>
                          <td class="text-center">
                            <a href="./" style="border-bottom: 1px dotted;"><?= $planSupervision ?></a>
                          </td>
                          <td class="text-center">
                            <div class="badge badge-primary" style="font-size: 11px;" id="entrantes_total">
                                <?= $totalEntrySupervision ?>
                            </div>
                          </td>
                          <td class="text-center">
                            <div class="badge badge-secondary" style="font-size: 11px;" id="entrantes_total">
                                <?= $totalOnTimeSupervision ?>
                                <div class="entrantes_total_div">  
                                  <!-- Analitcs / More Info  -->
                                </div>
                            </div>
                          </td>

                          <td class="text-center">
                            <div class="widget-content p-0">
                              <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                  <div class="widget-content-left pr-2">
                                    <div class="widget-numbers fsize-1 text-secondary text-left"><?= $progressOnTimeNumber ?></div>
                                  </div>
                                  <div class="widget-content-right w-100" style="max-width: 100%;" >
                                    <div class="progress-bar-xs progress" style="height: 8px; background-color: #ddd;">
                                      <div  class="progress-bar-striped progress-bar-animated <?= $bgProgress ?>" role="progressbar" style="width: <?= $progressOnTime ?>;"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="text-center">
                            <span class="pr- opacity-6" style="color: #3f5165; border-bottom: 1px dotted;">
                              <i class="fa fa-business-time"></i><?= $regionalPercentOnTime ?> 
                            </span> 
                          </td>


                          <!--<td class="text-center">
                            <span class="pr- opacity-6" style="color: #3f5165; border-bottom: 1px dotted;">
                              <i class="fa fa-business-time"></i>valor
                            </span> 
                          </td>
                          <td class="text-center">
                            <span class="pr- opacity-6" style="color: #3f5165;; border-bottom: 1px dotted;">
                              <i class="fa fa-business-time"></i>valor
                            </span>   
                          </td>-->
                          
                          <td class="text-left">
                            <a style="font-size: 12px;" class="badge badge-primary" data-toggle="collapse" href="#collapseExample<?=$supervision?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                              Analítico
                            </a>
                          </td>
                        </tr>
                      </tbody>
                      <tr>
                      <tbody>
                        <tr class="collapse" id="collapseExample<?=$supervision?>">
                          <td>
                          
                          </td>
                        </tr>
                      </tbody>
                  <?php
                  }
                  ?>
                      </tr>
                    </tr>
                  </table>
                </div>
            </div>
          </div>
    </div>
    <br/>

   
  
