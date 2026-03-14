@extends('frontend.master')
@section('content')

<section class="middle">
				<div class="container">
					<div class="row align-items-start justify-content-between">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 m-auto">
							<div class="mb-3">
								<h3>Request forgot password</h3>
							</div>
							<form class="border p-3 rounded" action="{{ route('send.pass.req') }}" method="POST">
                                @csrf
								<div class="form-group">
									<label>Email *</label>
									<input type="text" name="email" class="form-control" placeholder="Email*">
                                    @if (session('nt_exists'))
                                    <div class="alert alert-danger">{{ session('nt_exists') }}</div>
                                    @endif
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Send Request</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</section>

@endsection
