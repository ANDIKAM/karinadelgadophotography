var img=1;
var ViewPort = jQuery(window).width();
var Container =ViewPort<768?0:(ViewPort<992?750:(ViewPort<1200?970:1170));
function SetPosObjects(){
    var IniContainer=(ViewPort-Container)/2;
    jQuery("div.logo").css("left",IniContainer);
    
}
function setImg(){
    var imgtemp=img<=9?"0"+img:img;
    jQuery("div.back-slider").css("background-image","url(galeria/"+imgtemp+".jpg)");
    img++;
    if(img>8){img=1;}
}
jQuery(window).load(function() {
    jQuery("#spinner").remove();
    setImg();
    setInterval(function(){setImg();},5500);
});
(function($) { 
	/*
	 * Plugin defaults 
	 */
	var defaults = {
			images : ['http://dharmmotyar.googlecode.com/svn/trunk/images/spark.png', 'http://dharmmotyar.googlecode.com/svn/trunk/images//spark2.png',
			'http://dharmmotyar.googlecode.com/svn/trunk/images/spark3.png', 'http://dharmmotyar.googlecode.com/svn/trunk/images/spark4.png'],
			total : 10,
			ofTop: 0,
			ofLeft: 0,
			on:'document.body',
			twinkle: 0.2
	};
	$.firefly = function(settings) {

			$.firefly.settings = $.extend({}, defaults, settings);
			$.firefly.eleHeight = $($.firefly.settings.on).height();
			$.firefly.eleWidth = $($.firefly.settings.on).width();
			if($.firefly.settings.on!=='document.body'){
				var off = $($.firefly.settings.on).offset();
				$.firefly.offsetTop = off.top;
				$.firefly.offsetLeft = off.left;
				$.firefly.eleHeight = $($.firefly.settings.on).height();
				$.firefly.eleWidth = $($.firefly.settings.on).width();
			}
			else{
				$.firefly.offsetTop = 0;
				$.firefly.offsetLeft = 0;
				$.firefly.eleHeight = $(document.body).height();
				$.firefly.eleWidth = $(document.body).width();

			}

			
		
			if($.firefly.preloadImages()){
			for (i = 0; i < $.firefly.settings.total; i++){
				 $.firefly.fly($.firefly.create($.firefly.settings.images[$.firefly.random(($.firefly.settings.images).length)]));
			}
			}
			return;
	};
	
	/*
	 * Public Functions
	 */

	 $.firefly.create = function(img){
					spark = $('<img>').attr({'src' : img}).hide();
					if($.firefly.settings.on === 'document.body')
					 $(document.body).append(spark);
					 else
					 $($.firefly.settings.on).append(spark);
							return spark.css({
								            'position':'absolute',
												
										    'z-index': -1*$.firefly.random(20), //under all the stuff
											top: $.firefly.offsetTop + $.firefly.random(($.firefly.eleHeight-50)),	//offsets
											left:  $.firefly.offsetLeft + $.firefly.random(($.firefly.eleWidth-50)) //offsets
											}).show();		
	 }
    


$.firefly.fly = function(sp) {
	
  $(sp).animate({
	  top: $.firefly.offsetTop + $.firefly.random(($.firefly.eleHeight-50)),	//offsets
	  left: $.firefly.offsetLeft + $.firefly.random(($.firefly.eleWidth-50)),
	  opacity: $.firefly.opacity($.firefly.settings.twinkle)
  }, (($.firefly.random(10) + 5) * 2000),function(){  $.firefly.fly(sp) } );
};

$.firefly.stop = function(sp) {
  $(sp).stop();
};


$.firefly.preloadImages = function() {
	var preloads = new Object();
	for (i = 0; i < ($.firefly.settings.images).length; i++){  
			preloads[i] = new Image(); preloads[i].src =  $.firefly.settings.images[i];
        }
	return true;
}

$.firefly.random = function(max) {
	return Math.ceil(Math.random() * max) - 1;
}
// set twinkle.
$.firefly.opacity = function(min)
{
        op= Math.random();
        if(op < min)
                return 0;
        else
                return 1;
}		
})(jQuery);
jQuery(document).ready(function(){
    $.firefly({
     //images : ['images/fly1by1.png', 'images/fly2by2.png'], //You can change images
     total : 100, // You can edit the number of flies
     on: "#flyeffect"
     
    });
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
    my_jPlayer.jPlayer("play");
    my_jPlayer.click(function(){
        my_jPlayer.toggleClass("jp-play");
        my_jPlayer.toggleClass("jp-pause");
        if(my_jPlayer.hasClass("jp-play")){
            my_jPlayer.jPlayer("pause");
        }else{
            my_jPlayer.jPlayer("play");
        }
    });
    SetPosObjects();
    jQuery(document).resize(function(){
        SetPosObjects();
    })
});