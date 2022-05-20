<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{

     protected $contact;

     public function __construct(Contact $contact)
     {
         $this->contact = $contact;
     }


    public function model(array $row)
    {
        $data = Contact::first();
        return new Contact([
            'id'    => $row[0],
            'first_name'  => $row[1],
            'last_name'  => $row[2],
            'email' => $row[3],

        ]);
    }
}

