<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'director';
$route['registration'] = 'director/registration';
$route['destroy'] = 'director/destroy';
$route['login'] = 'director/login';
$route['add_item'] = 'items/add_item';
$route['new_item'] = 'items/new_item';
$route['item_view/(:num)'] = 'items/item_view/$1';
$route['remove_item/(:num)'] = 'items/remove_item/$1';
$route['deletefromwishlist/(:num)'] = 'items/deletefromwishlist/$1';
$route['addtowishlist/(:num)'] = 'items/addtowishlist/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;