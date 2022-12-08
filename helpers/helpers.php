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
