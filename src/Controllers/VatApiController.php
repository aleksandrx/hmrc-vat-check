<?php
namespace PatrixshahUKVatChecker\HmrcVatCheck\Controllers;

use App\Http\Controllers\Controller;
use PatrixshahUKVatChecker\HmrcVatCheck\Services\HmrcVatService;
use Illuminate\Http\Request;

class VatApiController extends Controller
{
    /**
     * Handle API request to check VAT number.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkVatNumber(Request $request, HmrcVatService $hmrcVatService)
    {
        $request->validate([
            'vat_number' => 'required|string',
        ]);

        try {
            $vatNumber = $request->input('vat_number');
            $resultApiCall = $hmrcVatService->checkVatNumber($vatNumber);

            return response()->json([
                'success' => true,
                'data' => $resultApiCall,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
