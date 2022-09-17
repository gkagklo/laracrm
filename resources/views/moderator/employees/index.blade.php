@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-12">         
            <a class="btn btn-success" href="{{ route('moderator.employees.create') }}" >
               Προσθήκη Εργαζόμενου  
            </a><br><br>
        @if($employees->count() > 0)
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Λίστα κατηγοριών</h3>
              </div>
              <div class="card-body">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Ονοματεπώνυμο</th>
                        <th scope="col">Email</th>
                        <th scope="col">Τηλέφωνο</th>
                        <th scope="col">Εταιρεία</th>
                        <th scope="col">Ενέργειες</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->full_name }}</td>   
                                <td>{{ $employee->email }}</td>  
                                <td>{{ $employee->phone }}</td>  
                                <td>{{ $employee->company->name }}</td>               
                                <td>
                                    <a href="{{ route('moderator.employees.edit', $employee->id) }}">
                                        <button type="button" class="btn btn-primary btn-sm"> Επεξεργασία</button>
                                    </a>
                                    <button rel="tooltip" title="Remove"
                                                    class="btn btn-sm btn-danger btn-icon table-action"
                                                    onclick="deleteEmployee({{ $employee->id }})">
                                                Διαγραφή
                                    </button>
                                    <div class="collapse">
                                            <form id="delete-form-{{ $employee->id }}" action="{{ route('moderator.employees.destroy',$employee->id) }}" method="POST" style="display:none;">
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
    function deleteEmployee(id) {
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