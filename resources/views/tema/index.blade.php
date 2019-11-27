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

    <a style="float:left" data-toggle="modal" data-target="#createTema" type="button" class="btn btn-primary">+ Add</a>
    @include('tema.create')
    <br><br>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Tema</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <th scope="row">{{ $loop->index+1 }}</th>
                <td>{{ $item->tema }}</td>
                <td>
                    <a type="button"class="btn btn-warning" data-toggle="modal" data-target="#editTema{{$item->id}}">Edit</a>
                    <a type="button" class= "btn btn-danger" onclick="deleteTema(event,{{$item->id}})">Delete</a>
                    @include('tema.edit')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#ajaxCreate').on('click', function(event){
        event.preventDefault();

            $.ajax ({
                type : 'POST',
                url : '{{route("tema.store")}}',
                dataType : 'JSON',
                data : $('form.ajaxCreate').serialize(),
                success : function(response) {
                    location.reload();
                     alert('Berhasil Menambah Data');
                    
                },
                error : function(xhr){
                    alert("error");
                }
            });
            return false;
        });
    });
        function editTema(event, $id)
        {
            event.preventDefault();

            var action = '/tema/' + $id + '/update';
            var nama = 'form.ajaxEdit' + $id;
            var tema = $(nama).serialize();

            $.ajax ({
                header: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                type : 'PUT',
                url : action,
                dataType : 'JSON',
                data : tema,
                success : function(response) {
                    alert('Berhasil Menambah Data');
                    location.reload();  
                },
                error : function(xhr){
                    alert("error");
                }
            });
            return false;
        }


        function deleteTema(event, $id)
        {
            event.preventDefault();

            var action = '/tema/' + $id;

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

