@extends('layouts.inner')

@section('content')
@if (\Session::has('success'))
  <div class="row" id="proBanner">
    <div class="col-md-12 grid-margin">
      <div class="card bg-gradient-primary border-0">
        <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
          <span>{!! \Session::get('success') !!}</span>
        </div>
      </div>
    </div>
  </div>
@endif

<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Gallery</h2>
          </div>
          
        </div>
        <div class="d-flex justify-content-between align-items-end flex-wrap">
          <a class="btn btn-primary mt-2 mt-xl-0" href="{{route('gallery.create')}}">Add</a>
        </div>
      </div>
    </div>
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <h4 class="card-title">Gallery </h4>       
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Total Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($galleries as $gallery)
              <tr>
                <td>{{$gallery->id}}</td>
                <td>{{$gallery->title}}</td>
                <td>{{$gallery->image->count()}}</td>
                <td>
                  <a class="badge badge-info" href="{{route('gallery.edit', $gallery->id)}}"><i class="mdi mdi-pencil"></i></a>

                  {{ Form::open(['route' => ['gallery.destroy', $gallery->id],  'method' => 'POST']) }}
                  @csrf  
                  @method('DELETE')  

                   <button type="submit" onclick="return confirm('Are you sure? You want to delete the album.')" class="badge badge-danger">
                      <i class="mdi mdi-delete"></i>
                    </button> 
                  {!! Form::close() !!}

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="pagination pagination-rounded justify-content-end mb-0">
            {{ $galleries->links() }}
        </div>
      </div>
    </div>
  </div>
 
</div>

@endsection
