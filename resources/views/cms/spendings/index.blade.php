@extends('cms.parent')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.spendings')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    
                                    <th>{{__('cms.quantity')}}</th>
                                    <th>{{__('cms.price')}}</th>
                                    <th>{{__('cms.user_id')}}</th>
                                    <th>{{__('cms.operation_name_id')}}</th>
                                    <th>{{__('cms.created_at')}}</th>
                                    <th>{{__('cms.updated_at')}}</th>
                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spendings as $spending)
                                <tr>
                                    <td>{{$spending->id}}</td>
                                    
                                    <td>{{$spending->quantity}}</td>
                                    <td>{{$spending->price}}</td>
                                    <td>{{$spending->user_id}}</td>
                                    <td>{{$spending->operation_name_id}}</td>
                                    <td>{{$spending->created_at}}</td>
                                    <td>{{$spending->updated_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('spendings.edit',$spending->id)}}" class="btn btn-secondary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete('{{$spending->id}}', this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id, reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id, reference);
        }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/cms/admin/spendings/'+id)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            reference.closest('tr').remove();
            showMessage(response.data);
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
            showMessage(error.response.data);
        });
    }
</script>
@endsection