@extends('layouts.master')

@section('titleHeade' , 'قائمة المستخدمين')

@section('css')
<!-- Internal Data table css -->

<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المستخدمين</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
									<div class="card-header pb-0">
										<div class="row row-xs wd-xl-80p">
											<div class="col-sm-6 col-md-3">
												@can('اضافة مستخدم')
													<a href="{{ route('users.create') }}" class="btn btn-primary btn-block"> <i
														class="fas fa-plus"></i>&nbsp; أضف مستخدم</a>
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
												<th class="border-bottom-0">اسم المستخدم</th>
												<th class="border-bottom-0">البريد الألكتروني</th>
												<th class="border-bottom-0">حالة المستخدم</th>
												<th class="border-bottom-0">نوع المستخدم</th>
												<th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 0 ?>
											@foreach ($data as $key => $item)
											<?php $i++?>
												<tr>
													<td>{{ $i }}</td>
													<td>{{ $item->name }}</td>
													<td>{{ $item->email }}</td>
													<td>
														@if ($item->Status == 'مفعل')
															<span class="label text-success d-flex">
																<div class="dot-label bg-success"></div>
																{{ $item->Status }}
															</span>
															@else 
																<span class="label text-danger d-flex">
																	<div class="dot-label bg-danger"></div>
																	{{ $item->Status }}
																</span>
														@endif
													</td>
													<td>
														@if (!empty($item->getRoleNames()))
															@foreach ($item->getRoleNames() as $v)
																<label class="badge badge-success">{{ $v }}</label>
															@endforeach

														@endif
													</td>
													<td>
														@can('تعديل مستخدم')
															<a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm btn-info"
																title="تعديل"><i class="las la-pen"></i></a>
														@endcan
														
														@can('حذف مستخدم')
															<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
															data-user_id="{{ $item->id }}" data-username="{{ $item->name }}"
															data-toggle="modal" href="#modaldemo8" title="حذف"><i
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
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">حذف المستخدم</h6><button aria-label="Close" class="close"
										data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<form action="{{ route('users.destroy', 'test') }}" method="post">
									@method('DELETE')
									@csrf
									<div class="modal-body">
										<p>هل انت متاكد من عملية الحذف ؟</p><br>
										<input type="hidden" name="user_id" id="user_id" value="">
										<input class="form-control" name="username" id="username" type="text" readonly>
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
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!--Internal  Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<script>
    $('#modaldemo8').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
        modal.find('.modal-body #username').val(username);
    })

</script>
@endsection