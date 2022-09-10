@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الأعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل قسم</span>
            </div>
        </div>
    </div>
    <!--first-->
    <!--show Errors massage Form-->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!--show succesful Edit massage Form-->
    @if(session()->has('success'))
    <div class="alert alert-success">
    {{ session()->get('success') }}
    </div>
    @endif

    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <h1 class=" p-3 display-4">  تعديل القسم : </h1>

        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto">
                    <!--first-->
                    <form class="p-4 m-3 border bg-gradient-info" method="POST" action="{{ url('products/update/' . $products->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="cat">اسم القسم </label>
                            <!--show the cat what you want to edit-->
                            <input type="text" name="product_name" value="{{$products->product_name}}" class="form-control" id="product_name">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-reply-all-fill"></i> Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
