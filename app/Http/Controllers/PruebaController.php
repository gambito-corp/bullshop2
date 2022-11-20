<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\WooComerceController;
use App\Models\Category;
use App\Models\Product;

class PruebaController extends Controller
{
    public function ActualizarCategoriasWooComerce()
    {
//(LLEVO A LIVEWIRE)
        $Categories = WooComerceController::getCategory();
        foreach ($Categories as $key => $value) {
            // dd($value);
            $categoria = Category::updateOrCreate(
                [
                    'wp_id'         => $value['wp_id']
                ],
                [
                    'name'          => $value['nombre'],
                    'wp_id'         => $value['wp_id'],
                    'slug'          => $value['slug'],
                    'description'   => $value['description'],
                    'display'       => $value['display'],
                    'image'         => $value['image'],
                ]
            );
        }
    }
    public function ActualizarProductosWooComerce()
    {
        //(LLEVO A LIVEWIRE)
        $this->ActualizarCategoriasWooComerce();
        $coleccion = collect();
        $Products = WooComerceController::getProducts();
        for ($i=1; $i < 33; $i++) { 
            $Products = WooComerceController::getProducts(100, $i);
            if($Products == [])
            {
                break;
            }else
            {
                foreach ($Products as $key => $value) 
                {
                    if($value->type == 'simple')
                    {
                        $imagen = $value->images[0]->src;
                        $categoria = Category::where('wp_id', $value->categories[0]->id)->first();
                        $attr = collect($value->attributes);
                        $marca = $attr->where('name', 'Marca')->first();
                        $metaData = collect($value->meta_data);
                        $costo = $metaData->where('key', 'purchase_product_simple')->first();
                        $producto = Product::updateOrCreate(
                            [                            
                                'wp_id'         => $value->id,                                
                            ],
                            [
                                'name'          => $value->name,
                                'wp_id'         => $value->id,
                                'slug'          => $value->slug,
                                'permalink'     => $value->permalink,
                                'type'          => $value->type,
                                'status'        => $value->status,
                                'description'   => $value->description,
                                'barcode'       => $value->sku,
                                'price'         => $value->price,
                                'costo'         => isset($costo->value) ? $costo->value : 0,
                                'stock'         => $value->stock_quantity == null ? 0 : $value->stock_quantity,
                                'marca'         => isset($marca->options[0]) ? $marca->options[0] : 'S/M',
                                'talla'         => 'S/T',
                                'image'        => $imagen,
                                'category_id'   => $categoria->id,

                            ]
                        );
                    }else{
                        $name = $value->name;
                        $producto = WooComerceController::getProductsVariations($value->id);
                        $categoria = Category::where('wp_id', $value->categories[0]->id)->first();
                        $attr = collect($value->attributes);
                        $marca = $attr->where('name', 'Marca')->first();
                        $slug = $value->slug;
                        $type = $value->type;
                        foreach ($producto as $key => $value) 
                        {
                            $imagen = $value->image->src;
                            $metaData = collect($value->meta_data);
                            $costo = $metaData->where('key', 'purchase_product_variable')->first();
                            $producto = Product::updateOrCreate(
                                [
                                    'wp_id' => $value->id
                                ],
                                [
                                    'name'          => $name,
                                    'wp_id'         => $value->id,
                                    'slug'          => $slug,
                                    'permalink'     => $value->permalink,
                                    'type'          => $type,
                                    'status'        => $value->status,
                                    'description'   => $value->description,
                                    'barcode'       => $value->sku,
                                    'price'         => $value->price,
                                    'costo'         => isset($costo->value) ? $costo->value : 0,
                                    'stock'         => $value->stock_quantity == null ? 0 : $value->stock_quantity,
                                    'marca'         => isset($marca->options[0]) ? $marca->options[0] : 'S/M',
                                    'talla'         => isset($value->attributes[0]->option) ? $value->attributes[0]->option : 'S/T',
                                    'imagen'        => $imagen,
                                    'category_id'   => $categoria->id,
    
                                ]
                            );
                        }
                    }
                }
            }
        }
        dd('Fin De La Ejecucion');
    }
}
