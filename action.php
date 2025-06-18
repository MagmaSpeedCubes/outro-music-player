<html>
<body>


<?php

$mode = $_GET['mode'];


$playtime = $_GET['playtime'];


$hours = $_GET['hours'];
$minutes = $_GET['minutes'];
$seconds = $_GET['seconds'];
$ms = $_GET['ms'];


echo "Mode: $mode<br>";
echo "Beat Drop At: $playtime<br>";
echo "Beat Drop In: {$hours}h {$minutes}m {$seconds}s {$ms}ms<br>";

?>

<script>
    var audio = new Audio('./outro-music.mp3');
    audio.preload = true;
    // JavaScript code to handle the audio playback based on the mode and playtime


    var mode = "<?php echo $mode; ?>";
    var hours = <?php echo (int)$hours; ?>;
    var minutes = <?php echo (int)$minutes; ?>;
    var seconds = <?php echo (int)$seconds; ?>;
    var ms = <?php echo (int)$ms; ?>;

    var delayTimeInMilliseconds = 0;
    if(mode == 'ExactTime'){
        var playtime = "<?php echo $playtime; ?>";
        var targetTime = new Date(playtime);
        var now = new Date();
        var delayTimeInMilliseconds = targetTime - now;


        //convert ExactTime to DelayTime
    }else if(mode == 'DelayTime'){
        
        delayTimeInMilliseconds += hours * 3600000; // hours to milliseconds
        delayTimeInMilliseconds += minutes * 60000; // minutes to milliseconds
        delayTimeInMilliseconds += seconds * 1000; // seconds to milliseconds
        delayTimeInMilliseconds += ms; // milliseconds

    }

    if(delayTimeInMilliseconds >= 58000){
        setTimeout(function() { playAudio(0); }, delayTimeInMilliseconds - 58000);
        //begins playing the audio 58 seconds before the beat drop
    }else{
        playAudio(58000 - delayTimeInMilliseconds);
        //plays the audio in the remaining time before the beat drop
    }
    //the beat drop occurs at 58 seconds

    function playAudio(startTime){
        
        audio.currentTime = startTime;
        audio.play();
    }
</script>




</body>
</html>
