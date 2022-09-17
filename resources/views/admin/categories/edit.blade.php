@extends('layouts.admin')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Επεξεργασία κατηγορίας</h3>
            </div>
            <form role="form" method="POST" action="{{ route('admin.categories.update',$category->id) }}">
              {!! csrf_field() !!}
              {{ method_field('PUT') }}
            <div class="card-body">

                  <div class="form-group">
                    <label for="name">Όνομα <span style="color:red">*</span></label>
                    <input type="text" class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Enter name" value="{{ $category->name }}">
                    @if($errors->has('name'))
                      <p class="help-block" style="color:red"> 
                        {{ $errors->first('name') }}
                      </p>
                    @endif
                  </div>
                 
                  <div class="form-group">
                    <label for="description">Περιγραφή </label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" rows="3" placeholder="Enter description" name="description">{{ $category->description }}</textarea>
                    @if($errors->has('description'))
                    <p class="help-block" style="color:red"> 
                      {{ $errors->first('description') }}
                    </p>
                  @endif
                </div>

              </div>                 
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Ανανέωση</button>
                </div>
              </form>
            
          </div>
    </div>
  </div>
</div>


@endsection