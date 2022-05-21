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
                        <h3 class="card-title">{{__('cms.create_income')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label>{{__('cms.users')}}</label>
                                <select class="form-control" id="user_id">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                <label>{{__('cms.income_sides')}}</label>
                                <select class="form-control" id="income_side_id">
                                    @foreach ($income_sides as $income_side)
                                    <option value="{{$income_side->id}}">{{$income_side->name_income_side}}</option>
                                    @endforeach
                                </select>
                            </div>  
                            
                            
                            <div class="form-group">
                                <label for="currency">{{__('cms.currency')}}</label>
                                <input type="text" class="form-control" id="currency" placeholder="{{__('cms.currency')}}">
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
        axios.post('/cms/admin/incomes', {
            currency: document.getElementById('currency').value,
            user_id: document.getElementById('user_id').value,
            name_income_side: document.getElementById('name_income_side').value,
        
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