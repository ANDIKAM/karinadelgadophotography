var GaleriaCantidad=GALERIAINFO.length;
function HideZoom(){
    jQuery("#zooming-img").remove();
    jQuery("#andikam-modal").remove();
}
function ShowZoom(){
    var width= jQuery(window).width();
    var height= jQuery(window).height();
    jQuery("body").append("<div id='andikam-modal' style='position:fixed;width:"+width+"px;height:"+height+"px;top:0px;left:0px;z-index:1040;background-color:rgba(0,0,0,.5)'></div>");
    var imgInfo=GALERIAINFO[fotoact];
    var img="";
    var Orientation=imgInfo.ancho>imgInfo.alto?"P":"L";
    var img="<img id=\"zooming-img\" class=\"center-img\" style=\"position:fixed !important, z-index=10000;max-height:"+(height-100)+"px\";max-width:"+(width-100)+"px\" src=\""+unescape(imgInfo.url)+"\">";
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
    }
    fotoact=index;
    var offset_min=index*115+"px";
    var offset_big=index*350+"px";
    jQuery("div.miniaturas ul").css("left","-"+offset_min);
    jQuery("div.galeria-principal ul").css("top","-"+offset_big);
}
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
});