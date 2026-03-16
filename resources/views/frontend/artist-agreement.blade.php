@extends('layouts.frontend.master')

@section('css')

<style>
        .digital-agreements {
            position:relative;
            margin: 4rem 0;
        }

        .digital-agreements .header {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .digital-agreements .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

       .digital-agreements  .logo {
            font-size: 1.5em;
            font-weight: 700;
            background: linear-gradient(45deg, #f093fb, #f5576c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .digital-agreements .header-actions {
            display: flex;
            gap: 12px;
        }

        .digital-agreements .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 0.95em;
        }

        .digital-agreements .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

       .digital-agreements .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
        }

      .digital-agreements  .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
        }

       .digital-agreements .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

       .digital-agreements .btn svg {
            width: 16px;
            height: 16px;
        }

       

       .digital-agreements .hero {
            text-align: center;
            margin-bottom: 60px;
            animation: fadeInDown 0.6s ease;
        }

       .digital-agreements .hero h1 {
            font-size: 3em;
            font-weight: 700;
            margin-bottom: 15px;
            background: linear-gradient(45deg, #a877ff, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Poppins';
        }

       .digital-agreements .hero-meta {
            color: #b8b8d4;
            font-size: 1em;
            margin-bottom: 30px;
        }

       .digital-agreements .hero-description {
            color: #e0e0e0;
            font-size: 1.1em;
            line-height: 1.8;
            max-width: 900px;
            margin: 0 auto 30px;
        }

       .digital-agreements .agreement-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: rgba(67, 233, 123, 0.2);
            border: 2px solid #43e97b;
            border-radius: 50px;
            color: #43e97b;
            font-weight: 600;
        }

       .digital-agreements .agreement-badge svg {
            width: 20px;
            height: 20px;
        }

       .digital-agreements .quick-summary {
                background: #16002dc7 !important;
             border: 2px solid rgb(102 126 234 / 10%);   
            border-radius: 15px;
            padding: 40px;
            margin-bottom: 40px;
            animation: fadeInUp 0.6s ease;
        }

       .digital-agreements .quick-summary h3 {
                font-size: 1.5em;
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                gap: 10px;
                font-family: 'Poppins';
                font-weight: 500;
                color: white;

        }

       .digital-agreements .quick-summary svg {
            width: 28px;
            height: 28px;
        }

      .digital-agreements  .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

      .digital-agreements  .summary-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

       .digital-agreements .summary-card h4 {
                color: #d2b8ff;
                margin-bottom: 10px;
                font-size: 1.1em;
                font-family: 'Poppins';
        }

       .digital-agreements .summary-card p {
            color: #e0e0e0;
            font-size: 0.95em;
            line-height: 1.6;
        }

      .digital-agreements  .sections-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 30px;
        }

      .digital-agreements  .section {
            background: #16002dc7 !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 40px;
            animation: fadeIn 0.8s ease;
            scroll-margin-top: 100px;
        }

       .digital-agreements .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgb(157 101 255 / 41%) !important;
        }

      .digital-agreements  .section-icon {
            width: 40px;
            height: 40px;
            padding: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

       .digital-agreements .section-icon svg {
            width: 20px;
            height: 20px;
        }

       .digital-agreements .section h2 {
            font-size: 1.6em;
            font-weight: 700;
            color: #fff;
            font-family: 'Poppins';
        }

      .digital-agreements  .section h3 {
            font-size: 1.2em;
            font-weight: 600;
            margin: 25px 0 15px;
            color: #bc95ff;
                font-family: 'Poppins';
        }

       .digital-agreements .section p {
            color: #e0e0e0;
            font-size: 1em;
            line-height: 1.8;
            margin-bottom: 20px;
        }

       .digital-agreements .section ul {
            list-style: none;
            margin: 20px 0;
        }

      .digital-agreements  .section ul li {
            color: #e0e0e0;
            font-size: 1em;
            line-height: 1.8;
            margin-bottom: 12px;
            padding-left: 30px;
            position: relative;
        }

       .digital-agreements .section ul li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 10px;
            width: 8px;
            height: 8px;
                background: linear-gradient(135deg, #b286ff, #b065f5) !important;
            border-radius: 50%;
        }

       .digital-agreements .highlight-box {
            background: rgba(102, 126, 234, 0.15);
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }

       .digital-agreements .highlight-box p {
            margin-bottom: 0;
            color: #e0e0e0;
        }

      .digital-agreements  .success-box {
            background: rgba(67, 233, 123, 0.15);
            border-left: 4px solid #43e97b;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }

       .digital-agreements .success-box p {
            margin-bottom: 0;
            color: #e0e0e0;
        }

     .digital-agreements  .warning-box {
            background: rgba(245, 87, 108, 0.15);
            border-left: 4px solid #f5576c;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }

      .digital-agreements  .warning-box p {
            margin-bottom: 0;
            color: #e0e0e0;
        }

       .digital-agreements .acceptance-section {
            background: #16002dc7 !important;
            border: 2px solid rgb(180 138 255) !important;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            margin-top: 50px;
            grid-column: 1 / -1;
        }

       .digital-agreements .acceptance-section h3 {
            font-size: 1.8em;
            margin-bottom: 15px;
                font-weight: 600;
            font-family: 'Poppins';
        }

      .digital-agreements  .acceptance-section p {
            font-size: 1.05em;
            color: #e0e0e0;
            margin-bottom: 30px;
            line-height: 1.8;
        }

      .digital-agreements  .checkbox-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 25px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

      .digital-agreements  .checkbox-wrapper:hover {
            background: rgba(255, 255, 255, 0.08);
        }

       .digital-agreements .checkbox-wrapper input[type="checkbox"] {
            width: 24px;
            height: 24px;
            cursor: pointer;
            accent-color: #667eea;
        }

       .digital-agreements .checkbox-wrapper label {
            font-size: 1.05em;
            color: #e0e0e0;
            cursor: pointer;
            user-select: none;
        }

      .digital-agreements  .accept-btn {
            padding: 18px 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 1.2em;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0.5;
            pointer-events: none;
        }

      .digital-agreements  .accept-btn.enabled {
            opacity: 1;
            pointer-events: all;
        }

      .digital-agreements  .accept-btn.enabled:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.5);
        }

      .digital-agreements  .footer {
            text-align: center;
            padding: 40px 20px;
            color: #8989ab;
            font-size: 0.95em;
        }

       .digital-agreements .footer a {
            color: #667eea;
            text-decoration: none;
        }

      .digital-agreements  .footer a:hover {
            text-decoration: underline;
        }

      .digital-agreements  .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 50%;
            color: #fff;
            cursor: pointer;
            display: none;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 100;
        }

      .digital-agreements  .scroll-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.5);
        }

      .digital-agreements  .scroll-top svg {
            width: 24px;
            height: 24px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
          .digital-agreements  .sections-grid {
                grid-template-columns: 1fr;
            }

           .digital-agreements .summary-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
           .digital-agreements .hero h1 {
                font-size: 2em;
            }

          .digital-agreements  .section {
                padding: 25px 20px;
            }

           .digital-agreements .section h2 {
                font-size: 1.3em;
            }

          .digital-agreements  .header-content {
                flex-direction: column;
                gap: 15px;
            }

          .digital-agreements  .header-actions {
                width: 100%;
            }

          .digital-agreements  .btn {
                flex: 1;
                justify-content: center;
            }

           .digital-agreements .scroll-top {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
            }
        }
    </style>

