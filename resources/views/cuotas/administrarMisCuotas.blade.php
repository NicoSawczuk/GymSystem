@extends('theme.admin-lte.template')

@section('title') Administrar cuotas @endsection

@section('body')
@parent


@section('content')

@section('contentHeader') Administrar cuotas @endsection

<body class="container-fluid">
  <div class="">
    <div class="">


      <div class="card card-teal card-outline">
        <div class="card-header">
          <h3 class="card-title">
            Cuotas de {{$gimnasio->nombre}}
          </h3>
          <div class="card-tools">
            <div class="float-right">
              <h5><i title="Ayuda" class="fal fa-question-circle"></i></h5>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        @if (count($cuotas)>0)
        <div class="mt-2 card-body table-responsive p-0 table-hover text-nowrap">

          <div class="table-responsive">
            <table id="tabla" class="table table-head-fixed text-nowrap table-striped table-bordered">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Fecha de pago</th>
                  <th>Especialidad</th>
                  <th>Monto</th>
                  <th>Monto pago</th>
                  <th>Deuda</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cuotas as $cuota)
                <tr>
                  <td>{{$cuota->cliente->nombre}} {{$cuota->cliente->apellido}}</td>
                  <td class="text-right">
                    {{ \Carbon\Carbon::create($cuota->fecha_pago)->format('d/m/Y')}}</td>
                  <td>
                    <span class="badge badge-pill badge-light">{{ $cuota->especialidad->nombre }}
                    </span>
                  </td>
                  <td class="text-right">
                    <span class="badge badge-pill badge-warning">${{$cuota->monto_cuota}}</span>
                  </td>
                  <td class="text-right">
                    <span class="badge badge-pill badge-success">${{$cuota->monto_pagado}}</span>
                  </td>
                  <td class="text-right">
                    <span class="badge badge-pill badge-danger">${{$cuota->monto_deuda}}</span>
                  </td>
                  <td>
                    @if ($cuota->vencido == 0)
                    Activa
                    @else
                    Vencida
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
        </div>
        <div class="callout callout-warning">
          <h5>Aún no tenes cuotas</h5>

          <p>Tus clientes aún no han pagado ninguna cuota</p>
        </div>
        @endif
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  @if (isset($gimnasio->reporte_configuracion))
  <script>
    $(function () {
        $("#tabla").DataTable({
          "responsive": true,
          "autoWidth": false,
          "lengthChange": true,
          "ordering": true,
          buttons: [
            'copy', 'csv', 'excel',
            {
              extend: 'pdfHtml5',
              className: 'btn btn-secondary buttons-pdf buttons-html5',
              text: 'PDF',
              filename: 'cuotas_'+'{{$gimnasio->slug()}}'+'_reporte_pdf',
              orientation: 'portrait', //landscape
              pageSize: 'A4', //A3 , A5 , A6 , legal , letter
  
  
              customize: function (doc) {
                //quitamos el titulo por defecto del pdfhtml5 eliminando el primer elemento del pdf que esta en el array content.
                doc.content.splice(0, 1);
                //Fecha para usar en el reporte mas adelante
                var now = new Date();
                var jsDate = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
  
                //Para poner una imagen hay que convertirla a Base64 con esta pagina se puede:
                // http://codebeautify.org/image-to-base64-converter
  
  
                //#region aca esta el logo en base64 (expandir, es muy largo xd)
                var logo= '{{$gimnasio->getImagenReporte64()}}';
                //#endregion
  
  
                // Ahora establecemos los margenes: [left,top,right,bottom] o [horizontal,vertical]
                // si ponemos solo un numero se establece ese mismo para todos los margenes
                doc.pageMargins = [60, 135, 20, 50];
  
                // Tamaño de fuente de todo el documento
                doc.defaultStyle.fontSize = 10;
                // Tamaño de fuente del encabezado
                doc.styles.tableHeader.fontSize = 12;
  
                //Al elemento 0 (porque borre el titulo al principio) del contenido o sea la tabla
                //lo centramos forzadamente
                //doc.content[0].margin = [100, 0, 100, 0]
  
                // Para personalizar el encabezado:
                // Creamos un encabezado con 3 columnas
                // A la izquierdalogo
                // En el medio: Titulo
                // A la derecha: algo xd
  
                //El titulo lo saco de un input oculto para poder usar esta misma configuracion para reportes distintos, entonces cambia el titulo segun el reporte.
                var titulo = 'Listado de cuotas de '+'{{$gimnasio->nombre}}';
                var autor_reporte = '{{$gimnasio->user->name}} {{$gimnasio->user->apellido}}';
                var filtros = '';
  
                var titulo_header = "{{$gimnasio->reporte_configuracion->titulo}}"
                var direccion_header = "{{$gimnasio->reporte_configuracion->calle}} {{$gimnasio->reporte_configuracion->altura}}, {{$gimnasio->reporte_configuracion->ciudad}} {{$gimnasio->reporte_configuracion->provincia}} {{$gimnasio->reporte_configuracion->pais}} "
                var contacto_header = "Teléfono: {{$gimnasio->reporte_configuracion->telefono}}"
  
                doc['header'] = (function () {
                  return {
                    columns: [
                      {
                        image: logo,
                        width: 70,
                        margin: [-10, -10, 10, 0]
                      },
                      // {
                      //   alignment: 'left',
                      //   fontSize: 10,
                      //   text: [
                      //     { text: titulo + " \n", bold: true, fontSize: 12 },
                      //     { text: 'Filtros' + "\n", fontSize: 10 },
                      //     { text: filtros + "\n" },
                      //   ],
                      //   width: 100,
                      //   margin: [-30, 100, 0, 0],
                      //   alignment: 'left'
                      // },
                      {
                        alignment: 'center',
                        text: [
                          { text: titulo_header + " \n", bold: true, fontSize: 16 }, 
                          { text: direccion_header + " \n" },
                          { text: contacto_header + "\n \n \n \n" },
                          { text: titulo + " \n", bold: true, fontSize: 12, alignment: 'left' },
                          { text: 'Filtros' + "\n", fontSize: 10, alignment: 'left'},
                          { text: filtros, alignment: 'left'},
                        ],
                        fontSize: 10,
                        margin: [-28, 10, 0, 0]
                      },
                      {
                        alignment: 'right',
                        fontSize: 10,
                        text: ['Fecha: ', { text: jsDate.toString() }, { text: '\n Autor: ' + autor_reporte, bold: true, fontSize: 11 }],
                        width: 75,
                        margin: [0, 10, 0, 0],
                        alignment: 'left'
                      }
                    ],
                    margin: 20
                  }
                });
  
                //Funcion que pone cada columna en tamaño *, para que se ajuste automagicamente. cuenta cada <td> del data table y genera array del tipo [*,*,*,..,n] y establece dicho array como width.
                var colCount = new Array();
                $("#tabla").find('tbody tr:first-child td').each(function () {
                  if ($(this).attr('colspan')) {
                    for (var j = 1; j <= $(this).attr('colspan'); $j++) {
                      colCount.push('*');
                    }
                  } else { colCount.push('*'); }
                });
                //console.log(colCount);
                colCount.push('*'); //Le pongo uno mas porque tengo un td oculto (el id)
  
                //doc.content[0].table.widths = colCount;
  
                //Es equivalente a: 
                doc.content[0].table.widths = [100, 75, 80, 50, 50, 50, 50];
  
                //Obtenemos la cantidad de filas y le damos la orientacion (izquierda, centro, derecha) que queremos
                var rowCount = document.getElementById("tabla").rows.length;
                for (i = 1; i < rowCount; i++) {
                    doc.content[0].table.body[i][0].alignment = 'left';
                    doc.content[0].table.body[i][1].alignment = 'right';
                    doc.content[0].table.body[i][2].alignment = 'left';
                    doc.content[0].table.body[i][3].alignment = 'right';
                    doc.content[0].table.body[i][4].alignment = 'right';
                    doc.content[0].table.body[i][5].alignment = 'right';
                    doc.content[0].table.body[i][6].alignment = 'left';

                  };
  
  
                // Para personalizar el pie de pagina:
                // Creamos un objeto de pie de pagina con dos columnas
                // Lado izquierdo: Fecha de creacion del reporte
                // Lado derecho: pagina actual y total de pagina
                doc['footer'] = (function (page, pages) {
                  return {
                    columns: [{
                      alignment: 'left',
                      text: ['Fecha de Generación: ', { text: jsDate.toString() }]
                    },
                    {
                      alignment: 'right',
                      text: ['Página ', { text: page.toString() }, ' de ', { text: pages.toString() }]
                    }
                    ],
                    margin: 20
                  }
                });
  
                // Change dataTable layout (Table styling)
                // To use predefined layouts uncomment the line below and comment the custom lines below
                // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                var objLayout = {};
                objLayout['hLineWidth'] = function (i) { return .7; };
                objLayout['vLineWidth'] = function (i) { return .7; };
                objLayout['hLineColor'] = function (i) { return '#cdcdcd'; };
                objLayout['vLineColor'] = function (i) { return '#cdcdcd'; };
                objLayout['paddingLeft'] = function (i) { return 4; };
                objLayout['paddingRight'] = function (i) { return 4; };
                objLayout['paddingTop'] = function (i) { return 6; };
                objLayout['paddingBottom'] = function (i) { return 6; };
                doc.content[0].layout = objLayout;
              },
              exportOptions: {
                columns: ":visible"
              }
            }
          ],
          dom: 'lrfBtip',
          language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Ver _MENU_",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Todavía no se registraron pagos",
            "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_",
            "sInfoEmpty": "Mostrando  del 0 al 0 de de 0 ",
            "sInfoFiltered": "(filtrado de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Sig",
              "sPrevious": "Ant"
            },
            "oAria": {
              "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
              "copy": "Copiar",
              "colvis": "Visibilidad"
            }
          }
        });
  
  $('#tabla_length').css({
        'position': 'absolute'
  });
  
  $('.dt-buttons').css({
        'position': "relative",
    'display': "-ms-inline-flexbox",
    'display': "block",
    'vertical-align': "middle",
    'text-align':" right"
  });
  });
  </script>
  @else
  <script>
    $(function () {
        $("#tabla").DataTable({
          "responsive": true,
          "autoWidth": false,
          "lengthChange": true,
          "ordering": true,
          language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Ver _MENU_",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Todavia no tiene clientes en su gimnasio, por agregue uno",
            "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_",
            "sInfoEmpty": "Mostrando  del 0 al 0 de de 0 ",
            "sInfoFiltered": "(filtrado de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Sig",
              "sPrevious": "Ant"
            },
            "oAria": {
              "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
              "copy": "Copiar",
              "colvis": "Visibilidad"
            }
          }
        });
      });
  </script>
  @endif

</body>
@endsection


@endsection
@include('theme.admin-lte.scripts')