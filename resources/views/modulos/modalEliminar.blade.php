<div id="eliminar{{$accesorio->clave_acc}}" class="modal fade">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="{{ url('/delete') }}" method="post">
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
        Codigo: <input type="text" name="clave_acc" readonly  value="{{$accesorio->clave_acc}}"/>
        <br>
        Nombre: <input type="text" name="nombre_acc" readonly  value="{{$accesorio->nombre_acc}}"/>
        <input type="hidden" name="estatus_acc" value="0"/>
      </div>
      <div class="modal-footer">
        <input type="submit" value="Eliminar"/>
        </form>
      </div>
    </div>
    
  </div>
</div>