@extends('layouts.main')
@section('contenido')
<div class="container"> <br>
     <div class="row">
       <div class="col-md-12">
         <div class="card">
           <div class="card-header">
             Listado de productos
             <a href= "{{ route('products.create') }}"  class="btn btn-success btn-sm float-right">Nuevo producto</a>

           </div class="card-body">
             @if(session('info'))
                <div class="alert alert-success">
                   {{ session('info') }}
                </div>
             @endif
             <table class="table table-hover table-sm">
               <thead>
                 <th>Descripción</th>
                 <th>Precio</th>         
                 <th>Acción</th>       
               </thead>
               <tbody>
                @foreach($products as $elemento)
                 <tr>
                    <td>
                      {{$elemento->description}}
                    </td>
                    <td>
                       {{$elemento->price}}
                    </td>
                    <td>
                      <a href="{{ route('products.edit', $elemento->id) }}" class="btn btn-warning btn-sm">Editar</a>
                      <a href="javascript: document.getElementById('delete-{{$elemento->id}}').submit()" class="btn btn-danger btn-sm">Eliminar</a>
                      <form id="delete-{{$elemento->id}}" action="{{ route('products.destroy', $elemento->id ) }}" method="POST">
                         @method('delete')
                         @csrf
                      </form>
                    </td>
                 </tr>
                @endforeach
               </tbody>
             </table>
           <div class="card-footer">
              Bienvenido {{auth()->user()->name}}
              <a href="javascript:document.getElementById('logout').submit()" class="btn btn-danger btn-sm float-right">Cerrar sesión</a>
             <form action="{{ route('logout') }}" id="logout" style="display:none" method = "POST">
             @csrf
             </form>
           
           </div>
         </div>
       </div>
     </div>
</div>
@endsection
