<?php 
use src\Classes\CardOff\CardOff as CardOff;
use src\Classes\Meta\Meta as Meta;
use src\Classes\CardOnline\CardOnline as CardOnline;
use src\Classes\Plan\Plan as Plan;

$geography = 'GRJ';

$meta = new Meta($pdo, $geography);
$plan = new Plan($pdo, $geography);
$cardOff = new CardOff($pdo, $geography);
$cardOn = new CardOnline($pdo, $plan->getTotalPlan());

//echo $cardOn->testBdCorrNow();
?>     
        <div class="tile_count shadow mb bg-write" style="background-color: #F8F8FF;">
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

        <div class="tile_count shadow mb  bg-write" style="background-color: #F8F8FF;">
        <div class="container-fluid">
            <div class="text-left" id="last-att">
                <strong style="color:black;">Reparos online</strong> - <strong id="last-att">Ultima atualização: <t id="last-date"></t></strong>
            </div><br/>
            <div class="row">
                  
            <div class="col-md-3 col-sm-4 tile_stats_count">
              <span class="count_top bg"><i class="fa fa-warning"></i> Reparos encerrados (Atual)</span>
              <div class="count" id="bd_corr"><?= $cardOn->getTotalRepairsFinallyR1AndR2()?></div>
              <strong><span class="count_bottom" id="bdcorr_now"><?= $cardOn->testBdCorrNow() ?> </span> - Encerrados hoje</strong><br/>
            <?php if($cardOn->getTotalPercentFinally() > $meta->getEntryMeta()): ?>
              <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"><?= $cardOn->getTotalPercentFinally() ?></i> Percentual</span></strong><br/>
            </div>
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
              <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?= $cardOn->getPercentRepeated() ?></i> Percentual</span></strong><br/>
              <span class="count_bottom"><i class="fa fa-check-circle-o"></i><strong> <?= $meta->getRepeatedMeta(); ?></strong> - Meta</span>
            </div>
            <?php else: ?>
              <div class="count" id="bd_rep"><?= $cardOn->getTotalRepairsRepeated() ?></div>
              <strong><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?= $cardOn->getPercentRepeated() ?></i> Percentual</span></strong><br/>
              <span class="count_bottom"><i class="fa fa-check-circle-o"></i><strong> <?= $meta->getRepeatedMeta(); ?></strong> - Meta</span>
            </div>
            <?php endif; ?>

            <div class="col-md-3 col-sm-4  tile_stats_count">
              <span class="count_top bg "><i class="fa fa-check-square-o"></i> No prazo</span>
            <?php if($cardOn->getPercentOnTime() < $meta->getOnTimeMeta()): ?>
              <div class="count" id="bd_ontime"><?= $cardOn->getTotalRepairsOnTime() ?></div>
              <strong><span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i><?= $cardOn->getPercentOnTime() ?></i> Percentual </span></strong><br/>
              <span class="count_bottom"><i class="fa fa-check-circle-o" ></i><strong> <?= $meta->getOnTimeMeta(); ?></strong> - Meta</span>
            </div>
            <?php else: ?>
              <div class="count" id="bd_ontime"><?= $cardOn->getTotalRepairsOnTime() ?></div>
              <strong><span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i><?= $cardOn->getPercentOnTime() ?></i> Percentual </span></strong><br/>
              <span class="count_bottom"><i class="fa fa-check-circle-o" ></i><strong> <?= $meta->getOnTimeMeta(); ?></strong> - Meta</span>
            </div>
            <?php endif; ?>

            <div class="col-md-3 col-sm-4  tile_stats_count">
              <span class="count_top bg red"><i class="fa fa-warning"></i> Reparos abertos</span>
              <div class="count" id="bd_on"><?= $cardOn->getTotalRepairsOnline(); ?></div>
              <span class="count_bottom"><i class="red"></i><strong>Tempo real <i class="fa fa-clock-o"></i></strong></span>
            </div>
            

          </div>    
        </div>
    </div>

    <script>
      setTimeout(function() {
      location.reload();
      }, 600000);
    </script>
        


