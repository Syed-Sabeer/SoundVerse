# SoundVerse — Music Streaming, Artist Portal & Royalty Management Platform

SoundVerse is a full-stack music streaming and artist management platform built for independent artists, listeners, and platform administrators. It provides a complete ecosystem where users can discover music, create playlists, follow artists, subscribe to premium plans, download songs, and support artists through tips.

The platform also includes a dedicated artist portal for uploading music, managing artwork, tracking analytics, viewing royalties, requesting payouts, and collaborating with other artists. The admin panel gives platform owners full control over content, users, artists, subscriptions, payments, royalties, ads, services, and website CMS content.

---

## Live Demo

Current Project Reference:
https://singwithmerecords.co.uk/

SoundVerse Deployment Link:
http://soundverse.deveoninc.com/

> Note: The SoundVerse deployment link will be updated after final deployment.

---

## Project Overview

SoundVerse is designed as a modern music platform inspired by real-world streaming and artist distribution systems. The goal of the project is to provide a complete digital music experience for three major user roles:

* Admin
* Artist
* Listener / Customer

The platform supports music uploads, streaming, playlists, favorites, artist following, premium subscriptions, offline downloads, royalty calculation, payout requests, collaboration splits, ad revenue tracking, sponsored playlists, and website content management.

---

## Key Highlights

* Multi-role platform: Admin, Artist, and Listener
* Full music streaming experience
* Artist portal with music, artwork, royalty, analytics, and payout features
* Admin dashboard for complete platform management
* Subscription-based feature access
* Royalty calculation and payout workflow
* Stripe/payment integration support
* Ad injection system for free users
* Playlist, favorite, follow, and tip features
* CMS-powered website pages and dynamic frontend content
* Responsive user interface
* Real-time notifications support

---

## Tech Stack

### Backend

* Laravel 10
* PHP 8.1+
* MySQL
* Laravel Sanctum
* Spatie Laravel Permission
* Pusher
* Stripe PHP SDK
* Laravel Mail
* Laravel Notifications

### Frontend

* Blade Templates
* HTML5
* CSS3
* JavaScript
* SCSS
* Vite
* Axios

### Other Tools & Integrations

* Stripe Payments
* Pusher Real-Time Events
* QR Code Support
* CSV/PDF Export
* Admin Dashboard
* Music Player
* File Upload System

---

## User Roles

### 1. Admin

The admin controls the entire platform, manages users and artists, configures subscriptions, handles royalty payouts, manages content, monitors analytics, and controls platform settings.

### 2. Artist

Artists can register, manage their profile, upload songs and artwork, view analytics, track royalties, request payouts, manage collaborations, and purchase subscription plans.

### 3. Listener / Customer

Listeners can discover music, play songs, create playlists, like songs, follow artists, subscribe to premium plans, download songs, tip artists, and manage their music experience.

---

## Admin Panel Features

### Content Management

* Manage website homepage content
* Manage About, Contact, Blog, Services, CMS pages
* Manage FAQ sections
* Manage newsletter content
* Manage live videos
* Manage news bar text
* Manage frontend dynamic sections

### User Management

* View and manage all customers
* Monitor user accounts
* Activate or deactivate users
* Toggle featured users
* View customer details and activity

### Artist Management

* Approve or reject artist registrations
* Manage artist accounts
* Toggle featured artist status
* View artist analytics
* Monitor artist subscriptions
* Manage artist visibility on the platform

### Music Management

* View uploaded songs
* Manage music library
* Toggle featured songs
* Manage artwork and thumbnails
* Monitor song performance
* Control song visibility

### Subscription Management

* Create and edit listener subscription plans
* Create and edit artist subscription plans
* Configure plan-based features
* Manage upload limits
* Monitor active subscriptions
* Manage premium feature access

### Royalty Management

* View royalty calculations
* Track stream-based earnings
* Review payout requests
* Approve or reject payout requests
* Process artist payouts
* View transaction history
* Generate royalty reports
* Export reports in CSV/PDF format

### Tip Management

* View all artist tips
* Track payment status
* View tip details
* Monitor platform fee deductions
* Track artist support transactions

### Analytics

* View dashboard metrics
* Track user activity
* Track artist performance
* Track song streams and downloads
* View demographics
* Export analytics reports

### Services Management

* Manage music and video upload services
* Manage royalty collection services
* Manage artist subscription services
* Manage artwork and photo upload services
* Manage support and networking services

### Additional Admin Features

* Chatbot management
* Partner management
* Gift and ring orders
* Ad management
* Sponsored playlists
* System settings
* Platform configuration

