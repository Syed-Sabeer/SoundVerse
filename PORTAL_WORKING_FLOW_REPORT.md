# SingWithMe Platform - Working Flow Report

## *Admin Panel - Working Flows*

### Content Management Flow
1. *Website Content Management*
   - Admin logs in → Navigate to CMS/Website section
   - Edit Home, Contact, Blog, Services sections dynamically
   - About page is static (not editable)
   - Changes are saved and reflected immediately on frontend

2. *Blog Management Flow*
   - Admin → Blog → Add New Blog Post
   - Fill in title, content, images, visibility settings
   - Save → Post appears on frontend (if visibility enabled)
   - Can edit, delete, or toggle visibility anytime

3. *FAQ Management Flow*
   - Admin → FAQ → Add FAQ Section
   - Add questions and answers
   - Toggle visibility to show/hide on frontend
   - Manage FAQ Questions for Chatbot

### User & Artist Management Flow
1. *Artist Approval Flow*
   - Artist registers
   - Admin → Artists → View pending artists
   - Admin can approve/reject, toggle featured status
   - Approved artists can access artist portal

2. *Customer Management Flow*
   - Admin → Customers → View all customers
   - Toggle customer status (active/inactive)
   - Toggle featured customer status
   - Edit customer details if needed

3. *Song Approval Flow*
   - Artist uploads song → Song saved to database
   - Admin → Songs → View all uploaded songs
   - Admin can toggle featured status for songs
   - Songs are visible to users once uploaded (no manual approval required currently)

### Subscription Management Flow
1. *User Subscription Plan Management*
   - Admin → Subscription Plans → Add/Edit Plan
   - Set price, features (ad-free, unlimited playlists, etc.)
   - Configure feature flags per plan
   - Users can purchase plans from user portal

2. *Artist Subscription Plan Management*
   - Admin → Artist Subscription Plans → Add/Edit Plan
   - Set monthly fee, upload limits, features
   - Configure artist-specific features (ISRC codes, featured rotation, etc.)
   - Artists can purchase from artist portal

### Royalty & Payout Management Flow
1. *Payout Request Processing Flow*
   - Artist requests payout → Admin → Royalty → Payout Requests
   - Admin views payout request details (amount, payment method, account details)
   - Admin approves → Wallet balance deducted, status changes to "processing"
   - Admin completes payout → Status changes to "completed", artist notified
   - Admin can reject with notes if needed

2. *Royalty Calculation Flow*
   - System tracks streams and downloads automatically
   - Admin can manually trigger royalty calculation
   - Royalties calculated based on platform revenue and artist shares
   - Earnings added to artist wallet (available balance)

### Tip Management Flow
1. *Tip Processing Flow*
   - User sends tip to artist → Payment processed (Stripe/PayPal)
   - Platform fee deducted → Remaining amount sent to artist
   - Admin → Tips → View all tips
   - Admin can view detailed tip information (user, artist, amount, fees, payment method, status)

### Analytics Flow
1. *View Analytics*
   - Admin → Analytics → View overall platform analytics
   - View artist-specific analytics by selecting artist
   - Export analytics data (CSV format)
   - Track song plays, user activity, subscription revenue

### Ad Management Flow
1. *Ad Creation & Management*
   - Admin → Ads → Create Ad
   - Upload ad file (image/video), set title, link, visibility
   - Ads are injected into free user experience
   - Toggle visibility to enable/disable ads

---

## *Artist Portal - Working Flows*

### Account & Registration Flow
1. *Artist Registration Flow*
   - Navigate to Artist Register page → Fill registration form
   - Artist assigned "artist" role
   - Redirected to artist portal after registration

2. *Profile Management Flow*
   - Artist → Profile Settings → Edit profile
   - Upload profile picture, update bio
   - Changes saved → Profile updated on artist profile page

### Music Upload Flow
1. *Song Upload Process*
   - Artist → Artist Portal → Upload Music
   - Fill form: Song name, upload music file, thumbnail image, optional video
   - System checks upload limit based on subscription plan
   - If within limit → File uploaded, metadata saved
   - If limit reached → Error message shown, upload blocked
   - Song appears in "My Music" library immediately
   - Song is visible to all users on platform

2. *Upload Limit Check Flow*
   - System checks artist's subscription plan
   - Free/Starter plan: Limited uploads per month (default: 3)
   - Premium plans: Unlimited uploads
   - Counts uploads for current month
   - Blocks upload if limit exceeded

### Artwork Upload Flow
1. *Artwork Management*
   - Artist → My Artwork → Upload Artwork
   - Upload image file → Saved to database
   - Artwork appears in gallery
   - Can edit or delete artwork anytime

### Analytics Flow
1. *View Analytics*
   - Artist → Analytics → View dashboard
   - See total streams, downloads, monthly listeners
   - View per-track analytics
   - Export analytics data (CSV)
   - View demographics data

### Royalty & Earnings Flow
1. *Earnings Tracking*
   - System automatically tracks streams and downloads
   - Royalties calculated and added to artist wallet
   - Artist → Royalty → View earnings dashboard
   - See available balance, pending balance, total earned

2. *Payout Request Flow*
   - Artist → Royalty → Payout Requests → Request Payout
   - Enter amount (must be ≤ available balance)
   - Select payment method (PayPal, Bank Transfer, etc.)
   - Enter payment account details
   - Submit request → Status: "Pending"
   - Admin reviews and approves → Status: "Processing"
   - Admin completes payment → Status: "Completed"
   - Artist receives notification

3. *Payment Details Management*
   - Artist → Payment Details → Add/Update payment information
   - Save PayPal email or bank account details
   - Details used for payout processing

