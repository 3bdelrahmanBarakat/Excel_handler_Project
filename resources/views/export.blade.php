@extends('layouts.layout')
@section('body')

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('layouts.navbar')

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
              <!-- Content -->

              <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">






                  <!-- Users data Table -->
                  <div class="card">
                    <h5 class="card-header">Excel Preview</h5>
                    <div class="table-responsive text-nowrap">
                        <form action="{{ route('admin.save') }}" method="post">
                            @csrf
                      <table class="table">
                        <thead>
                            <tr>
                                @foreach($originalColumns[0] as $column)
                    <th>
                        {{ $column }}
                        <select name="mapped_columns[{{ $column }}]">
                            <option>Select the column's name</option>
                            <option value="full_name">Full Name</option>
                            <option value="phone_number">Phone Number</option>
                            <option value="email">Email</option>
                        </select>
                    </th>
                @endforeach

                            </tr>

                        </thead>
                        <tbody class="table-border-bottom-0">

                            @for ($row = 1; $row < count($originalColumns); $row++)
                <tr>
                    @foreach ($originalColumns[$row] as $col => $value)
                        <td>
                            {{ $value }}
                            <input type="hidden" name="column_records[{{ $originalColumns[0][$col] }}][]" value="{{ $value }}">


                        </td>
                    @endforeach
                </tr>
            @endfor




                        </tbody>
                    </table>
                    <a href="{{route('admin.dashboard')}}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </form>
                    </div>
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

        </div>
        </div>

@endsection
