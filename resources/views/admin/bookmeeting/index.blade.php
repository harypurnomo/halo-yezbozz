@extends('layouts.applte')

@section('content')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

<script src="{{ asset('assets/lte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script>
$(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
    })
})
</script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
                {{ $titles }}
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{ $title }}</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ $title }}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">

                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Category</th>
                        <th>Service</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Notes</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                          <?php $no=1; ?>
                          @foreach($books as $b)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $b->date }}</td>
                        <td>{{ $b->time }}</td>
                        <td>{{ $b->category }}</td>
                        <td>{{ $b->service }}</td>
                        <td>{{ $b->name }}</td>
                        <td>{{ $b->phone }}</td>
                        <td>{{ $b->email }}</td>
                        <td>{{ $b->notes }}</td>
                        <td>@if($b->st_book==1)
                            <span class="label label-primary" style="font-size: 14px">Approve</span>
                            @elseif($b->st_book==2)
                            <span class="label label-danger" style="font-size: 14px">Rejected</span>
                            @else
                              <span class="label label-warning" style="font-size: 14px">Waiting</span>
                        @endif
                        </td>
                        <td>
                            <a href="{{ route('bookingroom.edit', ['id' => Crypt::encryptString($b->id)]) }}">
                                <i class="fa fa-edit text-blue" style="font-size: 20px"></i>
                            </a>&nbsp;
                            <a href="{{ route('bookingroom.delete', ['id' => Crypt::encryptString($b->id)]) }}" onclick="return confirm('Apakah anda yakin akan menghapus {{ $b->name }}?')">
                                <i class="fa fa-trash text-red" style="font-size: 20px"></i>
                            </a>
                        </td>
                      </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Category</th>
                            <th>Service</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Action</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
            <!-- /.box-body -->
            <div class="box-footer">
              Footer
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
@endsection
