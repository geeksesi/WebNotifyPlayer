<?php
global $web_url ;
?>
 SLM
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
<script src="assets/js/jquery.js"></script>

    
<script type="text/javascript">
var site_url = "<?php echo $web_url; ?>";
var user_name = "<?php echo $user_name; ?>";
// console.log(user_name);
function my_delay(message)
{


    console.log(message);
    message = jQuery.parseJSON(message);   
    switch (message.type) {
     case "fajr":
         var audio_fajr      = new Audio('http://localhost/OnlineAdhanPlayer/fajr-adhan.mp3');
         console.log("fajr delay");
         window.setTimeout(function()
                    {
                     audio_fajr.play();
                     ajax();   
                    }, message.delay);
        break;
     case "sunrise":
         var audio_sunrise   = new Audio('http://localhost/OnlineAdhanPlayer/sunrise.mp3');
         console.log("sunrise delay");
         window.setTimeout(function()
                    {
                     audio_sunrise.play();
                     ajax();   
                    }, message.delay);
        break;
     case "dhuhr":
         var audio_dhuhr     = new Audio('http://localhost/OnlineAdhanPlayer/dhuhr-adhan.mp3');
         console.log("dhuhr delay");
         window.setTimeout(function()
                    {
                     audio_dhuhr.play();
                     ajax();   
                    }, message.delay);     
         break;
     case "sunset":
         var audio_sunset    = new Audio('http://localhost/OnlineAdhanPlayer/sunset.mp3');
         console.log("sunset delay");
         window.setTimeout(function()
                    {
                     audio_sunset.play();
                     ajax();   
                    }, message.delay);        
         break;
     case "maghrib":
         var audio_maghrib   = new Audio('http://localhost/OnlineAdhanPlayer/maghrib-adhan.mp3');
         console.log("maghrib delay");
                 window.setTimeout(function()
                    {
                     audio_maghrib.play();
                     ajax();   
                    }, message.delay);
        break;
     case "delay":
        console.log("delay delay");
                 window.setTimeout(function()
                    {
                     ajax();   
                    }, message.delay);
        break;
     default:
     console.log("Sorry, we are out of " + expr + ".");
    }
//     var audio = new Audio('Careless.mp3');
//     var audio2 = new Audio('The_Hellespont.mp3');
//     // $.when().then();
//         audio.play();
// window.setTimeout(function(){
//                  audio.pause();
//                  // audio2.play();   
//                   }, message);      
}
function my_ajax() 
{
    $.ajax(
    {
	    type: 'POST',
	    url: site_url+'?user_name='+user_name,
	    data: 
	    { 
	        'check': true   
	    },
	    success: function(msg)
	    {
	        // my_delay(msg);
	        console.log(msg);
	    }
    }
    );
}
$(document).ready(my_ajax());

</script>
