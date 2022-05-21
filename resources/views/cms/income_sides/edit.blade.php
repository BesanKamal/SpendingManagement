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
                        <h3 class="card-title">{{__('cms.edit_income_side')}}</h3>
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
                                    <option value="{{$role->id}}">{{$role->name_income_side}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="name_income_side">{{__('cms.name_income_side')}}</label>
                                <input type="text" class="form-control" id="name_income_side" value="{{$income_side->name_income_side}}"
                                    placeholder="{{__('cms.name_income_side')}}">
                            </div>
                            
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{$income_side->id}}')"
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
        axios.put('/cms/admin/income_sides/{{$income_side->id}}', {
            name_income_side: document.getElementById('name_income_side').value,
            
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/cms/income_side/income_sides';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection