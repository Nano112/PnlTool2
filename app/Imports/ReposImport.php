<?php

namespace App\Imports;

use App\Models\Isin;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ReposImport implements ToModel, WithBatchInserts, WithChunkReading, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // validate row isin
        if (strlen($row[0]) != 12) {
            return null;
        }

        return new Isin([
            'isin' => $row[0],
            'name' => $row[1],
            'currency' => $row[2],
            'repo_rate' => $row[3],
            'comment' => $row[4],
        ]);
    }

    public function uniqueBy()
    {
        return 'isin';
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
