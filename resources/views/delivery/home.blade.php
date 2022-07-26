@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Orders') }}
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Item Code</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Pickup Address</th>
                                <th scope="col">Delivery Address</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($orders) && count($orders) > 0)
                                @foreach($orders as $order)
                                    <tr>
                                        <td scope="row">{{$order->item_code}}</td>
                                        <td scope="row">{{$order->item_name}}</td>
                                        <td scope="row">{{$order->order_status}}</td>
                                        <td scope="row">{{$order->pickup_address->address}}</td>
                                        <td scope="row">{{$order->delivery_address->address}}</td>
                                        {{--<td>{{$order->picked_at != null ? $order->picked_at->format('d M Y') : ''}}</td>--}}
                                        {{--<td>{{$order->delivered_at != null  ? $order->delivered_at->format('d M Y') : ''}}</td>--}}
                                        <td>
                                            @if($order->order_status == 'Open')
                                            <a class="picked" title="Pick"  href="{{route('delivery.orders.picked',$order->id)}}">Pick</a>
                                            @elseif($order->order_status == 'Picked')
                                            <a class="delivered text-danger" title="Delete" href="{{route('delivery.orders.delivered',$order->id)}}">Delivered</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No data Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="invoiceBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
        $(document).on('click', '.picked', function (e) {
            e.preventDefault();
            var conf = confirm("Are you sure!");
            if (conf) {
                var url = $(this).attr('href');
                console.log('url: ' + url);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        location.reload();
                    },
                    error: function (response) {
                        alert('try again');
                    }
                });
            }
        });

        $(document).on('click', '.delivered', function(e) {
            e.preventDefault();
            var conf = confirm("Are you sure!");
            if(conf){
                var url = $(this).attr('href');
                console.log('url: ' + url);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        location.reload();
                    },
                    error: function (response) {
                        alert('try again');
                    }
                });
            }
        })
    </script>
@endsection