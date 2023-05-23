<?php
// time zone of nepal
// date_default_timezone_set("America/New_York");
// echo "The time is " . date("h:i:sa")."\n";
// echo date('m/d/y')."\n";
// $currentDate = strtotime(date('m/d/y'));
// echo $currentDate;

// setting nepal time zone
// date_default_timezone_set("Asia/Kathmandu");
// echo "The time is " . date("h:i:sa")."\n";
// echo date('m/d/y')."\n";
// $currentDate = strtotime(date('m/d/y'));
// echo $currentDate;



// date_default_timezone_set("Asia/Kathmandu");
// $currentDate = strtotime(date('m/d/y'));
// $twentyFourHoursLater = strtotime('+24 hours', $currentDate);
// echo $currentDate ."\n";
// echo $twentyFourHoursLater."\n";
// $selectedDate = strtotime('5/23/2023');
// echo $selectedDate."\n";

// if ($selectedDate >= $twentyFourHoursLater) {
// echo "time is greater then 24 hrs";
// }
// else{
//     echo "time is less than 24 hrs";
// }

?>

<select name="collectionSlot">
    <option value="" disabled selected>Collection Time</option>

    <?php
    $wednesday_value = strtotime('next wednesday 10:00:00');
    $wednesday = date("j M, Y", strtotime('next wednesday 10:00:00')) . " (10AM - 1PM)";
    $thursday_value = strtotime('next thursday 10:00:00');
    $thursday = date("j M, Y", strtotime('next thursday 13:00:00')) . " (1PM - 4PM)";
    $friday_value = strtotime('next friday 16:00:00');
    $friday = date("j M, Y", strtotime('next friday 16:00:00')) . " (4PM - 7PM)";

    echo '<option value="' . $wednesday_value . '">' . $wednesday . '</option>';
    echo '<option value="' . $thursday_value . '">' . $thursday . '</option>';
    echo '<option value="' . $friday_value . '">' . $friday . '</option>';
    ?>

</select>