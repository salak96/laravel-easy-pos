<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class InstallController extends Controller
{
    public function install()
    {
        if (Schema::hasTable('setting')) {
            return;
        }

        try {

            Artisan::call('migrate', ['--force' => true]);
            echo "✅ Migrations completed.\n";

            Artisan::call('db:seed', ['--force' => true]);
            echo "✅ Database seeding completed.\n";

            Artisan::call('config:cache');
            Artisan::call('route:cache');
            Artisan::call('view:cache');
            echo "✅ Configuration and routes cached.\n";

            return response()->json(['message' => 'Installation completed successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
