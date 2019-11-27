      <div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            {!! Form::open(['url' => route('post.index'), 'class' => 'ajaxEdit']) !!}
            @csrf
            <div class="modal-body">
              <div class="form-group">
                  <label for="post" class="col-from-label">Post</label>
                  <input type="text" name="judul" class="form-control" id="judul" value="{{isset($item) ? $item->judul : ''}}" placeholder="Masukkan Judul">
                  <br>
                  <input type="text" name="isi" class="form-control" id="isi" value="{{isset($item) ? $item->isi : ''}}" placeholder="Masukkan isi">
                  <br>
                  <input type="file" name="foto" class="form-control" id="foto" value="{{isset($item) ? $item->foto : ''}}">
                  <br>
                  <select class="form-control " id="js-example-basic-multiple" name="tema_id" data-live-search="true">
                        <option value="">Pilih :</option>
                        @foreach($temas as $tema)
                          <option value= "{{$tema->id}}">{{$tema->tema}}</option>
                        @endforeach
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="ajaxCreate" class="btn btn-primary">Submit</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>

