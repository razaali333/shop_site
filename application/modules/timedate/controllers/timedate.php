<?php
class Timedate extends MX_Controller 
{

function __construct() {
    parent::__construct();
}

function get_nice_date($timestamp,$format)
{
    switch ($format) {
        // FUll Friday 18 of jaunary 2018 at 10:00:00 Am
        case 'full':
            $the_date=date('l jS \of F Y \a\t h:i:s A',$timestamp);
            break;
        
        case 'cool':
             $the_date=date('l jS \of F Y',$timestamp);
            break;
        case 'mini':
            $the_date=date('jS M Y',$timestamp);
                break;  
       case 'oldschool':
            $the_date=date('j\/n\/y',$timestamp);
                break;  

       case 'datepicker':
            $the_date=date('d\-m\-Y',$timestamp);
                break; 

        case 'monyear':
            $the_date=date('F Y',$timestamp);
                break;                             
    }
    return $the_date;
}


function make_timestamp_from_datepicker($datepicker)
{
 $hour=7;
 $minute=0;
 $second=0;
 $day=substr($datepicker, 0,2);
 $month=substr($datepicker, 3,2);
 $year=substr($datepicker, 6,4);

 $timestamp=$this->maketime($hour,$minute,$second,$month,$day,$year);
 return $timestamp;
}


function make_timestamp($day,$month,$year)
{
    $hour=7;
 $minute=0;
 $second=0;
 $timestamp=$this->maketime($hour,$minute,$second,$month,$day,$year);
 return $timestamp;
}

}