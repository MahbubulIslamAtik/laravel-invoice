@extends("layouts.app")

@section("title") 
 Manage Student  
@endsection

@section("page")
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Student</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Student</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <a href="{{url('/students/create')}}" class="btn btn-success">New Student</a>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>                
                  <tr>
                      <th style="width: 1%">   # </th>
                      <th style="width: 20%">  ID  </th>
                      <th style="width: 30%"> Student Name  </th>
                      <th> Mobile </th>
                      <th style="width: 8%" class="text-center">  Email  </th>
                      <th style="width: 20%">  </th>
                  </tr>              
                </thead>
              <tbody>
                  @foreach($students as $student)
                  <tr>
                      <td>  </td>
                      <td> {{$student->id}} </td>
                      <td> {{$student->name}} </td>
                      <td> {{$student->mobile}}</td>
                      <td> {{$student->email}} </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="{{url('/students/'.$student->id)}}">
                              <i class="fas fa-folder"></i>
                              View
                          </a>
                          <a class="btn btn-info btn-sm" href="{{url('/students/'.$student->id.'/edit')}}">
                              <i class="fas fa-pencil-alt"></i>
                              Edit
                          </a>
                          <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="$(this).find('.delete').submit();">
                              <i class="fas fa-trash"></i>
                              Delete                              
                            <form class='delete' action="{{route('students.destroy',$student->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>  
                          </a>
                      </td>
                  </tr>
                 @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>



@endsection

