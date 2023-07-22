<?php 
namespace App\Services;

use App\Models\DataProviderY;
use Illuminate\Support\Facades\DB;
use App\Interfaces\DataProviderInterface;

class DataProviderYService implements DataProviderInterface
{

    // Combine all filters together
    public function filterUsers($filters = []): array
    {
        $query = DataProviderY::query();

        if (isset($filters['provider'])) {
            // You can add provider-specific filtering here if needed
        }
        if (isset($filters['statusCode'])) {
            $query->where('status', $this->getStatusCodeValue($filters['statusCode']));
        }

        // Check if both $balanceMin and $balanceMax are not null
        if (isset($filters['balanceMin']) && isset($filters['balanceMax'])) {
            $query->whereBetween('balance', [$filters['balanceMin'], $filters['balanceMax']]);
        }
        // Check if only $balanceMin is not null
        elseif (isset($filters['balanceMin'])) {
            $query->where('balance', '>=', $filters['balanceMin']);
        }
        // Check if only $balanceMax is not null
        elseif (isset($filters['balanceMax'])) {
            $query->where('balance', '<=', $filters['balanceMax']);
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
                    DataProviderY   ::create($item);
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
        // Map status code strings to their corresponding integer values for DataProviderY
        $statusCodeMap = [
            'authorised' => 100,
            'decline' => 200,
            'refunded' => 300,
        ];

        return $statusCodeMap[$statusCode] ?? 0;
    }
}
