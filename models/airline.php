<?php
 require_once("db.php");
 class airline extends db{
    function checkairline($airlineid, $airlinename) {
        $sql="CALL sp_checkairline({$airlineid}, '{$airlinename}')";

        return $this -> getData($sql)->rowCount();
    }
    function saveairline($airlineid, $airlinename, $homecountryid, $logo) {
        if($this->checkairline($airlineid, $airlinename)) {
            return ["status"=>"exists", "message"=>"Airline already exists."];
         } else {
                $sql="CALL sp_saveairline ({$airlineid}, '{$airlinename}', {$homecountryid}, '{$logo}')";
                $this -> getData($sql);
                return ["status"=> "success","message"=> "Airline was saved successfully"];
             }
    }
    function filterairline($airlinename, $countryname) {
        $sql= "CALL sp_filterairline ( '{$airlinename}', '{$countryname}')";
        return $this -> getJSON($sql);
    }
    function getairlinedetails($airlineid) {
        $sql= "CALL sp_getairlinedetails ( {$airlineid})";
        return $this -> getJSON($sql);
    }
    function deleteairline($airlineid) {
        $sql= "CALL sp_deleteairline ( {$airlineid})";
        $this -> getData($sql);
        return ["status"=> "success","message"=> "Airline was deleted successfully"];
    }
 }
