<?php




 ?>
<html>    
    
<body>
    <h2>Sound Information</h2>
    <div id="length">Duration:</div>
    <div id="source">Source:</div>
    <div id="status" style="color:red;">Status: Loading</div>
    <hr>
    <h2>Control Buttons</h2>
    <button id="play">Play</button>
    <button id="pause">Pause</button>
    <button id="restart">Restart</button>
    <hr>
    <h2>Playing Information</h2>
    <div id="currentTime">0</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', 'http://soundbible.com/grab.php?id=2061&type=mp3');
    
    audioElement.addEventListener('ended', function() {
        this.play();
    }, false);
    
    audioElement.addEventListener("canplay",function(){
        $("#length").text("Duration:" + audioElement.duration + " seconds");
        $("#source").text("Source:" + audioElement.src);
        $("#status").text("Status: Ready to play").css("color","green");
    });
    
    audioElement.addEventListener("timeupdate",function(){
        $("#currentTime").text("Current second:" + audioElement.currentTime);
    });
    
    $('#play').click(function() {
        audioElement.play();
        $("#status").text("Status: Playing");
    });
    
    $('#pause').click(function() {
        audioElement.pause();
        $("#status").text("Status: Paused");
    });
    
    $('#restart').click(function() {
        audioElement.currentTime = 0;
    });
});
</script>