<?php
    include_once dirname(__FILE__).'/../basics/login.php';
    if(isset($_REQUEST["exec-action"])){ //Verifica si hay acciones pendientes
    //Servicios
        if($_REQUEST["exec-action"]==="new-service" && isset($_REQUEST["servicio-nuevo"])){ //Inserta un nuevo servicio
            $SERVICIOSINFO->InsertServicio($_REQUEST["servicio-nuevo"]);
        }
        
        if($_REQUEST["exec-action"]==="edit-service" && isset($_REQUEST["service-id"])&& isset($_REQUEST["servicio-edit"])){ //Edita un servicio
            $SERVICIOSINFO->setServicio($_REQUEST["service-id"],$_REQUEST["servicio-edit"]);
        }
        
        if($_REQUEST["exec-action"]==="del-service" && isset($_REQUEST["service-id"])){ //Elimina un servicio
            $SERVICIOSINFO->deleteServicio($_REQUEST["service-id"]);
        }
        if($_REQUEST["exec-action"]==="order-service" && isset($_REQUEST["vect-order"])){ //Elimina un servicio
            $SERVICIOSINFO->ordenarServicios($_REQUEST["vect-order"]);
        }
        
        if($_REQUEST["exec-action"]==="order-sliderprincipal-lista-galeria" && isset($_REQUEST["vect-order"])){ //Elimina un servicio
            $SLIDERINFO->ordenarImagenes($_REQUEST["vect-order"]);
        }
        
        if($_REQUEST["exec-action"]==="order-sliderprincipal-lista-galeria" && isset($_REQUEST["vect-order"])){ //Elimina un servicio
            $SLIDERINFO->ordenarImagenes($_REQUEST["vect-order"]);
        }
    }
?>
