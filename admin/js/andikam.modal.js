(function ( $ ) {
 
    $.fn.AndikamModalDialog = function( options ) {
        var settings = $.extend({
            ancho:"300px",
            alto:"300px",
            titulo:"",
            destroy:function(){jQuery('#andikam-modal').remove();
            jQuery('#andikam-modal-window').remove();},
            ok:function(){jQuery('#andikam-modal').remove();
            jQuery('#andikam-modal-window').remove();},
            buttons:{ok:false}
        }, options);        
        settings.buttons=$.extend({
            ok:false,
            okclass:"btn-primary",
            noclass:"btn-danger"
        },settings.buttons);
        var width= jQuery(window).width();
        var height= jQuery(window).height();
        var buttons="<a id=\"Cancelar\" class=\"btn "+settings.buttons.noclass+"\" style=\"width:100px;\" role=\"button\" >Cancelar<\a>";
        if(settings.buttons.ok===true){
            buttons="<a id=\"Aceptar\" class=\"btn "+settings.buttons.okclass+"\" style=\"margin-right:5px; width:100px;\" role=\"button\" >Aceptar<\a>"+buttons;
        }
        buttons="<div style=\"width:100%;text-align:right\">"+buttons+"</div>";
        jQuery("body").append("<div id='andikam-modal' style='position:fixed;width:"+width+"px;height:"+height+"px;top:0px;left:0px;z-index:1040;background-color:rgba(0,0,0,.5)'></div>"+
                "<div id='andikam-modal-window' style='position: fixed;margin: auto;top: 0;left: 0;right: 0;bottom: 0;z-index:9999;width:"+settings.ancho+"px; height:"+settings.alto+"px'>"+
                "<div class=\"panel panel-primary\" style=\"width:"+settings.ancho+"px; height:"+settings.alto+"px\">"+
                    "<div class=\"panel-heading\"><div style=\"width:100%; text-align:center;overflow-x:hidden; font-size:large\"><strong>"+settings.titulo+"</strong></div></div>"+
                        "<div class=\"panel-body\">"+
                        "</div>"+
                        "<div class=\"panel-footer\" style=\"position:absolute;bottom:0;width:"+(settings.ancho-2)+"px;\">"+
                        buttons+
                        "</div>"+
                    "</div>"+
                "</div>");
        
        jQuery("#andikam-modal-window .panel-body").append(this);
        jQuery("#andikam-modal-window .panel-footer #Cancelar").click(settings.destroy);
        if(settings.buttons.ok===true){
            /*jQuery("#andikam-modal-window .panel-footer #Aceptar").bind("click",
                                function(){
                                    jQuery("#andikam-modal-window .panel-footer #Aceptar").attr("disabled","disabled");
                                });*/
            jQuery("#andikam-modal-window .panel-footer #Aceptar").click(settings.ok);
        }
    };
 
}( jQuery ));