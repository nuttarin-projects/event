<?php
require_once "classes/Constants.php";
require_once "classes/Manager.php";

$param['v_id']=isset($_COOKIE['v_id'])? $_COOKIE['v_id']:"";
$param['u_id']=isset($_COOKIE['u_id'])? $_COOKIE['u_id']:"";

$success = isset($_GET['success']) ? $_GET['success'] :0;
$errors = isset($_GET['errors']) ? $_GET['errors'] :0;

$utm_source = isset($_GET["utm_source"]) ? $_GET["utm_source"] :'';
$utm_medium = isset($_GET["utm_medium"]) ? $_GET["utm_medium"] :'';
$utm_campaign = isset($_GET["utm_campaign"]) ? $_GET["utm_campaign"] :'';

$remark ='';

if($utm_source !='')
{
    $remark = '?1=1&utm_source='.$utm_source.'&utm_medium='.$utm_medium.'&utm_campaign='.$utm_campaign; 
}

$eventId=Constants::$lastOph;
$isOphDay=Manager::isOphDay($eventId,Constants::$OPH_DATE[$eventId]);// 1 is oph day

if($param['v_id']!='' || $param['v_id']!=null){
    header( "location: member.php");
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <!-- all header tag -->
    <?php include 'layouts-header-tag.php'; ?>
    <!-- all header tag end -->
</head>

<!-- bg-gray-100 -->

<body class="bg-gray-100 font-kanit text-gray-900">

    <!-- Google Tag Manager -->
    <?php include 'layouts-header-tag-inbody.php'; ?>
    <!-- Google Tag Manager End -->

    <!-- header -->
    <?php include 'header-other.php'; ?>

    <!-- main -->
    <main role="main">
        <br />
        <br />

        <section class="px-4 py-8 md:min-h-[calc(100vh-440px)]" data-aos="fade-up" data-aos-delay="600">
            <div class="max-w-4xl mx-auto bg-dpu-fourth rounded-2xl shadow space-y-6 p-8 md:px-28 lg:px-48 py-16 lg:py-24">

                <!-- Login Form -->
                <form id="loginForm" action="Services.php" method="POST">
                    <!-- novalidate - ปิด popup ของ browser -->
                    <?php if($isOphDay==1){ ?>
                    <div class="text-center mb-8">
                        <a href="register.php<?= $remark ?>" class="btn-primary w-full">ลงทะเบียนเพื่อร่วมกิจกรรม<span class="inline-block">ภายในงาน</span></a>
                        <div class="my-12 border-t border-gray-500 relative">
                            <span class="absolute top-[-0.85rem] left-1/2 transform -translate-x-1/2 bg-dpu-fourth px-4 text-gray-900 text-xl font-medium">หรือ</span>
                        </div>
                    </div>
                    <?php }?>

                    <div class="text-center mb-8">
                        <h2 class="text-3xl md:text-4xl text-gray-900 font-semibold">เข้าสู่ระบบ</h2>
                    </div>

                    <!-- Alert -->
                    <!-- id="info-no-userNoExist"  -->
                    <?php if ($success==0 && $errors==1) { ?>
                    <p class="mb-6 text-gray-900 text-center text-lg md:text-xl px-4 py-3 rounded-2xl">
                        ไม่พบข้อมูลการลงทะเบียน <span class="inline-block"><a href="register.php<?= $remark ?>" class="text-dpu-primary hover:underline">คลิกที่นี่</a> <span class="inline-block">เพื่อลงทะเบียน</span></span>
                    </p>
                    <?php } ?>

                    <div class="border-0">
                        <fieldset class="space-y-4 mt-[0px]">
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-6 pt-[0px]">
                                <input type="hidden" name="action" id="action" value="login">
                                <input type="hidden" name="remark" id="remark" value="<?= $remark ?>"> 
                                <input type="hidden" name="eventId" id="eventId" value="<?= $eventId ?>">
                                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-gray-900 mb-1">อีเมล <span class="text-red-500">*</span></label>
                                        <input type="email" id="email" name="email" placeholder="yourname@email.com"
                                            class="input-custom"
                                            required="" />
                                    </div>
                                    <!-- Tel -->
                                    <div class="mb-6">
                                        <label for="phone" class="block text-gray-900 mb-1">เบอร์โทรศัพท์ <span class="text-red-500">*</span></label>
                                        <input type="text" inputmode="numeric" pattern="[0-9]{10}" id="phone" name="phone"
                                            maxlength="10" placeholder="0912345678"
                                            class="input-custom"
                                            required="" />
                                    </div>
                                </div>
                            </div>
                            <!-- Submit -->
                            <button type="submit" class="btn-secondary w-full">เข้าสู่ระบบ</button>
                        </fieldset>
                    </div>
                </form>

            </div>
        </section>
        <br />
        <br />

        <?php include 'footer.php'; ?>
    </main>
    <?php include 'layouts-footer-tag-inbody.php'; ?>

    <script>

    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            }
        },
        messages: {
            email: {
                required: "กรุณากรอกอีเมล",
                email: "กรุณากรอกอีเมลให้ถูกต้อง เช่น yourname@email.com"
            },
            phone: {
                required: "กรุณากรอกเบอร์โทร",
                minlength: "กรุณากรอกเบอร์โทร 10 หลัก เช่น 0912345678",
                maxlength: "กรุณากรอกเบอร์โทร 10 หลัก เช่น 0912345678",
                number: "กรุณากรอกเบอร์โทรเป็นตัวเลข"
            }
        },
        submitHandler: function(form) {
            form.submit();
            return false;
        }
    });

    </script>

</body>

</html>