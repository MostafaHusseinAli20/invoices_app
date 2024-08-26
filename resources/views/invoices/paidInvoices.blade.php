@extends('layouts.master')

@section('titleHeade' , 'الفواتير المدفوعة')

@section('css')
	 <!-- Internal Data table css -->
	 <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
	 <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
	 <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
	 <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
	 <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
	 <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
	 <!--Internal   Notify -->
	 <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
	 <!--Internal  treeview -->
	 <link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير المدفوعة</span>
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
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">تاريخ الفاتورة</th>
												<th class="border-bottom-0">تاريخ الاستحقاق</th>
												<th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">الخصم</th>
												<th class="border-bottom-0">نسبة الضريبة</th>
												<th class="border-bottom-0">قيمة الضريبة</th>
												<th class="border-bottom-0">الاجمالي</th>
												<th class="border-bottom-0">الحالة</th>
												<th class="border-bottom-0">ملاحظات</th>
												<th class="border-bottom-0">العمليات</th>
												
											</tr>
										</thead>
										<tbody>
											@php
												$i = 0;
											@endphp
											@foreach ($invoices as $item)
											@php
												$i++;
											@endphp
											<tr>
												<td>{{ $i }}</td>
												<td>{{ $item->invoice_number }}</td>
												<td>{{ $item->invoice_date }}</td>
												<td>{{ $item->due_date }}</td>
												<td>{{ $item->product }}</td>
												<td><a href="{{ url('InvoicesDetails')}}/{{ $item->id }}">{{ $item->section->section_name }}</a>
												</td>
												<td>{{ $item->discount }}</td>
												<td>{{ $item->rate_vat }}</td>
												<td>{{ $item->value_vat }}</td>
												<td>{{ $item->total }}</td>
												<td class="text-success">
													{{ $item->status }}
												</td>
												<td>{{ $item->note }}</td>

												<td>
													<div class="dropdown">
														<button aria-expanded="false" aria-haspopup="true"
															class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
															type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
															{{-- Edit Invoice --}}
															<div class="dropdown-menu tx-13">
																	{{-- Delete Invoice --}}
																	@can('حذف الفاتورة')
																		<a class="dropdown-item" href="#" data-invoice_id="{{ $item->id }}"
																			data-toggle="modal" data-target="#delete_invoice"><i
																				class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
																			الفاتورة</a>
																	@endcan

															{{-- Print Invoice --}}
															@can('طباعةالفاتورة')
																<a class="dropdown-item" href="{{ route('print_invoice' , $item->id) }}"><i
																		class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
																	الفاتورة
																</a>
															@endcan
																
														</div>
															
													</div>
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
				
			<!-- delete -->
			<div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" 
			aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<form action="{{ route('invoices.destroy' , 'test') }}" method="post">
							@method('DELETE')
							@csrf
					</div>
					<div class="modal-body">
						هل انت متاكد من عملية الحذف ؟
						<input type="hidden" name="invoice_id" id="invoice_id" value="">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" 
						data-dismiss="modal">الغاء</button>
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
		 <!--Internal  Notify js -->
		 <script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
		 <script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

		 <script>
			$('#delete_invoice').on('show.bs.modal', function(event) {
				var button = $(event.relatedTarget)
				var invoice_id = button.data('invoice_id')
				var modal = $(this)
				modal.find('.modal-body #invoice_id').val(invoice_id);
			})
	
		</script>
@endsection