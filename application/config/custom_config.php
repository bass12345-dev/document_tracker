<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
// Loading class config
$base_url = load_class('Config')->config['base_url'];
$config['actions']   = ["released", "hold"];
$config['month']   = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];