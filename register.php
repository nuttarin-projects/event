<?php
session_start();
require_once "classes/Constants.php";
require_once "classes/Manager.php";
$rand = Constants::$rand;
$eventId=Constants::$lastOph;
$isOphDay=Manager::isOphDay($eventId,Constants::$OPH_DATE[$eventId]);// 1 is oph day

$levelList=Manager::getLevel();
$facultyList=Manager::getFaculty();

$success = isset($_REQUEST['success']) ? $_REQUEST['success'] :0;
$errors = isset($_REQUEST['errors']) ? $_REQUEST['errors'] :0;

$param['v_id']=isset($_COOKIE['v_id'])? $_COOKIE['v_id']:"";
$param['u_id']=isset($_COOKIE['u_id'])? $_COOKIE['u_id']:"";

$ip = $_SERVER['REMOTE_ADDR'];
$utm_source = isset($_GET["utm_source"]) ? $_GET["utm_source"] :'';
$utm_medium = isset($_GET["utm_medium"]) ? $_GET["utm_medium"] :'';
$utm_campaign = isset($_GET["utm_campaign"]) ? $_GET["utm_campaign"] :'';

$remark ='';

if($utm_source !='')
{
    $remark = '?1=1&utm_source='.$utm_source.'&utm_medium='.$utm_medium.'&utm_campaign='.$utm_campaign; 
}

if($param['v_id']!='' || $param['v_id']!=null){
    header( "location: member.php");
    exit(0);
}

