<?php

namespace App\Imports;

use App\Models\Axes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class AxesImport implements ToModel, WithBatchInserts, WithChunkReading, WithUpserts
{

    public function __construct($type)
    {
        $this->type = $type;
        $this->sizeIndex = $type == 'BID' ? 2 : 3;
        $this->date = date('Y-m-d');
    }


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!preg_match('/\d{5,}/', $row[0])) {
            return null;
        }

        $id = md5($row[0] . $this->type . $row[4] . $this->date);
        return new Axes([
            'id' => $id,
            'cusip' => $row[0],
            'size' => $row[$this->sizeIndex],
            'type' => $this->type,
            'dealer' => $row[7],
            'dealer_code' => $row[6],
        ]);
    }

    public function uniqueBy()
    {
        return 'id';
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
