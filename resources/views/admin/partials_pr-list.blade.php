@if ($data_person->isEmpty())
    <p>No data found for the selected filters.</p>
@else
    <!--begin::Table-->
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
        <thead>
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                <th class="w-10px pe-2">
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                    </div>
                </th>
                <th class="min-w-125px">Nama dan NIK</th>
                <th class="min-w-125px">Jenis Kelamin</th>
                <th class="min-w-125px">Kelurahan</th>
                <th class="min-w-125px">Status</th>
                <th class="text-end min-w-100px">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 fw-semibold">
            @foreach ($data_person as $person)
                <tr data-user-id="{{ $person->id }}">
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td class="d-flex align-items-center">
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <a href="/admin/persons/{{$person->id}}" class="text-gray-800 text-hover-primary mb-1">{{$person->nama}}</a>
                            <span>{{$person->nik}}</span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td>
                        @if ($person->jenis_kelamin == "P")
                            <div>Perempuan</div>
                        @else
                            <div>Laki-Laki</div>
                        @endif
                    </td>
                    <td>
                        @if ($person->kelurahan->nama == NULL)
                            <div class="badge badge-warning fw-bold">Tidak Diketahui</div>
                        @else
                            {{$person->kelurahan->nama}}
                        @endif
                    
                    </td>
                    <td>
                        @if ($person->status == NULL)
                            <div class="badge badge-warning fw-bold">Tidak Diketahui</div>
                        @elseif($person->status == "Hidup")
                            <div class="badge badge-success fw-bold">Hidup</div>
                        @else
                            <div class="badge badge-danger fw-bold">Meninggal</div>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions 
                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="/admin/persons/{{$person->id}}" class="menu-link px-3">Edit</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row">Delete</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!--end::Table-->
@endif