<?php

namespace App\Http\Controllers;

use Automattic\WooCommerce\Client;
use Illuminate\Http\Request;

class WooComerceController extends Controller
{

    public static function Woocomerce()
    {
        $woocomerce = new Client(
            env('API_URL', 'forge'),
            env('API_PUBLIC_KEY', 'forge'),
            env('API_PRIVATE_KEY', 'forge'),
            [
                'version' => 'wc/v3',
                'verify_ssl' => false
            ]
        );
        return $woocomerce;
    }

    public static function index()
    {
        $respuesta = WooComerceController::Woocomerce()->get("");
        dd($respuesta);
    }
    
    public static function getCoupons()
    {
        $respuesta = WooComerceController::Woocomerce()->get("coupons");
        dd($respuesta);
    }
    
    public static function getCustomers()
    {
        $respuesta = WooComerceController::Woocomerce()->get("customers");
        dd($respuesta);
    }
    
    public static function getOrders()
    {
        $respuesta = WooComerceController::Woocomerce()->get("orders");
        dd($respuesta);
    }
    
    public static function getOrdersNotes($id)
    {
        $respuesta = WooComerceController::Woocomerce()->get("orders/$id/notes");
        dd($respuesta);
    }
    
    public static function getOrderRefunds($id)
    {
        $respuesta = WooComerceController::Woocomerce()->get("orders/$id/refunds");
        dd($respuesta);
    }
    
    public static function getProducts()
    {
        $respuesta = WooComerceController::Woocomerce()->get("products/attributes");
        // $respuesta = WooComerceController::Woocomerce()->get("products");
        dd($respuesta);
    }

    public static function getCategory($id = '', $perPage=100, $page=1)
    {
        if($id == ''){
            $respuesta = WooComerceController::Woocomerce()->get("products/categories?per_page=$perPage&page=$page");
        }else{
            $respuesta = WooComerceController::Woocomerce()->get("products/categories/$id");
        }
        $objeto = collect();
        foreach ($respuesta as $key => $value) {
            $array = [
                'nombre'        => $value->name,
                'wp_id'         => $value->id,
                'slug'          => $value->slug,
                'description'   => null,
                'display'       => null,
                'image'         => null,
            ];
            $objeto->push($array);
        }
        dd($respuesta);
        return $objeto;
    }
   
}
