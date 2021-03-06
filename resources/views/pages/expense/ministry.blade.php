@extends('layouts.master')
@push('css')
	<title>Ministry Expenses</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/header_footer.css') }}">
  	<link rel="stylesheet" href="{{ asset('css/ministry-report-table.css') }}">
	  <link rel="stylesheet" href="{{ asset('css/header-footer.css') }}">
	  <link rel="stylesheet" href="{{ asset('css/filter.css') }}">
	<link rel="stylesheet" href="{{ asset('css/ministry_report_comments.css') }}">
	<script src="https://kit.fontawesome.com/8f691340fb.js" crossorigin="anonymous"></script>
@endpush

@section('content')
	<!-- Breadcrumb start -->
    {{ Breadcrumbs::render('expense.ministry') }}
	<header class="container section-wrapper">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb bg-white">
				<li class="breadcrumb-item not-active"><a href="{{ url('/') }}">HOME</a></li>
				<span>&#8226;</span>
				<li class="breadcrumb-item not-active"><a href="#">EXPENSE</a></li>
				<span>&#8226;</span>
				<li class="breadcrumb-item active" aria-current="page"><a href="{{ url('/expense/ministry') }}">MINISTRY SPENDING</a></li>
			</ol>
		</nav>
	</header>
	<section>
		<div class="container ">
			<div class="row">
				<div class="col-md-8 section-heading">
					<h1 class="section-heading-title">Ministry Spending</h1>
                    <p class="section-heading-paragraph">ExpenseNG tracks federal spending to ensure taxpayers can see how their money is being used in communities across Nigeria.</p>

                    <h5>Subscribe to daily  Report</h5>
                    <span>
                        @include('partials.modals.subscription')

                  </span>
				</div>
			</div>
		</div>
		<div class="section-button">
			<div class="container">
				<div class="row px-1">
					<div class="btn-group col-lg-10 col-md-12 d-flex justify-content-between responsive-button nav nav-tabs">
						<a class="btn-marg text-left active button" data-toggle="tab" role="tab" href="#table">Expense Summary</a>
						{{-- Commenting the below out as we don't have data for them yyet --}}
						{{-- <a class="btn-marg text-left button" data-toggle="tab" role="tab" href="">Project Summary</a>
						<a class="btn-marg text-left button" data-toggle="tab" role="tab" href="">Purchases Summary</a> --}}
						<a class="btn-marg text-left button" data-toggle="tab" role="tab" href="#description">No Description</a>
						<a class="btn-marg text-left button" data-toggle="tab" role="tab" href="#comments">Comments</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Filter Modal -->
	<div id="modal" class="row justify-content-center">
		<div class="col-md-8">
			<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				<div class="modal-content">
					<!-- Header -->
					<div class="modal-header">
					<h5 class="modal-title" id="filterModalLabel">Filter</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<!-- Body -->
					<div class="modal-body">
						<section>
							<p id="view" class="font-weight-bold">View by</p>
							<div id="date-btn" class="row">
								<div class="col-4">
								<button id="day" class="btn btn-block btn-date active">Day</button>
								</div>
								<div class="col-4">
								<button id="month" class="btn btn-block btn-date">Month</button>
								</div>
								<div class="col-4">
								<button id="year" class="btn btn-block btn-date">Year</button>
								</div>
							</div>
						</section>                   
						<br>
						<section class="row">
							<div class="col-12" >
							<i class="fa fa-calendar" aria-hidden="true"></i>
							<input placeholder="Select Date" name="select-date" id="select-date"  class="byDatePicker form-control">
							<input placeholder="Select Month" name="select-month" id="select-month" class="monthYearPicker form-control" />
							<input placeholder="Select Year" name="select-year" id="select-year" class="yearPicker form-control" />
							<small id="date-format-err"></small>
						</section>
						<br>
						<section id="sort-options">
							<p class="font-weight-bold">Sort by</p>
							<div>
								<button id="desc" class="btn btn-block btn-amount">Amount (Highest to Lowest)</button>
								<button id="asc" class="btn btn-block btn-amount">Amount (Lowest to Highest)</button>
							</div>
						</section>
					</div>
					<!-- Footer -->
					<div class="modal-footer">
					<button type="button" data-id="apply-filter" id="apply-filter" class="btn btn-block active mx-5 apply-filter" data-dismiss="modal">Apply Filter</button>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
	 <!-- End of Filter Modal -->
	<!---TABLE BEGINS--->
	<div class="tab-content">
		<div class="section-2 tab-pane show fade active" id="table" role="tabpanel">
			<section class="container bordered px-0">
				<div class="table-section reponsive-div">
					<div class="main-table">
						<div class="table-top p-3 d-flex justify-content-between align-items-center">
							<h3 id="said-date" class="align-self-center">Date: {{ date("dS, M Y") }}</h3>
							<button class="nav-button" data-toggle="modal" data-target="#filterModal">Filter<i class="fas fa-filter px-1" style="font-size: var(--fs-reg);"></i></button>
						</div>
						<div id="main-table" class="table-data">
							@include('pages.expense.tables.ministries')
						</div>
						
					</div>
				</div>
			</section>
			<section class="container">
				<div class="row">
					<div class="col-md-12 pb-5">
						<div id="mini-table" class="table-data">
							@include('pages.expense.tables.ministries_annual_totals_all')
						</div>
						<!---PAGINATION--->
						
					</div>
				</div>
			</section>
		</div>
		<div class="section-2 tab-pane fade" id="description" role="tabpanel">
			<section class="container bordered">
				<div class="table-section reponsive-div">
					<div class="main-table">
						<div class="table-top p-3 d-flex justify-content-between align-items-center">
							<h3 class="align-self-center">Payments without description</h3>
							<button type="button"  data-toggle="modal" data-target="#filterModal">Filter <i class="fas fa-filter px-1"></i></button>
						</div>
						<!-- Filter Modal -->
						<div id="modal" class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <!-- Header -->
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="filterModalLabel">Filter</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <!-- Body -->
                                    <div class="modal-body">
                                        <section>
                                            <p id="view" class="font-weight-bold">View by</p>
                                            <div id="date-btn" class="row">
                                                <div class="col-4">
                                                <button id="day" class="btn btn-block btn-date active">Day</button>
                                                </div>
                                                <div class="col-4">
                                                <button id="month" class="btn btn-block btn-date">Month</button>
                                                </div>
                                                <div class="col-4">
                                                <button id="year" class="btn btn-block btn-date">Year</button>
                                                </div>
                                            </div>
                                        </section>                   
                                        <br>
                                        <section class="row">
                                            <div class="col-12" >
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <input placeholder="Select Date" name="select-date" id="select-date2"  class="byDatePicker form-control">
                                            <input placeholder="Select Month" name="select-month" id="select-month2" class="monthYearPicker form-control" />
                                            <input placeholder="Select Year" name="select-year" id="select-year2" class="yearPicker form-control" />
                                            <small id="date-format-err"></small>
                                        </section>
                                        <br>
                                        <section id="sort-options">
                                            <p class="font-weight-bold">Sort by</p>
                                            <div>
                                                <button id="desc" class="btn btn-block btn-amount">Amount (Highest to Lowest)</button>
                                                <button id="asc" class="btn btn-block btn-amount">Amount (Lowest to Highest)</button>
                                            </div>
                                        </section>
                                    </div>
                                    <!-- Footer -->
                                    <div class="modal-footer">
                                    <button type="button" data-id="apply-filter2" id="apply-filter2" class="btn btn-block active mx-5 apply-filter" data-dismiss="modal">Apply Filter</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- End of Filter Modal -->
						<div class="table-data">
							<div style="overflow-x: auto;">
								<table cell-spacing="0" data-pagination="true" data-page-size="10" class="table table-striped table-responsive-sm">
									<thead>
										<tr>
											<th class="section-shadow row-ministry">Ministry</th>
											<th class="row-company">Company</th>
											<th class="row-amount">Amount</th>
											<th class="row-date">Date</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($collection['nondescriptive'] as $expense)
											<tr>
												<td class="section-shadow">
													<a href="{{ route('ministries.single', ['ministry' => strtolower($expense->ministry()['shortname']) ]) }}" class="text-success">
														{{ucfirst($expense->ministry()['name'])}}
													</a>
												</td>
												<td>{{$expense->beneficiary}}</td>
												<td>&#8358;{{$expense->amount()}}</td>
												<td>{{ date('d-m-Y', strtotime($expense->payment_date))}}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<!---PAGINATION--->
						@include('partials.pagination', ['data' => $collection['nondescriptive']])
					</div>
				</div>
			</section>
			<section class="container">
				<div class="row">
					<div class="col-md-8 offset-md-2 pb-5">
						<div class="table-data">
							@include('pages.expense.tables.ministries_annual_totals_nodesc')
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="section-2 tab-pane fade" id="comments" role="tabpanel">
			@include('partials.comments')
		</div>
	</div>
</div>
@endsection
	<!---TABLE ENDS--->
@section('js')
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="{{ asset('js/main.js') }}"></script>
	<script src="{{ asset('js/filter.js') }}"></script>
	<script src="{{ asset('js/ExpenditureScript.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endsection
	 
