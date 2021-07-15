<?php

//Export the database and output the status to the page
$command='-f bin/magento setup:upgrade';
exec($command,$output,$worked);
switch($worked){
  case 0:
    echo 'finish';
    break;
  case 1:
    print_r($output) ;
    break;
}
