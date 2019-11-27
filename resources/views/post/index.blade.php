@extends('layouts.app')

@section('content')


<div class="container">

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif

    {{-- <a style="float:left" href="{{ route('post.create') }}" type="button" class="btn btn-primary">+ Add</a> --}}
    <a style="float:left" data-toggle="modal" data-target="#createPost" type="button" class="btn btn-primary">+ Add</a>
    @include('post.create')
    <br><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Judul</th>
                <th scope="col">Isi</th>
                <th scope="col">Foto</th>
                <th scope="col">Tema</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            
                
            <tr>
                <th scope="row">{{ $loop->index+1 }}</th>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->isi }}</td>
                <td> <img src="{{ asset('post/'.$item->foto) }}" alt="" style="width:50px; height:50px;"></td>
                <td>{{ $item->tema->tema }}</td>
                <td>
                    
                        
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editPost" id="modalEditButton" onclick="editPost(event,{{$item->id}})">Edit</button>
                    <button  class= "btn btn-danger" onclick="deletePost(event,{{$item->id}})">Delete</button>
                           
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('post.edit')

@endsection

@section('js')
<script>
      $(document).ready(function() {

        $('#formAjax').on('submit', function(event){
        event.preventDefault();
        var formData = new FormData($(this)[0]);
            $.ajax ({
                headers: {'X-CSRF-TOKEN': $('input[name=_token]').val() },
                type : 'POST',
                url : '{{ route("post.store")}}',
                data : formData,
                cache: false,
                processData: false,
                contentType: false,
                success : function(response) {
                    alert('Berhasil Menambah Data');
                    location.reload();  
                },
                    
                error : function(xhr){
                    alert("error");
                }
            });
            return false;
        });
    });
        function editPost(event, id)
        {
            $.ajax({
                type : 'GET',
                url : '/post/' + id,
                cache: false,
                processData: false,
                contentType: false,
                success : function(response) {
                    $('form.ajaxEdit input#judul').val(response[0][0].judul),
                    $('form.ajaxEdit input#isi').val(response[0][0].isi),
                    $('form.ajaxEdit select[name=tema_id]').val(response[0][0].tema_id)  
                },
                error : function(xhr){
                    alert("error");
                }
            });

            var action = '/post/' + id + '/update';
            var nama = 'form.ajaxEdit';

            $('form.ajaxEdit').on('submit', function(event) {
                event.preventDefault();
                $.ajax ({
                    header: {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    type : 'PUT',
                    url : action,
                    dataType : 'JSON',
                    data : {
                        judul: $('form.ajaxEdit input#judul').val(),
                        isi: $('form.ajaxEdit input#isi').val(),
                        tema_id: $('form.ajaxEdit select[name=tema_id]').val()
                    },
                    success : function(response) {
                        alert('Berhasil mengubah Data');
                        location.reload();
                    },
                    error : function(xhr){
                        console.log(xhr.responseJSON.message);
                    }
                });
            });

            return false;
        }


        function deletePost(event, $id)
        {
            event.preventDefault();

            var action = '/post/' + $id;

            $.ajax ({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                type : 'DELETE',
                url : action,
                dataType : 'JSON',
                success : function(response) {
                    alert('Berhasil Menghapus Data');
                    location.reload();  
                },
                error : function(xhr){
                    alert("error");
                }
            });
            return false;
        }
    </script>
@endsection

