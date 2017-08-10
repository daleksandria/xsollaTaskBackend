<?php

class Interval
{
    public function findMaximumVisitors($str)
    {
        // получаем массив интервалов
        $intervals = [];
        $TimeOfArrivalAndDepartureVisitor = explode(" ", $str);
        foreach ($TimeOfArrivalAndDepartureVisitor as $intervalStr) {
            $times = explode("-", $intervalStr);
            list($hourStart, $minStart) = explode(":", $times[0]);
            list($hourEnd, $minEnd) = explode(":", $times[1]);
            $interval = [
                'startTime' => $hourStart * 60 + $minStart,
                'endTime' => $hourEnd * 60 + $minEnd
            ];
            $intervals[] = $interval;
        }

        // получаем список событий(время => количество людей)
        $events = [];
        foreach ($intervals as $interval) {
            if (isset($events[$interval['startTime']]))
                $events[$interval['startTime']]++;
            else
                $events[$interval['startTime']] = 1;

            if (isset($events[$interval['endTime']]))
                $events[$interval['endTime']]--;
            else
                $events[$interval['endTime']] = -1;
        }

        ksort($events);

        // по списку событий ищем интервал с максимальным количеством людей
        $maxVisitors = [
            'countVisitors' => 0,
            'startTime' => 0,
            'endTime' => 0
        ];

        $temp = [
            'countVisitors' => 0,
            'startTime' => 0,
            'endTime' => 0
        ];

        $count = 0;
        $watching = true;
        foreach ($events as $time => $event) {
            $count += $event;

            if ($count > $maxVisitors['countVisitors']
                && $count > $temp['countVisitors']) {
                $watching = true;
                $temp['countVisitors'] = $count;
                $temp['startTime'] = $time;
            }

            if ($watching && $event < 0) {
                $temp['endTime'] = $time;
                $maxVisitors = $temp;
                $watching = false;
            }
        }

        return $maxVisitors;
    }

    public function printMaxVisitors($maxVisitors)
    {
        $formatStartTime = intdiv($maxVisitors['startTime'], 60) . ':' . $maxVisitors['startTime'] % 60;
        $formatEndTime = intdiv($maxVisitors['endTime'], 60) . ':' . $maxVisitors['endTime'] % 60;
        print_r("{$maxVisitors['countVisitors']} {$formatStartTime}-{$formatEndTime}" . PHP_EOL);
    }
}

if ($argc > 1) {
    $maxVisitors = Interval::findMaximumVisitors($argv[1]);
    Interval::printMaxVisitors($maxVisitors);
} else {
    echo "Error. Parameters count less than 2\n";
}