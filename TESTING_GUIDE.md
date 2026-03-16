# Comprehensive Testing Guide for SingWithMe

This guide provides step-by-step instructions for testing all streaming, royalty, and ad injection features.

## Table of Contents
1. [Stream Tracking Tests](#stream-tracking-tests)
2. [Royalty Calculation Tests](#royalty-calculation-tests)
3. [Ad Injection Tests](#ad-injection-tests)
4. [Integration Tests](#integration-tests)

---

## Stream Tracking Tests

### Test 1: Basic Play Tracking
**Objective:** Verify that playing a song tracks the play correctly.

**Steps:**
1. Log in as a regular user (not artist)
2. Navigate to any page with music (homepage, artist profile, song library)
3. Click play on any song
4. Open browser console (F12) and check for:
   - `MusicPlayer: Tracking play for song` log
   - `MusicPlayer: Play tracked successfully` log
5. Check database:
   ```sql
   SELECT * FROM monthly_plays WHERE music_id = [SONG_ID] ORDER BY created_at DESC LIMIT 1;
   ```
   - Should show `plays = 1`
   - Should show current month/year

**Expected Result:** Play is tracked in `monthly_plays` table.

---

### Test 2: Complete Stream Tracking (30+ seconds)
**Objective:** Verify that streams 30+ seconds are marked as complete for royalty calculation.

**Steps:**
1. Log in as a regular user
2. Play a song and let it play for at least 30 seconds
3. Let the song finish completely (or skip to end)
4. Check browser console for:
   - `MusicPlayer: Tracking complete stream for royalty calculation`
   - `MusicPlayer: Complete stream tracked for royalty calculation`
5. Check database:
   ```sql
   SELECT * FROM stream_stats WHERE music_id = [SONG_ID] ORDER BY created_at DESC LIMIT 1;
   ```
   - Should show `is_complete = 1`
   - Should show `stream_duration >= 30`
   - Should show `artist_id` matching the song's artist

**Expected Result:** Complete stream is logged in `stream_stats` with `is_complete = true`.

---

### Test 3: Incomplete Stream Tracking (< 30 seconds)
**Objective:** Verify that short streams are marked as incomplete.

**Steps:**
1. Log in as a regular user
2. Play a song and skip/stop it before 30 seconds
3. Check database:
   ```sql
   SELECT * FROM stream_stats WHERE music_id = [SONG_ID] ORDER BY created_at DESC LIMIT 1;
   ```
   - Should show `is_complete = 0`
   - Should show `stream_duration < 30`

**Expected Result:** Incomplete stream is logged with `is_complete = false`.

---

### Test 4: Listeners Count Increment
**Objective:** Verify that the song's listener count increases.

**Steps:**
1. Note the current `listeners` count for a song:
   ```sql
   SELECT listeners FROM artist_musics WHERE id = [SONG_ID];
   ```
2. Play the song as a user
3. Check the count again:
   ```sql
   SELECT listeners FROM artist_musics WHERE id = [SONG_ID];
   ```
   - Should be incremented by 1

**Expected Result:** `listeners` count increases on each play.

---

## Royalty Calculation Tests

### Test 5: Set Platform Revenue
**Objective:** Verify admin can set platform revenue for a period.

**Steps:**
1. Log in as admin
2. Navigate to `/admin/royalty`
3. Click "Set Platform Revenue" button
4. Fill in:
   - Month: Current month
   - Year: Current year
   - Revenue Amount: `1000.00`
   - Revenue Source: `subscriptions`
5. Submit the form
6. Check database:
   ```sql
   SELECT * FROM platform_revenue_tracking 
   WHERE period_month = [CURRENT_MONTH] 
   AND period_year = [CURRENT_YEAR];
   ```
   - Should show `total_platform_revenue = 1000.00`
   - Should show `status = 'confirmed'`

**Expected Result:** Platform revenue is saved for the period.

---

### Test 6: Calculate Royalties
**Objective:** Verify royalty calculation distributes revenue correctly.

**Prerequisites:**
- Platform revenue set for current month/year
- At least 2 songs with complete streams (30+ seconds) in the period

**Steps:**
1. Create test streams:
   ```sql
   -- Create 10,000 streams for Song 1
   INSERT INTO stream_stats (music_id, artist_id, user_id, stream_duration, is_complete, streamed_at)
   SELECT [SONG1_ID], [ARTIST1_ID], 1, 45, 1, NOW()
   FROM (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) t1
   CROSS JOIN (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) t2
   CROSS JOIN (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) t3
   CROSS JOIN (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) t4
   LIMIT 10000;
   
   -- Create 5,000 streams for Song 2
   INSERT INTO stream_stats (music_id, artist_id, user_id, stream_duration, is_complete, streamed_at)
   SELECT [SONG2_ID], [ARTIST2_ID], 1, 45, 1, NOW()
   FROM (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) t1
   CROSS JOIN (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) t2
   CROSS JOIN (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) t3
   LIMIT 5000;
   ```

2. Log in as admin
3. Navigate to `/admin/royalty`
4. Click "Calculate Royalties" button
5. Select current month and year
6. Submit
7. Check results:
   ```sql
   -- Check royalty calculations
   SELECT * FROM royalty_calculations 
   WHERE calculation_period = '[CURRENT_YEAR]-[CURRENT_MONTH]-01'
   ORDER BY total_streams DESC;
   ```
   - Should show calculations for both artists
   - Artist 1 should have ~66.67% of revenue (10,000 / 15,000 streams)
   - Artist 2 should have ~33.33% of revenue (5,000 / 15,000 streams)
   - Platform fee should be 20% of gross
   - Net should be gross - platform fee

8. Check artist wallets:
   ```sql
   SELECT * FROM artist_wallets WHERE artist_id IN ([ARTIST1_ID], [ARTIST2_ID]);
   ```
   - `available_balance` should be updated with net earnings
   - `total_earned` should be updated

9. Check artist earnings:
   ```sql
   SELECT * FROM artist_earnings 
   WHERE artist_id IN ([ARTIST1_ID], [ARTIST2_ID])
   ORDER BY created_at DESC;
   ```
   - Should show individual earnings records per track

**Expected Result:** 
- Royalties calculated proportionally based on stream counts
- 20% platform fee deducted
- Earnings added to artist wallets
- Individual earnings records created

---

### Test 7: Collaborative Track Revenue Split
**Objective:** Verify revenue is split correctly for collaborative tracks.

**Prerequisites:**
- A track with collaboration and ownership splits set up

**Steps:**
1. Set up collaboration (if not exists):
   - Artist uploads song
   - Adds collaborator with 50% ownership split
2. Create streams for the collaborative track
3. Set platform revenue and calculate royalties
4. Check earnings:
   ```sql
   SELECT * FROM artist_earnings 
   WHERE music_id = [COLLABORATIVE_SONG_ID];
   ```
   - Should show earnings for both artists
   - Each should receive their percentage share (after platform fee)

**Expected Result:** Revenue split correctly between collaborators.

---

## Ad Injection Tests

### Test 8: Ads Show for Free Users
**Objective:** Verify free users see ads.

**Steps:**
1. Log in as a user with NO subscription (or Free Listener plan)
2. Navigate to any page with music player
3. Open browser console (F12)
4. Check for:
   - `Global AdInjectionSystem: Ads enabled` log
   - `window.adInjectionSystem.isEnabled === true`
5. Play a song
6. Let it play for a while or wait for song to end
7. Verify:
   - Ad overlay appears (between songs or during playback)
   - Ad shows for 15 seconds with countdown
   - Music pauses during ad
   - Music resumes after ad

**Expected Result:** Ads are displayed for free users.

---

### Test 9: Ads Hidden for Premium Users
**Objective:** Verify premium users don't see ads.

**Steps:**
1. Log in as a user with Premium Listener subscription
2. Navigate to any page with music player
3. Open browser console
4. Check for:
   - `Global AdInjectionSystem: Ads disabled - Premium user` log
   - `window.adInjectionSystem.isEnabled === false`
5. Play multiple songs
6. Verify:
   - No ad overlays appear
   - Music plays continuously without interruption

**Expected Result:** No ads shown for premium users.

---

### Test 10: Admin Can Upload Ads
**Objective:** Verify admin can upload and manage ads.

**Steps:**
1. Log in as admin
2. Navigate to admin panel (find ads management section)
3. Upload a new ad:
   - Title: "Test Ad"
   - File: Upload image or video
   - Link: "https://example.com"
   - Visibility: Enabled
4. Save
5. Check database:
   ```sql
   SELECT * FROM ads WHERE title = 'Test Ad';
   ```
   - Should show the ad with `visibility = 1`

**Expected Result:** Ad is saved and visible.

---

### Test 11: Ad Injection API
**Objective:** Verify API returns correct ad data.

**Steps:**
1. As free user, make API call:
   ```javascript
   fetch('/api/ad-injection/data')
     .then(r => r.json())
     .then(console.log);
   ```
2. Check response:
   - `success: true`
   - `data.show_ads: true` (for free users)
   - `data.ad` object with ad details
   - `data.next_ad_in_seconds` between 120-480

3. As premium user, make same API call
4. Check response:
   - `data.show_ads: false`
   - `data.ad: null` or not present

**Expected Result:** API returns correct ad status based on subscription.

---

## Integration Tests

### Test 12: Complete Flow - Stream to Royalty
**Objective:** Test the complete flow from stream to royalty payment.

**Steps:**
1. **Setup:**
   - Create 2 artists
   - Each uploads 1 song
   - Create free user account

2. **Generate Streams:**
   - Log in as free user
   - Play Artist 1's song 100 times (let each play for 30+ seconds)
   - Play Artist 2's song 50 times (let each play for 30+ seconds)

3. **Set Revenue:**
   - Admin sets platform revenue: $1,000 for current month

4. **Calculate Royalties:**
   - Admin calculates royalties for current month
   - Verify:
     - Artist 1 gets ~66.67% of $1,000 = $666.67 gross
     - Platform fee (20%) = $133.33
     - Artist 1 net = $533.34
     - Artist 2 gets ~33.33% of $1,000 = $333.33 gross
     - Platform fee (20%) = $66.67
     - Artist 2 net = $266.66

5. **Verify Wallets:**
   ```sql
   SELECT * FROM artist_wallets;
   ```
   - Artist 1: `available_balance = $533.34`
   - Artist 2: `available_balance = $266.66`

**Expected Result:** Complete flow works end-to-end.

---

### Test 13: Ad Revenue Integration
**Objective:** Verify ads appear during streaming and don't affect royalty calculation.

**Steps:**
1. Log in as free user
2. Play songs and verify ads appear
3. Generate streams (as in Test 12)
4. Calculate royalties
5. Verify:
   - Ads don't interfere with stream tracking
   - Royalties calculated correctly despite ads
   - Stream counts accurate

**Expected Result:** Ads work independently of royalty system.

---

## Automated Test Execution

Run PHPUnit tests:

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run specific test
php artisan test --filter StreamTrackingTest
php artisan test --filter RoyaltyCalculationTest
php artisan test --filter AdInjectionTest
```

---

## Database Verification Queries

### Check Stream Tracking
```sql
-- Total streams this month
SELECT COUNT(*) as total_streams, 
       SUM(CASE WHEN is_complete = 1 THEN 1 ELSE 0 END) as complete_streams
FROM stream_stats
WHERE MONTH(streamed_at) = MONTH(NOW())
AND YEAR(streamed_at) = YEAR(NOW());

-- Streams per artist
SELECT artist_id, COUNT(*) as streams
FROM stream_stats
WHERE is_complete = 1
AND MONTH(streamed_at) = MONTH(NOW())
AND YEAR(streamed_at) = YEAR(NOW())
GROUP BY artist_id;
```

### Check Royalty Calculations
```sql
-- Recent royalty calculations
SELECT rc.*, u.name as artist_name
FROM royalty_calculations rc
JOIN users u ON rc.artist_id = u.id
ORDER BY rc.calculation_period DESC
LIMIT 10;

-- Total earnings per artist
SELECT artist_id, 
       SUM(artist_royalty_amount) as total_earned,
       SUM(platform_fee_amount) as total_fees
FROM royalty_calculations
GROUP BY artist_id;
```

### Check Artist Wallets
```sql
-- Wallet balances
SELECT u.name, aw.available_balance, aw.total_earned, aw.total_paid_out
FROM artist_wallets aw
JOIN users u ON aw.artist_id = u.id
ORDER BY aw.available_balance DESC;
```

### Check Ad Status
```sql
-- Visible ads
SELECT * FROM ads WHERE visibility = 1;

-- User subscription status
SELECT u.id, u.name, usp.title as plan, usp.is_ads
FROM users u
LEFT JOIN user_subscriptions us ON u.id = us.user_id AND us.usersubscription_date <= NOW() AND DATE_ADD(us.usersubscription_date, INTERVAL us.usersubscription_duration DAY) >= NOW()
LEFT JOIN user_subscription_plans usp ON us.usersubscription_id = usp.id
WHERE u.is_artist = 0
LIMIT 10;
```

---

## Troubleshooting

### Streams Not Tracking
- Check browser console for errors
- Verify API endpoint `/api/monthly-plays/track` is accessible
- Check CSRF token is present
- Verify user is authenticated

### Royalties Not Calculating
- Ensure platform revenue is set for the period
- Verify streams exist with `is_complete = 1` for the period
- Check database transactions aren't failing
- Review Laravel logs: `storage/logs/laravel.log`

### Ads Not Showing
- Verify user has free subscription (or no subscription)
- Check ads exist in database with `visibility = 1`
- Verify `window.adInjectionSystem` is initialized
- Check browser console for errors
- Verify API endpoint `/api/ad-injection/data` returns correct data

---

## Test Checklist

- [ ] Stream tracking works for initial play
- [ ] Complete streams (30+ sec) are logged correctly
- [ ] Incomplete streams (< 30 sec) are marked as incomplete
- [ ] Listeners count increments
- [ ] Platform revenue can be set by admin
- [ ] Royalties calculate correctly based on stream proportion
- [ ] 20% platform fee is applied
- [ ] Artist wallets are updated with earnings
- [ ] Collaborative tracks split revenue correctly
- [ ] Free users see ads
- [ ] Premium users don't see ads
- [ ] Admin can upload ads
- [ ] Ad API returns correct data
- [ ] Complete flow works end-to-end

---

**Last Updated:** January 2026