@endsection

@section('content')

 <section class="digital-agreements">
    

    <div class="container">
        <div class="hero">
            <h1>Digital Artist Agreement</h1>
            <div class="hero-meta">Effective Date: December 20, 2024 | Version 2.0</div>
            <p class="hero-description">
                Welcome to SingWithMe Records! This agreement outlines the terms of our partnership. We believe in transparency, fair compensation, and empowering artists to grow their careers.
            </p>
            <div class="agreement-badge">
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                </svg>
                Artist-Friendly Agreement
            </div>
        </div>

        <div class="quick-summary">
            <h3>
                <svg fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"/>
                </svg>
                Quick Summary
            </h3>
            <div class="summary-grid">
                <div class="summary-card">
                    <h4>You Keep Ownership</h4>
                    <p>You retain 100% ownership of your music. We only distribute it on your behalf.</p>
                </div>
                <div class="summary-card">
                    <h4>Fair Revenue Split</h4>
                    <p>You keep 85% of streaming revenue. We take 15% for platform services.</p>
                </div>
                <div class="summary-card">
                    <h4>Monthly Payments</h4>
                    <p>Royalties paid monthly, 45 days after the end of each month. Minimum £10 threshold.</p>
                </div>
                <div class="summary-card">
                    <h4>Cancel Anytime</h4>
                    <p>You can terminate this agreement anytime with 30 days' notice. No hidden fees.</p>
                </div>
            </div>
        </div>

        <div class="sections-grid">
            <div class="section">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"/>
                        </svg>
                    </div>
                    <h2>1. Artist Responsibilities</h2>
                </div>

                <p>As an artist on our platform, you agree to the following responsibilities to ensure a smooth and legal distribution process.</p>

                <h3>Content Ownership & Rights</h3>
                <ul>
                    <li>You confirm that you own or have obtained all necessary rights to the music you upload</li>
                    <li>You possess valid licenses for samples, beats, or any third-party content used in your recordings</li>
                    <li>You have permission from all featured artists, producers, and collaborators</li>
                    <li>You will not upload content that infringes on others' copyrights, trademarks, or intellectual property</li>
                </ul>

                <h3>Accurate Metadata</h3>
                <ul>
                    <li>Provide correct song titles, artist names, album information, and release dates</li>
                    <li>Ensure genre classifications and language tags are accurate</li>
                    <li>Upload high-quality artwork (minimum 3000x3000px) that complies with streaming platform guidelines</li>
                    <li>Update metadata promptly if any information changes</li>
                </ul>

                <div class="success-box">
                    <p><strong>Artist Benefit:</strong> Accurate metadata helps your music get discovered and ensures you receive proper credit and royalties from streaming platforms.</p>
                </div>

                <h3>Content Standards</h3>
                <ul>
                    <li>Comply with platform content guidelines (no hate speech, explicit violence, or illegal content)</li>
                    <li>Mark explicit content appropriately</li>
                    <li>Respect community standards and fellow artists</li>
                </ul>
            </div>

            <div class="section">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"/>
                        </svg>
                    </div>
                    <h2>2. Platform Rights</h2>
                </div>

                <p>By using SingWithMe Records, you grant us certain permissions to distribute and promote your music effectively.</p>

                <h3>Distribution License</h3>
                <ul>
                    <li>You grant us a non-exclusive, worldwide license to distribute your music to streaming platforms (Spotify, Apple Music, YouTube Music, etc.)</li>
                    <li>This license remains in effect for as long as your content is on our platform</li>
                    <li>You can revoke this license by removing your content or terminating your account</li>
                </ul>

                <h3>Promotional Rights</h3>
                <ul>
                    <li>We may feature your music in playlists, newsletters, and social media promotions</li>
                    <li>Use snippets of your music (up to 30 seconds) for platform marketing</li>
                    <li>Display your artist name, profile photo, and bio on our website and promotional materials</li>
                    <li>You can opt out of promotional features in your account settings</li>
                </ul>

                <div class="highlight-box">
                    <p><strong>Important:</strong> We will never use your music for commercial advertising or sell your content to third parties without your explicit written consent.</p>
                </div>

                <h3>Content Moderation</h3>
                <ul>
                    <li>We reserve the right to review uploaded content for compliance with our guidelines</li>
                    <li>Content violating copyright laws or community standards may be removed</li>
                    <li>We will notify you before removing content, except in cases of legal violations</li>
                    <li>You have the right to appeal moderation decisions</li>
                </ul>
            </div>

            <div class="section">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"/>
                        </svg>
                    </div>
                    <h2>3. Revenue & Royalties</h2>
                </div>

                <p>We believe artists should be fairly compensated for their work. Here's how revenue sharing works.</p>

                <h3>Revenue Split</h3>
                <ul>
                    <li><strong>Artist Share: 85%</strong> - You keep 85% of all streaming revenue generated by your music</li>
                    <li><strong>Platform Fee: 15%</strong> - We retain 15% to cover distribution costs, platform maintenance, and customer support</li>
                    <li>No hidden fees, setup costs, or annual charges</li>
                    <li>Tips and direct artist support: 95% to artist (5% transaction fee only)</li>
                </ul>

                <h3>Payment Timeline</h3>
                <ul>
                    <li>Royalties calculated monthly based on streaming platform reports</li>
                    <li>Payments processed 45 days after month-end (allows for streaming platform reporting delays)</li>
                    <li>Minimum payout threshold: £10 (lower balances roll over to next month)</li>
                    <li>Payment methods: Bank transfer, PayPal, or Wise</li>
                </ul>

                <div class="success-box">
                    <p><strong>Example:</strong> If your music earns £1,000 in January, you receive £850 (85%) by mid-March. We handle all platform reporting and payment collection for you.</p>
                </div>

                <h3>Transparency & Reporting</h3>
                <ul>
                    <li>Real-time analytics dashboard showing streams, revenue, and listener demographics</li>
                    <li>Detailed monthly reports breaking down earnings by platform and track</li>
                    <li>Export data anytime in CSV or PDF format</li>
                    <li>Access historical earnings data for tax purposes</li>
                </ul>

                <h3>Tax Information</h3>
                <ul>
                    <li>You are responsible for reporting and paying taxes on your earnings</li>
                    <li>We provide annual earnings statements for tax filing</li>
                    <li>For UK artists, we report earnings to HMRC as required by law</li>
                </ul>
            </div>

            <div class="section">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                        </svg>
                    </div>
                    <h2>4. Account Termination</h2>
                </div>

                <p>We respect your freedom to leave at any time. Here's what you need to know about account termination.</p>

                <h3>Voluntary Termination (By You)</h3>
                <ul>
                    <li>You may terminate this agreement at any time with 30 days' written notice</li>
                    <li>Submit termination request through your account settings or email support@singwithme.com</li>
                    <li>Your content will be removed from all streaming platforms within 30 days</li>
                    <li>You'll receive all outstanding royalties up to the termination date</li>
                    <li>No cancellation fees or penalties apply</li>
                </ul>

                <h3>Platform-Initiated Termination</h3>
                <p>We may suspend or terminate accounts under the following circumstances:</p>
                <ul>
                    <li><strong>Copyright Violations:</strong> Repeated uploads of content you don't own rights to</li>
                    <li><strong>Fraudulent Activity:</strong> Stream manipulation, fake plays, or payment fraud</li>
                    <li><strong>Content Violations:</strong> Uploading prohibited content (hate speech, illegal material)</li>
                    <li><strong>Terms Breach:</strong> Violating any terms of this agreement after written warning</li>
                </ul>

                <div class="warning-box">
                    <p><strong>Fair Process:</strong> Before terminating your account, we'll send a written warning with 14 days to address the issue, except in cases of severe legal violations.</p>
                </div>

                <h3>Post-Termination</h3>
                <ul>
                    <li>Content removed from all platforms within 30 days</li>
                    <li>Access to analytics and historical data for 90 days</li>
                    <li>Outstanding payments processed according to normal schedule</li>
                    <li>You retain all rights to your music - we have no claims after termination</li>
                    <li>You may re-join the platform in the future unless terminated for fraud</li>
                </ul>
            </div>

            <div class="section">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm11 1H6v8l4-2 4 2V6z"/>
                        </svg>
                    </div>
                    <h2>5. Legal Provisions</h2>
                </div>

                <p>These provisions protect both artists and the platform while maintaining fairness and transparency.</p>

                <h3>Limitation of Liability</h3>
                <ul>
                    <li>We are not liable for streaming platform payment delays or changes to their policies</li>
                    <li>Not responsible for loss of revenue due to platform outages, technical issues, or force majeure events</li>
                    <li>Maximum liability limited to royalties owed to you in the 12 months prior to any claim</li>
                    <li>We maintain reasonable security measures but cannot guarantee complete protection against data breaches</li>
                </ul>

                <div class="highlight-box">
                    <p><strong>Our Commitment:</strong> While we limit liability for circumstances beyond our control, we commit to transparent communication and prompt resolution of any issues affecting your earnings.</p>
                </div>

                <h3>Indemnification</h3>
                <ul>
                    <li>You agree to indemnify SingWithMe Records against claims arising from copyright infringement of your uploaded content</li>
                    <li>You're responsible for legal costs if your content violates third-party rights</li>
                    <li>We'll notify you immediately of any claims and give you opportunity to defend</li>
                    <li>This protects both parties from unauthorized content uploads</li>
                </ul>

                <h3>Dispute Resolution</h3>
                <ul>
                    <li>Contact our support team first for any issues - we resolve 95% of concerns directly</li>
                    <li>If unresolved, disputes may be submitted to mediation before legal action</li>
                    <li>Mediation costs shared equally between parties</li>
                    <li>You retain the right to pursue legal action if mediation fails</li>
                </ul>

                <h3>Governing Law</h3>
                <ul>
                    <li>This agreement is governed by the laws of England and Wales</li>
                    <li>Legal disputes subject to jurisdiction of UK courts</li>
                    <li>For international artists, local consumer protection laws may also apply</li>
                </ul>

                <h3>Agreement Updates</h3>
                <ul>
                    <li>We may update these terms to reflect platform changes, new features, or legal requirements</li>
                    <li>You'll receive 30 days' notice before any material changes take effect</li>
                    <li>Notice sent via email and in-platform notification</li>
                    <li>Continued use of the platform after changes constitutes acceptance</li>
                    <li>If you disagree with changes, you may terminate your account without penalty</li>
                </ul>

                <div class="success-box">
                    <p><strong>Version History:</strong> All previous agreement versions archived and accessible in your account settings. You can review what changed and when.</p>
                </div>

                <h3>Severability</h3>
                <p>If any provision of this agreement is found unenforceable, the remaining provisions remain in full effect. Unenforceable provisions will be modified to reflect the parties' intent as closely as possible.</p>

                <h3>Entire Agreement</h3>
                <p>This document constitutes the complete agreement between you and SingWithMe Records regarding music distribution services. It supersedes all prior discussions, negotiations, or agreements.</p>
            </div>

            <div class="section">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                    </div>
                    <h2>6. Support & Contact</h2>
                </div>

                <p>We're here to help you succeed. Our artist support team is committed to your growth.</p>

                <h3>How to Reach Us</h3>
                <ul>
                    <li><strong>Email:</strong> support@singwithme.com (response within 24 hours)</li>
                    <li><strong>Live Chat:</strong> Available in your dashboard Monday-Friday, 9am-6pm GMT</li>
                    <li><strong>Help Center:</strong> Comprehensive guides, FAQs, and tutorials at help.singwithme.com</li>
                    <li><strong>Community Forum:</strong> Connect with fellow artists, share tips, and get peer support</li>
                </ul>

                <h3>What We Can Help With</h3>
                <ul>
                    <li>Technical issues with uploads or account access</li>
                    <li>Questions about royalty payments or analytics</li>
                    <li>Metadata corrections and content updates</li>
                    <li>Distribution status and platform troubleshooting</li>
                    <li>General guidance on music distribution best practices</li>
                </ul>

                <div class="highlight-box">
                    <p><strong>Artist Success Team:</strong> Premium members get access to dedicated artist managers who provide personalized guidance on release strategies and promotional opportunities.</p>
                </div>
            </div>

            <div class="acceptance-section">
                <h3>Agreement Acceptance</h3>
                <p>
                    By checking the box below and clicking "I Accept", you confirm that you have read, understood, and agree to be bound by all terms and conditions outlined in this Digital Artist Agreement. You also confirm that you have the legal authority to enter into this agreement.
                </p>

                <div class="checkbox-wrapper" >
                    <input type="checkbox">
                    <label >I have read and agree to the Digital Artist Agreement</label>
                </div>

                <button class="accept-btn">
                    I Accept the Terms
                </button>

                <p style="margin-top: 20px; font-size: 0.9em; color: #b8b8d4;">
                    Last Updated: December 20, 2024 | Agreement Version 2.0
                </p>
            </div>
        </div>
    </div>
    </section>

@endsection

