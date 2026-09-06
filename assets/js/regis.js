var captcha = generateCaptcha();

$("#registerForm").validate({
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
        },
        firstname: "required",
        lastname: "required",
        captchaAnswer: "required",
        acceptPDPA: "required",
        tx_academy: "required",
        tx_hourse_no: "required",
        tx_province: "required",
        tx_amphoe: "required",
        tx_tambon: "required",
        tx_zipcode: {
            required: true,
            number: true,
            minlength: 5,
            maxlength: 5
        },
        dl_level: "required",
        dl_year: "required",
        tx_interested: "required",
        tx_course_1: "required",
        tx_course_2: "required",
        tx_gpa: {
            number: true,
            min: 0,
            max: 4,
            step: 0.01,
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
        },
        firstname: "กรุณากรอกชื่อ",
        lastname: "กรุณากรอกนามสกุล",
        captchaAnswer: "กรุณาระบุผลลัพธ์ให้ถูกต้อง",
        acceptPDPA: "กรุณายอมรับเงื่อนไข",
        tx_academy: "กรุณากรอกสถานศึกษา",
        tx_hourse_no: "กรุณากรอกบ้านเลขที่",
        tx_province: "กรุณาเลือกจังหวัด",
        tx_amphoe: "กรุณาเลือกเขต/อำเภอ",
        tx_tambon: "กรุณาเลือกแขวง/ตำบล",
        tx_zipcode: {
            required: "กรุณากรอกรหัสไปรษณีย์",
            minlength: "ต้องกรอกเป็นรหัสไปรษณีย์ 5 หลัก",
            maxlength: "ต้องกรอกเป็นรหัสไปรษณีย์ 5 หลัก",
            number: "กรอกข้อมูลเป็นตัวเลขรหัสไปรษณีย์"
        },
        dl_level: "กรุณาเลือกระดับการศึกษา",
        dl_year: "กรุณาเลือกชั้นปี",
        tx_interested: "กรุณาเลือกระดับความสนใจ",
        tx_course_1: "กรุณาเลือกสาขาที่สนใจ",
        tx_course_2: "กรุณาเลือกสาขาที่สนใจ",
        tx_gpa: {
            minlength: "กรุณากรอกข้อมูลในรูปแบบเกรดเฉลี่ย เช่น 3.00",
            maxlength: "กรุณากรอกข้อมูลในรูปแบบเกรดเฉลี่ย เช่น 3.00",
            number: "กรุณากรอกข้อมูลในรูปแบบเกรดเฉลี่ย เช่น 3.00",
            max: "กรุณากรอกเกรดเฉลี่ย ที่มีค่า 0-4 เท่านั้น"
        },
    }
});

$("#dl_level").change(function() {
    $('#dl_year').find('option').not(':first').remove();//clear option
    $.ajax({
        url: "Services.php",
        type: "GET",
        data: {
            lId: $(this).val(),
            action: 'getLevelYear'		
        },
        success: function( data ) {
            var datas = JSON.parse(data);
            if(datas.success==1 )
            {
                var result = JSON.parse(datas.data);
                if(result.length>0)
                {
                    $.each(result, function(key,value) {
                        $('#dl_year').append(new Option(value.ly_title, value.ly_id))
                    });
                }
            }
        }
    });
});
    
$("#news").on('change', function() {
    if ($(this).is(':checked')) {
        $('#address').removeClass('hidden').addClass('block');
        $('html, body').animate({
            scrollTop: $('#address').offset().top - 64
        }, 500);
    } else {
        $('#address').removeClass('block').addClass('hidden');
        $('#hourse_no, #village_no, #village_name, #alley, #road, #input_zipcode').val('');
        $('#input_province, #input_amphoe, #input_tambon').val('');
    }
});

