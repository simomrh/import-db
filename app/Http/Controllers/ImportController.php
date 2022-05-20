<?php

namespace App\Http\Controllers;

use App\Models\CsvData;
use Symfony\Component\Console\Input\Input;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CsvImportRequest;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;





class ImportController extends Controller
{
    private $rows = [];
    public function getImport()
    {
        return view('import');
    }



    public function parseImport(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        $headers = explode(';', $data[0][0]);

        $csv =  array_map(function ($item) {
            return explode(';', $item[0]);
        }, array_slice($data, 1));


        $db_columns = $this->db_columns();

        return view('import_fields', compact('headers', 'csv', 'db_columns'));
    }

    public function processImport(Request $request)
    {
        $csv_rows = $request->input('rows');
        $selected_columns = array_flip($request->input('columns'));

        $inserts = [];
        foreach($csv_rows as $row) {
            $new = [];
            if(isset($selected_columns['first_name'])) $new['first_name'] = $row[$selected_columns['first_name']] ?? "";
            if(isset($selected_columns['last_name'])) $new['last_name'] = $row[$selected_columns['last_name']] ?? "";
            if(isset($selected_columns['email'])) $new['email'] = $row[$selected_columns['email']] ?? "";
            $new['created_at'] = now();
            $new['updated_at'] = now();

            $inserts[] = $new;
        }

        Contact::insert($inserts);



        return redirect()->back()->with('success', 'contact added successfully.');
    }


    private function db_columns() {
       return DB::select("SELECT `COLUMN_NAME`
            FROM `INFORMATION_SCHEMA`.`COLUMNS`
            WHERE `TABLE_SCHEMA`='test'
                AND `TABLE_NAME`='contacts' AND COLUMN_NAME NOT IN ('created_at','updated_at','id')");
    }
}
