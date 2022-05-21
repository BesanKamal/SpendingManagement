@extends('cms.parent')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.edit_spendings')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                            {{-- <div class="form-group">
                                <label>{{__('cms.roles')}}</label>
                                <select class="form-control" id="role_id">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->quantity}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label>{{__('cms.operation_name_id')}}</label>
                                <select class="form-control" id="operation_name_id">
                                    @foreach ($operation_names as $operation_name)
                                    <option value="{{$operation_name->id}}">{{$operation_name->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{__('cms.users')}}</label>
                                <select class="form-control" id="user_id">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">{{__('cms.quantity')}}</label>
                                <input type="text" class="form-control" id="quantity" value="{{$spending->quantity}}"
                                    placeholder="{{__('cms.quantity')}}">
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('cms.price')}}</label>
                                <input type="text" class="form-control" id="price" value="{{$spending->price}}"
                                    placeholder="{{__('cms.price')}}">
                            </div>
                            
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{$spending->id}}')"
                                class="btn btn-primary">{{__('cms.save')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
{{-- <script src="{{asset('js/axios.js')}}"></script> --}}
<script>
    function performUpdate(id) {
        axios.put('/cms/admin/spendings/{{$spending->id}}', {
            quantity: document.getElementById('quantity').value,
            price: document.getElementById('price').value,
            
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/admin/spendings';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection