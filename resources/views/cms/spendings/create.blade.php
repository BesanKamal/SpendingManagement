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
                        <h3 class="card-title">{{__('cms.create_spendings')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
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
                                <input type="quantity" class="form-control" id="quantity" placeholder="{{__('cms.quantity')}}">
                            </div>
                            <div class="form-group">
                                <label for="price">{{__('cms.price')}}</label>
                                <input type="price" class="form-control" id="quantity" placeholder="{{__('cms.price')}}">
                            </div>
                           
                            
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performStore()"
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
    function performStore() {
        axios.post('/cms/admin/spendings', {
            
            quantity: document.getElementById('quantity').value,
            price: document.getElementById('price').value,
            operation_name_id: document.getElementById('operation_name_id').value,
            user_id: document.getElementById('user_id').value,
            
            // role_id: document.getElementById('role_id').value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-form').reset();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
  
</script>

@endsection