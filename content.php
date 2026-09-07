<?php
require_once "classes/Constants.php";
require_once "classes/Manager.php";
$rand = Constants::$rand;
$eventId=Constants::$lastOph;
$isOphDay=Manager::isOphDay($eventId,Constants::$OPH_DATE[$eventId]);// 1 is oph day
?>

<!-- ก่อนวันงาน + วันงาน -->
<section class="py-12 rounded-2xl bg-dpu-third" data-aos="fade-up" data-aos-delay="300" style="display: block;">
  <div class="max-w-7xl mx-auto">
<?php if ($isOphDay == '0') {?>
    <!-- ก่อนวันงาน -->
    <!-- ปุ่มลงทะเบียน pre register -->
    <div class="flex justify-center mb-6">
      <div class="w-11/12 md:w-6/12 lg:w-5/12 xl:w-4/12 text-center">
        <a href="register.php">
          <img src="assets/images/pre_register.png?ver=<?= $rand ?>" alt="btn register" class="w-full max-w-md mx-auto transition hover:scale-105">
        </a>
      </div>
  </div>      
<?php } else if ($isOphDay == '1') {?>
    <!-- วันงาน -->
    <div class="mb-6">
      <!-- ปุ่มลงทะเบียน register -->
      <div class="flex justify-center mb-0">
        <div class="w-11/12 md:w-6/12 lg:w-5/12 xl:w-4/12 text-center">
          <a href="register.php">
            <img src="assets/images/btn_register.png?ver=<?= $rand ?>" alt="btn register" class="w-full max-w-sm mx-auto transition hover:scale-105">
          </a>
        </div>
      </div>
      <!-- ข้อความ "หรือ" -->
      <div class="flex justify-center">
        <div class="relative w-8/12 sm:w-6/12 md:w-4/12 lg:w-3/12 xl:w-3/12 text-center my-6">
          <h3 class="text-gray-500 text-sm font-medium relative inline-block px-4 bg-dpu-third z-10">
            <span class="text-xl font-semiblod text-gray-900">หรือ</span>
          </h3>
          <div class="absolute inset-0 top-1/2 border-t border-gray-500 z-0"></div>
        </div>
      </div>
      <!-- ปุ่มเข้าสู่ระบบ -->
      <div class="flex justify-center">
        <div class="w-11/12 md:w-6/12 lg:w-5/12 xl:w-4/12 text-center">
          <a href="sign-in.php">
            <img src="assets/images/btn_signin.png?ver=<?= $rand ?>" alt="btn signin" class="w-full max-w-sm mx-auto transition hover:scale-105">
          </a>
        </div>
      </div>
    </div>    
<?php } ?>
    
  </div>
</section>


  <!-- หลังวันงาน -->
  <?php if ($isOphDay == '2'){
    include 'after-event.php';
  } ?>

<?php if ($isOphDay != '2'){?>
<!-- หลังวันงาน ไม่มี content -->
<div style="display: block;">

  <section id="text_intro" class="py-16 rounded-2xl bg-white relative overflow-hidden" data-aos="fade-up">
    <!-- Title -->
    <div class="flex justify-center">
      <div class="w-11/12 sm:w-4/5 md:w-3/5 lg:w-2/5 text-center">
        <h1 class="text-3xl md:text-5xl font-semibold text-dpu-primary leading-snug mb-6">Lorem <span class="inline-block">ipsum dolor sit amet</span></h1>
      </div>
    </div>

    <!-- List -->
    <div class="max-w-6xl mx-auto px-4">
      <ul class="grid grid-cols-2 md:grid-cols-2 gap-x-12 gap-y-10 text-center">
        <li class="flex flex-col items-center gap-4">
          <div class="w-16 md:w-20">
            <img src="assets/images/icon_01.png?ver=<?= $rand ?>" alt="icon" class="w-full">
          </div>
          <div class="text-base md:text-2xl leading-relaxed font-kanit">
            <span class="text-dpu-primary font-semibold">Lorem ipsum dolor sit amet</span><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </div>
        </li>
        <li class="flex flex-col items-center gap-4">
          <div class="w-16 md:w-20">
            <img src="assets/images/icon_02.png?ver=<?= $rand ?>" alt="icon" class="w-full">
          </div>
          <div class="text-base md:text-2xl leading-relaxed font-kanit">
            <span class="text-dpu-primary font-semibold">Lorem ipsum dolor sit amet</span><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </div>
        </li>
        <li class="flex flex-col items-center gap-4">
          <div class="w-16 md:w-20">
            <img src="assets/images/icon_03.png?ver=<?= $rand ?>" alt="icon" class="w-full">
          </div>
          <div class="text-base md:text-2xl leading-relaxed font-kanit">
            <span class="text-dpu-primary font-semibold">Lorem ipsum dolor sit amet</span><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </div>
        </li>
        <li class="flex flex-col items-center gap-4">
          <div class="w-16 md:w-20">
            <img src="assets/images/icon_04.png?ver=<?= $rand ?>" alt="icon" class="w-full">
          </div>
          <div class="text-base md:text-2xl leading-relaxed font-kanit">
            <span class="text-dpu-primary font-semibold">Lorem ipsum dolor sit amet</span><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </div>
        </li>
        <li class="flex flex-col items-center gap-4">
          <div class="w-16 md:w-20">
            <img src="assets/images/icon_05.png?ver=<?= $rand ?>" alt="icon" class="w-full">
          </div>
          <div class="text-base md:text-2xl leading-relaxed font-kanit">
            <span class="text-dpu-primary font-semibold">Lorem ipsum dolor sit amet</span><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </div>
        </li>
        <li class="flex flex-col items-center gap-4">
          <div class="w-16 md:w-20">
            <img src="assets/images/icon_06.png?ver=<?= $rand ?>" alt="icon" class="w-full">
          </div>
          <div class="text-base md:text-2xl leading-relaxed font-kanit">
            <span class="text-dpu-primary font-semibold">Lorem ipsum dolor sit amet</span><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </div>
        </li>
        <li class="flex flex-col items-center gap-4 col-span-2">
          <div class="w-16 md:w-20">
            <img src="assets/images/icon_07.png?ver=<?= $rand ?>" alt="icon" class="w-full">
          </div>
          <div class="text-base md:text-2xl leading-relaxed font-kanit">
            <span class="text-dpu-primary font-semibold">Lorem ipsum dolor sit amet</span><br>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </div>
        </li>
      </ul>
    </div>

    <!-- Floating Decorations -->
    <div class="hidden md:block absolute left-0 bottom-8 animate-fadeInUp" data-aos="fade-up-right" data-aos-delay="100">
      <div class="fw_ani_1">
        <img src="assets/images/floats_l1.png?ver=<?= $rand ?>" alt="L1" class="w-44">
      </div>
    </div>
    <div class="hidden md:block absolute right-0 top-20 animate-fadeInUp" data-aos="fade-up-left" data-aos-delay="300">
      <div class="fw_ani_2">
        <img src="assets/images/floats_r1.png?ver=<?= $rand ?>" alt="R2" class="w-44">
      </div>
    </div>
  </section>
</div>
<?php } ?>