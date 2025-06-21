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

<audio id="outro-music" 
   preload="auto" 
   src="./outro-music.mp3" >

</audio>

<script>
    var audio = document.getElementById('outro-music');
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
        delayTimeInMilliseconds = targetTime - now;


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

    function playAudio(startTimeInMilliseconds) {



        var startTime = startTimeInMilliseconds / 1000; // Convert milliseconds to seconds
        function seekAndPlay() {
            console.log("Start Time:"+startTime);
            audio.currentTime = startTime;
            console.log("Current Time:"+audio.currentTime);
            audio.play();
        }

        if (audio.readyState >= 1) { // HAVE_METADATA
            seekAndPlay();
        } else {
            audio.addEventListener('loadedmetadata', function handler() {
                audio.removeEventListener('loadedmetadata', handler);
                seekAndPlay();
            });
            audio.load();
        }
    }
</script>




</body>
</html>
