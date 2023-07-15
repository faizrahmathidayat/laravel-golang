@extends('customer.index')
@section('content-customer')
    <div class="mt-3">
        <h4>Ubah Customer</h4>
        <form>
            <div class="row mb-3 input-group">
                <input type="hidden" value="{{ $data->cst_id }}" name="id" id="id">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" required name="cst_name" id="cst_name" class="form-control"
                        placeholder="Masukan Nama" value="{{ $data->cst_name }}">
                    <div class="invalid-feedback" id="cst_name_error_message"></div>
                </div>
            </div>
            <div class="row mb-3 input-group">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input type="date" required name="cst_dob" id="cst_dob" class="form-control"
                        value="{{ $data->cst_dob }}">
                    <div class="invalid-feedback" id="cst_dob_error_message"></div>
                </div>
            </div>
            <div class="row mb-3 input-group">
                <label class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input type="number" name="cst_phone_num" id="cst_phone_num" class="form-control"
                        placeholder="Masukan Telepon" value="{{ $data->cst_phone_num }}">
                    <div class="invalid-feedback" id="cst_phone_num_error_message"></div>
                </div>
            </div>
            <div class="row mb-3 input-group">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" name="cst_email" id="cst_email" class="form-control" placeholder="Masukan Email"
                        value="{{ $data->cst_email }}">
                    <div class="invalid-feedback" id="cst_email_error_message"></div>
                </div>
            </div>
            <div class="row mb-3 input-group">
                <label class="col-sm-2 col-form-label">Kewarganegaraan</label>
                <div class="col-sm-10">
                    <select class="form-select" name="nationality_id" id="nationality_id">
                        <option value="">Pilih Kewarganegaraan</option>
                        @foreach ($nationality as $nationalities)
                            <option value="{{ $nationalities['nationality_id'] }}"
                                {{ $data->nationality_id == $nationalities['nationality_id'] ? 'selected' : '' }}>
                                {{ $nationalities['nationality_name'] . ' (' . $nationalities['nationality_code'] . ')' }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" id="nationality_id_error_message"></div>
                </div>
            </div>
            <div class="col-12">
                <div class="card overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Keluarga</h5>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Hubungan</th>
                                    <th scope="col" class="text-center">Nama</th>
                                    <th scope="col" class="text-center">Tanggal Lahir</th>
                                    <th scope="col" class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody id="detail">
                                <?php $no = 0; ?>
                                @foreach ($data->family_list as $family_list)
                                    <?php $no++; ?>
                                    <tr id="row_{{ $no }}">
                                        <td>
                                            <input class="form-control" type="text" name="fl_relation[]"
                                                id="fl_relation_{{ $no }}"
                                                value="{{ $family_list['fl_relation'] }}">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="fl_name[]"
                                                id="fl_name_{{ $no }}" value="{{ $family_list['fl_name'] }}">
                                        </td>
                                        <td>
                                            <input class="form-control" type="date" name="fl_dob[]"
                                                id="fl_dob_{{ $no }}" value="{{ $family_list['fl_dob'] }}">
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" type="button"
                                                onclick="hapusBaris({{ $no }})">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" id="counter_row" value="{{ $no }}">
                        <button type="button" class="btn btn-info btn-sm" onclick="tambahBaris()"><i
                                class="fa fa-plus"></i>&nbsp;Tambah</button>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan">Simpan</button>
                    <a href="{{ route('customer.index') }}" class="btn btn-secondary btn-sm">Batal</a>
                </div>
            </div>
        </form>
    </div>
@endsection
