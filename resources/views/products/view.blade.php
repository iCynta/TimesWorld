
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('PRODUCT DETAIL') }}</div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
                            
                            <tbody>
                                
                                <tr>
                                    <td colspan='2'><img src="{{ asset('images/products/'.$product->image) }}" alt="{{$product->title}}" class=" img img-responsive img-thumbnail mx-auto d-block"></td>
                                </tr> 
                                <tr>
                                    <td>Title</td> <td> {{$product->title}}</td>
                                </tr> 
                                <tr>
                                    <td>Color</td> <td> {{$product->color->color}}</td>
                                </tr> 
                                <tr>
                                    <td>Size</td> <td> {{$product->size->size}}</td>
                                </tr> 
                                <tr>
                                    <td>Description</td> <td> {{trim($product->description)}}</td></tr> 
                                <tr>
                                    <td>Created On</td> <td> {{$product->created_at}}</td>
                                </tr>
                                
                            </tbody>
                            <tfooter>
                                <tr>
                                    <th colspan="2" class='text-end'>
                                        <a href='{{route('edit-product',$product->id)}}' class='btn btn-sm btn-warning mx-2'> EDIT </a>
                                        <a href="{{route('products')}}" class="btn btn-sm btn-secondary float-end mx-2"> BACK </a>
                                    </th>
                                </tr>
                            </tfooter>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>



@endsection