---

## Artist Portal Features

### Account & Profile

* Artist registration
* Artist login
* Profile management
* Profile customization
* Artist bio, image, and account details

### Music Management

* Upload songs with metadata
* Upload thumbnails and music files
* Manage music library
* Edit or delete uploaded songs
* Upload limits based on subscription plan
* Track uploaded songs

### Artwork Management

* Upload artwork
* Manage artwork gallery
* Edit artwork details
* Delete artwork

### Artist Analytics

* Artist dashboard
* Track song performance
* View monthly listeners
* View demographics
* View per-track analytics
* Export analytics in CSV format

### Royalty & Earnings

* Earnings dashboard
* Track total earnings
* Track available balance
* Track pending balance
* View per-track earnings
* Request payouts
* View payout history
* Manage payment details
* Export earnings reports

### Ad Revenue

* View ad revenue earnings
* Track income from ad-supported users
* Monitor ad injection-based revenue

### Collaborations

* Create track collaborations
* Add collaborating artists
* Manage ownership splits
* Approve or reject collaboration requests
* View revenue distribution
* Track collaborative earnings

### Artist Subscriptions

* View artist subscription plans
* Purchase subscription plans
* Unlock unlimited uploads
* Get featured rotation access
* Access ISRC code support
* Receive certified creator badge
* Unlock advanced analytics

---

## Listener / Customer Portal Features

### Account Management

* User registration
* User login
* Account management
* Profile management
* Secure logout

### Music Experience

* Discover music
* Search songs and artists
* Play songs using a music player
* View song details
* Browse artist profiles
* Explore featured tracks

### Playlists

* Create playlists
* Manage playlists
* Add songs to playlists
* Remove songs from playlists
* Free users can create limited playlists
* Premium users can create unlimited playlists
* Smart playlist support

### Favorites & Collections

* Like songs
* Manage favorite songs
* Create collections
* Follow artists
* View subscribed artists

### Subscriptions

Free listener plan:

* Ads during playback
* Limited playlists
* Standard audio quality
* No offline downloads

Premium listener plan:

* Ad-free listening
* Unlimited playlists
* Offline downloads
* HD audio
* Tip artists
* Supporter badge

### Offline Downloads

* Download songs as a premium user
* Manage downloaded songs
* Track download limits
* Access downloaded music

### Music Interaction

* Share songs
* Follow playlists
* Follow artists
* Tip artists
* Support independent creators

### Statistics

* User dashboard
* Playlist count
* Favorite songs count
* Subscribed artists count
* Listening history
* User activity statistics

### Payments

* Subscription purchase
* Stripe payment support
* PayPal support
* Google Pay support
* Apple Pay support
* Square payment support
* Payment status tracking

### Ads

* Ad injection for free users
* Premium users receive ad-free experience
* Sponsored music and playlist support

---

## Core System Flows

### Music Streaming Flow

1. Listener selects a song.
2. Music player loads the selected track.
3. The system tracks play activity.
4. Streams longer than the required threshold are counted for royalty calculation.
5. Analytics and artist stats are updated.

### Royalty Calculation Flow

1. User streams are tracked.
2. Complete streams are recorded.
3. Platform revenue is configured by admin.
4. Royalties are calculated based on stream share.
5. Platform fee is deducted.
6. Artist wallet balance is updated.
7. Artist can request payout.

### Payout Flow

1. Artist requests payout.
2. Admin reviews payout request.
3. Admin approves or rejects the request.
4. Approved payout moves to processing.
5. Admin marks payout as completed.
6. Artist receives updated payout status.

### Collaboration Flow

1. Artist creates collaboration for a track.
2. Collaborating artists are added.
3. Ownership percentages are assigned.
4. Collaborators approve or reject the split.
5. Revenue is distributed based on ownership percentage.

### Ad Injection Flow

1. Free user starts music playback.
2. System checks subscription status.
3. Ads are shown during or between playback.
4. Premium users do not see ads.
5. Ad-related activity can be tracked for revenue.

---

## Project Structure

```txt
SoundVerse/
│
├── app/
│   ├── Console/
│   ├── Events/
│   ├── Exceptions/
│   ├── Helpers/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/
│   │       ├── Api/
│   │       ├── Artist/
│   │       ├── Auth/
│   │       ├── Frontend/
│   │       └── Notification/
│   ├── Mail/
│   ├── Models/
│   ├── Notifications/
│   ├── Providers/
│   └── Services/
│
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── composer.json
├── package.json
├── vite.config.js
└── README.md
```

