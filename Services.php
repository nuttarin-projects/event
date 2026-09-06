<?php
header( 'Content-Type:text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
set_time_limit(0);
require_once "classes/Manager.php";  
require_once "classes/Constants.php";  

$vid = isset($_REQUEST['vid']) ? $_REQUEST['vid'] : "";
$uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : "";
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";
$acmYearFocus=Constants::$acmYearFocus;
$eventId=Constants::$lastOph;

$data=array();
$data['success']=-1;
$data['errors']="-1";
$data['data']="";

//echo nl2br(print_r($data),true);
if($vid!='' && $uid!='' ) {
	
} else {
   if($action=='getLevelYear') {
        $lId=$_GET['lId']!=''?$_GET['lId']:'';
        $rs=Manager::getLevelYear($lId);
        $data['success']=1;
        $data['data']=json_encode($rs);
        $data['errors']="";
    }
    else if($action=='checkDuplicate') {
        $tel=$_GET['tel']!=''?$_GET['tel']:'';
        $email=$_GET['email']!=''?$_GET['email']:'';
        $eventId=$_GET['eventId']!=''?$_GET['eventId']:'';
        $rs=Manager::checkDuplicate($tel,$email, $eventId);
        $data['success']=1;
        $data['data']=$rs;
        $data['errors']="";
    }
    else if($action=='addUser') {
        $param["event_transport"] = isset($_POST['event_transport']) ? $_POST['event_transport'] : "เดินทางด้วยรถยนต์ส่วนตัว";
        $param["u_id"]= uniqid();
		$param["v_id"]= Manager::getID();
        $param["year"]=$acmYearFocus;

        $param["event_id"] = isset($_POST['event_id']) ? $_POST['eventId']:$eventId;
		$param["status_type"]=isset($_POST['status_type']) ?$_POST['status_type']:'student';
		$param["fullname"]=$_POST['firstname']." ".$_POST['lastname'];

        $param["ly_id"]=isset($_POST['dl_year'])?$_POST['dl_year']:'0';
        $param["academy"]=isset($_POST['tx_academy'])?$_POST['tx_academy']:'-';
        $param["email"]=isset($_POST['email'])?$_POST['email']:'';
        $param["telephone"]=isset($_POST['phone'])?$_POST['phone']:'';
        $param["gpa"]=isset($_POST['tx_gpa'])?$_POST['tx_gpa']:'';
        $param["interested"]=isset($_POST['tx_interested'])?$_POST['tx_interested']:'';

        $courses = [
            $_POST['tx_course_1'] ?? null,
            $_POST['tx_course_2'] ?? null,
            $_POST['tx_course_3'] ?? null,
        ];

        $param['course_2'] = implode(',', array_values(
                array_filter($courses)
            )
        );

        $param["add_ip"]=isset($_POST['ip'])?$_POST['ip']:'';
        $param["url_referer"]=isset($_POST['url_referer'])?$_POST['url_referer']:'';
        $param["source"]=isset($_POST['utm_source'])?$_POST['utm_source']:'';
        $param["campaign"]=isset($_POST['utm_campaign'])?$_POST['utm_campaign']:'';
        $param["remark"]=isset($_POST['remark'])?$_POST['remark']:'';

        $param["hourse_no"]=isset($_POST['tx_hourse_no'])?$_POST['tx_hourse_no']:'';
        $param["village_no"]=isset($_POST['tx_village_no'])?$_POST['tx_village_no']:'';
        $param["village_name"]=isset($_POST['tx_village_name'])?$_POST['tx_village_name']:'';
        $param["alley"]=isset($_POST['tx_alley'])?$_POST['tx_alley']:'';
        $param["road"]=isset($_POST['tx_road'])?$_POST['tx_road']:'';
        $param["province"]=isset($_POST['tx_province'])?$_POST['tx_province']:'';
        $param["amphoe"]=isset($_POST['tx_amphoe'])?$_POST['tx_amphoe']:'';
        $param["tambon"]=isset($_POST['tx_tambon'])?$_POST['tx_tambon']:'';
        $param["zipcode"]=isset($_POST['tx_zipcode'])?$_POST['tx_zipcode']:'';

        if($param["source"]!='')
        {
            $param["refer_from"]=$param["source"]; 
        } 

        $param["status_confirm"]=0;

        $isOphDay=Manager::isOphDay($eventId,Constants::$OPH_DATE[$eventId]);// 1 is oph day
        if($isOphDay==1)
        {
            $param["status_confirm"]=1;
        }
        $rsCheckDuplicate=Manager::checkDuplicate($param["telephone"],$param["email"],$param["event_id"]);

        if($rsCheckDuplicate==0) {
            $rsIns=Manager::insVisitor($param);

            if($param["hourse_no"]!=''){
                Manager::insAddress($param);
            }

            $data['success']=$rsIns;
            $data['data']=$param["fullname"];
            $data['errors']="";

            setcookie ("v_id",$param["v_id"],time()+ 86400);
            setcookie ("u_id",$param["u_id"],time()+ 86400);
            setcookie ("remark",$param["remark"],time()+ 86400);
            header("Location: member.php");
            
            //echo $data['success'];
        } else {
            $data['success']=0;
			$data['data']="";
			$data['errors']="คุณเคยลงทะเบียนแล้ว กรุณากลับเข้าสู่ระบบในวันงานอีกครั้ง";
			header("Location: register.php?success=0&errors=1&".$param["remark"]);    
        }

    } else if($action=='login') {
        $isOphDay=Manager::isOphDay($eventId,Constants::$OPH_DATE[$eventId]);// 1 is oph day 

        $param["tx_email"]=isset($_POST['email'])?$_POST['email']:'';
        $param["tx_tel"]=isset($_POST['phone'])?$_POST['phone']:'';
        $param["event_id"]=isset($_POST['eventId'])?$_POST['eventId']:$eventId;
        $param["remark"]=isset($_POST['remark'])?$_POST['remark']:'';

		$rs=Manager::checkLogin($param);

        $param["v_id"]=isset($rs["v_id"])? $rs["v_id"]:'';
        $param["u_id"]=isset($rs["u_id"])? $rs["u_id"]:'';

        if($rs!=null) { 
            if($rs['status_confirm']==0 && $isOphDay==1)
            {
                Manager::updVisitor($param);
            }

            setcookie ("v_id",$rs["v_id"],time()+ 86400);
			setcookie ("u_id",$rs["u_id"],time()+ 86400);
            setcookie ("remark",$param["remark"],time()+ 86400);
            header("Location: member.php");

        } else {
            header("Location: sign-in.php?success=0&errors=1&".$param["remark"]);
        }

    }
}
echo json_encode($data);

?>