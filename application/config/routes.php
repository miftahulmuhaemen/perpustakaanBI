<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']         = 'user';
$route['404_override']                     = 'My404';
$route['translate_uri_dashes']     = FALSE;

$route['login']                                 = 'welcome/login';
$route['login/(:any)']                     = 'welcome/login/$1';
$route['daftar']                                 = 'welcome/register';
$route['daftar/(:any)']                 = 'welcome/register/$1';
$route['daftar-selesai']                 = 'Welcome/simpanUser';
$route['daftar-selesai/(:any)'] = 'Welcome/simpanUser/$1';
$route['hadir/(:any)']                     = 'welcome/hadir/$1';
$route['regis']                                 = 'welcome/saveRegis';
$route['regis/(:any)']                     = 'welcome/saveRegis/$1';
$route['pendaftaran-sukses']         = 'Welcome/sukses';
$route['resetpassword/token/(:any)']                                 = 'welcome/resetpassword/$1';

$route['cari-buku']                         = 'user';
$route['logout']                                = 'user/logout';
$route['riwayat']                              = 'user/riwayat';

$route['edit/user']                          = 'admin/editUser';
$route['dashboard']                          = 'admin/dashboard';
$route['kelola-user']                      = 'admin/kelola_user';
$route['kelola-buku']                      = 'admin/kelola_buku';
$route['kelola-corner']                  = 'admin/kelola_corner';
$route['anggota']                              = 'admin/anggota';
$route['activityArchieve']                                  = 'admin/activityArchieve';
$route['visitorArchieve']                                  = 'admin/visitorArchieve';
