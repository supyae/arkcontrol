<?php

$day = [
    1 => "Monday",
    2 => "Tuesday",
    3 => "Wednesday",
    4 => "Thursday",
    5 => "Friday",
    6 => "Saturday",
    7 => "Sunday"

];

$period = [
    1 => "06:00 ~ 08:00",
    2 => "08:00 ~ 10:00",
    3 => "10:00 ~ 12:00",
    4 => "12:00 ~ 14:00",
    5 => "14:00 ~ 16:00",
    6 => "16:00 ~ 18:00"
];

//$data = [
//    1 => [1, 2],
//    4 => [5, 6]
//];
$data = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            $input = explode("_", $key);
            $time_id = $input[2];
            $day_id = $input[1];

            echo "Field " . htmlspecialchars($key) . " is " . htmlspecialchars($value) . "<br>";

            $data[$day_id][] = $time_id;

        }
    }

}


?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Day Parting</title>
</head>

<body>
<div id="app">
    <form action="test.php" method="POST">
        <table class="dayparts table">
            <thead>
            <tr>
                <td></td>

            </tr>

            <tr>
                <td class="cell-label day-label" style="width: 130px"> Day</td>
                <?php foreach ($period as $key => $value) {
                    echo '<td style="width: 150px">' . $value . '</td>';
                } ?>

            </tr>
            </thead>
            <tbody>

            <?php foreach ($day as $key => $value) {
                $colspan_val = sizeof($period) + 1;

                echo "<tr class='day'><td colspan='" . $colspan_val . "'><table><tr>";
                echo '<td class="cell-label day-label" style="width: 130px">' . $value . '</td>';

                foreach ($period as $pkey => $pvalue) {
                    $checked = '';
                    if (!empty($data[$key]) && in_array($pkey, $data[$key])) $checked = "checked";
                    echo "<td class='dayparts-cell' style='width: 150px'><input type='checkbox' $checked name='dtime_" . $key . "_" . $pkey . "'></td>";
                }

                echo "</tr></td></table></td></tr>";

            } ?>
            </tbody>
        </table>

        <button type="submit">Save</button>
    </form>
</div>


<style>
    body {
        font-family: 'Open Sans';
        background: #eeeeee;
        user-select: none;
        font-weight: 400;
    }

    .dayparts-cell {
        transition: .3s;
        background-color: #d3dcde;
        width: 30px;
        height: 30px;
        margin: 0;
        padding: 0;
        border: 1px solid #ededed;
        cursor: pointer;
    }

    .active {
        transition: .3s;
        background-color: #BDE130 !important;
    }

    .day-label,
    .hour {
        cursor: pointer;
    }

    option {
        font-family: 'Open Sans'
    }

    .day-label {
        text-align: right;
        padding: 5px;
        transition: .3s;
    }

    .hour {
        transition: .3s;
    }

    .day-label:hover,
    .hour:hover {
        color: #BDE130;
    }

    .dayparts-cell:hover {
        background: #dff460;
    }

    .active:hover {
        background: #617c84 !important;
    }

    .preactive {
        color: #BDE130;
    }
</style>
</body>

</html>
