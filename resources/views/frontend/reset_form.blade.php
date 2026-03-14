@extends('frontend.master')
@section('content')
<section class="middle">
				<div class="container">
					<div class="row align-items-start justify-content-between">
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 m-auto">
							<div class="mb-3">
								<h3>Password Reset Form</h3>
							</div>
                            @if (session('Expired'))
                            <div class="alert alert-danger">
                                {{ session('Expired') }}
                            </div>
                            @endif
                             @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
							<form class="border p-3 rounded" action="{{ route('reset.confirm', $token) }}" method="POST">
                                @csrf
								<div class="form-group">
									<label>New password *</label>
									<input type="password" name="password" class="form-control" placeholder="Enter new password*">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
								</div>
								<div class="form-group">
									<label>Confirm password *</label>
									<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password*">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Change Password</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</section>

@endsection
