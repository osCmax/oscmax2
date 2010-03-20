<?php
  if ($_GET["date1"] == "" OR $_GET["date2"] == "") {
    if (isset($_SESSION['date1']) && isset($_SESSION['date2'])) {
      $date1 = $_SESSION['date1'];
      $date2 = $_SESSION['date2'];
    } else {
      $date1 = date('Y-m-d');#2003-09-07%
      $date2 = date('Y-m-d');#2003-09-07%
    }
  } else {
    if (preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/', $_GET['date1'])) {
      $_SESSION['date1'] = $_GET["date1"];
      $date1 = $_SESSION['date1'];
    } else {
      //$_SESSION['date1'] = date('Y-m-d'); #2003-09-07%
      $date1 = $_SESSION['date1'];
    }
  
    if ((preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})/', $_GET['date2'])) {
      $_SESSION['date2'] = $_GET["date2"];
      $date2 = $_SESSION['date2'];
    } else {
      //$_SESSION['date2'] = date('Y-m-d'); #2003-09-07%
      $date2 = $_SESSION['date2'];
    }
  }
  $cal1maxdate = date("Y") . "," . date("m") . "," . date("d");
?>