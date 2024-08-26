@extends('layouts.master')
@section('titleHeade' , 'طباعة الفاتورة')
@section('css')
	<style>
		@media print {
			#print_Button {
				display: none;
			}
		}

	</style>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ طباعة الفاتورة</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-md-12 col-xl-12">
						<div class=" main-content-body-invoice" id="print">
							<div class="card card-invoice">
								<div class="card-body">
									<div class="invoice-header">
										<h1 class="invoice-title">فاتورة تحصيل</h1>
										<!-- billed-from -->
									</div><!-- invoice-header -->
									<div class="row mg-t-20">
										
										<div class="col-md my-3">
											<label class="tx-gray-600">معلومات الفاتورة</label>
											<p class="invoice-info-row"><span>رقم الفاتورة</span> <span>{{ $invoices->invoice_number }}</span></p>
											<p class="invoice-info-row"><span>تاريخ الأصدار</span> <span>{{ $invoices->invoice_date }}</span></p>
											<p class="invoice-info-row"><span>تاريخ الأستحقاق</span> <span>{{ $invoices->due_date }}</span></p>
											<p class="invoice-info-row"><span>القسم</span> <span>{{ $invoices->section->section_name }}</span></p>
										</div>
									</div>
									<div class="table-responsive mg-t-40">
										<table class="table table-invoice border text-md-nowrap mb-0">
											<thead>
												<tr>
													<th class="wd-20p">#</th>
													<th class="wd-40p">المنتج</th>
													<th class="tx-center">مبلغ التحصيل</th>
													<th class="tx-right">مبلغ العمولة</th>
													<th class="tx-right">الأجمالي</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td class="tx-12">{{ $invoices->product }}</td>
													<td class="tx-center">{{ number_format($invoices->amount_collection , 2) }}</td>
													<td class="tx-right">{{ number_format($invoices->amount_commission , 2) }}</td>
													@php
														$total = $invoices->amount_collection + $invoices->amount_commission;
													@endphp
													<td class="tx-right">{{ number_format($total , 2) }}</td>
												</tr>
												<tr>
													<td class="valign-middle" colspan="2" rowspan="4">
														<div class="invoice-notes">
															
														</div><!-- invoice-notes -->
													</td>
													<td class="tx-right">الأجمالي</td>
													<td class="tx-right" colspan="2">{{ number_format($total , 2) }}</td>
												</tr>
												<tr>
													<td class="tx-right">نسبة الضريبة ({{ $invoices->rate_vat }})</td>
                                        			<td class="tx-right" colspan="2">287.50</td>
												</tr>
												<tr>
													<td class="tx-right">الخصم</td>
													<td class="tx-right" colspan="2">{{ number_format( $invoices->discount , 2) }}</td>
												</tr>
												<tr>
													<td class="tx-right tx-uppercase tx-bold tx-inverse">الأجمالي شامل الضريبة</td>
													<td class="tx-right" colspan="2">
														<h4 class="tx-primary tx-bold">
															{{ number_format($total , 2) }}
														</h4>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<hr class="mg-b-40">
									<a href="#" class="btn btn-danger float-left mt-3 mr-2" onclick="printDiv()"
									id="print_Button">
										<i class="mdi mdi-printer ml-1"></i>طباعة
									</a>
								</div>
							</div>
						</div>
					</div><!-- COL-END -->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

	<script type="text/javascript">
		function printDiv() {
			var printContents = document.getElementById('print').innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
			location.reload();
		}

	</script>
@endsection