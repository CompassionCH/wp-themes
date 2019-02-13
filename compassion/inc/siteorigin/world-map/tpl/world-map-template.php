<?php

  switch($instance['map_type']) {
    case 'zentren':
      include('template-zentren.php');
      break;
    case 'projekte':
      include('template-projekte.php');
      break;
    case 'partner_projekte_combi':
      include('template-partner_projekte_combi.php');
      break;
    default:
      include('template-default.php');
  }



?>
