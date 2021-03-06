var ViewPort = jQuery(window).width();
var Container =ViewPort<768?0:(ViewPort<992?750:(ViewPort<1200?970:1170));
var ScreenType=ViewPort<480?"XXS":(ViewPort<768?"XS":(ViewPort<992?"SM":(ViewPort<1200?"MD":"LG")));
jQuery(document).ready(function(){
   /* jQuery(".leaves-right").octoberLeaves({
    leafStyles: 1,      // Number of leaf styles in the sprite (leaves.png)
    speedC: 0.5,  // Speed of leaves
    rotation: 1,// Define rotation of leaves
    rotationTrue: 0,    // Whether leaves rotate (1) or not (0)
    numberOfLeaves: 1, // Number of leaves
    size: 20,   // General size of leaves, final size is calculated randomly (with this number as general parameter)
    cycleSpeed: 100,      // <a href="http://www.jqueryscript.net/animation/">Animation</a> speed (Inverse frames per second) (10-100)
    container:".leaves-right"
    });*/
    if(ScreenType=="MD" || ScreenType=="LG"){
        var	my_jPlayer = $(".audioplayer");
        var	opt_play_first = true;
        my_jPlayer.jPlayer({
            ready: function () {
                    //$("#jp_container .track-default").click();
            },
            timeupdate: function(event) {
                    //my_extraPlayInfo.text(parseInt(event.jPlayer.status.currentPercentAbsolute, 10) + "%");
            },
            play: function(event) {
                    //my_playState.text(opt_text_playing);
            },
            pause: function(event) {
                    //my_playState.text(opt_text_selected);
            },
            ended: function(event) {
                    my_jPlayer.jPlayer("play");
            },
            swfPath: "../../dist/jplayer",
            cssSelectorAncestor: "#jp_container",
            supplied: "mp3",
            wmode: "window"
        });
        my_jPlayer.jPlayer("setMedia", {
            mp3: "sound/sonido.mp3"
        });
        my_jPlayer.click(function(){
            my_jPlayer.toggleClass("jp-play");
            my_jPlayer.toggleClass("jp-pause");
            if(my_jPlayer.hasClass("jp-play")){
                my_jPlayer.jPlayer("pause");
            }else{
                my_jPlayer.jPlayer("play");
            }
        });
        my_jPlayer.jPlayer("play");
    }
    jQuery(".menu-mov").click(function(){
        var menumovil=jQuery(".menu-movil-container");
        jQuery(menumovil).toggleClass("menu-mov-oculto");
        jQuery(menumovil).toggleClass("menu-mov-mostrar");
    });
});