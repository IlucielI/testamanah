@extends('layouts/templete_backend')

@section('contents')
    <div class="container-fluid">
					<!-- Content Row -->
					<div class="row">
						<!-- Employee Card Example -->
						<div class="col">
							<div class="card border-left-success shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Products</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">{{$products}}</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-user-friends fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row mt-3">
						<!-- Earnings (Monthly) Card Example -->
						<div class="col">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Users</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">{{$users}}</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-user-clock fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
@endsection
