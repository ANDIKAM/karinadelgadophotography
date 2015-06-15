function replaceAll(find, replace, str) {
  return str.replace(new RegExp(find, 'g'), replace);
}
jQuery(document).ready(function(){
    $('.servicios-editar').sortable({
        forcePlaceholderSize: true 
    }).bind('sortupdate', function(e, ui) {
        var vector=[];
        $('.servicios-editar li').each(function(){
            var vect_temp=[$(this).attr("item-id"),$(this).attr("order")];
            vector.push(vect_temp);
        });
        $.post("helper_servicios.php",{"exec-action":"order-service","vect-order":vector});
    });
    $("#personal-fotografia").change(function(){
        var fullFileName=$("#personal-fotografia").val();
        
        $("#file-name-selected").text("Archivo seleccionado: "+fullFileName.substr(fullFileName.lastIndexOf("\\")+1, fullFileName.length));
    });
    $('.sliderprincipal-lista-galeria').sortable({
        forcePlaceholderSize: true 
    }).bind('sortupdate', function(e, ui) {
        var vector=[];
        $('.sliderprincipal-lista-galeria li').each(function(){
            var vect_temp=[$(this).attr("item-id"),$(this).attr("order")];
            vector.push(vect_temp);
        });
        $.post("helper_servicios.php",{"exec-action":"order-sliderprincipal-lista-galeria","vect-order":vector});
    });
});
