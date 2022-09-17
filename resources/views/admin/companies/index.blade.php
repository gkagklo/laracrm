@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-12">         
            <a class="btn btn-success" href="{{ route('admin.companies.create') }}" >
               Προσθήκη εταιρείας  
            </a><br><br>
        @if($companies->count() > 0)
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Λίστα εταιρειών</h3>
              </div>
              <div class="card-body">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Όνομα</th>
                        <th scope="col">Email</th>
                        <th scope="col">Κατηγορίες</th>
                        <th scope="col">Περιγραφή Δραστηριότητας</th>
                        <th scope="col">Ιστοσελίδα</th>
                        <th scope="col">Λογότυπο</th>
                        <th scope="col">Ενέργειες</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>   
                                <td>{{ $company->email }}</td>  
                                <td>
                                    @foreach($company->categories as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td style="max-width: 300px;">{{ $company->activity_description }}</td>              
                                <td>{{ $company->website }}</td> 
                                <td><img src="{{asset('storage/company/'.$company->image)}}" alt="" style="width:300px;height:200;"></td> 
                                <td>
                                    <a href="{{ route('admin.companies.edit', $company->id) }}">
                                        <button type="button" class="btn btn-primary btn-sm"> Επεξεργασία</button>
                                    </a>
                                    <button rel="tooltip" title="Remove"
                                                    class="btn btn-sm btn-danger btn-icon table-action"
                                                    onclick="deleteCompany({{ $company->id }})">
                                                Διαγραφή
                                    </button>
                                    <div class="collapse">
                                            <form id="delete-form-{{ $company->id }}" action="{{ route('admin.companies.destroy',$company->id) }}" method="POST" style="display:none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
              </div>
            </div>
            @else
            <div class="alert alert-warning">
                <strong>Warning!</strong> No data found.
            </div>
            @endif
      </div>
    </div>
</div>

@endsection

@push('js')

<script type="text/javascript">      
    function deleteCompany(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }
  </script>

@endpush