<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Currency_converter {

    function getcurrency() {

        $xml = simplexml_load_file('https://www.bank.lv/vk/ecb.xml');
        foreach($xml->Currencies->Currency AS $k => $v) {
            $rate[trim($v->ID)] = trim($v->Rate);
        }

        return $rate;

    }

    function convertcurrency($amount, $from_currency, $to_currency) {
       
        $xml = simplexml_load_file('https://www.bank.lv/vk/ecb.xml');
        foreach($xml->Currencies->Currency AS $k => $v) {
            if($from_currency == 'EUR') {
                $from = 1;
            } else {
                if(trim($v->ID) == $from_currency) {
                    $from = trim($v->Rate);
                }
            }
            if($to_currency == 'EUR') {
                $to = 1;
            } else {
                if(trim($v->ID) == $to_currency) {
                    $to = trim($v->Rate);
                }
            }
        }
        if($from) {
            $total = number_format($amount * $from / $to, 2, '.', '');
        } else {
            $total = 0;
        }

        return $total;
        
    }

}