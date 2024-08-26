@extends('layouts.master')

@section('titleHeade' , 'المنتجات')


@section('css')
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الأعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المنتجات</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				{{-- Errors Alert --}}
				@if ($errors->any())
					<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
						<ul>
							<ol type="1">
								@foreach ($errors->all() as $erorr)
								<li class="mx-1 my-1">{{ $erorr }}</li>
								@endforeach
							</ol>
						</ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
					</div>
					@endif
					{{-- Add Alert --}}
				@if (session()->has('Add'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						
						<span class="alert-inner--text mx-4"><strong> أضافة ! </strong> تم أضافة المنتج بنجاح </span>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					@endif
					{{-- Edit Alert --}}
					@if (session()->has('Edit'))
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						
						<span class="alert-inner--text mx-4"><strong> تعديل ! </strong> تم تعديل المنتج بنجاح </span>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					@endif
					{{-- Delete Alert --}}
					@if (session()->has('Delete'))
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<span class="alert-inner--text mx-4"><strong> حذف ! </strong> تم حذف المنتج بنجاح </span>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					@endif
				<!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="row row-xs wd-xl-80p">
									<div class="col-sm-6 col-md-3">
										@can('اضافة منتج')
											<a class="btn btn-info-gradient btn-block
											modal-effect btn btn-outline-info btn-block"
											data-effect="effect-scale" data-toggle="modal" href="#modaldemo8"
											>أضافة منتج</a>
										@endcan
									</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم المنتج</th>
												<th class="border-bottom-0">اسم القسم</th>
												<th class="border-bottom-0">الملاحظات</th>
												<th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
												<?php $x = 0 ?>
												@foreach ($product as $item)
												<?php $x++?>
													<tr>
														<td>{{ $x }}</td>
														<td>{{ $item->product_name }}</td>
														<td>{{ $item->section->section_name }}</td>
														<td>{{ $item->product_description }}</td>
														<td>
															{{-- Edit btn --}}
															@can('تعديل منتج')
																<button class="btn btn-outline-success btn-sm"
																data-product_name="{{ $item->product_name }}" 
																data-pro_id="{{ $item->id }}"
																data-section_name="{{ $item->section->section_name }}"
																data-product_description="{{ $item->product_description }}" 
																data-toggle="modal"
																data-target="#edit_Product">تعديل</button>
																</a>
															@endcan
															{{-- Delete btn  --}}
															@can('حذف منتج')
																<button class="btn btn-outline-danger btn-sm" 
																data-pro_id="{{ $item->id }}"
																data-product_name="{{ $item->product_name }}" data-toggle="modal"
																data-target="#modaldemo9">حذف</button>
															@endcan
															
														</td>
													</tr>
												@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
				</div>
				<!-- row closed -->
				{{-- Add --}}
				<div class="modal" id="modaldemo8">
					<div class="modal-dialog" role="document">
						<div class="modal-content modal-content-demo">
							<div class="modal-header">
								<h6 class="modal-title">اضافة المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal"
									type="button"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<form action="{{ route('products.store') }}" method="post">
									@csrf
									<div class="form-group">
										<label for="exampleInputEmail1">اسم المنتج</label>
										<input type="text" class="form-control" id="product_name" name="product_name"
										autocomplete="off">
									</div>
									<label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                            	<select name="section_id" id="section_id" class="form-control 
									mb-3" required>
										<option value="" selected disabled> --حدد القسم--</option>
										@foreach ($section as $item)
											<option value="{{ $item->id }}">{{ $item->section_name }}</option>
										@endforeach
                            	</select>
			
									<div class="form-group">
										<label for="exampleFormControlTextarea1">الملاحظات</label>
										<textarea class="form-control" id="product_description" name="product_description" rows="3"></textarea>
									</div>
			
									<div class="modal-footer">
										<button type="submit" class="btn btn-info">تاكيد</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<!-- edit -->
				<div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" 
				aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
						<button type="button" class="close" data-dismiss="modal" 
						aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
	
						<form action="products/update" 
						method="POST" autocomplete="off">
							@method('PATCH')
							@csrf
							<div class="form-group">
								<input type="hidden" name="pro_id" id="pro_id" value="">
								<label for="recipient-name" class="col-form-label">اسم المنتج</label>
								<input class="form-control" name="product_name"
								id="product_name" type="text">
							</div>
							<label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                            <select name="section_name" id="section_name" class="custom-select my-1 mr-sm-2" required>
                                @foreach ($section as $section)
                                    <option>{{ $section->section_name }}</option>
                                @endforeach
                            </select>
							<div class="form-group">
								<label for="message-text" class="col-form-label">الملاحظات</label>
								<textarea class="form-control" id="product_description" 
								name="product_description"></textarea>
							</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">تاكيد</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
					</div>
					</form>
				</div>
			</div>
		</div>
			<!-- delete -->
			<div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">حذف المنتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="products/destroy" method="post">
						@method('DELETE')
                        @csrf
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="pro_id" id="pro_id" value="">
                            <input class="form-control" name="product_name" id="product_name" 
							type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#edit_Product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('product_name')
			var section_name = button.data('section_name')
			var pro_id = button.data('pro_id')
			var product_description = button.data('product_description')
            var modal = $(this)
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #product_description').val(product_description);
            modal.find('.modal-body #pro_id').val(pro_id);
        })

    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var product_name = button.data('product_name')
            var modal = $(this)
            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #product_name').val(product_name);
        })
    </script>
@endsection