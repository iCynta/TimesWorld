
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('CREATE PRODUCT') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('store-product')}}"  id="image-form" enctype="multipart/form-data">
                        @csrf
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required autocomplete="title" autofocus>

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
                                <textarea id="description" name="description" rows="5" cols="10" class="form-control @error('description') is-invalid @enderror" ></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="color_id" class="col-md-4 col-form-label text-md-end">{{ __('Color') }}</label>

                            <div class="col-md-6">
                                <select class="form-select form-control @error('color') is-invalid @enderror" name="color_id">
                                    <option value="">{{__('Select Product Color') }}</option>
                                    @foreach($colors as $color)
                                    <option value={{$color->id}}>{{$color->color}}</option>
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
                                    <option value={{$size->id}}>{{$size->size}}</option>
                                    @endforeach
                                </select>

                                @error('size')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lot_code" class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                            <div class="col-md-4">
                                <input type="file" name="image" id="inputImage" class="form-control form-control-file">
                                <small id="imageHelp" class="form-text text-muted">{{ __('Only: jpeg,png,jpg,gif,svg. Max:2048') }}</small>
                                
                                <span class="invalid-feedback" id ="image-error" role="alert">
                                        
                                </span>
                                
                            </div>
                            <div class="col-md-4">
                                <a href='#' class="btn btn-sm btn-secondary"  id="image-upload">UPLOAD</a>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary float-end">
                                    {{ __('CREATE') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <img id="preview-image" width="300px">
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
      
    /*------------------------------------------
    --------------------------------------------
    Generating user Preview
    --------------------------------------------
    --------------------------------------------*/
    $('#inputImage').change(function(){    
        let reader = new FileReader();
        reader.onload = (e) => { 
            $('#preview-image').attr('src', e.target.result); 
        }   
        reader.readAsDataURL(this.files[0]); 
       
    });
      
    $('#image-upload').click(function(e) { 
        e.preventDefault();
        var productImage    =  document.getElementById('inputImage').files[0];
        
        var productImage = $('#inputImage').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('image', productImage);
        
        console.log(productImage);
        $.ajax({
            
            type:'post',
            url:"{{ route('upload-product-image') }}",
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            mimeType: 'multipart/form-data',
            data: form_data,//{ 'image': productImage} ,
            cache : false,
            processData: false,
            success:function(data) {
               alert("Image uploaded successfully")
            },
            error: function (msg) {
                alert("Image upload failed");
            }
        });
    });
</script>
@endsection

<!--


    $('#image-upload').click(function(e) {
           e.preventDefault();
           let formData = new FormData(this);
           $('#image-input-error').text('');
    
           $.ajax({
                type:'POST',
                url: "{{ route('upload-product-image') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    this.reset();
                    alert('Image has been uploaded successfully');
                },
                error: function(response){
                    $('#image-upload').find(".print-error-msg").find("ul").html('');
                    $('#image-upload').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#image-upload').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
           });




 $.ajax({
                enctype: 'multipart/form-data',
                type:'POST',
                url: "{{ route('upload-product-image') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                            "_token": "{{ csrf_token() }}",
                            "image": $('#inputImage').val()
                            },
                contentType: false,
                processData: false,
                success: (response) => {
                    this.reset();
                    alert('Image has been uploaded successfully');
                },
                error: function(response){
                    $('#image-form').find(".print-error-msg").find("ul").html('');
                    $('#image-form').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#image-form').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
           });


-->