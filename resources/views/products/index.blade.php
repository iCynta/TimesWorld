
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ __('PRODUCTS') }} </div>

                <div class="card-body table-responsive">
                    <table class='table table-sm table-strip'>
                        <thead>
                            <tr>
                                <th colspan="4"> <a href="{{route('create-product')}}" class="btn btn-sm btn-success float-end">NEW PRODUCT</a></th>
                            </tr>
                            <tr>
                                <th>Si:</th>
                                <th>Title</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{$product->title}}</td>
                                <td>{{$product->created_at}}</td>

                                <td>
                                    <a href='{{route('product',$product->id)}}' class='btn btn-sm btn-info'>VIEW</a>
                                    <a href='{{route('edit-product',$product->id)}}' class='btn btn-sm btn-secondary'>EDIT</a>
                                    @if($product->deleted_at == NULL)
                                        <a href='{{route('delete-product',$product->id)}}' class='btn btn-sm btn-warning'>DISABLE</a>
                                    @else
                                        <a href='{{route('enable-product',$product->id)}}' class='btn btn-sm btn-success'>ENABLE</a>
                                        <a href='{{route('thrash-product',$product->id)}}' class='btn btn-sm btn-danger'>THRASH</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
