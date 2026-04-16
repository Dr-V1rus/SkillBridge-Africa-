<?php 
ini_set("display_errors", 1); 
ini_set("display_startup_errors", 1); 
error_reporting(E_ALL); 
 
use Illuminate\Contracts\Http\Kernel; 
use Illuminate\Http\Request; 
 
define("LARAVEL_START", microtime(true)); 
 
if (file_exists($maintenance = __DIR__."/storage/framework/maintenance.php")) { 
    require $maintenance; 
} 
 
require __DIR__."/vendor/autoload.php"; 
 
$app = require_once __DIR__."/bootstrap/app.php"; 
 
$kernel = $app-
 
try { 
    $response = $kernel-
        $request = Request::capture() 
    )-
 
    $kernel-, $response); 
} catch (\Exception $e) { 
    echo "ERROR: " . $e- . "<br>"; 
    echo "File: " . $e- . "<br>"; 
    echo "Line: " . $e- . "<br>"; 
    echo "<pre>" . $e- . "</pre>"; 
    exit; 
} 
