<?php
    function getWeekAndDayByDate($startDate, $targetDate) {
        $startTimestamp = strtotime($startDate);
        $targetTimestamp = strtotime($targetDate);       
        // Tính số ngày chênh lệch giữa ngày bắt đầu và ngày cần kiểm tra
        $daysDiff = ($targetTimestamp - $startTimestamp) / (60 * 60 * 24);        
        // Tính tuần và ngày trong tuần
        $week = floor($daysDiff / 7) + 1;
        $dayOfWeek = date('N', $targetTimestamp) + 1; // Điều chỉnh để thứ hai bắt đầu từ 2        
        if ($dayOfWeek == 8) {
            $dayOfWeek = 1; // Nếu ngày trong tuần là Chủ nhật, chuyển nó thành 1
        }      
        return array('week' => $week, 'dayOfWeek' => $dayOfWeek);
    }
?>