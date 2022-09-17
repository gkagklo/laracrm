@extends('layouts.admin')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Επεξεργασία Εταιρείας</h3>
            </div>
            <form role="form" method="POST" action="{{ route('moderator.companies.update',$company->id) }}" enctype="multipart/form-data">
              {!! csrf_field() !!}
              {{ method_field('PUT') }}
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
                    <input type="text" class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Enter name" value="{{ $company->name }}">
                    @if($errors->has('name'))
                      <p class="help-block" style="color:red"> 
                        {{ $errors->first('name') }}
                      </p>
                    @endif
                  </div>

                  <div class="form-group">
                    <label for="email">Email <span style="color:red">*</span></label>
                    <input type="email" class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Enter email" value="{{ $company->email }}">
                    @if($errors->has('email'))
                      <p class="help-block" style="color:red"> 
                        {{ $errors->first('email') }}
                      </p>
                    @endif
                  </div>
                 
                  <div class="form-group">
                    <label for="activity_description">Περιγραφή Δραστηριότητας<span style="color:red">*</span></label>
                    <textarea class="form-control {{ $errors->has('activity_description') ? 'is-invalid' : '' }}" rows="3" placeholder="Enter activity description" name="activity_description">{{ $company->activity_description }}</textarea>
                    @if($errors->has('activity_description'))
                    <p class="help-block" style="color:red"> 
                      {{ $errors->first('activity_description') }}
                    </p>
                  @endif
                </div>

                <div class="form-group">
                  <label for="website">Ιστοσελίδα <span style="color:red">*</span></label>
                  <input type="website" class="form-control  {{ $errors->has('website') ? 'is-invalid' : '' }}" id="website" name="website" placeholder="Enter website" value="{{ $company->website }}">
                  @if($errors->has('website'))
                    <p class="help-block" style="color:red"> 
                      {{ $errors->first('website') }}
                    </p>
                  @endif
                </div>

                <div class="form-group">
                  <label for="image">Λογότυπο</label>
                  <input type="file"  name="image" class="form-control border-input">
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