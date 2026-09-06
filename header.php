<?php
require_once "classes/Constants.php";
$rand = Constants::$rand;
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
      <a href="register.php" class="text-dpu-primary hover:underline">ลงทะเบียน</a>
      <span>|</span>
      <a href="sign-in.php" class="text-dpu-primary hover:underline">เข้าสู่ระบบ</a>
    </nav>
  </div>
</header>

<!-- Hero Section -->
<section class="relative" data-aos="fade-up" data-aos-delay="100"> <!-- mb-6 -->
  <div class="swiper">

    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="hidden md:block">
          <img src="assets/images/herobanner_dt.jpg?ver=<?= $rand ?>" alt="Hero 1" class="w-full rounded-b-2xl">
        </div>
        <div class="block md:hidden">
          <img src="assets/images/herobanner_mb.jpg?ver=<?= $rand ?>" alt="Hero 2" class="w-full rounded-b-2xl">
        </div>
      </div>
    </div>

    <!-- Prev Button -->
    <div class="swiper-button-prev 
                absolute top-1/2 -translate-y-1/2 left-3 z-10 
                bg-white/80 text-dpu-primary 
                hover:bg-dpu-primary hover:text-white 
                p-6 rounded-full shadow-md 
                transition-all duration-300 ease-in-out 
                hover:scale-110 hover:shadow-lg">
      <i class="fas fa-chevron-left text-lg"></i>
    </div>

    <!-- Next Button -->
    <div class="swiper-button-next 
                absolute top-1/2 -translate-y-1/2 right-3 z-10 
                bg-white/80 text-dpu-primary 
                hover:bg-dpu-primary hover:text-white 
                p-6 rounded-full shadow-md 
                transition-all duration-300 ease-in-out 
                hover:scale-110 hover:shadow-lg">
      <i class="fas fa-chevron-right text-lg"></i>
    </div>

  </div>
</section>