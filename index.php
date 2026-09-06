<?php
require_once "classes/Constants.php";
require_once "classes/Manager.php";

$eventId=Constants::$lastOph;
$isOphDay=Manager::isOphDay($eventId,Constants::$OPH_DATE[$eventId]);// 1 is oph day
//echo $isOphDay;

?>
<!DOCTYPE html>
<html lang="th">

<head>
  <!-- all header tag -->
  <?php include 'layouts-header-tag.php'; ?>
  <!-- all header tag end -->
</head>

<body class="bg-gray-100 font-kanit text-gray-900">
  <!-- Google Tag Manager -->
  <?php include 'layouts-header-tag-inbody.php'; ?>
  <!-- Google Tag Manager End -->

  <!-- header -->
  <?php include 'header.php'; ?>

  <!-- main -->
  <main role="main">
    <?php include 'content.php'; ?>
    <?php include 'footer.php'; ?>
  </main>
  <?php include 'layouts-footer-tag-inbody.php'; ?>
</body>

</html>