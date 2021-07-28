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
      </div>
    </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">{{$gallery->title}}</h4>
        <p class="card-description">
          {{$gallery->description}}
        </p>

        <div class="row">
          @if($gallery->image->count() > 0)
            @foreach($gallery->image as $img)
            <div class="col-md-3">
              <a class="example-image-link" href="{{asset('uploads'). '/'.$img->path}}" data-lightbox="example-set" data-title="Click the right half of the image to move forward."><img class="example-image" src="{{asset('uploads'). '/'.$img->path}}" alt="" style="width:100%;  height:200px;"/></a>

              <a class="example-image-link" href="{{route('delete.image', $img->id)}}">delete</a>
            </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
    });
    $(document).on('click', '.galleryData', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
  </script>
@endsection