
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('UPDATE PRODUCT') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('update-product')}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $product->title }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="lot_code" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" name="description" rows="5" cols="10" class="form-control @error('description') is-invalid @enderror" >
                                   {{ $product->description }}
                                </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lot_code" class="col-md-4 col-form-label text-md-end">{{ __('Color') }}</label>

                            <div class="col-md-6">
                                <select class="form-select form-control @error('color') is-invalid @enderror" name="color_id">
                                    <option value="">{{__('Select Product Color') }}</option>
                                    @foreach($colors as $color)
                                        <option value="{{$color->id}}" @if( $color->id == $product->color_id) selected @endif>{{$color->color}}</option>
                                    @endforeach
                                </select>

                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lot_code" class="col-md-4 col-form-label text-md-end">{{ __('Size') }}</label>

                            <div class="col-md-6">
                                <select class="form-select form-control @error('size') is-invalid @enderror" name="size_id">
                                    <option value="">{{__('Select Product Size') }}</option>
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}" @if( $size->id == $product->size_id) selected @endif>{{$size->size}}</option>
                                    @endforeach
                                </select>

                                @error('size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input name="id" type="hidden" value="{{$product->id}}"> <!-- Primary key to update row -->
                                <button type="submit" class="btn btn-primary float-end">
                                    {{ __('UPDATE') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection