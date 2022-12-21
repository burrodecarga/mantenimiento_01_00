<?php

define('FALLA',array(
'equipo detenido',
'equipo no funciona',
'equipo no funciona adecuadamente',
'equipo presenta calentamiento',
'equipo presenta ruido',
'equipo presenta vibración'));

define('DIA',array('domingo','lunes','martes','miércoles','jueves','viernes','sábado'));

define('MES',array('enero','febrero', 'marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'));

function price($value){
   return number_format($value,2).' ';
}

function numero($value){
    return number_format($value,0).' ';
 }

 function randomColor() {
    $chars = 'FFABCDEF01234567898000FFFF';
    $color = '#';
    for ( $i = 0; $i < 6; $i++ ) {
       $color .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $color;
 }

