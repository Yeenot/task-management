<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\HasSearch;

class Task extends Model
{
    use HasFactory, HasSearch;

    /**
     * Columns that are guarded
     *
     * @var array
     */
    protected $guarded = [];
}