### Collaboration Flow
1. *Create Collaboration*
   - Artist → Collaborations → Create Collaboration
   - Select track → Add collaborating artists
   - Set ownership percentages (must total 100%)
   - Submit → Collaboration status: "Pending"
   - Collaborating artists receive notification

2. *Approve Collaboration*
   - Collaborating artist → Collaborations → View pending requests
   - Review ownership split → Approve or Reject
   - If all artists approve → Collaboration status: "Active"
   - Revenue automatically distributed based on ownership percentages

3. *Revenue Distribution*
   - System tracks earnings for collaborative tracks
   - Revenue distributed automatically based on ownership splits
   - Each artist sees their share in collaboration details


## *User/Customer Portal - Working Flows*

### Registration & Login Flow
1. *User Registration Flow*
   - Navigate to User Register page → Fill form (name, email, password)
   - System creates account → Assigns "individual" role
   - User logged in automatically → Redirected to user portal

2. *User Login Flow*
   - Navigate to User Login page → Enter email/username and password
   - System validates credentials → User logged in
   - Redirected to user portal

### Music Discovery & Playback Flow
1. *Search & Play Music*
   - User → User Portal → Search for songs
   - Click play button → Music player loads song
   - Song plays → Stream tracked for analytics
   - Ad injection system checks subscription → Shows ads if free user

2. *Ad Injection Flow (Free Users)*
   - Free user plays song → Ad timer starts
   - At random intervals (10-60 seconds) → Ad displayed
   - At 50% song progress → Mid-song ad displayed
   - Between songs → Ad displayed
   - Premium users → No ads shown (ad-free experience)

### Playlist Creation Flow
1. *Create Playlist Process*
   - User → User Portal → Create New Playlist (button)
   - Redirected to Playlist Creation page
   - Enter playlist name
   - Search for songs → Results appear
   - Click "+" button on songs → Songs added to selected list
   - Review selected songs → Can remove songs
   - Click "Create Playlist" → System validates:
     - Playlist name required
     - At least one song required
     - Check playlist limit (free: 3, premium: unlimited)
   - If valid → Playlist created → Redirected to user portal
   - Playlist appears in "My Playlists" section

2. *Add Songs to Existing Playlist*
   - User → My Playlists → Select playlist
   - Search for songs → Add songs to playlist
   - Songs added → Playlist updated

### Favorites Flow
1. *Like/Unlike Songs*
   - User plays song → Click like/favorite button
   - Song added to favorites → Stored in database
   - User → Favorites → View all favorited songs
   - Can unlike to remove from favorites

### Artist Subscription Flow
1. *Subscribe to Artist*
   - User → Artist Profile → Click Subscribe/Follow
   - Artist added to subscribed artists list
   - User receives notifications when artist uploads new songs
   - User → Subscribed Artists → View all followed artists

### Offline Downloads Flow
1. *Download Songs (Premium Feature)*
   - Premium user → Play song → Click download button
   - System checks download limit (if applicable)
   - If within limit → Song downloaded to device
   - User → Downloads → View all downloaded songs
   - Can play downloaded songs offline

### Subscription Purchase Flow
1. *Purchase User Subscription*
   - User → User Portal → View Subscription Plans
   - Select plan → Click Purchase
   - Choose payment method (Stripe, PayPal, Google Pay, Apple Pay, Square)
   - Complete payment → Subscription activated
   - Features unlocked immediately:
     - Ad-free experience (if plan includes)
     - Unlimited playlists (if plan includes)
     - Offline downloads (if plan includes)
     - HD audio, early access, etc.

### Tip Artist Flow
1. *Send Tip to Artist*
   - User → Artist Profile → Click Tip Button (premium feature)
   - Enter tip amount → Select payment method
   - Complete payment → Platform fee deducted
   - Remaining amount sent to artist
   - Tip recorded in system → Admin can view in Tips section


## *Cross-Portal Flows*

### Royalty Calculation & Distribution Flow
1. *Automatic Royalty Tracking*
   - User plays song → Stream logged in database
   - System tracks complete streams (30+ seconds)
   - Downloads tracked separately
   - Platform revenue set by admin
   - Royalties calculated: (Platform Revenue × Artist Share) / Total Streams
   - Earnings added to artist wallet (available balance)

2. *Payout Processing Flow*
   - Artist requests payout → Admin reviews
   - Admin approves → Wallet deducted → Status: Processing
   - Admin processes payment → Status: Completed
   - Artist receives notification

### Collaboration Revenue Distribution Flow
1. *Collaborative Track Earnings*
   - Collaborative track earns revenue
   - System calculates total earnings for track
   - Revenue distributed based on ownership percentages
   - Each artist's share added to their wallet
   - Artists can view distribution in collaboration details

### Notification Flow
1. *System Notifications*
   - Various events trigger notifications:
     - New song upload (to artist subscribers)
     - Payout approval/completion
     - Collaboration requests
     - New follower/subscriber
   - Notifications sent via Pusher (real-time)
   - Users see notifications in portal


## *Payment Processing Flows*

### Subscription Payment Flow
1. *User/Artist Subscription Purchase*
   - Select plan → Choose payment method
   - *Stripe*: Card details entered → Payment processed → Subscription activated
   - *PayPal*: Redirected to PayPal → Authorize → Return → Subscription activated
   - *Google Pay/Apple Pay*: Processed through Stripe → Subscription activated
   - *Square*: Card details entered → Payment processed → Subscription activated
   - Payment success → Subscription record created → Features unlocked

### Tip Payment Flow
1. *Tip Processing*
   - User enters tip amount → Select payment method
   - Payment processed → Platform fee calculated (5%)
   - Remaining amount sent to artist
   - Tip record created → Admin can view in Tips section
