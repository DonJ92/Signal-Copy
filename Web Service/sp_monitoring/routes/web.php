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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/accountlist', 'AccountListController@index')->name('accountlist');
Route::post('/getaccountlist', 'AccountListController@getAccountList')->name('getaccountlist');
Route::get('/accountlist/register', 'AccountListController@register')->name('accountlist.register');
Route::post('/accountlist/register', 'AccountListController@registerAction')->name('accountlist.registeraction');
Route::get('/accountlist/detail/{id}', 'AccountListController@detail')->name('accountlist.detail');
Route::post('/accountlist/update', 'AccountListController@updateAction')->name('accountlist.updateaction');
Route::get('/accountlist/delete/{id}', 'AccountListController@deleteAction')->name('accountlist.deleteaction');

Route::get('/vpslist', 'VPSListController@index')->name('vpslist');
Route::post('/getvpslist', 'VPSListController@getVPSList')->name('getvpslist');
Route::get('/vpslist/register', 'VPSListController@register')->name('vpslist.register');
Route::post('/vpslist/register', 'VPSListController@registerAction')->name('vpslist.registeraction');
Route::get('/vpslist/detail/{id}', 'VPSListController@detail')->name('vpslist.detail');
Route::post('/vpslist/update', 'VPSListController@updateAction')->name('vpslist.updateaction');
Route::get('/vpslist/delete/{id}', 'VPSListController@deleteAction')->name('vpslist.deleteaction');

Route::get('/broker', 'BrokerController@index')->name('broker');
Route::post('/getbrokerlist', 'BrokerController@getBrokerList')->name('getbrokerlist');
Route::get('/broker/register', 'BrokerController@register')->name('broker.register');
Route::post('/broker/register', 'BrokerController@registerAction')->name('broker.registeraction');
Route::get('/broker/detail/{id}', 'BrokerController@detail')->name('broker.detail');
Route::post('/broker/update', 'BrokerController@updateAction')->name('broker.updateaction');
Route::get('/broker/delete/{id}', 'BrokerController@deleteAction')->name('broker.deleteaction');


Route::get('/spclient', 'SPClientController@index')->name('spclient');
Route::post('/getspclientlist', 'SPClientController@getSPClientList')->name('getspclientlist');
Route::get('/spclient/register', 'SPClientController@register')->name('spclient.register');
Route::post('/spclient/register', 'SPClientController@registerAction')->name('spclient.registeraction');
Route::get('/spclient/detail/{id}', 'SPClientController@detail')->name('spclient.detail');
Route::post('/spclient/update', 'SPClientController@updateAction')->name('spclient.updateaction');
Route::get('/spclient/delete/{id}', 'SPClientController@deleteAction')->name('spclient.deleteaction');
Route::get('/spclient/getnewtoken', 'SPClientController@getNewToken')->name('spclient.getnewtoken');

Route::get('/paramhistory', 'ParamHistoryController@index')->name('paramhistory');
Route::post('/getparamhistory', 'ParamHistoryController@getParamHistory')->name('getparamhistory');

Route::get('/paramstate', 'ParamStateController@index')->name('paramstate');
Route::post('/getparamstatelist', 'ParamStateController@getParamStateList')->name('getparamstatelist');
Route::get('/paramstate/detail/{id}', 'ParamStateController@detail')->name('paramstate.detail');

Route::get('/account-detail', 'AccountDetailController@index')->name('accdetail');
Route::get('/account-detail/detail/{id?}', 'AccountDetailController@detail')->name('accdetail.detail');
Route::get('/account-detail/action/activate/{id?}', 'AccountDetailController@actionActivateClient')->name('accdetail.action.active');
Route::get('/account-detail/action/deactivate/{id?}', 'AccountDetailController@actionDeactivateClient')->name('accdetail.action.deactive');
Route::get('/account-detail/action/close-all/{id?}', 'AccountDetailController@actionCloseAllClient')->name('accdetail.action.closeall');
Route::any('/ajax-account-detail', 'AccountDetailController@getAccountDetailList')->name('accdetail.ajax.post');

Route::get('/filestate', 'FileStateController@index')->name('filestate');
Route::post('/getfilestate', 'FileStateController@getFileStateHistory')->name('getfilestate');

/*Route::get('/brokerlist', 'BrokerController@index')->name('brokerlist');
Route::post('/getbrokerlist', 'BrokerController@getBrokerList')->name('getbrokerlist');
Route::get('/broker/register', 'BrokerController@register')->name('broker.register');
Route::post('/broker/register', 'BrokerController@registerAction')->name('broker.registeraction');
Route::get('/broker/detail/{id}', 'BrokerController@detail')->name('broker.detail');
Route::post('/broker/update', 'BrokerController@updateAction')->name('broker.updateaction');

Route::get('/clientlist', 'ClientController@index')->name('clientlist');
Route::post('/getclientlist', 'ClientController@getClientList')->name('getclientlist');
Route::get('/client/register', 'ClientController@register')->name('client.register');
Route::post('/client/register', 'ClientController@registerAction')->name('client.registeraction');
Route::get('/client/detail/{id}', 'ClientController@detail')->name('client.detail');
Route::post('/client/update', 'ClientController@updateAction')->name('client.updateaction');*/


/*Route::get('/vps/servicelist', 'VPSController@serviceList')->name('vps.servicelist');
Route::post('/vps/getservicelist', 'VPSController@getServiceList')->name('vps.getservicelist');
Route::get('/vps/serviceregister', 'VPSController@serviceRegister')->name('vps.serviceregister');
Route::post('/vps/serviceregister', 'VPSController@serviceRegisterAction')->name('vps.serviceregisteraction');
Route::get('/vps/servicedetail/{id}', 'VPSController@serviceDetail')->name('vps.servicedetail');
Route::post('/vps/serviceupdate', 'VPSController@serviceUpdateAction')->name('vps.serviceupdateaction');*/

Route::get('/setting', 'SettingController@index')->name('setting');
Route::post('/updatepwd', 'SettingController@updatePwd')->name('setting.updatepwd');