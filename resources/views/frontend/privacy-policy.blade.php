@extends('layouts.frontend.master')

@section('css')
<style>
    .player-controls { display: none !important; }

    .legal-page {
        background: radial-gradient(circle at top right, rgba(151, 71, 255, 0.15), transparent 40%),
                    radial-gradient(circle at bottom left, rgba(44, 17, 92, 0.55), transparent 45%),
                    #0f0822;
        color: #f3efff;
        padding: 72px 0;
    }

    .legal-page .container {
        max-width: 1140px;
    }

    .legal-hero {
        background: linear-gradient(135deg, rgba(132, 73, 255, 0.23), rgba(42, 17, 86, 0.92));
        border: 1px solid rgba(187, 146, 255, 0.25);
        border-radius: 18px;
        padding: 32px 28px;
        margin-bottom: 24px;
    }

    .legal-hero h1 {
        font-size: 2rem;
        color: #fff;
        margin-bottom: 6px;
    }

    .legal-hero p {
        margin: 0;
        color: #d8cbff;
        font-size: 0.96rem;
    }

    .legal-block {
        background: rgba(23, 8, 52, 0.88);
        border: 1px solid rgba(187, 146, 255, 0.18);
        border-radius: 16px;
        padding: 22px 24px;
        margin-bottom: 16px;
    }

    .legal-block h2 {
        font-size: 1.2rem;
        color: #fff;
        margin-bottom: 12px;
        font-weight: 700;
    }

    .legal-block h3 {
        font-size: 1rem;
        color: #d9c2ff;
        margin-top: 14px;
        margin-bottom: 10px;
    }

    .legal-block p,
    .legal-block li {
        color: #ddd2fb;
        line-height: 1.75;
        font-size: 0.97rem;
    }

    .legal-block ul {
        margin: 0;
        padding-left: 18px;
    }

    .legal-links {
        margin-top: 24px;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .legal-links a {
        background: rgba(122, 70, 206, 0.3);
        border: 1px solid rgba(187, 146, 255, 0.3);
        color: #efddff;
        border-radius: 999px;
        padding: 8px 14px;
        font-size: 0.9rem;
        text-decoration: none;
    }

    @media (max-width: 991px) {
        .legal-page { padding: 46px 0; }
        .legal-hero h1 { font-size: 1.5rem; }
    }
</style>
@endsection

@section('content')
<section class="legal-page">
    <div class="container">
        <div class="legal-hero">
            <h1>PRIVACY POLICY</h1>
            <p>SingWithMe Records Ltd</p>
            <p>Effective Date: 3/17/2026</p>
        </div>

        <div class="legal-block">
            <h2>1. Introduction</h2>
            <p>SingWithMe Records Ltd ("Company", "we", "our", "us") respects your privacy and is committed to protecting your personal data.</p>
            <p>This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our platform, including any related services, content, or features.</p>
            <p>By using the platform, you agree to the collection and use of information in accordance with this policy.</p>
        </div>

        <div class="legal-block">
            <h2>2. Scope of This Policy</h2>
            <p>This policy applies to:</p>
            <ul>
                <li>Website visitors</li>
                <li>Registered users (artists, creators, listeners)</li>
                <li>Anyone interacting with our platform</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>3. Information We Collect</h2>
            <h3>3.1 Personal Information</h3>
            <p>We may collect:</p>
            <ul>
                <li>Full name</li>
                <li>Email address</li>
                <li>Username / profile details</li>
                <li>Contact information</li>
                <li>Payment details (if applicable in future)</li>
            </ul>
            <h3>3.2 Content Data</h3>
            <ul>
                <li>Music uploads</li>
                <li>Audio/video files</li>
                <li>Images and artwork</li>
                <li>Metadata (titles, descriptions, tags)</li>
            </ul>
            <h3>3.3 Technical Data</h3>
            <ul>
                <li>IP address</li>
                <li>Browser type</li>
                <li>Device information</li>
                <li>Operating system</li>
                <li>Usage behavior (pages visited, interactions)</li>
            </ul>
            <h3>3.4 Cookies & Tracking Technologies</h3>
            <p>We use cookies and similar technologies to:</p>
            <ul>
                <li>Improve user experience</li>
                <li>Analyze traffic and performance</li>
                <li>Personalize content</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>4. How We Use Your Information</h2>
            <p>We use your data to:</p>
            <ul>
                <li>Provide and maintain the platform</li>
                <li>Enable content uploads and sharing</li>
                <li>Manage user accounts</li>
                <li>Improve platform performance and features</li>
                <li>Communicate updates, notifications, and support</li>
                <li>Ensure compliance with legal obligations</li>
                <li>Detect fraud, abuse, or security threats</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>5. Legal Basis for Processing (GDPR Compliance)</h2>
            <p>We process your data based on:</p>
            <ul>
                <li>Consent (when you sign up or agree to cookies)</li>
                <li>Contractual necessity (to provide platform services)</li>
                <li>Legal obligations</li>
                <li>Legitimate interests (platform improvement, security)</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>6. AI-Generated Content & Data Handling</h2>
            <p>If you upload AI-generated or AI-assisted content:</p>
            <ul>
                <li>We do not claim ownership of such content</li>
                <li>You remain fully responsible for legality and rights</li>
                <li>We may process associated metadata and files for platform display, moderation, and compliance checks</li>
            </ul>
            <p>We do not use your content to train AI systems unless explicitly disclosed and consented to.</p>
        </div>

        <div class="legal-block">
            <h2>7. Data Sharing & Disclosure</h2>
            <p>We do not sell your personal data.</p>
            <p>We may share your data with:</p>
            <h3>7.1 Service Providers</h3>
            <ul>
                <li>Hosting providers</li>
                <li>Analytics tools</li>
                <li>Payment processors (if applicable)</li>
            </ul>
            <h3>7.2 Legal Authorities</h3>
            <p>If required by law, regulation, or legal request</p>
            <h3>7.3 Business Transfers</h3>
            <p>In case of merger, acquisition, or asset sale</p>
        </div>

        <div class="legal-block">
            <h2>8. International Data Transfers</h2>
            <p>Your data may be transferred and processed outside your country.</p>
            <p>We ensure appropriate safeguards, including:</p>
            <ul>
                <li>Standard Contractual Clauses (SCCs)</li>
                <li>GDPR-compliant transfer mechanisms</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>9. Data Retention</h2>
            <p>We retain your data only as long as necessary:</p>
            <ul>
                <li>While your account is active</li>
                <li>To comply with legal obligations</li>
                <li>To resolve disputes</li>
            </ul>
            <p>You may request deletion of your data at any time.</p>
        </div>

        <div class="legal-block">
            <h2>10. Your Rights (GDPR & Global Rights)</h2>
            <p>You have the right to:</p>
            <ul>
                <li>Access your personal data</li>
                <li>Correct inaccurate data</li>
                <li>Request deletion ("Right to be forgotten")</li>
                <li>Restrict processing</li>
                <li>Object to data processing</li>
                <li>Data portability</li>
                <li>Withdraw consent at any time</li>
            </ul>
            <p>To exercise your rights, contact us at:<br>info@singwithmerecords.co.uk</p>
        </div>

        <div class="legal-block">
            <h2>11. Data Security</h2>
            <p>We implement industry-standard measures to protect your data, including:</p>
            <ul>
                <li>Secure servers</li>
                <li>Encryption protocols</li>
                <li>Access controls</li>
            </ul>
            <p>However, no system is 100% secure.</p>
        </div>

        <div class="legal-block">
            <h2>12. Children’s Privacy</h2>
            <p>Our platform is not intended for users under 13.</p>
            <p>We do not knowingly collect data from children without parental consent.</p>
        </div>

        <div class="legal-block">
            <h2>13. Third-Party Links</h2>
            <p>Our platform may contain links to third-party websites.</p>
            <p>We are not responsible for their privacy practices or content.</p>
        </div>

        <div class="legal-block">
            <h2>14. Cookies Policy</h2>
            <p>We use cookies for:</p>
            <ul>
                <li>Essential functionality</li>
                <li>Analytics</li>
                <li>Performance tracking</li>
            </ul>
            <p>Users may control cookies through browser settings.</p>
        </div>

        <div class="legal-block">
            <h2>15. Changes to This Privacy Policy</h2>
            <p>We may update this policy periodically.</p>
            <p>Changes will be posted on this page with an updated effective date.</p>
        </div>

        <div class="legal-block">
            <h2>16. Contact Information</h2>
            <p>SingWithMe Records Ltd<br>info@singwithmerecords.co.uk<br></p>
        </div>

        <div class="legal-links">
            <a href="{{ route('terms-conditions') }}">Terms & Conditions</a>
            <a href="{{ route('legal-compliance-framework') }}">Legal & Compliance</a>
        </div>
    </div>
</section>
@endsection
