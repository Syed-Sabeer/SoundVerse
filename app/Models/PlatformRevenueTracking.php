<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformRevenueTracking extends Model
{
    use HasFactory;

    protected $table = 'platform_revenue_tracking';

    protected $fillable = [
        'period_month',
        'period_year',
        'total_platform_revenue',
        'total_platform_streams',
        'total_platform_downloads',
        'currency',
        'revenue_source',
        'status',
        'finalized_at',
        'notes',
    ];

    protected $casts = [
        'period_month' => 'integer',
        'period_year' => 'integer',
        'total_platform_revenue' => 'decimal:2',
        'total_platform_streams' => 'integer',
        'total_platform_downloads' => 'integer',
        'finalized_at' => 'datetime',
    ];

    /**
     * Get or create revenue tracking for current month
     */
    public static function getCurrentMonth()
    {
        return self::firstOrCreate(
            [
                'period_month' => now()->month,
                'period_year' => now()->year,
            ],
            [
                'total_platform_revenue' => 0,
                'total_platform_streams' => 0,
                'total_platform_downloads' => 0,
                'status' => 'pending',
            ]
        );
    }

    /**
     * Get revenue tracking for a specific month/year
     */
    public static function getForPeriod($month, $year)
    {
        return self::where('period_month', $month)
            ->where('period_year', $year)
            ->first();
    }
}
