<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp"),
 * @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp"),
 * @OA\Property(property="deleted_at", type="string", format="date-time", description="Soft delete timestamp"),
 * )
 * Class BaseModel
 *
 * @package App\Models
 */
abstract class BaseModel extends Model
{
}
