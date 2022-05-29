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
                    <div class="col-lg-12 ">
                        <h3 class="card-title">All Categories</h3>
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary float-right">Add New
                        </a>

                    </div>
                    {{-- <div class="row col-md-12">

                        <div class="col-md-12">
                            <h4>Filter Property details</h4>
                        </div>

                        <div class="col-md-10">
                            <form method="GET" action="{{ route('backend.propertydetails.filter') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Select Province</label>
                                        <select name="state" class="form-control stateID" id="">
                                            <option value="">Choose one</option>
                                            @if (isset($states) && !empty($states))
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"
                                                        data-districts="{{ json_encode($state->districts->toArray()) }}">
                                                        {{ $state->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Select District</label>
                                        <select name="district" class="form-control districtID" id="selectdistrict">
                                            <option value="">Choose one</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Select Municipal</label>
                                        <select name="municipal" class="form-control" id="selectmunicipals">
                                            <option value="">Choose one</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Ward No</label>
                                        <input type="text" name="ward_no" placeholder="Enter Ward Number"
                                            class="form-control">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary float-right mt-4">Filter</button>
                        </div>
                        </form>

                    </div> --}}

                </div>


            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 20%">
                                Category
                            </th>
                            <th style="width: 30%">
                                Status
                            </th>
                            <th>
                                Logo
                            </th>

                            <th style="width: 20%">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($categories) && !empty($categories))
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <a>
                                            {{ $category->title }}
                                        </a>
                                        <br />
                                        <small>{{ $category->created_at->format('Y-m-d') }}</small>

                                    </td>
                                    <td>
                                        <span class="badge @if ($category->status == 'active')
                                            badge-success
                                        @else
                                            badge-danger
                                        @endif   p-2 text-capitalize">
                                            {{ $category->status }}
                                        </span>
                                    </td>
                                    <td>
                                       <img src="{{ $category->logo ? getImageUrl($category->logo) : "" }}" style="height: 100px; object-fit:cover;" alt="">
                                    </td>


                                    <td class="project-actions text-left">
                                        {{-- <a class="btn btn-primary btn-sm"
                                            href="{{ route('backend.propertydetails.getPropertyDetail', $plotdetail->id) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a> --}}

                                        <a class="btn btn-info btn-sm"
                                            href="{{ route('admin.category.edit', $category->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.category.delete', $category->id) }}">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <div class="noplotdetail-section text-center mt-2">
                                <h1>No any categories</h1>
                            </div>
                        @endif

                    </tbody>
                </table>

                {{-- <div class="pagination mt-2 ml-2 justify-content-center">
                    {!! $allplotdetails->links() !!}
                </div> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>

@endsection


