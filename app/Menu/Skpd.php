<?php
namespace App\Menu;
class Skpd
{
function __construct(){
  add_module(
    [
      "sort" => 1,
      "nama_menu" => "Dashboard",
      "path"  => "skpd/dashboard",
      "icon"  => "fa-tachometer-alt",
      "function"  =>"dashboard",
      "controller"  =>"AdminSkpdController",
      "level"  => "skpd",
      "crud" => null,
      "child"  => null,
    ]
  );

  /*add_module(
    [
      "sort" => 2,
      "nama_menu" => "Master Data",
      "path"  => "skpd/realisasi",
      "icon"  => "fa-database",
      "function"  =>"dashboard",
      "controller"  =>"AdminSkpdController",
      "level"  => "skpd",
      "crud" => null,
      "child"  => array(
        [
          "sort" => 3,
          "nama_menu" => "Program",
          "path"  => "skpd/program",
          "icon"  => "fa-money-bill-alt",
          "function"  =>"programskpd",
          "controller"  =>"SkpdController",
          "crud" => null,
        ],
        [
          "sort" => 3,
          "nama_menu" => "Kegiatan",
          "path"  => "skpd/kegiatan",
          "icon"  => "fa-money-bill-alt",
          "function"  =>"realisasi",
          "controller"  =>"SkpdController",
          "crud" => null,
        ],
        [
          "sort" => 3,
          "nama_menu" => "Sub Kegiatan",
          "path"  => "skpd/sub-kegiatan",
          "icon"  => "fa-money-bill-alt",
          "function"  =>"dashboard",
          "controller"  =>"AdminController",
          "crud" => null,
        ],
      )
    ]
      );*/

      add_module(
        [
          "sort" => 3,
          "nama_menu" => "Data Kegiatan",
          "path"  => "skpd/kegiatan",
          "icon"  => "fa-chart-line",
          "function"  =>"kegiatanskpd",
          "controller"  =>"KegiatanController",
          "level"  => "skpd",
          "crud" => ['create','update','delete','edit','deletekuantitaslain','getsubkegiatans','getsubsubkegiatans'],
          "child"  => null,
        ]
      );

      add_module(
    [
      "sort" => 3,
      "nama_menu" => "Target",
      "path"  => "skpd/target",
      "icon"  => "fa-bullseye",
      "function"  =>"index",
      "controller"  =>"TargetSkpdController",
      "level"  => "skpd",
      "crud" => ['create','update','delete','edit','deletekuantitaslain'],
      "child"  => null,
    ]
  );

//   add_module(
//     [
//       "sort" => 4,
//       "nama_menu" => "Realisasi",
//       "path"  => "skpd/realisasi",
//       "icon"  => "fa-chart-line",
//       "function"  =>"index",
//       "controller"  =>"RealisasiSkpdController",
//       "level"  => "skpd",
//       "crud" => ['create','update','delete','realisasiganda','createganda'],
//       "child"  => null,
//     ]
//   );
  add_module(
    [
      "sort" => 4,
      "nama_menu" => "Realisasi",
      "path"  => "skpd/realisasi2",
      "icon"  => "fa-chart-line",
      "function"  =>"index2",
      "controller"  =>"RealisasiSkpdController",
      "level"  => "skpd",
      "crud" => ['create','update','delete','realisasiganda','createganda'],
      "child"  => null,
    ]
  );
  add_module(
    [
      "sort" => 5,
      "nama_menu" => "Data Pimpinan",
      "path"  => "skpd/pimpinan",
      "icon"  => "fa-chess-king",
      "function"  =>"updatepimpinan",
      "controller"  =>"SkpdController",
      "level"  => "skpd",
      "crud" => null,
      "child"  => null,
    ]
  );

}
}
