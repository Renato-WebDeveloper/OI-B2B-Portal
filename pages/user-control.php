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
            <h2>UPLOAD - CSV META<small></small></h2>

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
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">

                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Permissão</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php foreach($user->getAllUsers() as $userData): ?>
                              <?php
                              
                              if ($userData['status_'] == 0) {
                                $status = "Desativado";
                              } else {
                                $status = "Ativo";
                              }
                                
                              ?>
                              <tr>
                                  <td><?= $userData['id'] ?></td>
                                  <td><?= $userData['nome'] ?></td>
                                  <td><?= $userData['email'] ?></td>
                                  <td><?= $userData['permissoes'] ?></td>
                                  <td><?= $status ?></td>
                                  <td>
                                    <a href="#"><img src="../assets/images/edit.png" alt="" width="25px" height="23px"></a> 
                                    <a href="delete-user.php?id=<?=$userData['id']?>"><img src="../assets/images/delete.png" alt="" width="25px" height="23px"> 
                                    <a href="active-user.php?id=<?=$userData['id']?>"><img src="../assets/images/v.png" alt="" width="25px" height="23px"> 
                                    <a href="disable-user.php?id=<?=$userData['id']?>"><img src="../assets/images/x.png" alt="" width="25px" height="23px">
                                  </td>
                              </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
              </div>
            </div><br/>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- main -->



<?php require "../template/template_footer.php";?>



