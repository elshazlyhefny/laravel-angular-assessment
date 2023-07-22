<?php
namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\DataProviderXService;
use App\Models\DataProviderX;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataProviderXServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testFilterUsers()
    {
        // Create sample data in the database for DataProviderX
        DataProviderX::factory()->create([
            'statusCode' => 1,
            'Currency' => 'USD',
            'parentAmount' => 50,
        ]);

        DataProviderX::factory()->create([
            'statusCode' => 2,
            'Currency' => 'EUR',
            'parentAmount' => 100,
        ]);

        $dataProviderXService = new DataProviderXService();

        // Test filter by status code and currency
        $filters = ['statusCode' => 'authorised', 'Currency' => 'USD'];
        $filteredUsers = $dataProviderXService->filterUsers($filters);
        $this->assertCount(1, $filteredUsers);

        // Test filter by balance range
        $filters = ['balanceMin' => 0, 'balanceMax' => 75];
        $filteredUsers = $dataProviderXService->filterUsers($filters);
        $this->assertCount(1, $filteredUsers);
    }
}
