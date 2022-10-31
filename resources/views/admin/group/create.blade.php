@extends('admin.layouts.template')

@section('content')
<!-- begin:: Content Head -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main"> 
            <h3 class="kt-subheader__title">{{ Library::modules(Request::segment(1).'/'.Request::segment(2))[0]->module_name }}</h3>

            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Create a new</span>
            </div>
        </div>

        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                <a href="{{ route('master-group.index') }}" class="btn kt-subheader__btn-primary">Back To List &nbsp;</a>
            </div>
        </div>
    </div>
</div>
<!-- end:: Content Head -->					

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	<div class="row">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon-more"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">Form Create</h3>
                </div>
            </div>
            
            <div class="kt-portlet__body">

                <!--begin::Form-->
                <form class="kt-form form-submit-ajax" action="{{ url('administrator/master-group') }}" method="post">
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label>Group Name <span class="kt-font-danger">*</span></label>
                            <input type="text" name="group_name" class="form-control" placeholder="Your Group Name" required="" minlength="5" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="is_active">Active <span class="kt-font-danger">*</span></label>
                            <select class="form-control col-4" name="is_active" required="">
                                <option value="">-- choose one of them --</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h3 class="text-center">Module Access</h3>
                            <table class="table table-bordered table-hover table-access">
                                <thead>
                                    <tr>
                                        <th rowspan="2">List Of Modules</th>
                                        <th colspan="5">Access</th>
                                    </tr>
                                    <tr>
                                        <th>Read</th>
                                        <th>Create</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                        <th>Approve</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($module as $item)
                                    <tr>
                                        <td>{{ $item->module_name }}</td>
                                        <td class="td-center"><input type="checkbox" name="access[]" value="{{ $item->module_id }}_view"></td>
                                        <td class="td-center"><input type="checkbox" name="access[]" value="{{ $item->module_id }}_create"></td>
                                        <td class="td-center"><input type="checkbox" name="access[]" value="{{ $item->module_id }}_update"></td>
                                        <td class="td-center"><input type="checkbox" name="access[]" value="{{ $item->module_id }}_delete"></td>
                                        <td class="td-center"><input type="checkbox" name="access[]" value="{{ $item->module_id }}_approve"></td>
                                    </tr>
                                    @foreach ($item->child_module as $d)
                                        <tr>
                                            <td class="pl-40">{{ $d->module_name }}</td>
                                            <td class="td-center"><input type="checkbox" name="access[]" value="{{ $d->module_id }}_view"></td>
                                            <td class="td-center"><input type="checkbox" name="access[]" value="{{ $d->module_id }}_create"></td>
                                            <td class="td-center"><input type="checkbox" name="access[]" value="{{ $d->module_id }}_update"></td>
                                            <td class="td-center"><input type="checkbox" name="access[]" value="{{ $d->module_id }}_delete"></td>
                                            <td class="td-center"><input type="checkbox" name="access[]" value="{{ $d->module_id }}_approve"></td>
                                        </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="button" class="btn btn-primary btn-submit-ajax" data-href="{{ url('administrator/master-group') }}"><i class="fa fa-arrow-alt-circle-up"></i> Submit</button>&nbsp;
                            <button type="reset" class="btn btn-secondary"><i class="fa fa-history"></i> Reset</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->			

            </div>
        </div>
    </div>

</div>
    
@endsection