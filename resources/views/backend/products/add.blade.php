@extends('layouts/templete_backend')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@endsection

@section('contents')
<div class="container-fluid">
    <div class="container w-75 text-dark mt-5">
        <form action="/admin/addProduct" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="name">Name Product</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Product" required="" value="{{ old('name')}}">
                         @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="category">Category Product</label>
                    </div>
                    <div class="col-md-8">
                        <select class="custom-select" name="category" id="category" required>
                            <option value="">Select Category</option>
                            <option value="SW">Switch</option>
                            <option value="SV">Server</option>
                            <option value="RT">Router</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="branch">Code Branch</label>
                    </div>
                    <div class="col-md-8">
                        <select class="custom-select" name="branch" id="branch" required>
                            <option value="">Select Branch</option>
                            <option value="JKT">Jakarta</option>
                            <option value="BKS">Bekasi</option>
                            <option value="BGR">Bogor</option>
                            <option value="BDG">Bandung</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="month">Month</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control month" name="month" id="month">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="year">Year</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control year" name="year" id="year" maxlength="2" minlength="2">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="validatedCustomFile">Photo Product</label>
                    </div>
                    <div class="col-md-8">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" id="validatedCustomFile">
                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning w-75">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script>
      $(document).ready(function(){
       $(".year").datepicker({
          format: "yyyy",
          viewMode: "years",
          minViewMode: "years",
          autoclose:true
       });
       $(".month").datepicker({
          format: "MM",
          viewMode: "months",
          minViewMode: "months",
          autoclose:true
       });
    })
</script>
@endsection
