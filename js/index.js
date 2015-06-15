var img=0;
var ImgCant=Galeria.length;
function setImg(){
    jQuery("div.back-slider").css("background-image","url("+unescape(Galeria[img].url)+")");
    img++;
    if(img>=ImgCant){img=0;}
}
jQuery(window).load(function() {
    jQuery("#spinner").remove();
    setImg();
    setInterval(function(){setImg();},5500);
});
jQuery(document).ready(function(){

});