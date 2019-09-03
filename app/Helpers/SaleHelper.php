<?php

namespace App\Helpers;

use App\Helpers\DateFormat;

class SaleHelper {
	public static function format($sales) {
		foreach ($sales as $sale) {
            $sale->articles = DateFormat::format($sale->articles, 'd/m/Y', [['hora', 'created_at', 'G'], ['dia', 'created_at', 'l']]);
            foreach ($sale->articles as $article) {
                $article->sales = DateFormat::format($article->sales, 'd/m/Y', [['hora', 'created_at', 'G'], ['dia', 'created_at', 'l']]);
            }
        }
	}
}