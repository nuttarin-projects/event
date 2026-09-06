<?php
require_once "classes/Constants.php";
$rand = Constants::$rand;
$utm_source = isset($_GET["utm_source"]) ? $_GET["utm_source"] :'';
$utm_medium = isset($_GET["utm_medium"]) ? $_GET["utm_medium"] :'';
$utm_campaign = isset($_GET["utm_campaign"]) ? $_GET["utm_campaign"] :'';

$remark ='';

if($utm_source !='')
{
    $remark = '?1=1&utm_source='.$utm_source.'&utm_medium='.$utm_medium.'&utm_campaign='.$utm_campaign; 
}
?>

<header class="sticky top-0 z-50 bg-white shadow-md rounded-b-2xl -mb-8 md:-mb-4" data-aos="fade-in" data-aos-delay="0">
  <div class="max-w-7xl mx-auto flex items-center px-4 py-3">
    <a href="index.php">
      <div class="hidden md:block">
        <img src="assets/images/logo-default-slim.png?ver=<?= $rand ?>" alt="" class="h-10">
      </div>
      <div class="block md:hidden">
        <img src="assets/images/logo-default-slim.png?ver=<?= $rand ?>" alt="" class="h-10">
      </div>
    </a>
    <nav class="flex md:flex gap-6 ml-auto text-base sm:text-xl">
      <a href="/onlineadmission/<?=$remark?>" target="_blank" class="text-dpu-primary hover:underline text-xl md:text-2xl font-semibold">
        สมัครเรียน <i class="bi bi-arrow-right"></i>
      </a>
    </nav>
  </div>
</header>