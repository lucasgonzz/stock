<?php
	
namespace App\Helpers;

use DateTime;

class DateFormat{

	public static function format($array, $format, $extras = null, $diff = true, $atributes = ['creado', 'actualizado']){
		
		$dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
		$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
		
		foreach ($array as $value) {
			$value->{$atributes[0]} = date_format($value->created_at, $format);
			$value->{$atributes[1]} = date_format($value->updated_at, $format);
			if(!is_null($extras)){
				if(is_array($extras[0])){
					foreach ($extras as $extra) {
						if($extra[2] == 'l'){
							$dia = date_format($value->{$extra[1]}, $extra[2]);
							$value{$extra[0]} = str_replace($dias_EN, $dias_ES, $dia);
						}else{
							$value{$extra[0]} = date_format($value->{$extra[1]}, $extra[2]);
						}
					}
				}else{
					$value{$extras[0]} = date_format($value->{$extras[1]}, $extras[2]);
				}
			}
			if($diff){

				$now = new DateTime("now");
				$date1 = new DateTime($value->created_at);
				$diff = $now->diff($date1);
				$str = '';
			    if ($diff->y > 0) {
			        // years
			        $str .= ($diff->y > 1) ? $diff->y . ' años ' : $diff->y . ' año ';
			    } if ($diff->m > 0) {
			        // month
			        $str .= ($diff->m > 1) ? $diff->m . ' meses ' : $diff->m . ' meses ';
			    } if ($diff->d > 0) {
			        // days
			        $str .= ($diff->d > 1) ? $diff->d . ' dias ' : $diff->d . ' dia ';
			    }
				$value->created_diff = $str;

				$date2 = new DateTime($value->updated_at);
				$diff = $now->diff($date2);
				$str = '';
			    if ($diff->y > 0) {
			        // years
			        $str .= ($diff->y > 1) ? $diff->y . ' años ' : $diff->y . ' año ';
			    } if ($diff->m > 0) {
			        // month
			        $str .= ($diff->m > 1) ? $diff->m . ' meses ' : $diff->m . ' meses ';
			    } if ($diff->d > 0) {
			        // days
			        $str .= ($diff->d > 1) ? $diff->d . ' dias ' : $diff->d . ' dia ';
			    }
				$value->updated_diff = $str;
			}
		}

		return $array;
	}

	public static function formatObject($object, $format, $extras = null, $diff = true, $atributes = ['creado', 'actualizado']){
		$dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
		$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
		
		$object->{$atributes[0]} = date_format($object->created_at, $format);
		$object->{$atributes[1]} = date_format($object->updated_at, $format);
		if(!is_null($extras)){
			if(is_array($extras[0])){
				foreach ($extras as $extra) {
					if($extra[2] == 'l'){
						$dia = date_format($object->{$extra[1]}, $extra[2]);
						$object{$extra[0]} = str_replace($dias_EN, $dias_ES, $dia);
					}else{
						$object{$extra[0]} = date_format($object->{$extra[1]}, $extra[2]);
					}
				}
			}else{
				$object{$extras[0]} = date_format($object->{$extras[1]}, $extras[0]);
			}
		}
		if($diff){
			$now = new DateTime("now");
			$date1 = new DateTime($object->created_at);
			$diff = $now->diff($date1);
			$str = '';
		    if ($diff->y > 0) {
		        // years
		        $str .= ($diff->y > 1) ? $diff->y . ' años ' : $diff->y . ' año ';
		    } if ($diff->m > 0) {
		        // month
		        $str .= ($diff->m > 1) ? $diff->m . ' meses ' : $diff->m . ' meses ';
		    } if ($diff->d > 0) {
		        // days
		        $str .= ($diff->d > 1) ? $diff->d . ' dias ' : $diff->d . ' dia ';
		    }
			$object->created_diff = $str;

			$date2 = new DateTime($object->updated_at);
			$diff = $now->diff($date2);
			$str = '';
		    if ($diff->y > 0) {
		        // years
		        $str .= ($diff->y > 1) ? $diff->y . ' años ' : $diff->y . ' año ';
		    } if ($diff->m > 0) {
		        // month
		        $str .= ($diff->m > 1) ? $diff->m . ' meses ' : $diff->m . ' meses ';
		    } if ($diff->d > 0) {
		        // days
		        $str .= ($diff->d > 1) ? $diff->d . ' dias ' : $diff->d . ' dia ';
		    }
			$object->updated_diff = $str;
		}

		return $object;
	}
}