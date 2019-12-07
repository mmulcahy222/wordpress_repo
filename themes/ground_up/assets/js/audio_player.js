  // Asyncronously loads IFrame API code
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      //GLOBAL VARIABLES
      var every_quarter_second = undefined;
      dur = undefined;  
      // Creates IFrame when API loads
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '0',
          width: '0',
          videoId: 'gOm6B-ZV4Qk',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }
      // Call Function when ready
      function onPlayerReady(event) {
        //Done for the bar to move in the periodic poll
        dur = event.target.getDuration();
        //When you click on slider button, it will go to the part you want
        $( "#slider_timeline" ).slider({
          slide: function(e,ui){
            seconds_to_get_to = Math.floor(player.getDuration() * (ui.value/100));
            player.seekTo(seconds_to_get_to, true);  
          }
        });
        //play audio
        // event.target.playVideo();
        //IF MOBILE SITE, IT WILL START AS PAUSE BECAUSE OF MOBILE PROTECTION
        //This means that if it's not playing (it won't in a mobile site), then put in the play icon to give people the message
        if(player.getPlayerState() != 1)
        {
          $('.control_link').find("span:first").removeClass('glyphicon-pause').addClass('glyphicon-play');
        }      
      }
      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {

        //if switching songs by clicking in song title, it will reset this value so slider is in correct section
        dur = player.getDuration();

        if (event.data == YT.PlayerState.PLAYING && !done) {
          var state = player.getPlayerState();
          //IF IT'S PLAYING, THE BUTTON IS PAUSING
          $('.control_link').find("span:first").removeClass('glyphicon-play').addClass('glyphicon-pause');
          done = true;
        }
        if(state == 1){

         

          //Volume always 100
          player.setVolume(100);

          //Poll to move slider
          every_quarter_second = setInterval(periodic_poll,500); 
        }
      }

      function periodic_poll() {

            var mind = player.getCurrentTime();   // returns elapsed time in seconds 
            var m = Math.floor(mind / 60);
            var secd = mind % 60;
            var s = Math.ceil(secd);

            var dm = Math.floor(dur / 60);
            var dsecd = dur % 60;
            var ds = Math.ceil(dsecd)
            var playbackPercent = mind/dur;
            var sliderValue = playbackPercent * 100;

            $( "#slider_timeline" ).slider({ 
              range: "min",
              min:0,
              value: sliderValue,
            });

             //display time
             $('.music_time').text(m + ":" + n(s));

           }
           function n(n){
            return n > 9 ? "" + n: "0" + n;
          } 
          //CHANGE THE BUTTON
          function change_button(el)
          {
            if(typeof player != "undefined")
            {
              state = player.getPlayerState();
            }
            else
            {
              console.log("Nothing Happened");
              return;
            }

            glyph_element = $(el).find("span:first");
            if(state == 1)
            {
              glyph_element.removeClass('glyphicon-pause').addClass('glyphicon-play');
              player.pauseVideo();
              clearInterval(every_quarter_second);
            }
            else if(state == 2)
            {
              glyph_element.removeClass('glyphicon-play').addClass('glyphicon-pause');
              player.playVideo();
              every_quarter_second = setInterval(periodic_poll,250); 
            }
            else if(state == 0)
            {
              glyph_element.removeClass('glyphicon-play').addClass('glyphicon-pause');
              player.playVideo();
              every_quarter_second = setInterval(periodic_poll,250); 
            }
            else if(state == 5)
            {
              glyph_element.removeClass('glyphicon-play').addClass('glyphicon-pause');
              player.playVideo();
              every_quarter_second = setInterval(periodic_poll,250); 
            }
            else
            {
             player.playVideo();
           }
         }  


         function switch_song(el)
         {

          curr_element = $(el);  
          mcp = $('#my_custom_player');

          //change song
          player.loadVideoById(curr_element.attr('video-id'));
          $("#glyph_holder").removeClass('glyphicon-play').addClass('glyphicon-pause');

          //redo polling 
          dur = player.getDuration();

          clearInterval(every_quarter_second);
          every_quarter_second = setInterval(periodic_poll,500)

          //animate
          padding_of_player = $('#my_custom_player').css("padding");
          mcp.hide();
          mcp.appendTo(curr_element);
          mcp.slideDown(
          {
            duration: 250,
            start: function(){
              mcp.css({padding:padding_of_player});
            }
          }
          );

          //account for time in the song
          split_time = curr_element.attr("time").split(":");
          best_total_seconds = (parseInt(split_time[0]) * 60) + parseInt(split_time[1])
          player.seekTo(best_total_seconds, true);  
        }