<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Code - {{ $order->order_code ?? '' }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>

                @if (isset($order->orderdetails) && !empty($order->orderdetails))
                    @foreach ($order->orderdetails as $orderdetail)


                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td> <span class="text-capitalize"> {{ $orderdetail->product->title }}</span> </td>
                    <td>{{ $orderdetail->quantity }}</td>
                    <td>
                        <img src="{{ isset( $orderdetail->product->feature_img) ? getImageUrl($orderdetail->product->feature_img) : "" }}"
                        style="height: 100px;object-fit:cover;" alt="">
                    </td>

                    <td>Rs. {{ $orderdetail->price }}</td>
                </tr>
                @endforeach

                @endif
            </tbody>
            <tfoot>
                <tr>
                  <td>Total</td>
                  <td>Rs.{{ $order->total_amount ?? '' }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
