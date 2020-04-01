@extends('theme.admin-lte.template')

@section('title') Home @endsection

@section('body')
    @parent
    @section('nombreGimnasio') <strong>{{ $gimnasio->nombre }}</strong> @endsection

    @section('usuario')
        {{ Auth::user()->name }} {{ Auth::user()->apellido }}
    @endsection


    @section('contentHeader')
        Pagina principal
    @endsection



    @section('content')
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{ $gimnasio->getInscriptos() }}</h3>
      
                      <h4>Inscriptos</h4>
                    </div>
                    <div class="icon">
                      <i class="fas fa-users"></i>
                    </div>
                    <a href="/clientes/administrar/inscripto/{{ $gimnasio->id }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>{{ $gimnasio->getEnRegla() }}<sup style="font-size: 20px"></sup></h3>
      
                      <h4>En regla</h4>
                    </div>
                    <div class="icon">
                      <i class="fas fa-calendar-check"></i>
                    </div>
                    <a href="/clientes/administrar/en_regla/{{ $gimnasio->id }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>{{ $gimnasio->getNoInscriptos() }}</h3>
      
                      <h4>No inscriptos</h4>
                    </div>
                    <div class="icon">
                      <i class="fas fa-calendar-exclamation"></i>
                    </div>
                    <a href="/clientes/administrar/no_inscripto/{{ $gimnasio->id }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>{{ $gimnasio->getEnDeuda() }}</h3>
      
                      <h4>En deuda</h4>
                    </div>
                    <div class="icon">
                      <i class="fas fa-calendar-times"></i>
                    </div>
                    <a href="/clientes/administrar/en_deuda/{{ $gimnasio->id }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
              </div>
              <!-- THE CALENDAR -->
              <div class="card card-teal card-outline">
                <div class="card-body">
                  <div id="calendar"></div>
                </div>
              </div>
    
        
    @endsection

    <script>
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()

      var Calendar = FullCalendar.Calendar;
      var calendarEl = document.getElementById('calendar');
      var calendar = new Calendar(calendarEl, {
        plugins: [ 'list', 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],  
        header    : {
          left  : 'title',
          center: '',
          right : 'prev,next today,dayGridMonth,timeGridWeek,listMonth'
        },
        locale: 'es',
        buttonText: {
                    //Here I make the button show French date instead of a text.
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Dia',
                    
            },
        'themeSystem': 'standard',
        //Random default events
        events    : [
          {
            title       : 'event2',
            start       : '2020-03-05 10:00',
            color       : '#F1C4FF',
            borderColor : '#F251FF',
            allDay      : false
          },
          
        ],
        firstDay: 0,
        selectable: true,
        editable  : true,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        },
        
        eventClick: function(info) {
          alert('Event: ' + info.event.title);
        }

      });
      calendar.render();
    </script>

    <script>
      $(document).ready(function(){
        calendar.addEvent({
              title       : 'Nuevo evento',
              start       : '2020-04-01 10:00',
              color       : '#FF73A7',
              borderColor : '#FF2164',
              allDay      : true
            });
      });
    </script>

@endsection

@include('theme.admin-lte.scripts')