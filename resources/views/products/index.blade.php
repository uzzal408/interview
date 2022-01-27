@extends('layouts.app')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>


    <div class="card">
        <form action="" method="get" class="card-header">
            <div class="form-row justify-content-between">
                <div class="col-md-2">
                    <input type="text" name="title" placeholder="Product Title" class="form-control">
                </div>
                <div class="col-md-2">
                    <select name="variant" id="" class="form-control">
                        <option value=" ">Select a product variant</option>
                        @foreach($variants as $variant)
                            <option value="{{ $variant->id }}">{{ $variant->variant }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Price Range</span>
                        </div>
                        <input type="text" name="price_from" aria-label="First name" placeholder="From" class="form-control">
                        <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date" placeholder="Date" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <div class="card-body">
            <div class="table-response">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Variant</th>
                        <th width="150px">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php $sl=0 @endphp
                    @foreach($products as $product)
                    <tr>
                        <td width="5%">{{ ++$sl }}</td>
{{--                        <td>{{ $product->title }} <br> Created at : {{ Carbon\Carbon::parse($product->created_at)->format('d F Y') }}</td>--}}
                        <td width="10%">{{ $product->title }} <br> Created at : {{ $product->created_at->diffForHumans() }}</td>
                        <td>{{ $product->description }}</td>
                        <td width="30%">
                            @foreach($product->varient_price as $variant)
                            <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant">

                                <dt class="col-sm-3 pb-0">
{{--                                    {{ $variant->product_variant_two }}/ {{ $variant->product_variant_two }}/ {{ $variant->product_variant_three }}--}}
                                    {{ get_variant_name($variant->product_variant_one,$variant->product_variant_two,$variant->product_variant_three) }}
                                </dt>
                                <dd class="col-sm-9">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4 pb-0">Price : {{ number_format($variant->price,2) }}</dt>
                                        <dd class="col-sm-8 pb-0">InStock : {{ number_format($variant->stock,2) }}</dd>
                                    </dl>
                                </dd>
                            </dl>
                            @endforeach
                            <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show more</button>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('product.edit', 1) }}" class="btn btn-success">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    </tbody>

                </table>
                @if($paginate)
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        {{ $products->links() }}
                    </div>
                </div>
                @endif
            </div>

        </div>

        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <p>Showing {{ $start }} to {{ $end }} out of {{ $total }}</p>
                </div>
                <div class="col-md-2">

                </div>
            </div>
        </div>
    </div>

@endsection
