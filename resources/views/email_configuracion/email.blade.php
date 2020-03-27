<h4>{{ $data['contenido'] }}</h4>
<div class="col-6" id="detalle" style="display: block;">
    <br>
    <p class="lead">Detalles</p>
    <div class="table-responsive">
      <table class="table" style="width: 350px">
        <tbody><tr>
          <th style="width:70%; text-align: left;" class="text-left">Monto de especialidad:</th>
          <td id="montoEspecialidad">${{ $data['monto_especialidad'] }}</td>
        </tr>
        <tr>
          <th style="width:70%; text-align: left;" class="text-left">Monto de deuda</th>
          <td id="montoDeuda">${{ $data['monto_deuda'] }}</td>
        </tr>
        <tr>
          <th style="width:70%; text-align: left;" class="text-left">Monto total:</th>
          <td id="montoTotal">${{ $data['monto_total'] }}</td>
        </tr>
      </tbody></table>
    </div>
  </div>
<br>
<p style="color:rgb(130, 128, 128)">Si necesita mayor informacion puede enviar un email a la siguiente direccion</p>
<p>{{ $data['remitente'] }}</p>

<script>
    $(document).ready(function(){
        const detalle_monto = " {{ $data['detalle_monto'] }} ";
        if (detalle_monto == 1){
            $("#detalle").css("display", "block");
        }else{
            $("#detalle").css("display", "none");
        }
    })
</script>