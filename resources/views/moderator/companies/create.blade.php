@extends('layouts.admin')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Δημιουργία Εταιρείας</h3>
            </div>
            <form role="form" method="POST" action="{{ route('moderator.companies.store') }}" enctype="multipart/form-data">
              {!! csrf_field() !!}
            <div class="card-body"> 
              
                <div class="form-group">
                    <label for="categories">Κατηγορίες <span style="color:red">*</span></label>
                    <select name="categories[]" id="categories" class="form-control {{ $errors->has('categories') ? 'is-invalid' : '' }}" multiple="multiple">
                      @foreach($categories as $id => $categories)
                          <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || isset($company) && $company->categories->contains($id)) ? 'selected' : '' }}>{{ $categories }}</option>
                      @endforeach
                  </select>
                  @if($errors->has('categories'))
                      <p class="help-block" style="color:red"> 
                          {{ $errors->first('categories') }}
                      </p>
                  @endif
                </div>
              

                  <div class="form-group">
                    <label for="name">Όνομα <span style="color:red">*</span></label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Enter name" value="{{ old('name', isset($company) ? $company->name : '') }}">
                    @if($errors->has('name'))
                      <p class="help-block" style="color:red"> 
                          {{ $errors->first('name') }}
                      </p>
                    @endif
            </div> 

            <div class="form-group">
              <label for="email">Email <span style="color:red">*</span></label>
              <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Enter email" value="{{ old('email', isset($company) ? $company->email : '') }}">
              @if($errors->has('email'))
                <p class="help-block" style="color:red"> 
                    {{ $errors->first('email') }}
                </p>
              @endif
            </div> 

            <div class="form-group">
                    <label for="activity_description">Περιγραφή Δραστηριότητας </label>
                    <textarea class="form-control {{ $errors->has('activity_description') ? 'is-invalid' : '' }}" rows="3" placeholder="Enter activity description" name="activity_description">{{ old('activity_description', isset($company) ? $company->activity_description : '') }}</textarea>
                    @if($errors->has('activity_description'))
                    <p class="help-block" style="color:red"> 
                        {{ $errors->first('activity_description') }}
                    </p>
                  @endif
                </div>

                <div class="form-group">
                  <label for="website">Ιστοσελίδα </label>
                  <input type="text" class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" id="website" name="website" placeholder="Enter website" value="{{ old('website', isset($company) ? $company->website : '') }}">
                  @if($errors->has('website'))
                    <p class="help-block" style="color:red"> 
                        {{ $errors->first('website') }}
                    </p>
                  @endif
            </div> 

            <div class="form-group">
              <label for="image" class="form-control-label">Λογότυπο </label>
              <input type="file" id="image" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}">
              @if($errors->has('image'))
                <p class="help-block" style="color:red"> 
                    {{ $errors->first('image') }}
                </p>
              @endif
          </div>
       
              </div>                 
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Αποθήκευση</button>
                </div>
              </form>
            
          </div>
    </div>
  </div>
</div>


@endsection