<?php
if ( ! function_exists('convertResultToKeyValueArray')){
    function convertResultToKeyValueArray($result){
        $resultArray = array();
        foreach($result->result() as $key=>$value){
            $resultArray += [$key => $value];
        }
        return $resultArray;
    }   
}
if ( ! function_exists('convertResultToKeyValueArray')){
    function convertResultBasedOnType($items,$type,$formType = ''){
        
        switch(strtolower($type)){
            case "html":
                $html = "";
                switch(strtolower($formType)){
                    case "select":
                    break;
                    case "checkbox":
                    break;
                    case "radio":
                    break;
                }
                return $html;
            break;
            case "array":
                return $items;
            break;
        }
    }   
}
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
?>