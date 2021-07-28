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
        {!! Form::open(array('route' => 'gallery.store')) !!}
          <div class="form-group">
            {!! Form::label('title', 'Title',['class' => 'control-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}

            @if($errors->first('title'))
              <span class="form-error">{{$errors->first('title')}}</span>
            @endif
          </div>
          <div class="form-group">
            {!! Form::label('title', 'Description',['class' => 'control-label']) !!}
            {!! Form::textarea('description', null, ['class'=>'form-control']) !!}

            @if($errors->first('description'))
              <span class="form-error">{{$errors->first('description')}}</span>
            @endif
          </div>

          {!! Form::submit('Submit', ['class' => 'btn btn-primary mr-2']) !!}
          {!! Form::close() !!}
      </div>
    </div>
  </div>
 
</div>

@endsection
