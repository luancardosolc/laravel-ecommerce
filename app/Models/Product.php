<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 * @OA\Xml(name="Product"),
 * @OA\Property(property="id", type="integer", example="1"),
 * @OA\Property(property="name", type="string", example="Product Name"),
 * @OA\Property(property="slug", type="string", example="product-name"),
 * @OA\Property(property="price", type="number", format="double", example="10.99"),
 * @OA\Property(property="created_at", ref="#/components/schemas/BaseModel/properties/created_at"),
 * @OA\Property(property="updated_at", ref="#/components/schemas/BaseModel/properties/updated_at"),
 * @OA\Property(property="deleted_at", ref="#/components/schemas/BaseModel/properties/deleted_at")
 * )
 *
 * Class Product
 *
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price'
    ];
}
