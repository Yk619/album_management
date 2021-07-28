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
<style>
body {
  font-family: Verdana, sans-serif;
  margin: 0;
}

* {
  box-sizing: border-box;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>

<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Gallery Images</h2>
          </div>
          
        </div>
        <div class="d-flex justify-content-between align-items-end flex-wrap">
          <a class="btn btn-primary mt-2 mt-xl-0" href="{{route('image.create')}}">Add</a>
        </div>
      </div>
    </div>
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <h4 class="card-title">Gallery Image</h4>       
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Title</th>
                <th>album Title</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($images as $image)
              <tr>
                <td>{{$image->id}}</td>
                <td><div class="gallery">
                    <img src="{{asset('uploads'). '/'.$image->path}}" style="width:30px;height:30px;" onclick="openModal();" class="hover-shadow cursor">
                  </div>
                </td>
                <td>{{$image->title}}</td>
                <td>{{$image->album->title}}</td>
                <td>
                  <a class="badge badge-info" href="{{route('image.edit', $image->id)}}"><i class="mdi mdi-pencil"></i></a>

                  {{ Form::open(['route' => ['image.destroy', $image->id],  'method' => 'POST']) }}
                  @csrf  
                  @method('DELETE')  

                   <button type="submit" onclick="return confirm('Are you sure? You want to delete the image.')" class="badge badge-danger">
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
            {{ $images->links() }}
        </div>
      </div>
    </div>
  </div>
 
</div>
 <link rel="stylesheet" type="text/css" href="lightbox2/dist/css/lightbox.min.css">
    <script src="lightbox2/dist/js/lightbox-plus-jquery.min.js">
<script type="text/javascript">
function openModal() {
  document.getElementById("myModal").style.display = "block";
}
</script>

@endsection