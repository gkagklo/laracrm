@extends('layouts.admin')
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Επεξεργασία Εργαζόμενου</h3>
            </div>
            <form role="form" method="POST" action="{{ route('moderator.employees.update',$employee->id) }}">
              {!! csrf_field() !!}
              {{ method_field('PUT') }}
            <div class="card-body">

                  <div class="form-group">
                    <label for="full_name">Ονοματεπώνυμο <span style="color:red">*</span></label>
                    <input type="text" class="form-control  {{ $errors->has('full_name') ? 'is-invalid' : '' }}" id="full_name" name="full_name" placeholder="Enter full name" value="{{ $employee->full_name }}">
                    @if($errors->has('full_name'))
                      <p class="help-block" style="color:red"> 
                        {{ $errors->first('full_name') }}
                      </p>
                    @endif
                  </div>

                  <div class="form-group">
                      <label for="email">Email <span style="color:red">*</span></label>
                      <input type="email" class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Enter email" value="{{ $employee->email }}">
                      @if($errors->has('email'))
                        <p class="help-block" style="color:red"> 
                          {{ $errors->first('email') }}
                        </p>
                      @endif
                    </div>

                    <div class="form-group">
                        <label for="phone">Τηλέφωνο </label>
                        <input type="text" class="form-control  {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" name="phone" placeholder="Enter phone" value="{{ $employee->phone }}">
                        @if($errors->has('phone'))
                          <p class="help-block" style="color:red"> 
                            {{ $errors->first('phone') }}
                          </p>
                        @endif
                      </div>

                      <div class="form-group">
                          <label class="bmd-label-floating">Εταιρεία <span style="color:red">*</span></label>
                          <select class="form-control {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company">  
                              @foreach($companies as $company)
                                  <option value="{{ $company->id }}" @if($company->id ==  $employee->company_id ) selected="selected" @endif>{{ $company->name }}</option>
                              @endforeach
                          </select>
                          @if($errors->has('company'))
                              <p class="help-block" style="color:red"> 
                                  {{ $errors->first('company') }}
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