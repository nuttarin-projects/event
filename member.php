<?php
require_once "classes/Constants.php";
require_once "classes/Manager.php";  
$rand = Constants::$rand;

$logout = isset($_GET["logout"])? $_GET["logout"]:0;
if($logout==1)
{
    setcookie("u_id", "", time()-86400);
    setcookie("v_id", "", time()-86400);
    setcookie("remark", "", time()-86400);
}

$param['v_id']=isset($_COOKIE['v_id'])? $_COOKIE['v_id']:"";
$param['u_id']=isset($_COOKIE['u_id'])? $_COOKIE['u_id']:"";
$param['remark']=isset($_COOKIE['remark'])? $_COOKIE['remark'] : "";

if($param['v_id']=='' || $param['v_id']==null) {
    header( "location: register.php".$param['remark'] );
    exit(0);
} else {
    $rsUser=Manager::getUser($param['v_id'],$param['u_id']);
    $rsCheckin=Manager::getCheckInList($param);

}

//echo nl2br(print_r($rsUser,true));
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <!-- all header tag -->
  <?php include 'layouts-header-tag.php'; ?>
  <!-- all header tag end -->
</head>

<!-- bg-gray-100 -->
<body class="bg-dpu-fifth font-kanit text-gray-900">
  <!-- <body class="bg-gray-100 font-kanit text-gray-900"> -->

  <!-- Google Tag Manager -->
  <?php include 'layouts-header-tag-inbody.php'; ?>
  <!-- Google Tag Manager End -->

  <!-- header -->
  <?php //include 'header-other.php'; ?>

  <!-- main -->
  <main role="main">
    <!-- Sticky Navigation Menu -->
    <!-- top-[62px] -->
    <div id="sticky-nav" class="fixed top-[0px] left-0 right-0 z-40" data-aos="fade-down" data-aos-delay="0">
      <div class="flex justify-center gap-2 sm:gap-4 md:gap-6 py-2 px-0 md:px-0 bg-dpu-fifth">
        <a href="#section-promotion" class="transition-transform md:hover:scale-105">
          <img src="assets/images/menu_member_promotion.png?ver=<?= $rand ?>" alt="menu member promotion" class="h-18 sm:h-20 md:h-24 w-auto">
        </a>
        <a href="#section-activity" class="transition-transform md:hover:scale-105">
          <img src="assets/images/menu_member_activity.png?ver=<?= $rand ?>" alt="menu member activity" class="h-18 sm:h-20 md:h-24 w-auto">
        </a>
      </div>
    </div>
    <!-- Spacer for fixed navbar -->
    <div class="h-[80px] md:h-[100px]"></div>
    <br />
    <br />
    <br />

    <section id="member-detail" data-aos="fade-up" data-aos-delay="300" class="w-full py-8 mb-0">
      <div class="max-w-7xl mx-auto px-4">

        <!-- QR Code Area -->
        <div class="max-w-[260px] mx-auto mb-6 rounded-[15px] p-4 bg-white">
          <!-- QR Code -->
          <div id="qrcode" class="p-0">
          </div>
        </div>

        <!-- Member ID -->
        <div class="text-center">
          <h1 class="text-3xl md:text-3xl font-semibold text-gray-900 mb-6">
            <?=$rsUser['v_id'] ?>
          </h1>
        </div>

        <!-- Thank You Message -->
        <div id="thankyou-message" class="text-center py-2 px-4">
          <h2 class="text-xl md:text-2xl font-medium text-gray-900">
            <span id="name-member">
              น้อง <? $name = explode(" ", $rsUser['fullname']);
                  echo $name[0]; ?><!-- โชว์แค่ชื่อ ไม่ต้องใส่นามสกุล -->
            </span>
            <span class="inline-block mt-2">
              กรุณาใช้ QR CODE นี้
            </span>
            <br />
            <span class="inline-block mt-2">
              ในการร่วมกิจกรรม
            </span>
          </h2>
        </div>

      </div>
    </section>


    <!-- Page Sections -->
    <section id="section-promotion" class="mb-12">
      <div class="max-w-7xl mx-auto px-4">
        <div data-aos="fade-up" data-aos-delay="400" class="mt-4">
          <div class="flex justify-center">
              <a class="img_hover" href="" target="_blank">
                <img src="assets/images/banner_promotion_normal.png?ver=<?= $rand ?>" alt="banner promotion" class="w-full max-w-lg">
              </a>
          </div>
        </div>
      </div>
    </section>


    <section id="section-activity" class="mb-6" data-aos="fade-up" data-aos-delay="500">
      <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-center">
          <div class="w-full sm:max-w-[495px] px-2 md:px-0">
            <div class="text-center mb-[0px]">
              <img src="assets/images/member_title_checkin.png?ver=<?= $rand ?>" class="mx-auto w-full" alt="member title checkin">
            </div>
            <?php if(!empty($rsCheckin)){
            for($i=0;$i<count($rsCheckin);$i++){?>
            <!-- checkin แล้ว -->
            <div class="bg-white py-6 px-4 mb-2">
              <h2 class="text-lg md:text-xl font-semibold text-gray-900 mb-0">
                <?=$rsCheckin[$i]['station_name']?>
              </h2>
              <h3 class="flex text-gray-900 text-md md:text-lg">
                <span>กิจกรรม:</span>&nbsp;
                <span><?=$rsCheckin[$i]['description']?></span>
              </h3>
            </div>
            <?php }
            } else {?>
              <!-- ยังไม่ได้ checkin -->
              <div class="bg-white text-center py-6 px-4 mb-2">
                <h2 class="font-semibold text-xl md:text-2xl text-gray-900">คุณยังไม่เข้าร่วมกิจกรรม</h2>
              </div>
            <?php }?>
          </div>
        </div>
      </div>
    </section>

    <br />
    <br />
    <br />

    <?php include 'footer.php'; ?>
  </main>

  <?php include 'layouts-footer-tag-inbody.php'; ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

  <script>
    var qrcode = new QRCode("qrcode", { width : 230, height : 230});

    function makeCode (elText) {		
      qrcode.makeCode(elText);
    }
    const v_id="<?=$param['v_id']?>" ;
    const u_id="<?=$param['u_id']?>" ;
    makeCode(v_id+"_"+u_id); 

    $(function() {
      $('#sticky-nav a[href^="#"]').on('click', function(e) {
        e.preventDefault();

        const targetId = $(this).attr('href');
        const targetEl = $(targetId);

        if (targetEl.length) {
          $('html, body').animate({
            scrollTop: targetEl.offset().top - 120 // 120 offset สำหรับเมนู fixed
          }, 600); // 600ms ความเร็ว animation
        }
      });
    });

  </script>
</body>

</html>