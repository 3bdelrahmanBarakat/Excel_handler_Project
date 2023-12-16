

@extends('layouts.layout')
@section('body')

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      @include('layouts.navbar')
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav
          class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar"
        >
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


            <ul class="navbar-nav flex-row align-items-center ms-auto">


              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                          <small class="text-muted">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>




                  <li>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </button>
                    </form>

                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
              @if ($errors->any())
              <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                  <i class="bx bx-bell me-2"></i>
                  <div class="me-auto fw-semibold">Error</div>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                @endforeach
                </div>
              </div>

                  @endif
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Welcome back {{ Auth::user()->name }}! 🎉</h5>
                        <p class="mb-4">
                          You can manage importing and exporting Excel files of users.
                        </p>

                      </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                      <div class="card-body pb-0 px-0 px-md-4">
                        <img
                          src="../assets/img/illustrations/man-with-laptop-light.png"
                          height="140"
                          alt="View Badge User"
                          data-app-dark-img="illustrations/man-with-laptop-dark.png"
                          data-app-light-img="illustrations/man-with-laptop-light.png"
                        />
                      </div>
                    </div>
                  </div>
                </div>


              </div>

              <div class="col-lg-6 mb-4 order-0">

                    @if(session()->has('message'))
                      <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                <form action="{{route('admin.import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="formFile" class="form-label">Import Excel</label>
                <input class="form-control" name="file" type="file" id="formFile">
                <br>
                <button type="submit" class="btn btn-primary">Preview</button>
                </form>
                </div>




              <!-- Users data Table -->

              <div class="card">
                  <form action="{{ route('admin.export') }}" method="post">
                      @csrf



                <h5 class="card-header">Users data </h5>


                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Full Name
                                    <select name="full_name">
                                        <option value="">Select the column's name</option>
                                        <option value="name">Name</option>
                                        <option value="user">User</option>
                                    </select>
                                </th>
                                <th>
                                    Phone Number
                                    <select name="phone_number" onchange="updateCheckboxName(this, 'checkbox2')">
                                        <option value="">Select the column's name</option>
                                        <option value="telephone">telephone</option>
                                        <option value="phone">Phone</option>
                                    </select>
                                </th>
                                <th>
                                    Email
                                    <select name="email_address" id="input1">
                                        <option value="">Select the column's name</option>
                                        <option value="email">Email</option>
                                        <option value="gmail">gmail</option>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($userData as $data)
                            <tr>
                                <td>
                                    @if ($data['full_name'])
                                    
                                    {{ $data['full_name'] }}
                                    <fieldset>
                                    Yes
                                    <input type="checkbox" name="checkbox1[]" value="{{ $data['full_name'] }}">
                                    No
                                    <input type="checkbox" name="checkbox1[]" value="{{ null }}">
                                </fieldset>
                                    @endif
                                </td>
                                <td>
                                    @if ($data['phone_number'])
                                    {{ $data['phone_number'] }}
                                    <fieldset>
                                    Yes
                                    <input type="checkbox" name="checkbox2[]" value="{{ $data['phone_number'] }}">
                                    No
                                    <input type="checkbox" name="checkbox2[]" value="{{ null }}">
                                     </fieldset>
                                    @endif
                                </td>
                                <td>
                                    @if ($data['email'])
                                    {{ $data['email'] }}
                                    <fieldset>
                                        Yes
                                        <input type="checkbox" name="checkbox3[]" id="input2" value="{{ $data['email'] }}">
                                        No
                                        <input type="checkbox" name="checkbox3[]" id="input2" value="{{ null }}">

                                    </fieldset>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                <button type="submit" class="btn btn-primary">Export</button>
                </form>
                </div>
                {{$userData->links()}}
            </div>
              <!--/ Users data Table -->



            </div>

          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , made with ❤️
              </div>

            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->



@endsection
