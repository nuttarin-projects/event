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

<footer id="footer" class="bg-dpu-third rounded--2xl text-gray-900 pt-10 pb-6 text-center md:text-left">
  <div class="max-w-7xl mx-auto px-4 space-y-8">

    <!-- Top: Contact + CTA Button -->
    <div class="flex flex-col md:flex-row justify-between gap-8">

      <!-- Contact Info -->
      <div class="md:w-2/3">
        <h3 class="text-xl md:text-2xl font-semibold text-dpu-primary mb-2">Demo University</h3>
        <p class="mb-3 text-md md:text-lg leading-relaxed">
          888/8-8 Lorem ipsum dolor sit amet, <span class="block lg:inline-block">consectetur adipisicing elit 10800</span>
        </p>
        <div class="space-y-2 text-md md:text-lg">
          <p>
            <i class="bi bi-telephone-outbound mr-2 text-dpu-primary"></i>
            <a href="" class="hover:underline">02-888-8888</a>
          </p>
          <p>
            <i class="bi bi-envelope-paper mr-2 text-dpu-primary"></i>
            <a href="" class="hover:underline">demo@gmail.ac.th</a>
          </p>
        </div>
      </div>

      <!-- CTA Button -->
      <div class="md:w-1/3 flex items-start md:items-center justify-center md:justify-end">
        <a href="/onlineadmission/<?=$remark?>" target="_blank"
          class="btn-primary sm:min-w-[380px] md:min-w-[250px]">
          สมัครเรียนเลย <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>

    <!-- Middle: Social -->
    <div class="flex justify-center md:justify-start space-x-4 text-3xl text-dpu-primary">
      <a href="https://www.facebook.com/" target="_blank" title="Facebook" class="hover:text-gray-900">
        <i class="bi bi-facebook"></i>
      </a>
      <a href="https://www.instagram.com/" target="_blank" title="Instagram" class="hover:text-gray-900">
        <i class="bi bi-instagram"></i>
      </a>
      <a href="https://lin.ee/" target="_blank" title="Line" class="hover:text-gray-900">
        <i class="bi bi-line"></i>
      </a>
      <a href="https://www.youtube.com/c/" target="_blank" title="Youtube" class="hover:text-gray-900">
        <i class="bi bi-youtube"></i>
      </a>
      <a href="https://www.tiktok.com/" target="_blank" title="Tiktok" class="hover:text-gray-900">
        <i class="bi bi-tiktok"></i>
      </a>
    </div>

    <!-- Bottom: Copyright -->
    <div class="text-center text-sm text-gray-500 pt-4">
      Copyright © <?= date('Y') ?> Demo University. All rights reserved.
    </div>

  </div>
</footer>
<div id="scrollToTop"
  class="fixed bottom-[8rem] right-6 z-20 hidden 
      w-12 aspect-square rounded-full 
      bg-[#DAFA03] text-[#691bff]
      flex items-center justify-center shadow-xl
      hover:bg-blue-500 hover:scale-110 hover:shadow-xl hover:text-white
      transition-all duration-300 cursor-pointer group">
  <i class="fas fa-arrow-up text-lg lg:group-hover:rotate-180 transition-transform duration-500"></i>
</div>