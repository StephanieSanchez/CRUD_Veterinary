<div id="resurtir{{$accesorio->clave_acc}}" class="modal fade">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="{{ url('/change') }}" method="post">
    {{csrf_field()}}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span>×</span>
        </button>
        <br>
        <h4 class="modal-title">Resurtir el producto con codigo <input type="text" name="clave_acc" readonly  value="{{$accesorio->clave_acc}}"/></h4>
      </div>
      <div class="modal-body">
        <p>Articulo:{{$accesorio->nombre_acc}} </p>
        <p>Cantidad existente:{{$accesorio->existencia}}  </p>
        <p>Ingrese la cantidad a resurtir</p>
        <input type="hidden" name="existencia" value="{{$accesorio->existencia}}"/>
        <input type="number" name="cantidad" required/>
      </div>
      <div class="modal-footer">
        <input type="submit" value="Resurtir"/>
        </form>
      </div>
    </div>
    
  </div>
</div>