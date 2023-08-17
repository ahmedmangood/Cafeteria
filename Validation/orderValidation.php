<?php 


function validateDates($start_date, $end_date) {
  if (empty($start_date) ||!strtotime($start_date)) {
    return false;
  }

    if (empty($end_date)|| !strtotime($end_date)) {
    return false;
  }

    if (strtotime($end_date) < strtotime($start_date)) {
    return false;
  }

  return true;
}