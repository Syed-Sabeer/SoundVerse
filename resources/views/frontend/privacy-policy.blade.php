@extends('layouts.frontend.master')

@section('css')
    <style>
       .player-controls {
        display:none !Important;
       }
.privacy-policySec {
    position:relative;
}
        
.privacy-policySec .header-content {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.privacy-policySec .logo {
    font-size: 1.5em;
    font-weight: 700;
    background: linear-gradient(45deg, #f093fb, #f5576c);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.privacy-policySec .back-btn {
    padding: 10px 20px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.privacy-policySec .back-btn:hover {
    background: rgba(255, 255, 255, 0.15);
}

.privacy-policySec .back-btn svg {
    width: 16px;
    height: 16px;
}

.privacy-policySec .container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 60px 20px;
}

.privacy-policySec .hero {
    text-align: center;
    margin-bottom: 60px;
    animation: fadeInDown 0.6s ease;
}

.privacy-policySec .hero h1 {
    font-size: 3em;
    font-weight: 700;
    margin-bottom: 15px;
    background: linear-gradient(45deg, #a877ff, #ffffff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.privacy-policySec .hero-meta {
    color: #b8b8d4;
    font-size: 1em;
    margin-bottom: 30px;
}

.privacy-policySec .hero-description {
    color: #e0e0e0;
    font-size: 1.1em;
    line-height: 1.8;
    max-width: 900px;
    margin: 0 auto;
}

.privacy-policySec .table-of-contents {
    background: #16002dc7 !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 30px;
    margin-bottom: 40px;
    animation: fadeInUp 0.6s ease;
}

.privacy-policySec .toc-title {
    font-size: 1.3em;
    font-weight: 700;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.privacy-policySec .toc-title svg {
    width: 24px;
    height: 24px;
}

.privacy-policySec .toc-list {
    list-style: none;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.privacy-policySec .toc-list li {
    margin-bottom: 0;
}

.privacy-policySec .toc-list a {
    color: #b8b8d4;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 15px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.privacy-policySec .toc-list a:hover {
    color: #ffffff;
    background: rgb(101 55 183);
    border-color: #673AB7;
    transform: translateX(5px);
}

.privacy-policySec .toc-list a svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

.privacy-policySec .sections-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    margin-bottom: 30px;
}

.privacy-policySec .section {
    background: #16002dc7 !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 40px;
    animation: fadeIn 0.8s ease;
    scroll-margin-top: 100px;
    margin: 2rem 0;
}

.privacy-policySec .section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgb(157 101 255 / 41%) !important;

}

.privacy-policySec .section-icon {
    width: 32px;
    height: 32px;
    padding: 8px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.privacy-policySec .section-icon svg {
    width: 20px;
    height: 20px;
}

.privacy-policySec .section h2 {
    font-size: 1.5em;
    font-weight: 700;
    color: #fff;
    font-family: 'Poppins';
}

.privacy-policySec .section h3 {
    font-size: 1.2em;
    font-weight: 600;
    margin: 25px 0 15px;
    color: #bc95ff ;
    font-family: 'Poppins';
}

.privacy-policySec .section p {
    color: #e0e0e0;
    font-size: 1em;
    line-height: 1.8;
    margin-bottom: 20px;
}

.privacy-policySec .section ul {
    list-style: none;
    margin: 20px 0;
}

.privacy-policySec .section ul li {
    color: #e0e0e0;
    font-size: 1em;
    line-height: 1.8;
    margin-bottom: 12px;
    padding-left: 30px;
    position: relative;
}

.privacy-policySec .section ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10px;
    width: 8px;
    height: 8px;
    background: linear-gradient(135deg, #b286ff, #b065f5) !important;
    border-radius: 50%;
}

.privacy-policySec .highlight-box,
.privacy-policySec .warning-box,
.privacy-policySec .info-box {
    padding: 20px;
    border-radius: 8px;
    margin: 25px 0;
}

.privacy-policySec .highlight-box {
    background: rgba(102, 126, 234, 0.1);
    border-left: 4px solid #667eea;
}

.privacy-policySec .warning-box {
    background: rgba(245, 87, 108, 0.1);
    border-left: 4px solid #f5576c;
}

.privacy-policySec .info-box {
    background: rgba(67, 233, 123, 0.1);
    border-left: 4px solid #43e97b;
}

.privacy-policySec .contact-section {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.2), rgba(118, 75, 162, 0.2));
    border: 2px solid rgba(102, 126, 234, 0.3);
    border-radius: 15px;
    padding: 40px;
    text-align: center;
    margin-top: 50px;
    grid-column: 1 / -1;
}
.privacy-policySec .contact-section h3 {
        font-family: 'Poppins';
        font-weight: 500;
        color: white;
}
.privacy-policySec .contact-email {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 30px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 10px;
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1em;
    margin-top: 1rem;
}

.privacy-policySec .footer {
    text-align: center;
    padding: 40px 20px;
    color: #8989ab;
}

.privacy-policySec .scroll-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    color: #fff;
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 100;
}

/* MEDIA QUERIES */

@media (max-width: 1024px) {
    .privacy-policySec .sections-grid {
        grid-template-columns: 1fr;
    }
    .privacy-policySec .toc-list {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .privacy-policySec .hero h1 {
        font-size: 2em;
    }
    .privacy-policySec .section {
        padding: 25px 20px;
    }
    .privacy-policySec .section h2 {
        font-size: 1.3em;
    }
    .privacy-policySec .header-content {
        flex-direction: column;
        gap: 15px;
    }
    .privacy-policySec .scroll-top {
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
    }
}
@media (max-width: 476px) { 
    .privacy-policySec .contact-email {
            padding: 15px 12px;
        word-break: break-word;
        font-size: 13px;
    }
    .contact-section svg {
        width: 50px;
    }
}
    </style>
@endsection

@section('content')

    <section class="privacy-policySec">
        <div class="container">
            <div class="hero">
                <h1>Privacy Policy</h1>
                <div class="hero-meta">Last Updated: December 20, 2024</div>
                <p class="hero-description">
                    At SingWithMe Records, we take your privacy seriously. This policy explains how we collect, use, protect, and share your personal information when you use our music distribution platform.
                </p>
            </div>

            <div class="table-of-contents">
                <div class="toc-title">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"/>
                    </svg>
                    Table of Contents
                </div>
                <ul class="toc-list">
                    <li>
                        <a href="#section1">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                            </svg>
                            Information We Collect
                        </a>
                    </li>
                    <li>
                        <a href="#section2">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                            </svg>
                            How We Use Your Information
                        </a>
                    </li>
                    <li>
                        <a href="#section3">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                            </svg>
                            Cookies & Tracking Technologies
                        </a>
                    </li>
                    <li>
                        <a href="#section4">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                            </svg>
                            Data Sharing & Third Parties
                        </a>
                    </li>
                    <li>
                        <a href="#section5">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                            </svg>
                            Data Security & Protection
                        </a>
                    </li>
                    <li>
                        <a href="#section6">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                            </svg>
                            Your Rights & Controls
                        </a>
                    </li>
                    <li>
                        <a href="#section7">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                            </svg>
                            International Data Transfers
                        </a>
                    </li>
                    <li>
                        <a href="#section8">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                            </svg>
                            Children's Privacy
                        </a>
                    </li>
                </ul>
            </div>

            <div class="section" id="section1">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"/>
                        </svg>
                    </div>
                    <h2>1. Information We Collect</h2>
                </div>

                <p>We collect different types of information to provide you with the best possible service and ensure the security of your account.</p>

                <h3>Information You Provide Directly</h3>
                <ul>
                    <li><strong>Account Information:</strong> Name, email address, username, password, profile photo, and artist bio</li>
                    <li><strong>Artist Profile Data:</strong> Stage name, genre, social media links, biography, and promotional materials</li>
                    <li><strong>Payment Information:</strong> Bank account details, PayPal email, tax identification numbers (processed securely through our payment partners)</li>
                    <li><strong>Music Content:</strong> Audio files, artwork, metadata (song titles, album names, release dates), and lyrics</li>
                    <li><strong>Communication Data:</strong> Messages sent through our support system, feedback, and survey responses</li>
                </ul>

                <h3>Information Collected Automatically</h3>
                <ul>
                    <li><strong>Usage Data:</strong> Pages visited, features used, time spent on platform, and interaction patterns</li>
                    <li><strong>Device Information:</strong> IP address, browser type, operating system, device identifiers, and screen resolution</li>
                    <li><strong>Location Data:</strong> General geographic location based on IP address (country and city level)</li>
                    <li><strong>Performance Analytics:</strong> Stream counts, listener demographics, engagement metrics, and revenue data</li>
                </ul>

                <div class="info-box">
                    <p><strong>Note:</strong> We never collect sensitive personal data such as race, ethnicity, political opinions, or health information unless explicitly required by law for tax or regulatory purposes.</p>
                </div>
            </div>

            <div class="section" id="section2">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"/>
                        </svg>
                    </div>
                    <h2>2. How We Use Your Information</h2>
                </div>

                <p>We use your personal information for the following purposes, always in accordance with applicable data protection laws:</p>

                <h3>Service Delivery & Account Management</h3>
                <ul>
                    <li>Creating and maintaining your user account</li>
                    <li>Processing and distributing your music to streaming platforms (Spotify, Apple Music, YouTube Music, etc.)</li>
                    <li>Calculating and processing royalty payments</li>
                    <li>Providing customer support and responding to your inquiries</li>
                    <li>Sending important service updates, security alerts, and account notifications</li>
                </ul>

                <h3>Analytics & Performance Tracking</h3>
                <ul>
                    <li>Generating analytics reports on stream counts, listener demographics, and revenue</li>
                    <li>Identifying trending content and providing performance insights</li>
                    <li>Improving our recommendation algorithms and platform features</li>
                    <li>Conducting research to understand user behavior and preferences</li>
                </ul>

                <h3>Marketing & Communication</h3>
                <ul>
                    <li>Sending promotional emails about new features, services, or opportunities (with your consent)</li>
                    <li>Sharing industry news, tips, and best practices for artists</li>
                    <li>Conducting surveys to gather feedback and improve our services</li>
                </ul>

                <div class="highlight-box">
                    <p><strong>Legal Basis (GDPR Compliance):</strong> We process your data based on: (1) Performance of our contract with you, (2) Your explicit consent, (3) Our legitimate business interests, and (4) Compliance with legal obligations.</p>
                </div>
            </div>

            <div class="section" id="section3">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/>
                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"/>
                        </svg>
                    </div>
                    <h2>3. Cookies & Tracking Technologies</h2>
                </div>

                <p>We use cookies and similar tracking technologies to enhance your experience, analyze usage patterns, and provide personalized content.</p>

                <h3>Types of Cookies We Use</h3>
                <ul>
                    <li><strong>Essential Cookies:</strong> Required for the platform to function properly (login sessions, security features)</li>
                    <li><strong>Analytics Cookies:</strong> Help us understand how users interact with our platform (Google Analytics, Mixpanel)</li>
                    <li><strong>Preference Cookies:</strong> Remember your settings and preferences (language, theme, display options)</li>
                    <li><strong>Marketing Cookies:</strong> Track advertising campaign effectiveness and deliver relevant ads (with your consent)</li>
                </ul>

                <h3>Third-Party Cookies</h3>
                <p>Some third-party services we integrate may set their own cookies:</p>
                <ul>
                    <li>Payment processors (Stripe, PayPal)</li>
                    <li>Analytics providers (Google Analytics)</li>
                    <li>Social media platforms (when you share content)</li>
                </ul>

                <div class="info-box">
                    <p><strong>Cookie Control:</strong> You can manage cookie preferences in your browser settings or through our cookie consent banner. Blocking certain cookies may affect platform functionality.</p>
                </div>
            </div>

            <div class="section" id="section4">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                        </svg>
                    </div>
                    <h2>4. Data Sharing & Third Parties</h2>
                </div>

                <p>We share your data with trusted third parties only when necessary to provide our services. We never sell your personal information to advertisers or data brokers.</p>

                <h3>Streaming Platforms</h3>
                <p>We share your music and associated metadata with streaming services to distribute your content:</p>
                <ul>
                    <li>Spotify, Apple Music, YouTube Music, Amazon Music, Deezer, Tidal</li>
                    <li>TikTok, Instagram, Facebook (for music library integration)</li>
                </ul>
                <p>These platforms have their own privacy policies governing how they handle your music and listener data.</p>

                <h3>Payment Processors</h3>
                <ul>
                    <li><strong>Stripe:</strong> Processes credit/debit card payments and bank transfers</li>
                    <li><strong>PayPal:</strong> Handles PayPal account withdrawals</li>
                    <li><strong>Wise (TransferWise):</strong> Facilitates international payments</li>
                </ul>
                <p>We do not store your complete payment card details. Payment processors handle this data securely under PCI-DSS compliance standards.</p>

                <h3>Service Providers & Partners</h3>
                <ul>
                    <li><strong>Cloud Storage:</strong> Amazon Web Services (AWS) for secure file storage</li>
                    <li><strong>Email Services:</strong> SendGrid, Mailchimp for transactional and marketing emails</li>
                    <li><strong>Analytics:</strong> Google Analytics, Mixpanel for usage tracking</li>
                    <li><strong>Customer Support:</strong> Zendesk, Intercom for support ticket management</li>
                </ul>

                <div class="warning-box">
                    <p><strong>Important:</strong> All third-party service providers are contractually obligated to protect your data and use it only for the purposes we specify. We conduct due diligence to ensure they meet high security and privacy standards.</p>
                </div>
            </div>

            <div class="section" id="section5">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                    </div>
                    <h2>5. Data Security & Protection</h2>
                </div>

                <p>We implement industry-standard security measures to protect your personal and financial information from unauthorized access, disclosure, alteration, or destruction.</p>

                <h3>Technical Security Measures</h3>
                <ul>
                    <li><strong>Encryption:</strong> All data transmitted between your device and our servers is encrypted using TLS 1.3 (HTTPS)</li>
                    <li><strong>Data Storage:</strong> Personal data is encrypted at rest using AES-256 encryption</li>
                    <li><strong>Secure Authentication:</strong> Passwords are hashed using bcrypt with strong salt values</li>
                    <li><strong>Two-Factor Authentication (2FA):</strong> Optional 2FA available for enhanced account security</li>
                    <li><strong>Access Controls:</strong> Role-based access restrictions limit employee access to sensitive data</li>
                </ul>

                <h3>Operational Security</h3>
                <ul>
                    <li>Regular security audits and vulnerability assessments</li>
                    <li>Employee training on data protection and security best practices</li>
                    <li>Incident response procedures for potential data breaches</li>
                    <li>Regular backups with secure, encrypted storage</li>
                    <li>Network monitoring and intrusion detection systems</li>
                </ul>

                <h3>Payment Security</h3>
                <ul>
                    <li>PCI-DSS Level 1 compliant payment processing</li>
                    <li>Tokenization of payment card data (we never store full card numbers)</li>
                    <li>Secure payment gateway integration with Stripe and PayPal</li>
                </ul>

                <div class="warning-box">
                    <p><strong>Data Breach Notification:</strong> In the unlikely event of a data breach affecting your personal information, we will notify you within 72 hours as required by GDPR and other applicable regulations.</p>
                </div>
            </div>

            <div class="section" id="section6">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                        </svg>
                    </div>
                    <h2>6. Your Rights & Controls</h2>
                </div>

                <p>You have significant control over your personal data. We respect your rights and provide tools to exercise them easily.</p>

                <h3>Your Data Rights (GDPR & CCPA Compliant)</h3>
                <ul>
                    <li><strong>Right to Access:</strong> Request a copy of all personal data we hold about you</li>
                    <li><strong>Right to Rectification:</strong> Correct inaccurate or incomplete information in your profile</li>
                    <li><strong>Right to Erasure ("Right to be Forgotten"):</strong> Request deletion of your account and associated data</li>
                    <li><strong>Right to Data Portability:</strong> Download your data in a machine-readable format (JSON, CSV)</li>
                    <li><strong>Right to Restrict Processing:</strong> Limit how we process your data under certain circumstances</li>
                    <li><strong>Right to Object:</strong> Opt out of marketing communications and certain data processing activities</li>
                    <li><strong>Right to Withdraw Consent:</strong> Revoke previously given consent at any time</li>
                </ul>

                <h3>How to Exercise Your Rights</h3>
                <ul>
                    <li><strong>Account Settings:</strong> Access your dashboard to update profile information, change privacy settings, and manage preferences</li>
                    <li><strong>Data Export:</strong> Use the "Download My Data" feature in Account Settings to receive a complete copy of your information</li>
                    <li><strong>Email Preferences:</strong> Unsubscribe from marketing emails using the link in any promotional message</li>
                    <li><strong>Account Deletion:</strong> Request account deletion through Settings > Privacy > Delete Account</li>
                    <li><strong>Contact Us:</strong> Email privacy@singwithmerecords.com for any data-related requests</li>
                </ul>

                <div class="highlight-box">
                    <p><strong>Response Time:</strong> We aim to respond to all data requests within 30 days. For complex requests, we may extend this period by an additional 60 days with notification.</p>
                </div>

                <h3>Marketing Preferences</h3>
                <p>You can control marketing communications at any time:</p>
                <ul>
                    <li>Unsubscribe from promotional emails via the link at the bottom of each email</li>
                    <li>Manage email preferences in Account Settings > Notifications</li>
                    <li>Opt out of SMS notifications through your account dashboard</li>
                </ul>
            </div>

            <div class="section" id="section7">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z"/>
                        </svg>
                    </div>
                    <h2>7. International Data Transfers</h2>
                </div>

                <p>SingWithMe Records operates globally, and your data may be transferred to and processed in countries outside your residence.</p>

                <h3>Data Transfer Mechanisms</h3>
                <ul>
                    <li><strong>EU-US Data Privacy Framework:</strong> We comply with the EU-US and Swiss-US Data Privacy Framework principles</li>
                    <li><strong>Standard Contractual Clauses (SCCs):</strong> We use EU-approved SCCs when transferring data to countries without adequacy decisions</li>
                    <li><strong>Adequate Safeguards:</strong> All international transfers include appropriate technical and organizational security measures</li>
                </ul>

                <h3>Data Storage Locations</h3>
                <p>Your data may be stored and processed in the following regions:</p>
                <ul>
                    <li>European Union (primary data center: Frankfurt, Germany)</li>
                    <li>United Kingdom (London data center)</li>
                    <li>United States (AWS cloud infrastructure)</li>
                    <li>Canada (backup and redundancy systems)</li>
                </ul>

                <div class="info-box">
                    <p><strong>EEA Residents:</strong> If you reside in the European Economic Area, we ensure that any data transferred outside the EEA receives an equivalent level of protection as required by GDPR.</p>
                </div>
            </div>

            <div class="section" id="section8">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                        </svg>
                    </div>
                    <h2>8. Children's Privacy</h2>
                </div>

                <p>SingWithMe Records is not intended for use by children under the age of 16. We do not knowingly collect personal information from children.</p>

                <ul>
                    <li>Users must be at least 16 years old to create an account</li>
                    <li>We do not knowingly solicit or collect data from anyone under 16</li>
                    <li>If we discover we have collected data from a child under 16, we will delete it immediately</li>
                    <li>Parents or guardians who believe we may have collected information from a child should contact us at privacy@singwithmerecords.com</li>
                </ul>

                <div class="warning-box">
                    <p><strong>Age Verification:</strong> By creating an account, you confirm that you are at least 16 years old (or the age of majority in your jurisdiction, whichever is higher).</p>
                </div>
            </div>

            <div class="section">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                        </svg>
                    </div>
                    <h2>9. Data Retention</h2>
                </div>

                <p>We retain your personal data only for as long as necessary to fulfill the purposes outlined in this policy or as required by law.</p>

                <h3>Retention Periods</h3>
                <ul>
                    <li><strong>Active Accounts:</strong> Data retained as long as your account is active</li>
                    <li><strong>Deleted Accounts:</strong> Most data deleted within 30 days; some data retained for legal compliance (tax records: 7 years)</li>
                    <li><strong>Analytics Data:</strong> Aggregated, anonymized data may be retained indefinitely for research purposes</li>
                    <li><strong>Transaction Records:</strong> Financial records retained for 7 years to comply with tax and accounting regulations</li>
                    <li><strong>Support Communications:</strong> Retained for 3 years to maintain service quality and resolve disputes</li>
                </ul>
            </div>

            <div class="section">
                <div class="section-header">
                    <div class="section-icon">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
                        </svg>
                    </div>
                    <h2>10. Changes to This Policy</h2>
                </div>

                <p>We may update this Privacy Policy from time to time to reflect changes in our practices, technology, legal requirements, or other factors.</p>

                <ul>
                    <li>We will notify you of material changes via email or through a prominent notice on our platform</li>
                    <li>The "Last Updated" date at the top of this policy indicates when it was last revised</li>
                    <li>Continued use of our services after changes constitute acceptance of the updated policy</li>
                    <li>Previous versions of this policy are available upon request</li>
                </ul>
            </div>

            <div class="contact-section">
                <h3>Questions or Concerns?</h3>
                <p>If you have any questions about this Privacy Policy or how we handle your data, we're here to help.</p>
                <a href="mailto:privacy@singwithmerecords.com" class="contact-email">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                    </svg>
                    privacy@singwithmerecords.com
                </a>
                <p style="margin-top: 20px; font-size: 0.95em;">
                    <strong>Data Protection Officer:</strong><br>
                    SingWithMe Records Ltd.<br>
                    123 Music Street, London, UK<br>
                    Phone: +44 20 1234 5678
                </p>
            </div>
        </div>
    </section>

@endsection

