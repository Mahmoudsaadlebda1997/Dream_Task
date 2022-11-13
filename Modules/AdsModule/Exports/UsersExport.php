<?php

namespace Modules\AdsModule\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Modules\AdsModule\Entities\User;

class UsersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }
}
