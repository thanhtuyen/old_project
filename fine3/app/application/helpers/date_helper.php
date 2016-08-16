<?php

function checkDateFormat($date, $format="Y-m-d") {
    $dt = DateTime::createFromFormat($format, $date);
    return $dt !== false && !array_sum($dt->getLastErrors());
}


function getAge($date) {
   $year = date('Y', strtotime($date));
   $currentYear = date('Y');
   $age =  $currentYear - $year;

   return $age;
}
