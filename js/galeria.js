var GaleriaCantidad=GALERIAINFO.length;
function HideZoom(){
    jQuery("#zooming-img").remove();
    jQuery("#andikam-modal").remove();
}
function ShowZoom(){
    var width= jQuery(window).width();
    var height= jQuery(window).height();
    jQuery("body").append("<div id='andikam-modal' style=''></div>");
    var imgInfo=GALERIAINFO[fotoact];
    var img="";
    var Orientation=imgInfo.ancho>imgInfo.alto?"P":"L";
    var img="<img id=\"zooming-img\" class=\"center-img\" style=\"\" src=\""+unescape(imgInfo.url)+"\">";
    jQuery("body").append(img);
    jQuery("#zooming-img").click(function(){HideZoom();});
    jQuery("#andikam-modal").click(function(){HideZoom();});
    $("#zooming-img").bind("contextmenu",function(){
        return false;
     });
}

function select_directo(index){
    if(index>=GaleriaCantidad){
        index=index-GaleriaCantidad;
    }
    if(index<0){
        index=GaleriaCantidad-1;
    }//(ScreenType=="SM"?400:350)
    fotoact=index;
    var bigOffset=jQuery("div.galeria-principal ul li:first-of-type").outerHeight( true );
/*    
    if(ScreenType=="XXS"){bigOffset=170;}
    if(ScreenType=="XS" && jQuery(window).width()>jQuery(window).height()){bigOffset=170;}
    if(ScreenType=="XS" && jQuery(window).width()<=jQuery(window).height()){bigOffset=350;}
    if(ScreenType=="SM"){bigOffset=400;}
    if(ScreenType=="MD"){bigOffset=350;}
    if(ScreenType=="LG"){bigOffset=350;}*/
    var offset_min=index*115+"px";
    var offset_big=index*bigOffset+"px";
    jQuery("div.miniaturas ul").css("left","-"+offset_min);
    jQuery("div.galeria-principal ul").css("top","-"+offset_big);
}
jQuery(window).load(function() {
    jQuery("#spinner").remove();
    jQuery(".center-img-container").remove();
});
jQuery(document).ready(function(){
    var miniaturas=6;
    jQuery("div.galeria-principal ul li").click(function(){ShowZoom();});
    jQuery("div.miniaturas").css("width",115*miniaturas);
    jQuery("div.miniaturas ul li:lt(5)").clone().appendTo("div.miniaturas ul");
    jQuery("div.miniaturas ul").css("width",(GaleriaCantidad+miniaturas)*115+"px");
    jQuery(".left-arrow").click(function(){
        select_directo(fotoact-1);
    });
    jQuery(".right-arrow").click(function(){
        select_directo(fotoact+1);
    });
    jQuery("div.miniaturas ul li").click(function(){
        var index=jQuery("div.miniaturas ul li").index(this);
        select_directo(index);
    });
    jQuery("div.miniaturas ul li:first-of-type").click();
    $("img").bind("contextmenu",function(){
        return false;
     });
     $( window ).resize(function() {
         select_directo(fotoact);
     });
});