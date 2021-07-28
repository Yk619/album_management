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
      <h4 class="card-title"> Edit Gallery </h4>
      {{ Form::open(['route' => ['gallery.update', $gallery->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        @csrf
        @method('PATCH')
          <div class="form-group">
            {!! Form::hidden('album_id', $gallery->id) !!}

            {!! Form::label('title', 'Title',['class' => 'control-label']) !!}
            {!! Form::text('title', $gallery->title, ['class' => 'form-control']) !!}

            @if($errors->first('title'))
              <span class="form-error">{{$errors->first('title')}}</span>
            @endif
          </div>
          <div class="form-group">
            {!! Form::label('title', 'Description',['class' => 'control-label']) !!}
            {!! Form::textarea('description', $gallery->description, ['class'=>'form-control']) !!}

            @if($errors->first('description'))
              <span class="form-error">{{$errors->first('description')}}</span>
            @endif
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
