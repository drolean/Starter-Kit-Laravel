<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
 */

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/lockscreen', 'DashboardController@lockscreen')->name('lockscreen');

/*! Regras basica de usuarios, permissoes e regras */
Route::resource('/alertas', 'AlertsController');
Route::resource('/usuarios', 'UsersController');
Route::resource('/permissions', 'PermissionsController');
Route::resource('/roles', 'RolesController');
Route::resource('/tickets', 'Ticket\TicketController');
Route::resource('/empresas', 'Empresas\EmpresaController');

/*! Super Routes */
Route::get('/atividades', 'BackendController@getAtividades')->name('atividades');
Route::get('/logs', 'BackendController@getLogs')->name('logs');
Route::get('/gerar_permissions', 'PermissionsController@getGerar')->name('permissions.gerar');
Route::get('/server', 'BackendController@getServer')->name('server');

/*! Profiles */
Route::group(['namespace' => 'Profile', 'prefix' => 'profile'], function () {
    // Atualiza profile
    Route::get('/', 'ProfileController@showProfile')->name('profile.show');
    Route::post('/', 'ProfileController@updateProfile')->name('profile.show');
    // Atera Senha
    Route::get('/alterar-senha', 'ProfileController@getPassword')->name('profile.password');
    Route::post('/alterar-senha', 'ProfileController@postPassword')->name('profile.password');
    // Notificacoes
    Route::get('/notificacoes', 'ProfileController@getNotificacoes')->name('profile.notificacoes');
    Route::post('/notificacoes', 'ProfileController@postNotification')->name('profile.notificacoes');
    // Lista Atividades do usuario
    Route::get('/atividade', 'ProfileController@getAtividade')->name('profile.atividade');
    // Altera Usuario
    Route::get('/alternar/{id}', 'ProfileController@getAlternar')->name('profile.alternar');
    // Voltar ao Usuario
    Route::get('/voltar', 'ProfileController@getVoltar')->name('profile.voltar');
    // Deletar Conta
    Route::get('/delete', 'ProfileController@getDelete')->name('profile.delete');
    Route::delete('/delete', 'ProfileController@postDelete')->name('profile.delete');
    // Altera Logo da Empresa
    Route::get('/logo', 'ProfileController@getLogo')->name('profile.logo');
    Route::post('/logo', 'ProfileController@postLogo')->name('profile.logo');
    // Altera empresa do usuario
    Route::post('/companie', 'ProfileController@postCompanie')->name('profile.companie');
    // TwoFactor Authenticator
    Route::get('/2fa', 'ProfileController@getTwoFactor')->name('profile.2fa');
    Route::post('/2fa', 'ProfileController@postTwoFactor')->name('profile.2fa');
    Route::delete('/2fa', 'ProfileController@deleteTwoFactor')->name('profile.2fa');
});

/*! Notifications */
Route::group(['namespace' => 'Notifications'], function () {
    Route::post('notifications', 'NotificationController@store')->name('notification');
    Route::get('notifications', 'NotificationController@index')->name('notification');
    Route::patch('notifications/{id}/read', 'NotificationController@markAsRead')->name('notification.read');
    // Push Subscriptions
    Route::post('subscriptions', 'PushSubscriptionController@update')->name('subscription');
    Route::post('subscriptions/delete', 'PushSubscriptionController@destroy')->name('subscription.delete');
});

/*! Chat */
Route::group(['namespace' => 'Chat', 'prefix' => 'chat'], function () {
    Route::get('messages', 'ChatsController@fetchMessages')->name('messages');
    Route::post('messages', 'ChatsController@sendMessage')->name('messages');
});
