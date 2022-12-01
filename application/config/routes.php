<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['get_role'] = "sistem/admin/group/ajax_list";
$route['group'] = "sistem/admin/group";
$route['FrmComeRule'] = "sistem/admin/group";
// data umum
$route['FrmComNation'] = "sistem/data_umum/FrmComNation";

// data medis
$route['FrmComJadwal'] = "sistem/data_medis/FrmComjadwal";
$route['FrmComSpesialis'] = "sistem/data_medis/FrmComSpesialis";
$route['FrmComDokter'] = "sistem/data_medis/FrmComDokter";
$route['FrmComParamedis'] = "sistem/data_medis/FrmComParamedis";
$route['FrmComUnitMedis'] = "sistem/data_medis/Frmcomunitmedis";
$route['FrmComTindakan'] = "sistem/data_medis/Frmcomtindakan";
$route['FrmComPenyakit'] = "sistem/data_medis/Frmcompenyakit";



// operasional
$route['FrmTrxPasien'] = "operasional/FrmTrxPasien";