//echo $success;
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
        <?php if ($isOphDay == '2') {?>
            <!-- หลังวันงาน -->
            <div class="bg-white py-24 min-h-screen" style="display: block;">
                <?php include 'after-event.php'; ?>
            </div>
        <?php } else {?>
            <!-- วันงาน -->
        <div style="display: block;">
            <br />
            <br />
            <section class="px-4 py-8" data-aos="fade-up" data-aos-delay="600">
                <h1 class="text-3xl lg:text-4xl font-medium text-gray-900 mb-0 md:mb-1 text-center leading-snug">
                    ลงทะเบียนเข้าร่วมงาน
                </h1>
                <h1 class="text-3xl lg:text-4xl font-medium text-dpu-primary mb-2 md:mb-2 text-center leading-snug">
                    DEMO OPEN HOUSE 2025
                </h1>
                <div class="max-w-4xl mx-auto bg-dpu-fourth rounded-2xl shadow pb-4">
                    <div class="block bg-dpu-secondary rounded-t-2xl w-full py-3">
                        <!-- วันงาน -->
                        <p class="text-white text-center text-xl md:text-2xl px-4">
                            หรือ <a href="sign-in.php<?=$remark?>" class="text-white underline hover:underline transition">คลิกที่นี่</a> <span class="inline-block">เพื่อเข้าสู่ระบบ</span>
                        </p>
                    </div>
                    <form id="registerForm" action="Services.php" method="POST" class="space-y-6 p-4 md:p-8 !pt-0">
                        <!-- novalidate - ปิด popup ของ browser -->
                        <p class="text-green-700 text-center mt-10 mb-[-30px] w-full px-4 py-3 border rounded-xl border-2 border-green-700 text-center text-md md:text-lg custom-error" id="info-userExist">
                            <!-- id="info-userExist" -->
                            คุณเคยลงทะเบียนแล้ว <span class="inline-block">กรุณากลับเข้าสู่ระบบในวันงานอีกครั้ง</span>
                        </p>
                        <div class="border-0">
                            <fieldset class="space-y-4 mt-[0px]">
                                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 pt-[0px]">
                                    <input type="hidden" name="eventId" id="eventId" value="<?= $eventId ?>">
                                    <input type="hidden" name="ip" id="ip" value="<?= $ip ?>">
                                    <input type="hidden" name="action" id="action" value="addUser">
                                    <input type="hidden" id="utm_source" name="utm_source" value="<?= $utm_source ?>">
                                    <input type="hidden" id="utm_campaign" name="utm_campaign" value="<?= $utm_campaign ?>">
                                    <input type="hidden" id="utm_medium" name="utm_medium" value="<?= $utm_medium ?>">
                                    <input type="hidden" id="remark" name="remark" value="<?= $remark ?>">
                                    
                                    <div class="text-md text-gray-900 px-6 relative z-5 top-[38px] md:top-[38px]">
                                        <span class="bg-dpu-fourth px-2">ข้อมูลสำคัญ</span>
                                    </div>
                                    <div class="border-2 border-dpu-sixth rounded-xl pt-4 md:pt-6 overflow-hidden">
                                        <div class="space-y-4 mt-[0px]">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 md:p-6 !pt-[20px]">
                                                <!-- Email -->
                                                <div>
                                                    <label for="email" class="block text-gray-900 mb-1">อีเมล <span class="text-red-500">*</span></label>
                                                    <input type="email" id="email" name="email" placeholder="yourname@email.com"
                                                        class="infoLogin input-custom"
                                                        required="" />
                                                </div>
                                                <!-- Tel -->
                                                <div>
                                                    <label for="phone" class="block text-gray-900 mb-1">เบอร์โทรศัพท์ <span class="text-red-500">*</span></label>
                                                    <input type="text" inputmode="numeric" pattern="[0-9]{10}" id="phone" name="phone"
                                                        maxlength="10" placeholder="0912345678"
                                                        class="infoLogin input-custom"
                                                        required="">
                                                </div>
                                                <!-- First Name -->
                                                <div>
                                                    <label for="firstname" class="block text-gray-900 mb-1">ชื่อ <span class="text-red-500">*</span></label>
                                                    <input type="text" id="firstname" name="firstname" placeholder="ปัญญา"
                                                        class="input-custom"
                                                        required="" />
                                                </div>
                                                <!-- Last Name -->
                                                <div>
                                                    <label for="lastname" class="block text-gray-900 mb-1">นามสกุล <span class="text-red-500">*</span></label>
                                                    <input type="text" id="lastname" name="lastname" placeholder="ณ ดีพียู"
                                                        class="input-custom"
                                                        required="" />
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-2">
                                                <!-- Checkbox Newsletter -->
                                                <div class="flex items-start items-center pb-4 px-4 md:px-6">
                                                    <div class="w-1/10">
                                                        <input type="checkbox" id="news" name="" value="News" class="checkbox-custom">
                                                    </div>
                                                    <label class="ml-0 cursor-pointer" for="news">สนใจรับจดหมายข่าวสารและสิทธิพิเศษ</label>
                                                </div>
                                                <!-- Address Fields (Initially hidden) --> <!-- ใส่คลาส hidden ต่อที่ id address ตอนทำโปรแกรม -->
                                                <div id="address" class="order-2 md:col-span-2 bg-dpu-seventh p-4 md:p-6 hidden">
                                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
                                                        <!-- House No. -->
                                                        <div>
                                                            <label for="hourse_no" class="block text-gray-900 mb-1">บ้านเลขที่ <span class="text-red-500">*</span></label>
                                                            <input type="text" name="tx_hourse_no" id="hourse_no" maxlength="8" placeholder="888/8-8"
                                                                class="input-custom"
                                                                required="" />
                                                        </div>

                                                        <!-- Village No. -->
                                                        <div>
                                                            <label for="village_no" class="block text-gray-900 mb-1">หมู่ที่</label>
                                                            <input type="text" name="tx_village_no" id="village_no" maxlength="3" placeholder="1"
                                                                class="input-custom" />
                                                        </div>

                                                        <!-- Village Name -->
                                                        <div>
                                                            <label for="village_name" class="block text-gray-900 mb-1">ชื่อหมู่บ้าน</label>
                                                            <input type="text" name="tx_village_name" id="village_name" maxlength="100" placeholder="หมู่บ้าน"
                                                                class="input-custom" />
                                                        </div>

                                                        <!-- Alley -->
                                                        <div class="md:col-span-1">
                                                            <label for="alley" class="block text-gray-900 mb-1">ซอย/ตรอก</label>
                                                            <input type="text" name="tx_alley" id="alley" maxlength="50" placeholder="ประชาชื่น"
                                                                class="input-custom" />
                                                        </div>

                                                        <!-- Road -->
                                                        <div class="md:col-span-1">
                                                            <label for="road" class="block text-gray-900 mb-1">ถนน</label>
                                                            <input type="text" name="tx_road" id="road" maxlength="50" placeholder="ประชาชื่น"
                                                                class="input-custom" />
                                                        </div>

                                                        <!-- Province -->
                                                        <div class="relative">
                                                            <label for="input_province" class="block text-gray-900 mb-1">จังหวัด <span class="text-red-500">*</span></label>
                                                            <select id="input_province" name="tx_province"
                                                                class="select-custom"
                                                                required="">
                                                                <option value="">กรุณาเลือก</option>
                                                            </select>
                                                        </div>

                                                        <!-- District -->
                                                        <div class="relative">
                                                            <label for="input_amphoe" class="block text-gray-900 mb-1">เขต/อำเภอ <span class="text-red-500">*</span></label>
                                                            <select id="input_amphoe" name="tx_amphoe"
                                                                class="select-custom"
                                                                required="">
                                                                <option value="">กรุณาเลือก</option>
                                                            </select>
                                                        </div>

                                                        <!-- Sub-district -->
                                                        <div class="relative">
                                                            <label for="input_tambon" class="block text-gray-900 mb-1">แขวง/ตำบล <span class="text-red-500">*</span></label>
                                                            <select id="input_tambon" name="tx_tambon"
                                                                class="select-custom"
                                                                required="">
                                                                <option value="">กรุณาเลือก</option>
                                                            </select>
                                                        </div>

                                                        <!-- Zipcode -->
                                                        <div>
                                                            <label for="input_zipcode" class="block text-gray-900 mb-1">รหัสไปรษณีย์ <span class="text-red-500">*</span></label>
                                                            <input type="text" name="tx_zipcode" id="input_zipcode" maxlength="5" placeholder="10210"
                                                                class="input-custom"
                                                                required="" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">
                                        <!-- Educational Institution -->
                                        <div>
                                            <label for="tx_academy" class="block text-gray-900 mb-1">สถานศึกษา <span class="text-red-500">*</span></label>
                                            <input type="text" id="tx_academy" name="tx_academy" placeholder="โรงเรียนดีพียู"
                                                class="input-custom"
                                                required="" />
                                        </div>
                                        <!-- Education Level -->
                                        <div class="relative">
                                            <label for="dl_level" class="block text-gray-900 mb-1">ระดับการศึกษา <span class="text-red-500">*</span></label>
                                            <select id="dl_level" name="dl_level" onchange="ChangeStudyList()"
                                                class="select-custom"
                                                required="">
                                                <option value="">ระดับการศึกษา</option>
                                                <?php
                                                    for($i=0;$i<count($levelList);$i++)
                                                    {
                                                        echo " <option value='".$levelList[$i]['l_id']."'>".$levelList[$i]['l_title']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- Year -->
                                        <div class="relative">
                                            <label for="dl_year" class="block text-gray-900 mb-1">ชั้นปี <span class="text-red-500">*</span></label>
                                            <select id="dl_year" name="dl_year"
                                                class="select-custom"
                                                required="">
                                                <option value="">ชั้นปี</option>
                                            </select>
                                        </div>
                                        <!-- GPA -->
                                        <div>
                                            <label for="tx_gpa" class="block text-gray-900 mb-1">เกรดเฉลี่ยสะสม</label>
                                            <input type="text" id="tx_gpa" name="tx_gpa" maxlength="4" placeholder="4.00"
                                                class="input-custom" />
                                        </div>
                                    </div>
                                    <!-- Interested in further study -->
                                    <div class="mt-0 mb-4">
                                        <label class="block text-gray-900 mb-1">คุณสนใจศึกษาต่อที่Demo Universityหรือไม่ <span class="text-red-500">*</span></label>
                                        <div class="flex flex-col gap-2">
                                            <div class="radio-option">
                                                <div class="radio-wrapper">
                                                    <input type="radio" id="interested_1" name="tx_interested" value="สนใจศึกษาต่อมาก" class="radio-custom" required="" />
                                                    <span class="radio-custom-dot"></span>
                                                </div>
                                                <label for="interested_1" class="ml-2 cursor-pointer">สนใจศึกษาต่อมาก</label>
                                            </div>
                                            <div class="radio-option">
                                                <div class="radio-wrapper">
                                                    <input type="radio" id="interested_2" name="tx_interested" value="สนใจ" class="radio-custom" required="" />
                                                    <span class="radio-custom-dot"></span>
                                                </div>
                                                <label for="interested_2" class="ml-2 cursor-pointer">สนใจ</label>
                                            </div>
                                            <div class="radio-option">
                                                <div class="radio-wrapper">
                                                    <input type="radio" id="interested_3" name="tx_interested" value="ไม่แน่ใจ" class="radio-custom" required="" />
                                                    <span class="radio-custom-dot"></span>
                                                </div>
                                                <label for="interested_3" class="ml-2 cursor-pointer">ไม่แน่ใจ</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Field of interest -->
                                    <div class="border-2 border-dpu-sixth rounded-b-xl">
                                        <div class="block bg-dpu-sixth w-full p-4">
                                            <span class="block text-white mb-2">สาขาที่สนใจ? (เลือกอย่างน้อย 2 ข้อ) <span class="text-red-500">*</span></span>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 p-4 md:p-6">
                                            <!-- course -->
                                            <div class="relative">
                                                <select id="tx_course_1" name="tx_course_1"  class="select-custom" required="">
                                                    <option value="">สาขาที่สนใจอันดับ 1</option>
                                                    <?php for($i=0;$i<count($facultyList);$i++)
                                                        {?>
                                                        <optgroup label="<?php echo $facultyList[$i]['fac_name_th']?>">
                                                            <?php $CourseList=Manager::getCourse($facultyList[$i]['fac_id']);?>
                                                                <?php for($y=0;$y<count($CourseList);$y++){
                                                                    if($CourseList[$y]['fac_id'] == $facultyList[$i]['fac_id']){
                                                                    echo " <option value='".$CourseList[$y]['cou_id']."'>".$CourseList[$y]['cou_name_th']."</option>";
                                                                    }
                                                                }?> 
                                                            </optgroup>";
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <div class="relative">
                                               <select id="tx_course_2" name="tx_course_2" class="select-custom" required="">
                                                    <option value="">สาขาที่สนใจอันดับ 2</option>
                                                    <?php for($i=0;$i<count($facultyList);$i++)
                                                        {?>
                                                        <optgroup label="<?php echo $facultyList[$i]['fac_name_th']?>">
                                                            <?php $CourseList=Manager::getCourse($facultyList[$i]['fac_id']);?>
                                                                <?php for($y=0;$y<count($CourseList);$y++){
                                                                    if($CourseList[$y]['fac_id'] == $facultyList[$i]['fac_id']){
                                                                    echo " <option value='".$CourseList[$y]['cou_id']."'>".$CourseList[$y]['cou_name_th']."</option>";
                                                                    }
                                                                }?> 
                                                            </optgroup>";
                                                    <?php }?>
                                            </select>
                                            </div>
                                            <div class="relative">
                                                <select id="tx_course_3" name="tx_course_3" class="select-custom">
                                                    <option value="">สาขาที่สนใจอันดับ 3</option>
                                                    <?php for($i=0;$i<count($facultyList);$i++)
                                                        {?>
                                                        <optgroup label="<?php echo $facultyList[$i]['fac_name_th']?>">
                                                            <?php $CourseList=Manager::getCourse($facultyList[$i]['fac_id']);?>
                                                                <?php for($y=0;$y<count($CourseList);$y++){
                                                                    if($CourseList[$y]['fac_id'] == $facultyList[$i]['fac_id']){
                                                                    echo " <option value='".$CourseList[$y]['cou_id']."'>".$CourseList[$y]['cou_name_th']."</option>";
                                                                    }
                                                                }?> 
                                                            </optgroup>";
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Captcha -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        กรุณาหาผลลัพธ์ <span class="text-red-500">*</span>
                                        <input type="text" disabled="" id="captcha"
                                            class="input-custom" />
                                    </div>
                                    <div>
                                        ผลลัพธ์ <span class="text-red-500">*</span>
                                        <input type="number" inputmode="numeric" pattern="[0-9]*"
                                            id="captchaAnswer" name="captchaAnswer" placeholder="พิมพ์ผลลัพธ์"
                                            class="input-custom"
                                            required="" />
                                    </div>
                                </div>
                                <p style="display:none;"
                                    class="text-center mt-8 mb-8 w-full px-4 py-3 border rounded-xl border-2 border-green-700 text-center text-md md:text-lg custom-error"
                                    id="info-captcha">
                                    กรุณาระบุผลลัพธ์ให้ถูกต้อง
                                </p>

                                <!-- Terms -->
                                <div class="flex items-start form-check-acceptPDPA">
                                    <div class="w-1/10">
                                        <input id="acceptPDPA" name="acceptPDPA" type="checkbox" class="checkbox-custom" />
                                    </div>
                                    <label for="acceptPDPA" class="text-md cursor-pointer">
                                        <p>ผู้สมัครได้อ่านและทำความเข้าใจเกี่ยวกับ <a
                                                href="" target="_blank"
                                                class="text-dpu-primary hover:underline transition">นโยบายเกี่ยวกับการใช้งานคุกกี้</a>
                                            และ <a href="" target="_blank"
                                                class="text-dpu-primary hover:underline transition">การคุ้มครองข้อมูลส่วนบุคคล</a>
                                            ของDemo Universityเรียบร้อยแล้ว</p>
                                        <p class="text-sm text-red-500 mt-1 z-5 mb-[-40px] hidden custom-error" id="errorTerms">
                                            กรุณายอมรับเงื่อนไข</p>
                                        <p>&nbsp;</p>
                                    </label>
                                </div>

                                <!-- Submit -->
                                <button type="submit" class="btn-primary w-full">ลงทะเบียน</button>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </section>
            <br />
            <br />
            <br />
            <?php include 'footer.php'; ?>
        </div>
        <?php } ?>
        
    </main> 
    <?php include 'layouts-footer-tag-inbody.php'; ?>
    <script src ="assets/js/regis.js"></script>
    <script>
        let usernameExist = 0; // 0= not duplicate,1=duplicate
        let success = '<?= $success ?>';
        let errors = '<?= $errors ?>';

        if (success == 0 && errors == 1) { 
            $('#info-userExist').show();
            setTimeout(() => {
                $('html, body').animate({scrollTop: $('#info-userExist').offset().top - 100}, '50');
            }, 200)
        } else {
            usernameExist = 0;
            $('#info-userExist').hide();
        }

        $('.infoLogin').on('blur', function () {
            var tel = $('#phone').val();
            var email = $('#email').val();
            var eventId = $('#eventId').val();
            //console.log(tel+" "+email);
            if (tel != '' || email != '') {
                $.ajax({
                    url: "Services.php",
                    type: "GET",
                    data: {
                        tel: tel,
                        email: email,
                        eventId: eventId,
                        action: 'checkDuplicate'
                    },
                    success: function (data) {
                        var rs = JSON.parse(data);
                        if (rs.success == 1) {
                            usernameExist = rs.data
                            if (usernameExist == 1) {
                                $('#info-userExist').show();
                                setTimeout(() => {
                                    $('html, body').animate({scrollTop: $('#info-userExist').offset().top - 100}, '50');
                                }, 200);
                            } else {
                                usernameExist = 0;
                                $('#info-userExist').hide();
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>