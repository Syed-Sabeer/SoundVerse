<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MonthlyPlay extends Model
{
    use HasFactory;

    protected $table = 'monthly_plays';

    protected $fillable = [
        'user_id',
        'music_id',
        'plays',
        'month',
        'year'
    ];

    protected $casts = [
        'plays' => 'integer',
        'month' => 'integer',
        'year' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the monthly play record
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the music that was played
     */
    public function music()
    {
        return $this->belongsTo(ArtistMusic::class, 'music_id');
    }

    /**
     * Increment play count for a user and music in current month/year
     */
    public static function incrementPlay($userId, $musicId)
    {
        try {
            $currentMonth = now()->month;
            $currentYear = now()->year;

            Log::info('MonthlyPlay: Incrementing play count', [
                'user_id' => $userId,
                'music_id' => $musicId,
                'month' => $currentMonth,
                'year' => $currentYear
            ]);

            $monthlyPlay = self::firstOrCreate(
                [
                    'user_id' => $userId,
                    'music_id' => $musicId,
                    'month' => $currentMonth,
                    'year' => $currentYear
                ],
                [
                    'plays' => 0
                ]
            );

            $monthlyPlay->increment('plays');

            Log::info('MonthlyPlay: Play count incremented successfully', [
                'monthly_play_id' => $monthlyPlay->id,
                'current_plays' => $monthlyPlay->plays
            ]);

            return $monthlyPlay;

        } catch (\Exception $e) {
            Log::error('MonthlyPlay: Error incrementing play count', [
                'user_id' => $userId,
                'music_id' => $musicId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Get total plays for a user in a specific month/year
     */
    public static function getUserMonthlyPlays($userId, $month = null, $year = null)
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        return self::where('user_id', $userId)
            ->where('month', $month)
            ->where('year', $year)
            ->sum('plays');
    }

    /**
     * Get total plays for a specific music in a specific month/year
     */
    public static function getMusicMonthlyPlays($musicId, $month = null, $year = null)
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        return self::where('music_id', $musicId)
            ->where('month', $month)
            ->where('year', $year)
            ->sum('plays');
    }

    /**
     * Get top played songs for a user in a specific month/year
     */
    public static function getUserTopSongs($userId, $month = null, $year = null, $limit = 10)
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        return self::with('music')
            ->where('user_id', $userId)
            ->where('month', $month)
            ->where('year', $year)
            ->orderBy('plays', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get monthly play statistics for a user
     */
    public static function getUserMonthlyStats($userId, $year = null)
    {
        $year = $year ?? now()->year;

        return self::where('user_id', $userId)
            ->where('year', $year)
            ->selectRaw('month, SUM(plays) as total_plays, COUNT(DISTINCT music_id) as unique_songs')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    /**
     * Get all-time play statistics for a user
     */
    public static function getUserAllTimeStats($userId)
    {
        return self::where('user_id', $userId)
            ->selectRaw('SUM(plays) as total_plays, COUNT(DISTINCT music_id) as unique_songs, COUNT(DISTINCT CONCAT(month, "-", year)) as active_months')
            ->first();
    }

    /**
     * Scope for current month/year
     */
    public function scopeCurrentMonth($query)
    {
        return $query->where('month', now()->month)
                    ->where('year', now()->year);
    }

    /**
     * Scope for specific month/year
     */
    public function scopeForMonth($query, $month, $year)
    {
        return $query->where('month', $month)
                    ->where('year', $year);
    }

    /**
     * Scope for specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for specific music
     */
    public function scopeForMusic($query, $musicId)
    {
        return $query->where('music_id', $musicId);
    }
}