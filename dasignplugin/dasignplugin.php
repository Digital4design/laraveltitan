<?php
/**
* Plugin Name: Visualization Report
* Description: Test plugin to show visual report to user on a page using [larareport] shortcode
* Version: 1.0
* Author: Malwinder Singh
**/

function d4dshowstatscisualreport( ){
    global $wpdb;
   
    $result = $wpdb->get_results(' 
    SELECT *
    FROM isha_spielplan
    LEFT JOIN isha_playgrounds
    ON isha_spielplan.playground_id =  isha_playgrounds.id
    WHERE ls_id =164 order by datum');
      
    $temp = '';
    
   $data=' <style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
</style>';
   
        $data .= '<table  cellspacing="0"  class="dt-table table table-striped table-bordered"  width="100%">';
        $data .=  '<tbody>';
               
                foreach ($result as $item){
                    $play_date =  date('d-m-Y', strtotime($item->datum));
                    if($temp!=$play_date){
                        $data .='<tr>';
                        $data .='<th style="text-align: left">'.date('l', strtotime($item->datum)).' , '.date('d. F. Y', strtotime($item->datum)).'</th>';
                        $data .='</tr>';
                        $data .='<tr>';
                        $data .='<td>'.$item->short_name .' &nbsp; '. date('H:i', strtotime($item->datum)).' Uhr </td>';
                        $data .='</tr>';
                             }else{
                        $data .='<tr>';
                        $data .='<td>'.$item->short_name .' &nbsp; '. date('H:i', strtotime($item->datum)).'Uhr </td>';
                        $data .='</tr>';
                    }                
                    $temp = $play_date;
                }

        $data .=' </tbody>';
        $data .='</table>';
        
    return $data;
}
add_shortcode( 'larareport', 'd4dshowstatscisualreport' );