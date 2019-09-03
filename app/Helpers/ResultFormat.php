<?php

namespace App\Helpers;

use Carbon\Carbon;

class ResultFormat{

	public static function format($articles){
        $fechaMinima = Carbon::now()->subMonths(6);

		foreach ($articles as $article) {
			$article->cost = number_format($article->cost, 0, "", ".");
			$article->price = number_format($article->price, 0, "", ".");
			$article->previus_price = number_format($article->previus_price, 0, ",", ".");
			if($article->updated_at < $fechaMinima){
			    $article->style ="old";
			}
			if($article->stock == 1 ){
			    $article->style ="warning";
			}
			if($article->stock == 0 ){
			    $article->style ="danger";
			}
		}

		return $articles;
	}

	public static function pricesFormat($articles) {
		foreach ($articles as $article) {
			$article->cost = number_format($article->cost, 0, "", ".");
			$article->price = number_format($article->price, 0, "", ".");
		}
		return $articles;
	}

}
