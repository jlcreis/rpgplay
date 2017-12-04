<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'jogadores'], function () {
    Route::get('/', 'JogadorController@index')->name('jogadores');
    Route::get('/{id}', 'JogadorController@show')->name('jogador');
    Route::post('/{id}/edit', 'JogadorController@update')->name('editaUsuario');
    Route::delete('jogador/{id}', 'JogadorController@destroy')->name('deletarJogador');
    Route::post('/novoJogador', 'JogadorController@create')->name('criarJogador');
});

Route::group(['prefix' => 'partidas'], function () {
    Route::get('/', 'PartidaController@index')->name('partidas');
    Route::get('/create', 'PartidaController@create')->name('criarPartida');
    Route::post('/gravar', 'PartidaController@store')->name('gravarPartida');
    Route::get('/pesquisa_jogador', 'JogadorController@listaJogadores')->name('listaJogadores');
    Route::get('/{id}/configuração','PartidaController@show')->name('configurarPartida');
    Route::get('/{id_partida}/aceitar_convite','PartidaController@aceitarConvite')->name('aceitarConvite');
    Route::get('/{id_partida}/personagemSecundario','PartidaController@personagemSecundario')->name('personagemSecundario');
    Route::get('/{id_partida}/recusar_convite','PartidaController@recusarConvite')->name('recusarConvite');
    Route::get('/[{id_personagem},{id_partida}]/importar', 'PartidaController@importarPersonagem')->name('importarPersonagem');
    Route::delete('personagemSecundario/{id}', 'PartidaController@deletarPersonagemPartida')->name('deletarPersonagemSecundario');
});

Route::group(['prefix' => 'personagens'], function () {
    Route::get('/', 'PersonagemController@index')->name('personagens');
    Route::get('/novo', 'PersonagemController@create')->name('criarPersonagem');
    Route::post('/gravar', 'PersonagemController@store')->name('gravarPersonagem');
    Route::get('/{id}/edit', 'PersonagemController@edit')->name('editarPersonagem');
    Route::get('/{vatar}/editAvatar', 'PersonagemController@editAvatar')->name('editarAvatarPersonagem');
    Route::post('/{id}/update', 'PersonagemController@update')->name('atualizarPersonagem');
    Route::post('/{avatar}/updateAvatar', 'PersonagemController@updateAvatar')->name('atualizarAvatarPersonagem');
    Route::delete('personagem/{id}', 'PersonagemController@destroy')->name('deletarPersonagem');
});

Route::group(['prefix' => 'jogar'], function () {
    Route::get('/{id_partida}', 'JogarController@index')->name('jogar');
    Route::post('/{id_partida}/acao', 'JogarController@acao')->name('acao');
    Route::post('/historicoAcao', 'JogarController@historicoAcoes')->name('historicoAcoes');
    Route::post('/statusPartida', 'JogarController@statusPartida')->name('statusPartida');
});
