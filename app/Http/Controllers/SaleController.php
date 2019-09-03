<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Article;
use Carbon\Carbon;
use App\Helpers\DateFormat;
use App\Helpers\ResultFormat;
use App\Helpers\SaleTotal;
use App\Helpers\SaleHelper;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $sales = Sale::with('article')->get();
        $fecha = Carbon::today();
        $sales = Sale::whereDate('created_at', $fecha)->orderBy('id', 'DESC')->with('article')->get();
        return $sales;
    }

    public function addItem($barCode) {
        $article = Article::where('bar_code', $barCode)->firstOrFail();
        $article->stock --;
        $article->timestamps = false;
        $article->save();
        return $article;
    }

    public function removeItem($id) {
        $article = Article::find($id);
        $article->stock ++;
        $article->timestamps = false;
        $article->save();
        return $article;
    }

    public function store(Request $request)
    {
        $ids_articles = $request->ids_articles;
        $sale = new Sale();
        $sale->save();
        $sale->articles()->attach($ids_articles);
        $sale->save();
        return;
    }

    public function today(){
        $fecha = date('Y-m-d');
        $sales = Sale::whereDate('created_at', $fecha)->orderBy('id', 'DESC')->with('articles')->get();
        foreach ($sales as $sale) {
            $sale->articles = DateFormat::format($sale->articles, 'd/m/Y', [['hora', 'created_at', 'G'], ['dia', 'created_at', 'l']]);
            foreach ($sale->articles as $article) {
                $article->sales = DateFormat::format($article->sales, 'd/m/Y', [['hora', 'created_at', 'G'], ['dia', 'created_at', 'l']]);
            }
        }
        $sales = SaleTotal::getTotalPerSale($sales);
        $sales = DateFormat::format($sales, 'd/m/Y', ['hora', 'created_at', 'G:i']);
        return $sales;
    }

    public function morning(){
        $fecha = date('Y-m-d');
        $sales = Sale::whereBetween('created_at', [$fecha . ' 08:00:00', $fecha . ' 15:00:00'])->orderBy('id', 'DESC')->with('articles')->get();
        $sales = SaleTotal::getTotalPerSale($sales);
        foreach ($sales as $sale) {
            $sale->articles = DateFormat::format($sale->articles, 'd/m/Y', [['hora', 'created_at', 'G'], ['dia', 'created_at', 'l']]);
            foreach ($sale->articles as $article) {
                $article->sales = DateFormat::format($article->sales, 'd/m/Y', [['hora', 'created_at', 'G'], ['dia', 'created_at', 'l']]);
            }
        }
        $sales = DateFormat::format($sales, 'd/m/Y', ['hora', 'created_at', 'G:i']);
        return $sales;
    }

    public function afternoon(){
        $fecha = date('Y-m-d');
        $sales = Sale::whereBetween('created_at', [$fecha . ' 15:00:00', $fecha . ' 23:59:00'])->orderBy('id', 'DESC')->with('articles')->get();
        $sales = SaleTotal::getTotalPerSale($sales);
        foreach ($sales as $sale) {
            $sale->articles = DateFormat::format($sale->articles, 'd/m/Y', [['hora', 'created_at', 'G'], ['dia', 'created_at', 'l']]);
            foreach ($sale->articles as $article) {
                $article->sales = DateFormat::format($article->sales, 'd/m/Y', [['hora', 'created_at', 'G'], ['dia', 'created_at', 'l']]);
            }
        }
        $sales = DateFormat::format($sales, 'd/m/Y', ['hora', 'created_at', 'G:i']);
        return $sales;
    }

    public function fromDate(Request $request){
        $sales = Sale::whereBetween('created_at', [$request->desde, $request->hasta])->orderBy('id', 'DESC')->with('articles')->get();
        $sales = SaleTotal::getTotalPerSale($sales);
        $sales = SaleTotal::getTotalPerDay($sales);
        foreach ($sales as $sale) {
            $sale->articles = DateFormat::format($sale->articles, 'd/m/Y', [['hora', 'created_at', 'G'], ['dia', 'created_at', 'l']]);
            foreach ($sale->articles as $article) {
                $article->sales = DateFormat::format($article->sales, 'd/m/Y', [['hora', 'created_at', 'G'], ['dia', 'created_at', 'l']]);
            }
        }
        $sales = DateFormat::format($sales, 'd/m/Y', ['hora', 'created_at', 'G:i']);
        return $sales;   
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyArticle(Request $request)
    {   
        $article = Article::findOrFail($request->article_id);
        $article->timestamps = false;
        $article->stock ++;
        $article->save();

        // $sale = Sale::find($request->sale_id);
        DB::delete('DELETE FROM article_sale WHERE article_id = ? AND sale_id = ? LIMIT 1',[$request->article_id, $request->sale_id]);
        // $sale->articles()->sync($request->articles_ids);
        // $sale->save();

    }

    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->articles()->detach();
        $sale->delete();
    }
}
