@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الأعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ جميع المنتجات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
				<!--succes delete massage-->
				@if(session()->has('success'))
				<div class="alert alert-success">
					{{ session()->get('success')}}
				</div>
			@endif	
@endsection
@section('content')
				<!-- row -->
					@if($sections->isEmpty())
					<h1 class=" p-3 display-4"> لا يمكن اضافة منتج بدون وجود قسم</h1>
					<h2  >لإضافة قسم</h2>
					<a class="btn btn-primary" href="{{ url('sections') }}" role="button">اضغط هنا</a>
					@elseif(!$products->isEmpty())
					<div class="container">
						<div class="row">
							<div class="col-12">
							<table class="table">
								<thead class="thead-dark">
									<tr>
									<th scope="col">#</th>
									<th scope="col">product name</th>
									<th scope="col">description</th>
									<th scope="col">section name</th>
									<th scope="col">edit</th>
									<th scope="col">delete</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($products as $product)
									<tr>
										<th scope="row">{{$loop->iteration}}</th>
										<td>{{$product->product_name}}</td>
										<td>{{$product->description}}</td>
										<td>{{$product->section->section_name}}</td>										
										<td>
											<a href="{{url('products/edit/'.$product->id)}}" class="btn btn-info">Edit <i class="bi bi-pencil-square"></i></a>                        
										</td>
										<td>
											<form action="{{url('products/delete/'.$product->id)}}" method="POST">
												@csrf
												@method("DELETE")
												<div class="form-group">
													<input type="submit" value="Delete" class="btn btn-danger" />
												</div>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
								</table>
						</div>
					</div>
			</div>
			@else
				<h1 class=" p-3 display-4">  لا يوجد منتجات </h1>
				<h2  >لإضافة منتج</h2>
				<a class="btn btn-primary" href="{{ url('products') }}" role="button">اضغط هنا</a>
				@endif

				<!-- row closed -->
			</div>
			<!-- Container closed -->
			
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection