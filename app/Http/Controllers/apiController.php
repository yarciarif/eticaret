<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kullanici;
use App\Models\Urun;

class apiController extends Controller
{
    public function index($id)
    {
    	$user = Kullanici::findorfail($id);
    	return json_encode($user);
    }
    public function urunBul($id)
    {
    	$api= Urun::findOrFail($id);
    	return json_encode($api);
    }
}
