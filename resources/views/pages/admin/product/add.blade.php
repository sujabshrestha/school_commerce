@extends('layouts.admin.master')

{{-- @section('contentHeader')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Propertydetails</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.auth.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">All property details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection --}}

@section('content')
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Add Categories</h3>
                    </div>



                </div>


            </div>
            <div class="card-body p-0">
                <div class="col-md-12">
                    <form action="{{ route('admin.category.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                     @include('pages.admin.category.commonform')
                        <div class="sub-button float-right mt-3 mb-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
@endsection
