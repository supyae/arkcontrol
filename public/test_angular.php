<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && file_get_contents('php://input')) {

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    foreach ($request as $key => $value) {

        $day_period = explode("_", $value->day_period);
        $day = $day_period[0];
        $period = $day_period[1];

        $schedule[$day][] = $period;
    }

    echo json_encode($schedule);
}


?>