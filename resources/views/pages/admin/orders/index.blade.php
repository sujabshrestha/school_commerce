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

        <div class="modal fade viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="appendOrderData">

                </div>
            </div>
        </div>


        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-12 ">
                        <h3 class="card-title">All Orders</h3>

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
                                Order Code
                            </th>
                            <th style="width: 30%">
                                User
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Total Amount
                            </th>
                            <th style="width: 20%">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($orders) && !empty($orders))
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <a>
                                            <span class="text-capitalize">
                                                {{ $order->order_code }}

                                            </span>
                                        </a>
                                        <br />
                                        <small>{{ $order->created_at->format('Y-m-d') }}</small>

                                    </td>
                                    <td>
                                        {{ $order->user->name }}
                                    </td>
                                    <td>
                                        <select name="status" data-orderid="{{ $order->id }}" class="form-control status" id="">
                                            <option @if (isset($order) && $order->order_status == 'pending')
                                                selected
                                            @endif  value="pending">Pending</option>
                                            <option @if (isset($order) && $order->order_status == 'inprogress')
                                                selected
                                            @endif value="inprogress">In Progress</option>
                                            <option @if (isset($order) && $order->order_status == 'rejected')
                                                selected
                                            @endif value="rejected">Rejected</option>
                                            <option @if (isset($order) && $order->order_status == 'delivered')
                                                selected
                                            @endif value="delivered">Delivered</option>
                                        </select>
                                    </td>

                                    <td>
                                        Rs. {{ $order->total_amount }}
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-primary viewOrder"
                                            data-orderid="{{ $order->id }}">View</button>



                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <div class="noplotdetail-section text-center mt-2">
                                <h1>No any products</h1>
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


@push('scripts')
    <script>
        $(document).on('click', '.viewOrder', function(e) {
            e.preventDefault();
            var currentthis = $(this);
            var orderid = $(this).attr('data-orderid');
            var url = "{{ route('admin.order.viewOrder', ':id') }}";
            url = url.replace(':id', orderid);

            $.ajax({
                type: "GET",
                url: url,
                beforeSend: function(data) {},
                success: function(data) {
                    $('.appendOrderData').html(data.data.view);

                    $('.viewModal').modal("show");

                },
                error: function(err) {
                    if (err.status == 422) {
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: red;">' + error[0] + '</span>')
                                .fadeOut(15000));
                        });
                    }
                }
            });




            $(this).attr('disabled');
        });


        $(document).on('change', '.status', function(e){
            e.preventDefault();
            currentthis = $(this);
            var orderid = currentthis.attr('data-orderid');
            var status = currentthis.val();
            var url = "{{ route('admin.order.changeStatus', ':id') }}";
            url = url.replace(':id', orderid);
            $.ajax({
                type: "GET",
                url: url,
                data :{
                    status : status
                },
                beforeSend: function(data) {},
                success: function(data) {
                    toastr.success("Successfully Updated");
                },
                error: function(err) {
                    if (err.status == 422) {
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: red;">' + error[0] + '</span>')
                                .fadeOut(15000));
                        });
                    }
                }
            });
        });
    </script>
@endpush
