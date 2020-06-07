<div id="eliminar{{$mascota->idExpediente}}" class="modal fade">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="{{ url('/deleteProfile') }}" method="post">
    {{csrf_field()}}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span>×</span>
        </button>
        <br>
      </div>
      <div class="modal-body">
        <h4 class="modal-title">Desea eliminar el producto </h4>
        Codigo: <input type="text" name="idExpediente" readonly  value="{{$mascota->idExpediente}}"/>
        <br>
        Nombre: <input type="text" name="nombreExpediente" readonly  value="{{$mascota->nombreExpediente}}"/>
        <input type="hidden" name="estatusExpediente" value="0"/>
      </div>
      <div class="modal-footer">
        <input type="submit" value="Eliminar"/>
        </form>
      </div>
    </div>
    
  </div>
</div>