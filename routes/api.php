<?php
use Illuminate\Support\Facades\Route;
use PatrixshahUKVatChecker\HmrcVatCheck\Controllers\VatApiController;

// Route to check VAT number via API
Route::post('/api/vat/check', [VatApiController::class, 'checkVatNumber']);
