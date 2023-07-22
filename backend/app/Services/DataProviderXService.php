<?php 
namespace App\Services;

use App\Models\DataProviderX;
use Illuminate\Support\Facades\DB;
use App\Interfaces\DataProviderInterface;

class DataProviderXService implements DataProviderInterface
{
    
    // Combine all filters together
    public function filterUsers($filters = []): array
    {
        $query = DataProviderX::query();
        if (isset($filters['provider'])) {
            // You can add provider-specific filtering here if needed
        }
        if (isset($filters['statusCode'])) {
            $query->where('statusCode', $this->getStatusCodeValue($filters['statusCode']));
        }

        // Check if both $balanceMin and $balanceMax are not null
        if (isset($filters['balanceMin']) && isset($filters['balanceMax'])) {
            $query->whereBetween('parentAmount', [$filters['balanceMin'], $filters['balanceMax']]);
        }
        // Check if only $balanceMin is not null
        elseif (isset($filters['balanceMin'])) {
            $query->where('parentAmount', '>=', $filters['balanceMin']);
        }
        // Check if only $balanceMax is not null
        elseif (isset($filters['balanceMax'])) {
            $query->where('parentAmount', '<=', $filters['balanceMax']);
        }

        if (isset($filters['currency'])) {
            $query->where('currency', $filters['currency']);
        }

        return $query->get()->toArray();
    }

    public function saveFromJsonFile($filePath)
    {
        DB::beginTransaction();

        try {
            $this->processJsonFile($filePath, function ($data) {
                foreach ($data as $item) {
                    DataProviderX::create($item);
                }
            });

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            // Re-throw the exception to be caught in the controller
            throw $e;
        }
    }

    protected function processJsonFile($filePath, callable $callback)
    {
        $fileContent = file_get_contents($filePath);
        $jsonData = json_decode($fileContent, true);

        $chunkSize = 1000; // Adjust chunk size as needed

        foreach (array_chunk($jsonData, $chunkSize) as $dataChunk) {
            $callback($dataChunk);
        }
    }

    private function getStatusCodeValue(string $statusCode): int
    {
        // Map status code strings to their corresponding integer values
        $statusCodeMap = [
            'authorised' => 1,
            'decline' => 2,
            'refunded' => 3,
        ];

        return $statusCodeMap[$statusCode] ?? 0;
    }
}