---

## Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/Syed-Sabeer/SoundVerse.git
cd SoundVerse
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Create Environment File

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Configure Database

Update your `.env` file:

```env
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 7. Run Migrations

```bash
php artisan migrate
```

If you are using the provided SQL file, import it manually into MySQL.

### 8. Link Storage

```bash
php artisan storage:link
```

### 9. Build Frontend Assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 10. Start Local Server

```bash
php artisan serve
```

Open the project:

```txt
http://127.0.0.1:8000
```

---

## Environment Variables

Create a `.env` file using `.env.example`.

Required configuration:

```env
APP_NAME=SoundVerse
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=soundverse
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=

STRIPE_KEY=
STRIPE_SECRET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
```

> Never upload real `.env` files, production credentials, API keys, or database passwords to GitHub.

---

## Screenshots

Add screenshots inside a `screenshots/` folder.

Recommended screenshots:

```md
![Homepage](screenshots/homepage.png)
![Music Player](screenshots/music-player.png)
![Artist Portal](screenshots/artist-portal.png)
![Admin Dashboard](screenshots/admin-dashboard.png)
![Royalty Dashboard](screenshots/royalty-dashboard.png)
![Playlist Page](screenshots/playlist-page.png)
![Subscription Plans](screenshots/subscription-plans.png)
```

---

## Recommended Screenshots to Add

* Homepage
* Login/Register page
* Listener dashboard
* Music player
* Song details page
* Playlist creation page
* Favorites page
* Artist profile page
* Artist dashboard
* Upload music page
* Artist analytics page
* Royalty/earnings page
* Payout request page
* Collaboration page
* Admin dashboard
* User management page
* Artist approval page
* Song management page
* Subscription plan management
* Royalty management page
* Ad management page
* CMS page management

---

## My Role

I worked as the full-stack developer and contributed to the complete development of the platform, including:

* Laravel backend development
* Database structure and models
* Authentication and role-based access
* Admin panel modules
* Artist portal modules
* Listener/customer portal modules
* Music upload and streaming flow
* Playlist and favorites functionality
* Subscription plan management
* Royalty calculation workflow
* Payout request workflow
* Collaboration ownership split logic
* Tip and payment flow integration
* Ad injection system
* CMS and dynamic website content
* Frontend integration using Blade, JavaScript, and Vite
* Testing and deployment preparation

---

## Documentation

This repository can include additional documentation files:

```txt
PORTAL_FEATURES_REPORT.md
PORTAL_WORKING_FLOW_REPORT.md
TESTING_GUIDE.md
PAYMENT_METHODS_FIX.md
JAVASCRIPT_FIXES_SUMMARY.md
```

Recommended documentation to add:

```txt
docs/
├── features.md
├── installation.md
├── database-overview.md
├── api-overview.md
├── testing-guide.md
├── deployment-guide.md
└── security-notes.md
```

---

## Future Improvements

* Add REST API documentation
* Add OpenAPI/Swagger documentation
* Improve automated test coverage
* Add Docker setup
* Add CI/CD workflow
* Improve frontend UI consistency
* Add advanced recommendation system
* Add real-time chat between artists and listeners
* Add advanced analytics dashboards
* Add multi-language support
* Add mobile app support
* Add queue-based processing for uploads and notifications
* Add cloud storage for music and artwork files
* Add admin activity logs
* Add role-based permission UI
* Add stronger security auditing

---

## Security Notes

Before using this project publicly or in production:

* Do not upload `.env` files
* Do not upload production credentials
* Do not upload database passwords
* Do not upload mail passwords
* Do not upload payment gateway secrets
* Do not upload private API keys
* Remove sensitive data from SQL files
* Use demo data in public repositories
* Keep production credentials inside server environment variables
* Rotate any key that was ever committed publicly

---

## Repository Status

This project is under active improvement and portfolio preparation.

Current focus:

* Cleaning repository structure
* Improving documentation
* Adding screenshots
* Preparing SoundVerse deployment
* Improving security and environment handling
* Making the project more professional for portfolio and job/university review

---

## Author

**Syed Sabeer Faisal**
Software Engineer | Full-Stack Developer

GitHub: https://github.com/Syed-Sabeer
Portfolio: Add your portfolio link here
LinkedIn: Add your LinkedIn link here

---

## Disclaimer

This project is built for educational, portfolio, and demonstration purposes. Any music, artwork, media, or payment credentials used in the public version should be demo data, licensed content, or test-mode information only.
