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

    .legal-block ul,
    .legal-block ol {
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
            <h1>TERMS & CONDITIONS</h1>
            <p>SingWithMe Records Ltd</p>
            <p>Effective Date: 3/17/2026</p>
        </div>

        <div class="legal-block">
            <h2>1. Introduction</h2>
            <p>Welcome to SingWithMe Records Ltd ("Company", "we", "our", "us").</p>
            <p>SingWithMe Records Ltd is a digital platform designed to enable artists, songwriters, musicians, and creators to upload, share, and promote their music and related content globally.</p>
            <p>By accessing or using this platform, you agree to be legally bound by these Terms & Conditions. If you do not agree, you must not use the platform.</p>
        </div>

        <div class="legal-block">
            <h2>2. Eligibility</h2>
            <p>You must:</p>
            <ul>
                <li>Be at least 18 years old, or</li>
                <li>Have legal parental/guardian consent</li>
            </ul>
            <p>By using the platform, you confirm that:</p>
            <ul>
                <li>You have the legal capacity to enter into this agreement</li>
                <li>All information you provide is accurate and truthful</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>3. User Accounts</h2>
            <ul>
                <li>You are responsible for maintaining the confidentiality of your account</li>
                <li>You are responsible for all activity under your account</li>
                <li>You must not share or transfer your account</li>
                <li>We reserve the right to suspend or terminate accounts at our discretion</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>4. User Content</h2>
            <h3>4.1 Ownership</h3>
            <p>You retain full ownership of the content you upload, including:</p>
            <ul>
                <li>Music</li>
                <li>Audio recordings</li>
                <li>Videos</li>
                <li>Artwork</li>
                <li>Written material</li>
            </ul>
            <h3>4.2 License to Platform</h3>
            <p>By uploading content, you grant SingWithMe Records Ltd a non-exclusive, worldwide, royalty-free license to:</p>
            <ul>
                <li>Host</li>
                <li>Display</li>
                <li>Distribute</li>
                <li>Promote your content on the platform</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>5. AI-Generated Content Policy</h2>
            <p>SingWithMe Records Ltd is a platform created to support and promote original music by artists, songwriters, and creators worldwide.</p>
            <p>While the platform is primarily intended for original, human-created works, users are not prohibited from uploading music or content that has been generated or assisted by artificial intelligence ("AI Content").</p>
            <p>By uploading AI-generated or AI-assisted content, you agree that:</p>
            <ol>
                <li>No Royalties or Payments: The platform does not provide any royalties, earnings, or financial compensation for AI-generated content.</li>
                <li>Full User Responsibility: You are solely responsible for ownership, legality, copyright compliance, and third-party rights.</li>
                <li>Disclosure Requirement: You must not misrepresent AI-generated content as fully human-created where disclosure is required.</li>
                <li>Platform Discretion: AI content may receive limited visibility, reduced promotion, or different categorization.</li>
                <li>Right to Remove Content: We reserve the right to remove AI content that violates policies or creates legal risk.</li>
            </ol>
        </div>

        <div class="legal-block">
            <h2>6. Prohibited Content & Use</h2>
            <p>You agree NOT to upload or distribute content that:</p>
            <ul>
                <li>Infringes copyrights, trademarks, or IP rights</li>
                <li>Contains illegal, harmful, or abusive material</li>
                <li>Promotes violence, hate, or discrimination</li>
                <li>Includes misleading or fraudulent content</li>
                <li>Violates any applicable law or regulation</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>7. Copyright & Intellectual Property</h2>
            <ul>
                <li>You must own or have rights to all uploaded content</li>
                <li>You agree not to upload copyrighted material without permission</li>
                <li>We may remove content upon receiving valid infringement claims</li>
                <li>Repeat violations may result in account termination</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>8. Payments & Royalties</h2>
            <ul>
                <li>The platform does not guarantee earnings or royalties</li>
                <li>Monetization (if introduced) will be governed by separate agreements</li>
                <li>AI-generated content is explicitly excluded from any payouts</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>9. Content Moderation</h2>
            <p>We reserve the right to:</p>
            <ul>
                <li>Review, monitor, or remove content</li>
                <li>Suspend or terminate accounts</li>
                <li>Restrict access to features</li>
            </ul>
            <p>This may occur without prior notice if policies are violated.</p>
        </div>

        <div class="legal-block">
            <h2>10. Data Protection & Privacy</h2>
            <p>Your data is handled in accordance with our Privacy Policy.</p>
            <p>We implement reasonable measures to protect your data, but we cannot guarantee absolute security.</p>
        </div>

        <div class="legal-block">
            <h2>11. Third-Party Services</h2>
            <p>The platform may include links or integrations with third-party services.</p>
            <p>We are not responsible for:</p>
            <ul>
                <li>Their content</li>
                <li>Their policies</li>
                <li>Their practices</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>12. Limitation of Liability</h2>
            <p>To the fullest extent permitted by law:</p>
            <p>SingWithMe Records Ltd shall not be liable for:</p>
            <ul>
                <li>Loss of data</li>
                <li>Loss of revenue or profits</li>
                <li>Copyright disputes between users</li>
                <li>User-generated content</li>
            </ul>
            <p>Use of the platform is at your own risk.</p>
        </div>

        <div class="legal-block">
            <h2>13. Indemnification</h2>
            <p>You agree to indemnify and hold harmless SingWithMe Records Ltd from any claims, damages, or legal disputes arising from:</p>
            <ul>
                <li>Your content</li>
                <li>Your misuse of the platform</li>
                <li>Violation of these Terms</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>14. Termination</h2>
            <p>We may suspend or terminate your account:</p>
            <ul>
                <li>For violation of these Terms</li>
                <li>For legal or compliance reasons</li>
                <li>At our discretion</li>
            </ul>
            <p>You may stop using the platform at any time.</p>
        </div>

        <div class="legal-block">
            <h2>15. Changes to Terms</h2>
            <p>We reserve the right to update these Terms at any time.</p>
            <p>Continued use of the platform constitutes acceptance of updated Terms.</p>
        </div>

        <div class="legal-block">
            <h2>16. Governing Law</h2>
            <p>These Terms shall be governed by and interpreted in accordance with the laws of:</p>
            <p> United Kingdom</p>
        </div>

        <div class="legal-block">
            <h2>17. Contact Information</h2>
            <p>SingWithMe Records Ltd<br>info@singwithmerecords.co.uk<br></p>
        </div>

        <div class="legal-links">
            <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
            <a href="{{ route('legal-compliance-framework') }}">Legal & Compliance</a>
        </div>
    </div>
</section>
@endsection
