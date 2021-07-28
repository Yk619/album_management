@extends('layouts.inner')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
      <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2> Gallery</h2>
          </div>
          
        </div>
        
      </div>
    </div>
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      <h4 class="card-title"> Add Gallery </h4>       
        {!! Form::open(array('route' => 'image.store', 'enctype' => 'multipart/form-data')) !!}
        @csrf
          <div class="form-group">
            {!! Form::label('title', 'Title',['class' => 'control-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}

            @if($errors->first('title'))
              <span class="form-error">{{$errors->first('title')}}</span>
            @endif
          </div>
          <div class="form-group">
            {!! Form::label('title', 'Album',['class' => 'control-label']) !!}
            @php 
              $options = [];
              if(!empty($albums)){
                foreach($albums as $album){
                  $options[$album->id] = $album->title;
                }
              }
            @endphp
            {!! Form::select('album_id', $options, '',['class' => 'form-control']) !!}
          </div>
          <div class="form-group">
            {!! Form::label('title', 'Image',['class' => 'control-label']) !!}
            {{ Form::file('image[]', ['class' => 'control-label', 'multiple' => 'multiple']) }}

            @if($errors->first('image'))
              <span class="form-error">{{$errors->first('image')}}</span>
            @endif
          </div>

          {!! Form::submit('Submit', ['class' => 'btn btn-primary mr-2']) !!}
          {!! Form::close() !!}
      </div>
    </div>
  </div>
 
</div>



@endsection
