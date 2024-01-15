<?php
namespace App\Menu;
class superadmin
{
  function __construct(){
    add_module(
      [
        "sort" => 2,
        "nama_menu" => "Data Master",
        "path"  => null,
        "icon"  => "fa-database",
        "function"  =>"dashboard",
        "controller"  =>"SkpdController",
        "level"  => "admin",
        "crud" => null,
        "child"  => array(
          [
            "sort" => 7,
            "nama_menu" => "Data SKPD",
            "path"  => "admin/skpd",
            "icon"  => "fa-money-bill-alt",
            "function"  =>"skpd",
            "controller"  =>"SkpdController",
            "crud" => ['create','edit','delete'],
          ],

          [
            "sort" => 1,
            "nama_menu" => "Periode Pemerintahan",
            "path"  => "admin/periode",
            "icon"  => "fa-money-bill-alt",
            "function"  =>"periode",
            "controller"  =>"PeriodeController",
            "crud" => ['create','edit','delete'],
          ],
          [
            "sort" => 2,
            "nama_menu" => "Urusan Pemerintahan",
            "path"  => "admin/urusan",
            "icon"  => "fa-money-bill-alt",
            "function"  =>"urusan",
            "controller"  =>"UrusanController",
            "crud" => ['create','edit','delete'],
          ],
           [
            "sort" => 3,
            "nama_menu" => "Bidang Urusan",
            "path"  => "admin/bidangurusan",
            "icon"  => "fa-money-bill-alt",
            "function"  =>"bidangurusan",
            "controller"  =>"BidangUrusanController",
            "crud" => ['create','edit','delete'],
          ],
          [
            "sort" => 1,
            "nama_menu" => "Program Unggulan",
            "path"  => "admin/program-unggulan",
            "icon"  => "fa-money-bill-alt",
            "function"  =>"programunggulan",
            "controller"  =>"ProgramUnggulanController",
            "crud" => ['create','edit','delete'],
          ],
          [
            "sort" => 3,
            "nama_menu" => "Program",
            "path"  => "admin/program",
            "icon"  => "fa-money-bill-alt",
            "function"  =>"program",
            "controller"  =>"ProgramController",
            "crud" => ['create','edit','delete'],
          ],
          [
            "sort" => 3,
            "nama_menu" => "Data Kegiatan",
            "path"  => "admin/data_kegiatan",
            "icon"  => "fa-money-bill-alt",
            "function"  =>"Kegiatan",
            "controller"  =>"dataKegiatanController",
            "crud" => ['create','edit','delete'],
          ],
          [
            "sort" => 5,
            "nama_menu" => "Kegiatan & SUB SKPD",
            "path"  => "admin/kegiatan",
            "icon"  => "fa-money-bill-alt",
            "function"  =>"kegiatan",
            "controller"  =>"KegiatanController",
            "crud" => ['create','edit','delete','getsubkegiatans','getsubsubkegiatans'],
          ],
          /*[
            "sort" => 5,
            "nama_menu" => "Sub Kegiatan",
            "path"  => "admin/sub-kegiatan",
            "icon"  => "fa-money-bill-alt",
            "function"  =>"subkegiatan",
            "controller"  =>"SubKegiatanController",
            "crud" => ['create','edit','delete'],
          ]*/
        ),
      ]
      );

      add_module(
        [
          "sort" => 10,
          "nama_menu" => "User SKPD",
          "path"  => "admin/user",
          "icon"  => "fa-users",
          "function"  =>"akunskpd",
          "controller"  =>"UserController",
              "level"  => "admin",
              "crud" => ['create','edit','delete'],
          "child"  => null
        ]
        );
        add_module(

         [
          "sort" => 3,
          "nama_menu" => "Target",
          "path"  => null,
          "icon"  => "fa-exchange-alt",
          "function"  =>"dashboard",
          "controller"  =>"SkpdController",
          "level"  => "admin",
          "crud" => null,
          "child"  => array(

            [
              "sort" => 3,
              "nama_menu" => "Pagu SKPD",
              "path"  => "admin/target-skpd",
              "icon"  => "fa-money-bill-alt",
              "function"  =>"target",
              "controller"  =>"SkpdController",
              "crud" => null,
            ],
            // [
            //   "sort" => 3,
            //   "nama_menu" => "Pagu Per Kegiatan",
            //   "path"  => "admin/target-skpdddd",
            //   "icon"  => "fa-money-bill-alt",
            //   "function"  =>"realisasi",
            //   "controller"  =>"SkpdController",
            //   "crud" => null,
            // ]
          )
          ],
        );

        add_module(
          [
            "sort" => 3,
            "nama_menu" => "Realisasi",
            "path"  => null,
            "icon"  => "fa-chart-bar",
            "function"  =>"dashboard",
            "controller"  =>"SkpdController",
            "level"  => "admin",
            "crud" => null,
            "child"  => array(

              [
                "sort" => 3,
                "nama_menu" => "Realisasi SKPD",
                "path"  => "admin/realisasi-skpd",
                "icon"  => "fa-money-bill-alt",
                "function"  =>"realisasi",
                "controller"  =>"SkpdController",
                "crud" => null,
              ],
              // [
              //   "sort" => 3,
              //   "nama_menu" => "Realisasi Per Kegiatan",
              //   "path"  => "admin/target-skpdsss",
              //   "icon"  => "fa-money-bill-alt",
              //   "function"  =>"realisasi",
              //   "controller"  =>"SkpdController",
              //   "crud" => null,
              // ]
            )
            ]
              );
  add_module(
    [
      "sort" => 1,
      "nama_menu" => "Dashboard",
      "path"  => "admin/dashboard",
      "icon"  => "fa-tachometer-alt",
      "function"  =>"dashboard",
      "controller"  =>"AdminController",
      "level"  => "admin",
      "crud" => null,
      "child"  => null,
    ]
    );
  /*add_module(
    [
      "sort" => 4,
      "nama_menu" => "Laporan",
      "path"  => null,
      "icon"  => "fa-print",
      "function"  =>"dashboard",
      "controller"  =>"SkpdController",
      "level"  => "admin",
      "crud" => null,
      "child"  => array(

        [
          "sort" => 3,
          "nama_menu" => "Grafik Penyerapan OPD",
          "path"  => "admin/report",
          "icon"  => "fa-money-bill-alt",
          "function"  =>"report",
          "controller"  =>"ReportController",
          "crud" => null,
        ],
        [
          "sort" => 3,
          "nama_menu" => "Evaluasi Prog. Unggulan",
          "path"  => "admin/evaluasi-prog-unggulan",
          "icon"  => "fa-money-bill-alt",
          "function"  =>"realisasi",
          "controller"  =>"SkpdController",
          "crud" => null,
        ],
        [
          "sort" => 3,
          "nama_menu" => "Evaluasi RKPD",
          "path"  => "admin/evaluasi-rkpd",
          "icon"  => "fa-money-bill-alt",
          "function"  =>"realisasi",
          "controller"  =>"SkpdController",
          "crud" => null,
        ],
         [
          "sort" => 3,
          "nama_menu" => "Evaluasi RPJMD",
          "path"  => "admin/evaluasi-rpjmd",
          "icon"  => "fa-money-bill-alt",
          "function"  =>"realisasi",
          "controller"  =>"SkpdController",
          "crud" => null,
        ],


      ),
    ]
    );*/
  }
}
