<?php
namespace App\Menu;
class kaban
{
  function __construct(){

    add_module(
      [
        "sort" => 1,
        "nama_menu" => "Dashboard",
        "path"  => "kaban/dashboard",
        "icon"  => "fa-tachometer-alt",
        "function"  =>"dashboard",
        "controller"  =>"KabanController",
        "level"  => "kaban",
        "crud" => null,
        "child"  => null,
      ]
      );

      add_module(
        [
          "sort" => 1,
          "nama_menu" => "Target & Realisasi",
          "path"  => "kaban/realisasi-skpd",
          "icon"  => "fa-chart-line",
          "function"  =>"realisasi",
          "controller"  =>"KabanController",
          "level"  => "kaban",
          "crud" => null,
          "child"  => null,
        ]
        );
  }
}
