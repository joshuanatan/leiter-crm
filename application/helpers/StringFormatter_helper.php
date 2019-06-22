<?php
if ( ! function_exists('splitterMoney')){
    function splitterMoney($string,$separator){
        $split = explode($separator,$string);
        $result = "";
        for($a = 0; $a<count($split); $a++){
            $result .= $split{$a};
        }
        return $result;
    }   
}
if(!function_exists("bulanRomawi")){
    function bulanRomawi($bulan){
        switch((int)$bulan){
            case 1: return "I"; break;
            case 2: return "II"; break;
            case 3: return "II"; break;
            case 4: return "IV"; break;
            case 5: return "V"; break;
            case 6: return "VI"; break;
            case 7: return "VII"; break;
            case 8: return "VIII"; break;
            case 9: return "IX"; break;
            case 10: return "X"; break;
            case 11: return "XI"; break;
            case 12: return "XII"; break;
        }
    }
}
?>