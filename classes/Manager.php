<?php
    require_once __DIR__."/DBManager.php";
    class Manager
    {
        public static function isOphDay($eventId,$ophDate)
        {
            $result=0;
            for($i=0;$i<count($ophDate);$i++)
            {
                if(date('Ymd')==$ophDate[$i])
                {
                    $result=1;
                    break;
                }
                else if(date('Ymd')>$ophDate[$i])
                {
                    $result=2;
                    break;
                }
            }
            return $result ;
        }

        public static function getLevel()
        {
            $result = array();

            $sql = "SELECT l_id, l_title ,l_sort FROM mt_level WHERE l_status = 1 ORDER BY l_sort";
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $rs = $stmt->get_result();
                while ($row = $rs->fetch_assoc()) {
                    $result[] = $row ;
                } 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }

        public static function getLevelYear($lId)
        {
            $result = array();

            $sql = " SELECT ly_id, ly_title ,ly_sort FROM mt_level_year WHERE ly_status = 1 and l_id=? ORDER BY ly_sort DESC";
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                $stmt->bind_param(str_repeat("s",substr_count($sql,'?')), $lId); 
                $stmt->execute();
                $rs = $stmt->get_result();
                while ($row = $rs->fetch_assoc()) {
                    $result[] = $row ;
                } 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }

        public static function getCourse($fac_id)
        {
            $result = array();

            $sql = " select * from mt_course where degree_id ='4' and fac_id =? and cou_flag ='T' ";
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                $stmt->bind_param(str_repeat("s",substr_count($sql,'?')), $fac_id); 
                $stmt->execute();
                $rs = $stmt->get_result();
                while ($row = $rs->fetch_assoc()) {
                    $result[] = $row ;
                } 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }

        public static function getFaculty()
        {
            $result = array();

            $sql = " SELECT fac_id, fac_name_th ,fac_sort FROM mt_faculty WHERE fac_id not in ('05', '12', '13', '17', '00') ORDER BY fac_sort ";
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $rs = $stmt->get_result();
                while ($row = $rs->fetch_assoc()) {
                    $result[] = $row ;
                } 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }

        public static function checkDuplicate($tel,$email, $eventId)
        {
            $result = "0";

            $sql = "SELECT v_id FROM tr_visitor WHERE (telephone = ? or email=? ) AND event_id =? ";
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                $stmt->bind_param(str_repeat("s",substr_count($sql, '?')),$tel,$email, $eventId);
                $stmt->execute();
                $rs = $stmt->get_result();
                if ($row = $rs->fetch_assoc()) {
                    $result = "1";
                } 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }

        public static function getID()  
        {			
            $result = -1 ;
            $sql ="SELECT MAX(v_id) AS currentID FROM tr_visitor";
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $rs = $stmt->get_result();
                if ($row = $rs->fetch_assoc()) {
                    $result = $row['currentID']+1;
                } 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }

        public static function insVisitor($param)
        {
            
            $result = 0;
            $sql = "INSERT INTO tr_visitor ( year, fullname, academy, ly_id
            , telephone, email, source
            , campaign, remark, refer_from, url_referer, add_ip
            , event_id, u_id, v_id, status_type
            , transport, status_confirm, interested,course_id ) 
            VALUES (?,?,?,? 
            ,?,?,?
            ,?,?,?,?,?
            ,?,?,?,?
            ,?,?,?,?)";
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                $stmt->bind_param(str_repeat("s",substr_count($sql,'?')),$param['year'],$param['fullname'],$param['academy'],$param['ly_id']
                ,$param['telephone'],$param['email'],$param['source']
                ,$param['campaign'],$param['remark'],$param['refer_from'],$param['url_referer'],$param['add_ip']
                ,$param['event_id'],$param['u_id'],$param['v_id'],$param['status_type']
                ,$param['event_transport'],$param['status_confirm'],$param['interested'],$param['course_2']);
                
                $result =$stmt->execute();
                 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }   

        public static function insAddress($param)
        {
            
            $result = 0;
            $sql = "INSERT INTO tr_address ( v_id, u_id, event_id, hourse_no, village_no
            , village_name, alley, road, province, amphoe
            , tambon, zipcode) 
            VALUES (?,?,?,?,? 
            ,?,?,?,?,?
            ,?,?)";
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                $stmt->bind_param(str_repeat("s",substr_count($sql,'?')),$param['v_id'],$param['u_id'],$param['event_id'],$param['hourse_no'],$param['village_no']
                ,$param['village_name'],$param['alley'],$param['road'],$param['province'],$param['amphoe']
                ,$param['tambon'],$param['zipcode']);
                
                $result =$stmt->execute();
                 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }

        public static function getUser($vid,$uid)
        {
            $result = array();

            $sql = "select * from tr_visitor where v_id=? and u_id=? ";
            $con = DBManager::getConnection(); 
            try
            {

                $stmt = $con->prepare($sql);
                $stmt->bind_param(str_repeat("s",substr_count($sql,'?')), $vid, $uid); 
                $stmt->execute();
                $rs = $stmt->get_result();
                while ($row = $rs->fetch_assoc()) {
                    $result = $row ;
                } 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
   
            DBManager::closeConnection($con);
            return $result ;
        }

        public static function getCheckInList($param)
        {
            $result = array();
            $sql = "SELECT VS.v_id, VS.u_id, VS.create_date, S.* FROM tr_visit_certificate VS
            LEFT JOIN mt_station S ON VS.id_station = S.id_station
            WHERE VS.v_id =? AND VS.u_id=? AND VS.event_id=? order by order_list";
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                    $stmt->bind_param(str_repeat("s",substr_count($sql, '?')),$param["v_id"],$param["u_id"],$param["event_id"]);
                $stmt->execute();
                $rs = $stmt->get_result();
                while ($row = $rs->fetch_assoc()) {
                    $result[] = $row ;
                } 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }

        public static function checkLogin($param)
        {
            $result = array();

            $sql ="SELECT * FROM tr_visitor WHERE email = ? and telephone = ? and event_id =?  ";	
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                $stmt->bind_param(str_repeat("s",substr_count($sql, '?')),$param['tx_email'],$param['tx_tel'],$param["event_id"]);
                $stmt->execute();
                $rs = $stmt->get_result();
                while ($row = $rs->fetch_assoc()) {
                    $result = $row ;
                } 
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }

        public static function updVisitor($param)
        {
            $result = 0;
            $sql = "UPDATE tr_visitor SET status_confirm = '1', updated_date=now() 
                WHERE v_id =? AND u_id =? ";
            $con = DBManager::getConnection(); 
            try
            {
                $stmt = $con->prepare($sql);
                $stmt->bind_param(str_repeat("s",substr_count($sql,'?')),$param['v_id'],$param['u_id']);
                $result =$stmt->execute();
                
            }
            catch(Exception $e)
            {
                print_r($e);
            }
            DBManager::closeConnection($con);
            return $result ;
        }

        
        // public static function insPDPA($email, $eventId)
        // {
        //     $result = 0;

        //     $sql = "insert into  pdpa_logs (from_tr,created_by,remark) value ('tr_visitor',?,?)";
        //     $con = DBManager::getConnectionByName("pdpa_concent"); 
        //     try
        //     {
        //         $stmt = $con->prepare($sql);
        //         $stmt->bind_param(str_repeat("s",substr_count($sql, '?')),$email, $eventId);
        //         $result=$stmt->execute();
                 
        //     }
        //     catch(Exception $e)
        //     {
        //         print_r($e);
        //     }
        //     DBManager::closeConnection($con);
        //     return $result ;
        // }
    }
?>