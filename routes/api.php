<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authModule\authtication;
use App\Http\Controllers\{AdminuserController, BoxsleeveController, ColorsController, CostomerController, CostomerrequistController, CountryzoneController, CoversController, CoversupgradesController, OrientationController, PaperController, ProductboxsleeveController, ProductboxsleevepriceController, ProductcolorsController, ProductController, ProductcoversController, ProductcoversupgradesController, ProductorientationController, ProductpapperpriceController, ProductsheetController, ProductSizeController, SheetController, SizeController, StudioController};
use App\Models\productSize;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Post('auth/login', [authtication::class, 'login']);
Route::Post('auth/otpveryfi', [authtication::class, 'otpvery']);
Route::Post('auth/costomer/login', [authtication::class, 'costomerlogin']);
Route::Post('auth/costomer/token', [authtication::class, 'tokenVerify']);
Route::Post('auth/costomer/forget-password', [authtication::class, 'forgetPasswordReq']);
Route::Post('auth/costomer/forget-password/check-otp', [authtication::class, 'checkOtp']);
Route::Post('auth/costomer/forget-password/set-password', [authtication::class, 'setPassword']);

Route::apiResource('costomer', CostomerController::class);
Route::post('costomer/approve/{id}', [CostomerController::class, 'aprovedReq']);
Route::post('costomer/status/{id}', [CostomerController::class, 'statusUpdate']);
Route::post('costomer/password/{id}', [CostomerController::class, 'passwordUpdate']);
Route::post('costomer/zoneupdate/{id}', [CostomerController::class, 'zoneUpdate']);
Route::post('costomer/change-avtar/{id}', [CostomerController::class, 'changeAvatar']);
Route::post('costomer/fetch', [CostomerController::class, 'show']);

Route::apiResource('product', ProductController::class);
Route::apiResource('countryzone', CountryzoneController::class);
Route::apiResource('orientation', OrientationController::class);
Route::apiResource('Size', SizeController::class);
Route::apiResource('paper', PaperController::class);
Route::apiResource('sheet', SheetController::class);
Route::apiResource('covers', CoversController::class);
Route::apiResource('coversupgrades', CoversupgradesController::class);
Route::apiResource('colors', ColorsController::class);
Route::apiResource('boxsleeve', BoxsleeveController::class);

// resource update routes
Route::post('product/update/{id}', [ProductController::class, 'update']);
Route::post('orientation/update/{id}', [OrientationController::class, 'update']);
Route::post('Size/update/{id}', [SizeController::class, 'update']);
Route::post('paper/update/{id}', [PaperController::class, 'update']);
Route::post('sheet/update/{id}', [SheetController::class, 'update']);
Route::post('covers/update/{id}', [CoversController::class, 'update']);
Route::post('coversupgrades/update/{id}', [CoversupgradesController::class, 'update']);
Route::post('colors/update/{id}', [ColorsController::class, 'update']);
Route::post('boxsleeve/update/{id}', [BoxsleeveController::class, 'update']);
Route::post('countryzone/update/{id}', [CountryzoneController::class, 'update']);

Route::post('product/create/{id}', [ProductController::class, 'createProductResource']);

Route::get('test', function () {
    return response([
        'success' => true,
        'message' => productSize::with(['size', 'papers', 'cover', 'boxsleeve', 'sheet',])->get()
    ], 200);
});

/*
Route::apiResource('productorientation', ProductorientationController::class);
Route::apiResource('productSize', ProductSizeController::class);
Route::apiResource('productsheet', ProductsheetController::class);
Route::apiResource('productcovers', ProductcoversController::class);
Route::apiResource('productcoversupgrades', ProductcoversupgradesController::class);
Route::apiResource('productcolors', ProductcolorsController::class);
Route::apiResource('productboxsleeve', ProductboxsleeveController::class);
Route::apiResource('productsheetprice', ProductsheetController::class);
Route::apiResource('productpapperprice', ProductpapperpriceController::class);
Route::apiResource('productboxsleeveprice', ProductboxsleevepriceController::class);

Route::apiResource('user',AdminuserController::class);
Route::apiResource('studio',StudioController::class);


*/
