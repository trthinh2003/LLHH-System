<?php
    function getDateByWeekAndDay($startDate, $week, $dayOfWeek) {
        // Chuyển ngày bắt đầu sang định dạng timestamp
        $startTimestamp = strtotime($startDate);
        // Tính toán số ngày cần thêm vào ngày bắt đầu
        $daysToAdd = ($week - 1) * 7 + ($dayOfWeek - 1 - date('N', $startTimestamp));
        // Tính toán ngày mới
        $newDate = date('Y-m-d', strtotime("+$daysToAdd days", $startTimestamp));        
        return $newDate;
    }
?>