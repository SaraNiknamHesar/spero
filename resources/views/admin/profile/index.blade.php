@extends('admin.layouts.app')
@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Profile</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                              <label class="form-label required">Name</label>
                              <input type="text" class="form-control" name="example-required-input" placeholder="Required...">
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                              <label class="form-label required">Email</label>
                              <input type="text" class="form-control" name="example-required-input" placeholder="Required...">
                            </div>
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary">Update Account</button>

            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h3 class="card-title">Update Password</h3>
            </div>
            <div class="card-body">Simple card</div>
        </div>

    </div>
@endsection
