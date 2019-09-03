<?php
namespace App\Helpers;

class SaleTotal {
	public static function getTotalPerSale($sales){
		$total = 0;
		$ventas_cont = 0;
		foreach ($sales as $sale) {
			foreach ($sale->articles as $article) {
				$total += $article->price;
				$ventas_cont ++;
			}
			$sale->total = $total;
			$total = 0;
		}
		$sales->cant_ventas = $ventas_cont;
		return $sales;
	}
	public static function getTotalPerDay($sales){

        // $fechaInicio = strtotime($sales[0]->creado);
        // $fechaFin    = strtotime($sales[count($sales-1)]->creado);

        // for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
        //     if($sale)
        // }


        $date = '';
        $total_day = 0;
        $posiciones_para_atras = 0;
        for ($i=0; $i < count($sales) ; $i++) {
            if($sales[$i]->creado != $date){
            	if($total_day == 0){
	            	$total_day += $sales[$i]->total;
	            	$date = $sales[$i]->creado;
	            	$posiciones_para_atras++;
            	}else{

                    $sales[$i]->diff = "aca cambio";

            		// // Se configuran los nuevos atributos de la venta que esta 
            		// // $posiciones_para_atras veces atras en $sales
            		// $sales[$i - $posiciones_para_atras]->otherDay = "aaa";//$sales[$i - 1]->creado;
            		// $sales[$i - $posiciones_para_atras]->totalDay = $total_day;

            		// // Se reinician las variables
            		// $total_day = 0;
            		// $posiciones_para_atras = 0;

            		// // Se vuelven a incrementar las variables para el siguiente dia
	            	// $total_day += $sales[$i]->total;
            		// $date = $sales[$i]->creado;
            		// // $posiciones_para_atras++;
            	}
            }else{
                $sales[$i]->aca = $date; 
            	$total_day += $sales[$i]->total;
            	// if($i == (count($sales) - 1)){
            	// 	// Significa que es la utima vuelta
            	// 	// $posiciones_para_atras++;
            	// 	$sales[$i - $posiciones_para_atras]->otherDay = "sadas"; // $sales[$i - $posiciones_para_atras]->creado;
            	// 	$sales[$i - $posiciones_para_atras]->totalDay = $total_day;
            		
            	// }
            	$date = $sales[$i]->creado;
            	$posiciones_para_atras++;
            }
        }
		return $sales;
	}
}