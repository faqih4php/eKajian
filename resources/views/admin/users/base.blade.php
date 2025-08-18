@extends('layouts.base')
@section('title', 'Admin List')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <!-- Invoice List Widget -->
            <div class="card">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header">List Admin yang mengelola data kajian</h5>
                    <a href="{{ route('user.create') }}" type="button" class="btn btn-primary h-50 me-7">Buat
                        Admin</a>
                </div>
                <div class="table-responsive text-nowrap">
                    @include('components.alert')
                    <div class="container mb-3">
                        <table class="table p-3" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="icon-base bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('request-kajian.edit', $user->id) }}"><i
                                                            class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                                    <form
                                                        action="{{ route('request-kajian.destroy', $user->id) }}"
                                                        method="POST" onsubmit="return confirm('Yakin mau hapus?')"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="icon-base bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
