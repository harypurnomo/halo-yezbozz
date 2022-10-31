@extends('layouts.applte')

@section('content')

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
                  <h3 class="box-title">{{ $title }} - {{ $b->category }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('bookingroom.update', ['id' => Crypt::encryptString($b->id)]) }}" method="post">
                  {{ csrf_field() }}
                  <div class="box-body">
                  
                    <div class="form-group">
                    <label for="category">Category</label>
                        <?php
                          $cats = DB::table('book_category')
                          ->where('st_category', 1)
                          ->orderBy('id', 'ASC')
                          ->get();
                         ?>
                        <select class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }} select2" name="category" id="category" style="width: 100%;" required>
                            <option value="">---Chose Category</option>
                            @foreach($cats as $cat)
                                <option value="{{ $cat->name }}" @if($cat->name == $b->category) selected="selected" @endif>{{ $cat->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('category'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @endif
                    </div>
                    <?php
                          $servs = DB::table('book_service')
                          ->where('st_service', 1)
                          ->orderBy('id', 'ASC')
                          ->get();
                          ?>
                    <div class="form-group">
                    <label for="service">Service</label>
                        <select class="form-control{{ $errors->has('service') ? ' is-invalid' : '' }} select2" name="service" id="service" style="width: 100%;" required>
                            <option value="">---Chose Sub Menu</option>
                            @foreach($servs as $serv)
                                <option value="{{ $serv->name }}" @if($serv->name == $b->service) selected="selected" @endif >{{ $serv->name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('service'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('service') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" id="date" placeholder="Date" value="{{ $b->date }}" required>
                        @if ($errors->has('date'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="text" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" name="time" id="time" placeholder="Time" value="{{ $b->time }}" required>
                        @if ($errors->has('time'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('time') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="durasi">Durasi</label>
                        <input type="text" class="form-control{{ $errors->has('durasi') ? ' is-invalid' : '' }}" name="durasi" id="durasi" placeholder="Durasi" value="{{ $b->durasi }}" required>
                        @if ($errors->has('durasi'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('durasi') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" placeholder="Nama" value="{{ $b->name }}" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="phone">Telepon</label>
                        <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="phone" placeholder="Telepon" value="{{ $b->phone }}" required>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email" value="{{ $b->email }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                    <label for="pay">Pembayaran</label>
                    <input type="text" class="form-control{{ $errors->has('pay') ? ' is-invalid' : '' }}" name="pay" id="pay" placeholder="Pembayaran" value="{{ $b->pay }}" required>
                    @if ($errors->has('pay'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('pay') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="phone">Telepon</label>
                        <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="phone" placeholder="Telepon" value="{{ $b->phone }}" required>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="pay">Notes</label>
                        <textarea name="notes" class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}">{{$b->notes}}</textarea>
                        @if ($errors->has('notes'))
                                <span class="invalid-feedback" style="color: red">
                                    <strong>{{ $errors->first('notes') }}</strong>
                                </span>
                            @endif
                        </div>

                    <div class="form-group">
                        <label for="st_book">Status</label>
                        <select class="form-control{{ $errors->has('st_book') ? ' is-invalid' : '' }} select2" name="st_book" id="st_book" style="width: 100%;" required>
                            <option value="">---Choose Status</option>
                            <option value="0" @if($b->st_book==0) selected @endif>Waiting</option>
                            <option value="1" @if($b->st_book==1) selected @endif>Approve</option>
                            <option value="2" @if($b->st_book==2) selected @endif>Rejected</option>
                        </select>
                        @if ($errors->has('st_book'))
                            <span class="invalid-feedback" style="color: red">
                                <strong>{{ $errors->first('st_book') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-default" onclick="location.href='{{ route('bookingrooms') }}'">Cancel</button>
                  </div>
                </form>
              </div>
          <!-- /.box -->
    
        </section>
        <!-- /.content -->
      </div>
@endsection