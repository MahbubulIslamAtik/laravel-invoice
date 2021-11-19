@extends("layouts.app");
@section("title")
  Create Student
@endsection

@section("page")

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Student</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create Student</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('students.store')}}" method="post" class="form-horizontal">
                 @csrf
                 <div class="card-body">
                  <div class="form-group row">
                    <label for="txtName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Name">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="txtMobile" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtMobile" name="txtMobile" placeholder="Mobile">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email">
                    </div>
                  </div>

                 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                  <button type="reset" class="btn btn-default float-right">Clear</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
         </section>
            @endsection