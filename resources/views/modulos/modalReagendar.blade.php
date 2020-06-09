<div id="reagendar{{$cita->idConsulta}}" class="modal fade">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="{{ url('/updateCita') }}" method="post">
    {{csrf_field()}}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span>×</span>
        </button>
        <br>
      </div>
      <div class="modal-body">
        <h4 class="modal-title">Reagendar</h4>
        <br>
        Nombre: <input type="date" name="proximaConsulta" />
        <input type="hidden" name="idConsulta" value="{{$cita->idConsulta}}" required/>
      </div>
      <div class="modal-footer">
        <input type="submit" value="Aceptar"/>
        </form>
      </div>
    </div>
    
  </div>
</div>