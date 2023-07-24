<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\DataProviderXService;
use App\Services\DataProviderYService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DataImportRequest;

class DataImportController extends Controller
{
    public function import(DataImportRequest  $request)
    {

        // Process the data import based on the provider
        $provider = $request->input('provider');
        $file = $request->file('file');
        $tempFilePath = $file->store('temp-imports'); // Store the uploaded file in a temporary location

        try {
            if ($provider === 'DataProviderX') {
                $dataProviderXService = new DataProviderXService();
                $dataProviderXService->saveFromJsonFile($tempFilePath);
            } elseif ($provider === 'DataProviderY') {
                $dataProviderYService = new DataProviderYService();
                $dataProviderYService->saveFromJsonFile($tempFilePath);
            }
            // remove file
            Storage::delete($tempFilePath);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the import process
            // Log the error for debugging purposes
            \Log::error($e->getMessage());
            // remove file 
            Storage::delete($tempFilePath);
            // Provide feedback to the user about the error
            return response()->json(['message' => $e->getMessage()], 500);
        }


        // Return a success response if the data import is successful
        return response()->json(['message' => 'Data import successfully']);
    }
}
