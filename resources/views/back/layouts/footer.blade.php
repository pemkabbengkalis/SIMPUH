<?php
$tahunglobal = (isset($_GET['tahun'])) ? $_GET['tahun']:date('Y');
?>
<footer class="main-footer">
    <strong> Copyright &copy; 2022 TIM IT Diskominfotik</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> BETA
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

$.ajax({
  url: '{{ route('getChartBYunggulan',$tahunglobal) }}', // Ganti dengan URL API sesuai dengan kebutuhan
  method: 'GET',
  dataType: 'json',
  success: function(apiData) {
    // Mengolah data untuk xAxis categories
    const categories = apiData.map(item => item.program_unggulan);

    // Mengolah data untuk series (K) dan (Rp)
    const seriesK = {
      name: '(K)',
      color: '#17A2B8',
      data: apiData.map(item => parseFloat(item.kuantitas))
    };

    const seriesRp = {
      name: '(Rp)',
      color: 'red',
      data: apiData.map(item => parseFloat(item.realisasi))
    };

    // Membuat grafik Highcharts setelah data diambil
    Highcharts.chart('chartunggulan', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Grafik 8 Program Kerja Unggulan Realisasi Kinerja & Anggaran'
      },
      xAxis: {
        categories: categories, // Menggunakan categories yang telah diolah
        crosshair: true
      },
      yAxis: {
    min: 0,
    title: {
      text: 'Persentase (%)'
    }
  },
      // ... (bagian lain dari konfigurasi)
      series: [seriesK, seriesRp] // Menggunakan series yang telah diolah
    });
  },
  error: function() {
    console.log('Gagal mengambil data dari API');
  }
});


$.ajax({
  url: '{{ route('getrealisasiKIA',$tahunglobal) }}', // Ganti dengan URL API sesuai dengan kebutuhan
  method: 'GET',
  dataType: 'json',
  success: function(apiData) {
    // Mengolah data untuk xAxis categories
    const categories = apiData.map(item => item.triwulan);

    // Mengolah data untuk series (K) dan (Rp)
    const seriesK = {
      name: '(K)',
      color: '#17A2B8',
      data: apiData.map(item => parseFloat(item.kuantitas))
    };

    const seriesRp = {
      name: '(Rp)',
      color: 'red',
      data: apiData.map(item => parseFloat(item.realisasi))
    };

    // Membuat grafik Highcharts setelah data diambil
    Highcharts.chart('chart', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Grafik Realisasi Kinerja & Anggaran'
      },
      xAxis: {
        categories: categories, // Menggunakan categories yang telah diolah
        crosshair: true
      },
      yAxis: {
    min: 0,
    title: {
      text: 'Persentase (%)'
    }
  },
      // ... (bagian lain dari konfigurasi)
      series: [seriesK, seriesRp] // Menggunakan series yang telah diolah
    });
  },
  error: function() {
    console.log('Gagal mengambil data dari API');
  }
});
$.ajax({
  url: '{{ route('skpdGrafik',$tahunglobal) }}', // Replace with the actual URL of your PHP file
  method: 'GET',
  success: function(dataFromPHP) {
    // Assuming dataFromPHP is an array of SKPD IDs returned from the PHP function
    var skpds = [];
    var seriesData = [];
    dataFromPHP.forEach(function(item) {
        skpds.push(item.nama_skpd);

        // Extract TW data from the 'data_tw' object
        var twData = [];
        for (var tw in item.data_tw) {
          twData.push(item.data_tw[tw]);
        }
        seriesData.push({
          name: item.nama_skpd,
          data: twData
        });
      });

      Highcharts.chart('skpdchart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Realisasi Anggaran Perangkat Daerah Per Triwulan',
        align: 'left'
    },
    
    xAxis: {
        categories: ['TW I','TW II','TW III','TW IV'],
        crosshair: true,
        accessibility: {
            description: 'Perangkat Daerah'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Realisasi Anggaran (RP)'
        }
    },
    tooltip: {
        valueSuffix: ' RP'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: seriesData,
});

},
  error: function() {
    console.log('Error fetching data from PHP.');
  }
});

// Highcharts.chart('skpdchart', {
//   chart: {
//     type: 'column'
//   },

//   title: {
//     text: 'Grafik Realisasi Kinerja dan Anggaran Perangkat Daerah'
//   },
//   xAxis: {
   
//     categories: ['1','2','3','4','5','6'],
//     crosshair: true
//   },
//   yAxis: {
//     min: 0,
//     title: {
//       text: 'Persentase (%)'
//     }
//   },

//   tooltip: {
//     headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
//     pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
//       '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
//     footerFormat: '</table>',
//     shared: true,
//     useHTML: true
//   },
//   plotOptions: {
//     column: {
//       pointPadding: 0.2,
//       borderWidth: 0
//     }
//   },
//   series: [
//   {
//     name: 'TW1',
//     color: '#17A2B8',
//     data: seriesData[0],

//   },  
//   {
//     name: 'TW2',
//     color: 'pink',

//     data: seriesData[1],

//   },  
//   {
//     name: 'TW3',
//     color: 'green',

//     data: seriesData[2],

//   },
//   {
//     name: 'TW4',
//     color: 'red',

//     data: seriesData[3],

//   },
//   ]
// });


  </script>

  <script src="{{asset('backend_template/dist/vanilaCalendar.js')}}" type="text/javascript"></script>
  <script>
    window.addEventListener('load', function () {
      vanillaCalendar.init({
        disablePastDays: true
      });
    })
  </script>
<!-- jQuery -->
<script src="{{ asset('backend_template') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend_template') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $("#table").DataTable({
      "paging": true,
      "lengthChange": [20, 50, 100, 200, 500],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    }).searching().container().appendTo('#table_wrapper .col-md-8:eq(0)');
    $('#table2').DataTable({
      "paging": true,
 

      "lengthChange": [20, 50, 100, 200, 500],
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  $(function () {
    $('#example').DataTable({
      "paging": true,
      "lengthMenu": [10, 20, 50, 100, 200, 500],

      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- select2 -->
<!-- Select2 -->
<script src="{{ asset('backend_template') }}/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend_template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('backend_template') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('backend_template') }}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('backend_template') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('backend_template') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('backend_template') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend_template') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('backend_template') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('backend_template') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend_template') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend_template') }}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('backend_template') }}/dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('backend_template') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('backend_template') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('backend_template') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

</body>
</html>
