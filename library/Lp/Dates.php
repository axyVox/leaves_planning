<?php

class Lp_Dates
{

    public function isWorkingDay($date)
    {
        $unix_timestamp = strtotime($date);
        $day_number = date('w', $unix_timestamp);

        if ($day_number > 0 && $day_number < 6)
            return true;

        return false;
    }

    public function countWorkingDays($from_date, $to_date)
    {
        $count = 0;
        $current_date = $from_date;


        while (strtotime($current_date) < strtotime($to_date)) {
            if ($this->isWorkingDay($current_date))
                $count++;
            $current_date = date("Y-m-d", strtotime("+1 day", strtotime($current_date)));
        }

        return $count;
    }
} 