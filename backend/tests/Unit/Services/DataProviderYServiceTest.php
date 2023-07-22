<?php
namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\DataProviderYService;
use App\Models\DataProviderY;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataProviderYServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testFilterUsers()
    {
        // Create sample data in the database for DataProviderY
        DataProviderY::factory()->create([
            'status' => 100,
            'currency' => 'AED',
            'balance' => 50,
        ]);

        DataProviderY::factory()->create([
            'status' => 200,
            'currency' => 'USD',
            'balance' => 100,
        ]);

        $dataProviderYService = new DataProviderYService();

        // Test filter by status code and currency
        $filters = ['statusCode' => 'authorised', 'currency' => 'AED'];
        $filteredUsers = $dataProviderYService->filterUsers($filters);
        $this->assertCount(1, $filteredUsers);

        // Test filter by balance range
        $filters = ['balanceMin' => 0, 'balanceMax' => 75];
        $filteredUsers = $dataProviderYService->filterUsers($filters);
        $this->assertCount(1, $filteredUsers);
    }
}