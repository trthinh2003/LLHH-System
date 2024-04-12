<?php
    function getDateByWeekAndDay($startDate, $week, $dayOfWeek) {
        $startTimestamp = strtotime($startDate);
        $daysToAdd = ($week - 1) * 7 + ($dayOfWeek - 1 - date('N', $startTimestamp));
        $newDate = date('Y-m-d', strtotime("+$daysToAdd days", $startTimestamp));        
        return $newDate;
    }
?>