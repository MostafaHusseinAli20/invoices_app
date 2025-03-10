@extends('layouts.master')

@section('titleHeade' , 'الأقسام')

@section('css')
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الأعدادت</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأقسام</span>
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
							@foreach ($errors->all() as $erorr)
								<li class="mx-3 my-1">{{ $erorr }}</li>
							@endforeach
						</ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
					</div>
					@endif
					{{-- edit Alert --}}
					@if (session()->has('edit'))
					<div class="alert alert-info alert-dismissible fade show" role="alert">
						
						<span class="alert-inner--text mx-4"><strong> تعديل ! </strong> تم تعديل القسم بنجاح </span>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					@endif
					{{-- Add Alert --}}
					@if (session()->has('Add'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						
						<span class="alert-inner--text mx-4"><strong> أضافة ! </strong> تم أضافة القسم بنجاح </span>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					@endif
					{{-- Delete Alert --}}
					@if (session()->has('delete'))
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<span class="alert-inner--text mx-4"><strong> حذف ! </strong> تم حذف القسم بنجاح </span>
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
									<div class="card-header pb-0">
										<div class="row row-xs wd-xl-80p">
											<div class="col-sm-6 col-md-3">
												@can('اضافة قسم')
													<a class="btn btn-success-gradient btn-block
													modal-effect btn btn-outline-primary btn-block"
													data-effect="effect-scale" data-toggle="modal" href="#modaldemo8"
													>أضافة قسم</a>
												@endcan
											</div>
									</div>
									</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
										style="text-align: center">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم القسم</th>
												<th class="border-bottom-0">الوصف</th>
												<th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 0 ?>
											@foreach ($show as $item)
											<?php $i++?>
												<tr>
													<td>{{ $i }}</td>
													<td>{{ $item->section_name }}</td>
													<td>{{ $item->section_description }}</td>
													<td>
														
														@can('تعديل قسم')
															<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
															data-id="{{ $item->id }}" data-section_name="{{ $item->section_name }}"
															data-section_description="{{ $item->section_description }}" 
															data-toggle="modal"
															href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>
														@endcan
														
														@can('حذف قسم')
															<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
															data-id="{{ $item->id }}" data-section_name="{{ $item->section_name }}"
															data-toggle="modal" href="#modaldemo9" title="حذف"><i
																class="las la-trash"></i></a>
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
				</div>
				<!-- row closed -->
				<div class="row">

					<div class="modal" id="modaldemo8">
						<div class="modal-dialog" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
										type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form action="{{ route('sections.store') }}" method="post">
										@csrf
				
										<div class="form-group">
											<label for="exampleInputEmail1">اسم القسم</label>
											<input type="text" class="form-control" id="section_name" name="section_name"
											autocomplete="off">
										</div>
				
										<div class="form-group">
											<label for="exampleFormControlTextarea1">الوصف</label>
											<textarea class="form-control" id="section_description" name="section_description" rows="3"></textarea>
										</div>
				
										<div class="modal-footer">
											<button type="submit" class="btn btn-success">تاكيد</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
			<!-- Container closed -->
			<!-- edit -->
			<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" 
			aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
						<button type="button" class="close" data-dismiss="modal" 
						aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
	
						<form action="sections/update" method="post" autocomplete="off">
							@method('PATCH')
							@csrf
							<div class="form-group">
								<input type="hidden" name="id" id="id" value="">
								<label for="recipient-name" class="col-form-label">اسم القسم</label>
								<input class="form-control" name="section_name" 
								id="section_name" type="text">
							</div>
							<div class="form-group">
								<label for="message-text" class="col-form-label">الوصف</label>
								<textarea class="form-control" id="section_description" 
								name="section_description"></textarea>
							</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-info">تاكيد</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		 <!-- delete -->
		 <div class="modal" id="modaldemo9">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
							type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<form action="sections/destroy" method="post">
						@method('DELETE')
						@csrf
						<div class="modal-body">
							<p>هل انت متاكد من عملية الحذف ؟</p><br>
							<input type="hidden" name="id" id="id" value="">
							<input class="form-control" name="section_name" id="section_name" type="text" readonly>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
							<button type="submit" class="btn btn-danger">تاكيد</button>
						</div>
				</div>
				</form>
			</div>
		</div>
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
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var section_description = button.data('section_description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #section_description').val(section_description);
    })

</script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
    })

</script>
@endsection