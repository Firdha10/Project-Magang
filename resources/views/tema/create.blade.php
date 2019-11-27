
<div class="modal fade" id="createTema" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah {{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      		{!! Form::open(['url' => route('tema.index'), 'class' => 'ajaxCreate']) !!}
			<div class="modal-body">
				<div class="form-group">
					<label for="tema" class="col-from-label">Tema</label>
					<input type="text" name="tema" class="form-control" id="tema" value="{{isset($item) ? $item->tema : ''}}">
				</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="button" type="submit" id="ajaxCreate" class="btn btn-primary">Submit</button>
    		</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>