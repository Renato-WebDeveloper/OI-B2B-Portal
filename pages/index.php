<?php require "../template/template_full.php"; ?>

<!-- main -->
<div class="right_col" role="main">
	<div class="">
</br></br>
		<?php include '../partials/cards.php';?> <!-- Card de indicadores -->
		<div class="container-fluid"  id="gif_chart">
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Indicadores Online -<small>Em desenvolvimento</small></h2>
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
                       <img class="gif_chart " src="../assets/images/chart.gif">
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
	</div>
</div>

<?php require "../template/template_footer.php" ?>