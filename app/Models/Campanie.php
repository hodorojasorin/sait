<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campanie extends Model
{
    use HasFactory;

    public const SERVICE_OPTIONS = [
        'seo' => 'SEO',
        'ppc' => 'PPC',
        'social_media' => 'Social Media',
        'email_marketing' => 'Email Marketing',
        'content_creation' => 'Content Creation',
        'analytics' => 'Analytics',
    ];

    public const STATUS_OPTIONS = [
        'planificata' => 'Planificata',
        'activa' => 'Activa',
        'in_pauza' => 'In pauza',
        'finalizata' => 'Finalizata',
    ];

    protected $table = 'campanii';

    protected $fillable = [
        'client_name',
        'project_name',
        'service_type',
        'status',
        'budget',
        'launch_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'budget' => 'decimal:2',
            'launch_date' => 'date',
        ];
    }

    public static function serviceOptions(): array
    {
        return self::SERVICE_OPTIONS;
    }

    public static function statusOptions(): array
    {
        return self::STATUS_OPTIONS;
    }
}
