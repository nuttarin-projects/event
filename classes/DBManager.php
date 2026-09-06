<?php

class DBManager
{
    public static function getConnection()
    {
        $dbuser = "root";
        $dbpassword = "Thebest1";
        $dbname = "event";
        $dbhost = "172.16.14.102";
        $dbport=3306;

        $con = new mysqli("db", $dbuser, $dbpassword, $dbname ) or die(mysqli_error($con));
        mysqli_set_charset($con, "utf8");
        return $con ;
            
        
    }
    public static function closeConnection($con)
    {
        mysqli_close($con);
        $con = null; 
    }

    public static function getConnectionByName($dbname)
    {
        $dbuser = "root";
        $dbpassword = "Thebest1";;
        $dbhost = "172.16.14.102";
        $dbport=3306;
        $con = new mysqli("db", $dbuser, $dbpassword, $dbname)or die(mysqli_error($con));
        mysqli_set_charset($con, "utf8");
        return $con ;
        
    } 
}