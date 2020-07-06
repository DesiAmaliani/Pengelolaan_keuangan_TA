<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login_client';
$route['admin'] = 'login_admin';
$route['register'] = 'login_admin/register';
$route['kasir'] = 'login_kasir';
$route['admin/kasir'] = 'kasir/index';
$route['admin/client'] = 'client/index';
$route['admin/admin'] = 'admin/index';
$route['admin/paket'] = 'paket/index';
$route['admin/tagihan'] = 'tagihan/index';
$route['admin/profil'] = 'login_admin/profil';
$route['admin/pemasukan'] = 'pemasukan/index';
$route['admin/laporan_pertahun'] = 'laporan_pertahun/index';
$route['admin/laporan_perbulan'] = 'laporan_perbulan/index';
$route['admin/pengeluaran'] = 'pengeluaran/index';
$route['admin/transaksi'] = 'transaksi/index';
$route['admin/beranda_admin'] = 'login_admin/home';
$route['kasir/profil'] = 'login_kasir/profil';
$route['kasir/beranda_kasir'] = 'login_kasir/home';
$route['kasir/pembayaran'] = 'pembayaran_kasir/index';
$route['client/beranda_client'] = 'login_client/home';
$route['client/pembayaran'] = 'pembayaran_client/index';
$route['client/profil'] = 'login_client/profil';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
