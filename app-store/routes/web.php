<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/app-store', function () {
    return view('helloworld');
})->name("app");

//o que está entre {} será tratado como um parâmetro e recebido na function
//de ordem sequêncial, com o "?", torna o parâmetro opcional na rota, sendo assim, ele toma
//o valor setado no recebmento da função como padrão
//where funciona com a regex que se espera receber desses parâmetros passados, se a regex não for obedecida,
//então é redicionada a uma página de erro
Route::get("/app-store/teste/{n1}/{n2?}", function($n1, $n2=0) {
    return "Isso é um teste de parâmetro: ".$n1 * $n2;
})  ->where('n1', '[0-9]{1,}')
    ->where('n2', '[0-9]{0,}')
    ->name("app.teste");
    
//agrupamento de rotas a partir da função prefix
//sendo assim localhost:8000/app-store/group/my-app
Route::prefix("/app-store/group")->group(function() {
    Route::get("/my-app", function(){ return "My app!";});
    Route::get("/testing", function(){ return "Testing...!";});
    
});

Route::get("/app-store/example", function() {
    return view("welcome");
})->name("app.example");

//redireciona a uma pagina

Route::redirect("teste", "/app-store/example", 301);

Route::get('testeapp2', function() {
    return redirect()->route("app.example");
});

Route::post('/requisicoes', function(Request $request){
    //toda solicitação de rota que não seja por get, necessita do token csrf;
    //para fins de teste, desabilitarei o token em: app/controllers/middleware/verifycsrftoken.php - $except
    echo  "TESTE POST";
});

Route::delete('/requisicoes', function(Request $request){
    echo  "TESTE DELETE";
});

Route::put('/requisicoes', function(Request $request){
    echo  "TESTE PUT";
});
Route::patch('/requisicoes', function(Request $request){
    echo  "TESTE PATCH";
});