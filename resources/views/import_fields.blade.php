@extends('app')

@section('content')


    <div class="row mt-5">
        <div class="col-sm-12">
            <div name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Select fields') }}
                </h2>
            </div>
        </div>
    </div>


    <div class="row mt-5">
        <div class="col-sm-12">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">

                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <form action="{{ url('/import_process') }} " method="POST">


                                {{ csrf_field() }}
                                <table class="table">
                                    <thead>
                                        <tr>
                                            @if (isset($headers))
                                                @foreach ($headers as $csv_header_field)
                                                    <th>
                                                        {{ $csv_header_field }}
                                                    </th>
                                                @endforeach
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($csv as $key_row => $row)
                                            <tr>
                                                @foreach ($row as $key => $column)
                                                    <td>
                                                        <input type="hidden"
                                                            name="rows[{{ $key_row }}][{{ $headers[$key] }}]"
                                                            value="{{ $column }}" />
                                                        {{ $column }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach

                                        <tr>
                                            @foreach ($headers as $key => $value)
                                                <td>
                                                    <select required="true" name="columns[{{ $value }}]">
                                                        <option value>Choisir colonne</option>
                                                        @foreach ($db_columns as $column)
                                                            <option value="{{ $column->COLUMN_NAME }}"
                                                                class="text-uppercase">
                                                                {{ $column->COLUMN_NAME }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>


                                <div class="row">
                                    <div class="col-md-8"> <input type="submit" class="btn btn-primary"
                                            value="{{ __('Submit') }}" /></div>
                                </div>

                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
