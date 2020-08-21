<?php

require "../template/template_full.php";

if($user->permissions('ADMIN')) {

} else {
  ?><script type="text/javascript">window.location.href="403.html";</script><?php
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $user->disableUser($_GET['id']);
    ?><script type="text/javascript">window.location.href="user-control.php";</script><?php
}



?>