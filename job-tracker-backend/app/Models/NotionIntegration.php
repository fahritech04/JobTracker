<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotionIntegration extends Model
{
    protected $fillable = [
        'user_id', 'notion_workspace_id', 'access_token', 'database_id'
    ];
}
