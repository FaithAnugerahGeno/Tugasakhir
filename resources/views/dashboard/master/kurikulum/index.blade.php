@extends('layouts.app')
@section('content')
  @pushOnce('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
  @endPushOnce
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-6">
            <h3>Kurikulum</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Applications</a></li>
              <li class="breadcrumb-item">Data Master</li>
              <li class="breadcrumb-item active">Kurikulum</li>
            </ol>
          </div>
          <div class="col-sm-6">
            <!-- Bookmark Start-->
            <div class="bookmark">
              <ul>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Tables"><i data-feather="inbox"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
                <li><a href="javascript:void(0)" data-container="body" data-bs-toggle="popover" data-placement="top"
                    title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
                <li><a href="javascript:void(0)"><i class="bookmark-search" data-feather="star"></i></a>
                  <form class="form-inline search-form">
                    <div class="form-group form-control-search">
                      <input type="text" placeholder="Search..">
                    </div>
                  </form>
                </li>
              </ul>
            </div>
            <!-- Bookmark Ends-->
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test"
              data-bs-target="#addKurikulum">Add Kurikulum</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="display table table-bordered" id="basic-1">
                <thead>
                  <tr style="text-align: center">
                    <th style="width: 55px">No</th>
                    <th>Nama Kurikulum</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $a)
                    <tr style="text-align: center">
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $a['nm_kurikulum'] }}</td>
                      @if ($a['stts_kurikulum'] == 'Active')
                        <td>
                          <span class="span badge rounded badge-success">
                            Active
                          </span>
                        </td>
                      @else
                        <td>
                          <span class="span badge rounded badge-danger">
                            Non Active
                          </span>
                        </td>
                      @endif
                      <td>
                        <form method="POST" action="kurikulum/delete/{{ $a['id_kurikulum'] }}">
                          @csrf
                          <a type="button" class="btn btn-primary btn-xs edit" data-bs-id="{{ $a->id_kurikulum }}"><i
                              class="fa fa-edit"></i></a>
                          <input name="_method" type="hidden" class="btn-primary btn-xs" value="DELETE">
                          <a type="submit" class="btn btn-danger btn-xs show_confirm"><i class="fa fa-trash"></i></a>
                        </form>
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
  </div>
  @pushOnce('js')
    @include('dashboard.master.kurikulum.add')
    @include('dashboard.master.kurikulum.edit')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="../assets/js/form-validation-custom.js"></script>
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    <script type="text/javascript">
      $('.show_confirm').click(function(e) {
        var form = $(this).closest("form");
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                // timer: 3000
              });
              form.submit();
            } else {
              swal("Your imaginary file is safe!", {
                icon: "info"
              });
            }
          })
      });
    </script>
    <script>
      @if (session()->has('success'))
        toastr.success('{{ session('success') }}', 'Wohoooo!');
      @else
        toastr.error('{{ session('error') }}', 'Whoops!');
      @endif
    </script>
    <script>
      $(document).ready(function() {
        //edit data
        $('.edit').on("click", function() {
          var id = $(this).attr('data-bs-id');
          $.ajax({
            url: "/kurikulum/edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
              $('#id_kurikulum').val(data.id_kurikulum);
              $('#nm_kurikulum').val(data.nm_kurikulum);
              // $('.radio_animated input:radio[value="' + data.stts_kurikulum + '"]').prop('checked', true);
              $("input:radio[name=stts_kurikulum][value=" + data.stts_kurikulum + "]").prop('checked', true);
              $('#editKurikulum').modal('show');
            }
          });
        });

      });
    </script>
  @endPushOnce
@endsection
