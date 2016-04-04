<?php
$wbauer="&#9817;";
$wturm="&#9814;";
$wspringer="&#9816;";
$wlaeufer="&#9815;";
$wkoenigin="&#9813;";
$wkoenig="&#9812;";

$bbauer="&#9823;";
$bturm="&#9820;";
$bspringer="&#9822;";
$blaeufer="&#9821;";
$bkoenigin="&#9819;";
$bkoenig="&#9818;";
$leer = '&nbsp;';

    $schachbrett = array(
              array('/', 'A', 'B', 'C', 'D', 'E','F', 'G', 'H', '/'),
              array(8,$bturm,$bspringer,$blaeufer,$bkoenigin,$bkoenig,$blaeufer,$bspringer,$bturm,8),
              array(7,$bbauer,$bbauer,$bbauer,$bbauer,$bbauer,$bbauer,$bbauer,$bbauer,7),
              array(6,$leer,$leer,$leer,$leer,$leer,$leer,$leer,$leer,6),
              array(5,$leer,$leer,$leer,$leer,$leer,$leer,$leer,$leer,5),
              array(4,$leer,$leer,$leer,$leer,$leer,$leer,$leer,$leer,4),
              array(3,$leer,$leer,$leer,$leer,$leer,$leer,$leer,$leer,3),
              array(2,$wbauer,$wbauer,$wbauer,$wbauer,$wbauer,$wbauer,$wbauer,$wbauer,2),
              array(1,$wturm,$wspringer,$wlaeufer,$wkoenigin,$wkoenig,$wlaeufer,$wspringer,$wturm,1),
              array('/', 'A', 'B', 'C', 'D', 'E','F', 'G', 'H', '/')
    );
?>
