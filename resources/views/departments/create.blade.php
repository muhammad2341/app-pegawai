@extends('master')
@section('title', 'Tambah Departemen')
@section('content')
    <h1>Tambah Departemen</h1>
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <table>
            <tbody>
                <tr>
                    <td><label for="department_name">Nama Departemen:</label></td>
                    <td>
                        <input type="text" id="department_name" name="department_name"
                            value="{{ old('department_name') }}" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right;">
                        <button type="submit">Simpan</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
@endsection
