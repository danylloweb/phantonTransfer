<?php

namespace Database\Seeders;

use App\Entities\TransactionStatus;
use App\Entities\TransferStatus;
use Illuminate\Database\Seeder;

class TransferStatusSeeder extends Seeder
{
    public function run()
    {
        $TransferStatuses = [
            ['name' => 'Em processamento'],
            ['name' => 'Cancelada'],
            ['name' => 'Finalizada'],
        ];
        foreach ($TransferStatuses as $TransferStatus) {TransferStatus::create($TransferStatus);}
    }
}
