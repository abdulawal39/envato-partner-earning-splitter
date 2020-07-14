<?php
require_once('class.envato-partner-earning-splitter.php');
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($_POST['item_id'])){
  $item_id      = htmlspecialchars($_REQUEST['item_id']);
  $month        = htmlspecialchars($_REQUEST['month']);
  $percentage   = htmlspecialchars($_POST['percentage']);
  $site         = htmlspecialchars($_POST['site']);
  $datetime     = new DateTime($month);
  $start_date   = $datetime->format('Y-m-01');
  $end_date     = $datetime->format('Y-m-t');
  $get_statement = EnvatoEarningSplitter::getStatement($item_id, $start_date, $end_date, $site );
  if( $get_statement &&  $get_statement > 0 ){
    $total_earnings           = $get_statement;
    $percentage_earning       = ($total_earnings * $percentage) / 100;

    echo '<strong>Total Earning of item: '. $item_id .' in '.$month.' : </strong>'. $total_earnings .'<br />';
    echo '<strong>'. $percentage .'% Earning of item: '. $item_id .' in '.$month.' : </strong>'. $percentage_earning .'<br />';
  } else {
    echo 'Sorry, something went wrong. please try again after a few hours if the error continues.';
  }
}