<?php 
require "../template/template_full.php";
  if($user->permissions('ADMIN')) {
  
  } else {
    ?><script type="text/javascript">window.location.href="403.html";</script><?php
  }




      ?>
      <!-- main -->
      <div class="right_col" role="main">
        <div class="">
          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Controle de usuários<small></small></h2>

                  <span class="horario" id="data-hora"></span>
                  <ul class="nav navbar-right panel_toolbox">
                    <li>
                      <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li>
                      <a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                      <div class="col-md-12">

                      <div class="card-header" style=" border:1px dotted; border-color: #3f5165;background-color: #498eec;">
                        <div class="card-header-title font-size-lg  font-weight-normal" style="color:white;"> Controle de usuários </div>
                      </div>
                
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="table-responsive">
                      <table class="align-middle text-truncate mb-0 table table-borderless table-hover">
                            <thead>
                              <tr>
                                <th class="text-center" style="font-weight: lighter; color:#44688f;">Nome</th>
                                <th class="text-left" style="font-weight: lighter; color:#44688f;">Email</th>
                                <th class="text-center" style="font-weight: lighter; color:#44688f;">Permissões</th>
                                <th class="text-center" style="font-weight: lighter; color:#44688f;">Status</th>
                                <th class="text-left" style="font-weight: lighter; color:#44688f;">Ações</th>
                              </tr>
                            </thead>
                            <?php foreach($user->getAllUsers() as $userData): ?>
                              <tbody style="border:1px dotted; border-color: cornflowerblue;" >

                              <?php 
                              if ($userData['status_'] == 0) {
                                $userData['status_'] = "Inativo";
                              } elseif($userData['status_'] ==1) {
                                $userData['status_'] = "Ativo";
                              }
                              ?>

                                <tr>
                                  <td><?=$userData['nome']?></td>
                                  <td><?=$userData['email']?></td>
                                  <td class="text-center"><?=$userData['permissoes']?></td>
                                  <td class="text-center"><?=$userData['status_']?></td>

                                  <td>
                                    <a href="active-user.php?id=<?=$userData['id']?>"><img src="../assets/images/v.png" alt="" width="25px" height="23px"></a>
                                    <a href="disable-user.php?id=<?=$userData['id']?>"><img src="../assets/images/x.png" alt="" width="25px" height="23px"></a>
                                  </td>
                                </tr>
                              </tbody>
                          <?php endforeach; ?>
                        </table>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- main -->



<?php require "../template/template_footer.php";?>



