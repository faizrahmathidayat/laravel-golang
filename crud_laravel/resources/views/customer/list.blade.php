@extends('customer.index')
@section('content-customer')
    <h4 class="mt-3">Data Customer</h4>
    <div class="mt-3">
        <a href="{{ route('customer.create') }}" class="btn btn-sm btn-primary">Tambah</a>
    </div>
    <div class="table table-responsive mt-3">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>Kewarganegaraan</td>
                    <td>Tanggal Lahir</td>
                    <td>Telepon</td>
                    <td>Email</td>
                    <td>Jumlah Keluarga</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @foreach ($data as $customer)
                        <tr>
                            <td>{{ $customer['cst_name'] }}</td>
                            <td>{{ $customer['nationality']['nationality_name'] }}</td>
                            <td>{{ $customer['cst_dob'] }}</td>
                            <td>{{ $customer['cst_phone_num'] }}</td>
                            <td>{{ $customer['cst_email'] }}</td>
                            <td>{{ count($customer['family_list']) }}</td>
                            <td>
                                <a href="{{ route('customer.showByid', ['cst_id' => $customer['cst_id']]) }}"
                                    class="btn btn-sm btn-outline-secondary">Ubah</a>
                                <button type="button" onclick="hapus({{ $customer['cst_id'] }})"
                                    class="btn btn-sm btn-outline-danger">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center">
                        <td colspan="7">Tidak ada data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
@push('custom-js')
    <script src="{{ asset('assets/js/custom/customer/customer.js') }}"></script>
@endpush