function showProvinces() {
    let input_province = document.querySelector("#input_province");
    let url = "https://ckartisan.com/api/provinces";
    console.log(url);
    // if(input_province.value == "") return;
    fetch(url)
    .then((response) => response.json())
    .then((result) => {
        console.log(result);
        //UPDATE SELECT OPTION
        let input_province = document.querySelector("#input_province");
        input_province.innerHTML =
        '<option value="">กรุณาเลือกจังหวัด</option>';
        for (let item of result) {
        let option = document.createElement("option");
        option.text = item.province;
        option.value = item.province;
        input_province.appendChild(option);
        }
        //QUERY AMPHOES
        showAmphoes();
    });
}

function showAmphoes() {
    let input_province = document.querySelector("#input_province");
    let url =
    "https://ckartisan.com/api/amphoes?province=" + input_province.value;
    console.log(url);
    // if(input_province.value == "") return;
    fetch(url)
    .then((response) => response.json())
    .then((result) => {
        console.log(result);
        //UPDATE SELECT OPTION
        let input_amphoe = document.querySelector("#input_amphoe");
        input_amphoe.innerHTML =
        '<option value="">กรุณาเลือกเขต/อำเภอ</option>';
        for (let item of result) {
        let option = document.createElement("option");
        option.text = item.amphoe;
        option.value = item.amphoe;
        input_amphoe.appendChild(option);
        }
        //QUERY AMPHOES
        showTambons();
    });
}

function showTambons() {
    let input_province = document.querySelector("#input_province");
    let input_amphoe = document.querySelector("#input_amphoe");
    let url =
    "https://ckartisan.com/api/tambons?province=" +
    input_province.value +
    "&amphoe=" +
    input_amphoe.value;
    console.log(url);
    // if(input_province.value == "") return;
    // if(input_amphoe.value == "") return;
    fetch(url)
    .then((response) => response.json())
    .then((result) => {
        console.log(result);
        //UPDATE SELECT OPTION
        let input_tambon = document.querySelector("#input_tambon");
        input_tambon.innerHTML =
        '<option value="">กรุณาเลือกแขวง/ตำบล</option>';
        for (let item of result) {
        let option = document.createElement("option");
        option.text = item.tambon;
        option.value = item.tambon;
        input_tambon.appendChild(option);
        }
        //QUERY AMPHOES
        showZipcode();
    });
}

function showZipcode() {
    let input_province = document.querySelector("#input_province");
    let input_amphoe = document.querySelector("#input_amphoe");
    let input_tambon = document.querySelector("#input_tambon");
    let url =
    "https://ckartisan.com/api/zipcodes?province=" +
    input_province.value +
    "&amphoe=" +
    input_amphoe.value +
    "&tambon=" +
    input_tambon.value;
    console.log(url);
    // if(input_province.value == "") return;
    // if(input_amphoe.value == "") return;
    // if(input_tambon.value == "") return;
    fetch(url)
    .then((response) => response.json())
    .then((result) => {
        console.log(result);
        //UPDATE SELECT OPTION
        let input_zipcode = document.querySelector("#input_zipcode");
        input_zipcode.value = "";
        for (let item of result) {
        input_zipcode.value = item.zipcode;
        break;
        }
    });
}

//EVENTS
document
    .querySelector("#input_province")
    .addEventListener("change", (event) => {
    showAmphoes();
    });

document
    .querySelector("#input_amphoe")
    .addEventListener("change", (event) => {
    showTambons();
    });
    
document
    .querySelector("#input_tambon")
    .addEventListener("change", (event) => {
    showZipcode();
    });

showProvinces();


function generateCaptcha() {
    var a = Math.floor((Math.random() * 10));
    var b = Math.floor((Math.random() * 10));
    var c = Math.floor((Math.random() * 10));
    var e = a + b + c
    $('#captcha').val(a.toString() + " + " + b.toString() + " + " + c.toString() + " = ");
    return e;
}

function checkCapcha(captcha) {
    $("#captchaAnswer").val()
    if ($("#captchaAnswer").val() == captcha) {
        return true;
    } else {
        return false;
    }
}