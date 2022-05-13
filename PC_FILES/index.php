<?php
	
	include_once("../lib/devicedetector.php");
    if(!isMobileDevice()){
        //Detecta que estas accedint desde un PC
            header("Location:./PC_index.php");
        }
    // Si es mobil te lleva al home mobil o al index mobil si no estas logueado
    else if(isMobileDevice()){
		header("Location:./PC_index.php");
	}
	    	
?>