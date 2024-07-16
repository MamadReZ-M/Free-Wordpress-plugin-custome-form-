<?php
require_once 'jdf.php';

class checkInput
{
    public function filter($input){
        $output = '';
        $output = str_replace('`','',$input);
        $output = str_replace('"','',$input);
        $output = str_replace('/','',$input);
        $output = str_replace('{','',$input);
        $output = str_replace('&','',$input);
        $output = str_replace('#','',$input);
        $output = str_replace('$','',$input);
        $output = str_replace("'","",$input);
        $output = htmlspecialchars($input);
        return $output;
    }

    public function getUserIP() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    
    public function dateConvertGToJ($date,$format){
        $arr_parts = explode('-', $date);            
        $gYear  = $arr_parts[0];
        $gMonth = $arr_parts[1];
        $gDay   = $arr_parts[2];
        $timestamp = mktime(0,0,0,$gMonth,$gDay,$gYear);
        $current_gdate = jdate( $format , $timestamp , '' , 'Asia/Tehran' );
        return $current_gdate;
    }

    public function convertToGregorian($date){
        $date = explode('/',$date);
        $date = jalali_to_gregorian($date[0],$date[1],$date[2]);
        $date = implode('-',$date);
        return $date;
    }

    public function convertToJalali($date){
        $date = explode(' ',$date);
        $time = $date[1];
        $date = explode('-',$date[0]);
        $date = gregorian_to_jalali($date[0],$date[1],$date[2]);
        $date = implode('/',$date);
        return $date.' '.$time;
    }

    public function getDiff($start_date,$start_time){
        $now = date('Y-m-d H:i:s');       
        $start_date_time = $start_date.' '.$start_time;
        $diff = strtotime($start_date_time) - strtotime($now);
        return $diff;
    }

    public function pagination($total_records, $page, $limit, $path)
    {
        $pagLink = '<div class="container-fluid center">
        <ul class="pagination">';
        if($total_records != 0){            
            // Number of pages required.
            $start = 1;
            $end = 6;

            $total_pages = ceil($total_records / $limit);
            
            $m = $end/2;
            if($page >= $m){
                $dif = $page - $m;
                $start += $dif;
                $end += $dif;
            }
            else{
                if($page > 1){
                    $dif = $m - $page;
                    if($dif < $start)
                        $start -= $dif;
                    $end -= $dif;
                }
            }
            if($page > 1){
                $pagLink .= '<li  class="pre-li"><a class="pre" href="'.$path.($page-1).'"><</a></li>';
            }           
            for ($i=$start; $i<=$end; $i++) {
                if($i >= ($total_records/$limit)+1){
                    break;
                }
                if($i==$page)
                    $pagLink .= '<li><a class="active disabled" href="'.$path.$i.'">'.$i.'</a></li>';
                else
                    $pagLink .= '<li><a href="'.$path.$i.'">'.$i.'</a></li>';
            }
            if(($page*$limit) < $total_records){
                $pagLink .= '<li  class="next-li"><a href="'.$path.($page+1).'">></a></li>';
            }

            $pagLink .= '    </ul>
            </div>';
        }
        echo $pagLink;
    }
}