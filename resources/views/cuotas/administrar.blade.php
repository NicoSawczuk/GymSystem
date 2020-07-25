@extends ('theme.admin-lte.template')

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
            Cuotas de todos los gimnasios
          </h3>
          <div class="card-tools">
            <div class="float-right">
              <h5>
                <i title="Ayuda" id="popover" class="fal fa-question-circle"
                  data-content="Esta tabla muestra las cuotas que se registraron en todos los gimnasios de {{$gimnasio->user->name }} {{$gimnasio->user->apellido}}. Además, presionando en el botón de filtros puede ver resultados más específicos segun lo que desee">
                </i>
              </h5>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        @if (count($cuotas)>0)

        <div class="mt-1 mr-1">
          <div class="float-right">
            <button title="Desplegar filtros" data-toggle="collapse" data-target="#demo" class="btn primary bg-light"><i
                class="far fa-filter"></i></button>
          </div>
          <div class="ml-1">
            <div id="demo" class="collapse">
              <div class="row">
                <div class="col-md-2">
                  <label for="desde" class="col-form-label text-md-right">Desde</label>
                  <input type="date" id="desde" class="form-control" data-inputmask-alias="datetime"
                    data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" placeholder="dd/mm/yyyy">
                </div>
                <div class="col-md-2">
                  <label for="hasta" class="col-form-label text-md-right">Hasta</label>
                  <input type="date" id="hasta" class="form-control" data-inputmask-alias="datetime"
                    data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" placeholder="dd/mm/yyyy">
                </div>
                <div class="col-md-3">
                  <label for="gimnasios" class=" col-form-label text-md-right">Gimnasios</label>
                  <select class="select2bs4 select2-hidden-accessible" multiple=""
                    data-placeholder="Seleccione gimnasios" style="width: 100%;" aria-hidden="true" id="gimnasios">
                    @foreach (Auth::user()->gimnasios as $gim)
                    <option value="{{$gim->nombre}}">{{ $gim->nombre}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="especialidades" class=" col-form-label text-md-right">Especialidades</label>
                  <select class="select2bs4 select2-hidden-accessible" multiple=""
                    data-placeholder="Seleccione especialidades" style="width: 100%;" aria-hidden="true"
                    id="especialidades">
                    @foreach (Auth::user()->especialidades as $especialidad)
                    <option value="{{$especialidad->nombre}}">{{ $especialidad->nombre}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-1">
                  <label for="" class="col-form-label text-md-right text-white">Filtro</label>
                  <button id="filtrar" type="button" class="btn btn-dark">Filtrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-3 card-body table-responsive p-0 table-hover text-nowrap">
          <div class="table-responsive">
            <table id="tabla" class="table table-head-fixed text-nowrap table-striped table-bordered">
              <thead>
                <tr>

                  <th>Cliente</th>
                  <th>Gimnasio</th>
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
                  <td>{{ $cuota->cliente ->nombre}} {{ $cuota->cliente->apellido}}</td>
                  <td>{{ $cuota->gimnasio ->nombre}}</td>
                  <td class="text-right">
                    {{ \Carbon\Carbon::create($cuota->fecha_pago)->format('d/m/Y')}}</td>
                  <td>
                    {{ $cuota->especialidad ->nombre}}

                  </td>
                  <td class="text-right">
                    <span class="badge badge-pill badge-warning">${{ $cuota->monto_cuota}}</span>
                  </td>
                  <td class="text-right">
                    <span class="badge badge-pill badge-success">${{ $cuota->monto_pagado}}</span>
                  </td>
                  <td class="text-right">
                    <span class="badge badge-pill badge-danger">${{ $cuota->monto_deuda}}</span>
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
    <input type="hidden" id="filtros" value="Ningún filtro aplicado.">
  </div>


  <script>
    $(function () {
        $('#popover').popover();
    })
  </script>

  <script>
    $(function () {
      //Datemask dd/mm/yyyy
      $('#desde').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
      $('#hasta').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy' });
      $('.select2bs4').select2({
          theme: 'bootstrap4'
      });
      document.getElementById("desde").max = new Date().toISOString().split("T")[0];
      document.getElementById("hasta").max = new Date().toISOString().split("T")[0];

      $("#desde").change(function () {
        var fecha = $(this).val();
        document.getElementById("hasta").min = fecha;
      });
      $("#hasta").change(function () {
        var fecha = $(this).val();
        document.getElementById("desde").max = fecha;
      });
      })
  </script>


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
                filename: 'cuotas_gimnasios_pdf',
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
                  var logo = '{{$gimnasio->getImagenReporte64()}}';
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
                  var titulo = 'Listado de cuotas de todos los gimnasios de ' + '{{$gimnasio->user->name}} {{$gimnasio->user->apellido}}';
                  var autor_reporte = '{{$gimnasio->user->name}} {{$gimnasio->user->apellido}}';
                  filtros = String($('#filtros').val());

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
                            { text: filtros, fontSize: 10, alignment: 'left' },
                          ],
                          fontSize: 10,
                          margin: [-28, 10, 0, 10]
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
                      margin: [20, 10, 20, 20]
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
                  doc.content[0].table.widths = [90, 70, 60, 'auto', 'auto', 'auto', 'auto', 'auto'];

                  //Obtenemos la cantidad de filas y le damos la orientacion (izquierda, centro, derecha) que queremos
                  var rowCount = document.getElementById("tabla").rows.length;
                  for (i = 1; i < rowCount; i++) {
                    doc.content[0].table.body[i][0].alignment = 'left';
                    doc.content[0].table.body[i][1].alignment = 'left';
                    doc.content[0].table.body[i][2].alignment = 'right';
                    doc.content[0].table.body[i][3].alignment = 'left';
                    doc.content[0].table.body[i][4].alignment = 'right';
                    doc.content[0].table.body[i][5].alignment = 'right';
                    doc.content[0].table.body[i][6].alignment = 'right';
                    doc.content[0].table.body[i][7].alignment = 'left';
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

  {{-- Filtros --}}
  <script>
    $(document).ready(function () {
      var table = $('#tabla').DataTable();

      //un boton con id filtrar
      $('#filtrar').click(function () {


        //aca se obtienen los valores
        var filtro3 = [];
        filtro3 = $('#gimnasios').val();

        var filtro4 = [];
        filtro4 = $('#especialidades').val();

        var filtro1 = $('#desde').val();
        var filtro1Titulo = moment(filtro1).format('DD/MM/YYYY');
        if (filtro1 != "") {
          filtro1 = moment(filtro1).format('YYYYMMDD');
        }

        var filtro2 = $('#hasta').val();
        var filtro2Titulo = moment(filtro2).format('DD/MM/YYYY');
        if (filtro2 != "") {
          filtro2 = moment(filtro2).format('YYYYMMDD');
        }

        //no olvidarme de volver a poner (pop) las filas
        //esto es por si se realizo algun filtro asi se vuelve a cargar el datatable

        $.fn.dataTable.ext.search.pop(
          function (settings, data, dataIndex) {
            if (1) {
              return true;
            }
            return false;
          }
        );
        table.draw();

        if (filtro3 != "") {
          var gimnasios = filtro3;
          console.log(gimnasios);
        }
        if (filtro4 != "") {
          var especialidades = filtro4;
          console.log(especialidades);
        }
        if (filtro1 != "") {
          var desde = filtro1;
          console.log(desde);
        }
        if (filtro2 != "") {
          var hasta = filtro2;
          console.log(hasta);
        }
        filtros = "";
        if (filtro1 == "" && filtro2 == "" && filtro3 == "" && filtro4 == "") {
          console.log('filtro 0');
          var filtros = "Ningún filtro aplicado.";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            if (true) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        if (filtro1 != "" && filtro2 == "" && filtro3 == "" && filtro4 == "") {
          console.log('filtro 1');
          var filtros = "F. desde: " + filtro1Titulo+".";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }

        else if (filtro1 != "" && filtro2 != "" && filtro3 == "" && filtro4 == "") {
          console.log('filtro 2');
          var filtros = "F. desde: " + filtro1Titulo+" y F. hasta: " + filtro2Titulo;
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && hasta >= newdate1) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }

        else if (filtro1 != "" && filtro2 != "" && filtro3 != "" && filtro4 == "") {
          console.log('filtro 3');
          var filtros = "F. desde: " + filtro1Titulo+", F. hasta: " + filtro2Titulo +" y Gimnasios: "+String(filtro3);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && hasta >= newdate1 && gimnasios.includes(data[1])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 != "" && filtro2 != "" && filtro3 != "" && filtro4 != "") {
          console.log('filtro 4');
          var filtros = "F. desde: " + filtro1Titulo+", F. hasta: " + filtro2Titulo +", Gimnasios: "+String(filtro3) +" y Especialidades: "+ String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && hasta >= newdate1 && gimnasios.includes(data[1]) && especialidades.includes(data[3])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 == "" && filtro2 != "" && filtro3 != "" && filtro4 != "") {
          console.log('filtro 5');
          var filtros = "F. hasta: "+filtro2Titulo+", Gimnasios: "+String(filtro3)+" y Especialidades: "+String(filtro4); 
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (hasta >= newdate1 && gimnasios.includes(data[1]) && especialidades.includes(data[3])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 == "" && filtro2 != "" && filtro3 == "" && filtro4 != "") {
          console.log('filtro 6');
          var filtros = "F. hasta: "+filtro2Titulo+" y Especialidades: "+String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (hasta >= newdate1 && especialidades.includes(data[3])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 == "" && filtro2 != "" && filtro3 == "" && filtro4 == "") {
          console.log('filtro 7');
          var filtros = "F. hasta: "+filtro2Titulo+".";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (hasta >= newdate1) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }

        else if (filtro1 == "" && filtro2 == "" && filtro3 != "" && filtro4 != "") {
          console.log('filtro 8');
          var filtros = "Gimnasios: "+String(filtro3)+" y Especialidades: "+String(filtro4);
          console.log(filtros);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            if (gimnasios.includes(data[1]) && especialidades.includes(data[3])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 == "" && filtro2 == "" && filtro3 != "" && filtro4 == "") {
          console.log('filtro 9');
          var filtros = "Gimnasios: "+String(filtro3);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            if (gimnasios.includes(data[1])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 != "" && filtro2 == "" && filtro3 != "" && filtro4 == "") {
          console.log('filtro 10');
          var filtros = "F. desde: " + filtro1Titulo+"y Gimnasios: "+String(filtro3)+".";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && gimnasios.includes(data[1])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 == "" && filtro2 != "" && filtro3 != "" && filtro4 == "") {
          console.log('filtro 11');
          var filtros = "F. hasta: "+filtro2Titulo+"y Gimnasios: "+String(filtro3)+".";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (hasta >= newdate1 && gimnasios.includes(data[1])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }

        else if (filtro1 == "" && filtro2 == "" && filtro3 == "" && filtro4 != "") {
          console.log('filtro 12');
          var filtros = "Especialidades: "+String(filtro4)+".";
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            if (especialidades.includes(data[3])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 != "" && filtro2 == "" && filtro3 == "" && filtro4 != "") {
          console.log('filtro 13');
          var filtros = "F. desde: "+filtro1Titulo+" y Especialidades: "+String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && especialidades.includes(data[3])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 != "" && filtro2 != "" && filtro3 == "" && filtro4 != "") {
          console.log('filtro 14');
          var filtros = "F. desde: " + filtro1Titulo+", F. hasta: " + filtro2Titulo +" y Especialidades: "+String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && hasta >= newdate1 && especialidades.includes(data[3])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

        }
        else if (filtro1 != "" && filtro2 == "" && filtro3 != "" && filtro4 != "") {
          console.log('filtro 15');
          var filtros = "F. desde: " + filtro1Titulo+", Gimnasios: " + String(filtro3) +" y Especialidades: "+String(filtro4);
          var filtradoTabla = function FuncionFiltrado(settings, data, dataIndex) {
            var datearray1 = data[2].split("/");
            var newdate1 =   datearray1[2] + datearray1[1] + datearray1[0];
            if (desde <= newdate1 && gimnasios.includes(data[1]) && especialidades.includes(data[3])) {
              return true;

            } else {
              return false;

            }
          }

          $.fn.dataTable.ext.search.push(filtradoTabla)

          table.draw()

          

        }
        $('#filtros').val(String(filtros));

      });
    });
  </script>

</body>
@endsection


@endsection
@include('theme.admin-lte.scripts')