<?php
require_once 'db.php';
class Country extends db{
    function checkcountry($countryid, $countryname){
        $sql="CALL 'sp_checkcountry'({$countryid}, '{$countryname}')";
        return $this ->getData($sql)->rowCount();
    }
    function savecountry($countryid, $countryname){
        if($this->checkcountry($countryid, $countryname)){
            return ["status"=>"exists", "message"=>"Country already exists"];
        }else{
        $sql="CALL 'sp_savecountry'({$countryid}, '{$countryname}')";
        $this->getData($sql);
        return ["status"=>"success", "message"=>"Country saved successfully"];
        }
    }
    function getcountry(){
        $sql="CALL 'sp_getcountry'()";
        return $this->getJSON($sql);
    }
    function getcountrydetails($countryid){
        $sql="CALL 'sp_getcountrydetail'({$countryid})";
        return $this->getJSON($sql);
    }
    function deletecountry($countryid){
        $sql="CALL 'sp_deletecountry'({$countryid})";
        $this->getData($sql);
        return ["status"=>"success", "message"=>"Country deleted successfully"];
    }
    
}
