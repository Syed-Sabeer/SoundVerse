@extends('layouts.frontend.master')

@section('css')
<style>
    .player-controls { display: none !important; }

    #legalDoc,
    #legalDoc * {
        box-sizing: border-box;
        visibility: visible !important;
        opacity: 1 !important;
        text-shadow: none !important;
    }

    #legalDoc {
        position: relative;
        z-index: 20;
        background: radial-gradient(circle at top right, rgba(133, 75, 222, 0.18), transparent 45%), #120826 !important;
        padding: 45px 0 70px;
    }

    #legalDoc .doc-wrap {
        max-width: 1080px;
        margin: 0 auto;
        padding: 0 16px;
    }

    #legalDoc .doc-header,
    #legalDoc .doc-section {
        background: #1b1033 !important;
        border: 1px solid rgba(170, 128, 241, 0.35) !important;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 12px;
    }

    #legalDoc .doc-header {
        border-left: 5px solid #8b5cf6 !important;
        margin-bottom: 15px;
    }

    #legalDoc h1,
    #legalDoc h2,
    #legalDoc h3,
    #legalDoc p,
    #legalDoc li,
    #legalDoc a,
    #legalDoc span,
    #legalDoc strong {
        font-family: Arial, sans-serif !important;
        color: #efe9ff !important;
    }

    #legalDoc h1 {
        margin: 0 0 8px;
        font-size: 30px !important;
        line-height: 1.25 !important;
        font-weight: 700 !important;
    }

    #legalDoc h2 {
        margin: 0 0 8px;
        font-size: 21px !important;
        line-height: 1.35 !important;
        font-weight: 700 !important;
    }

    #legalDoc h3 {
        margin: 12px 0 8px;
        font-size: 17px !important;
        line-height: 1.4 !important;
        font-weight: 700 !important;
        color: #cdb3ff !important;
    }

    #legalDoc p,
    #legalDoc li {
        margin: 0 0 9px;
        font-size: 16px !important;
        line-height: 1.85 !important;
    }

    #legalDoc ul,
    #legalDoc ol {
        margin: 0 0 10px;
        padding-left: 24px;
    }

    #legalDoc ul { list-style: disc !important; }
    #legalDoc ol { list-style: decimal !important; }
    #legalDoc li { display: list-item !important; }

    #legalDoc .links {
        margin-top: 16px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    #legalDoc .links a {
        text-decoration: none;
        background: #7c3aed !important;
        border: 1px solid #7c3aed !important;
        color: #ffffff !important;
        border-radius: 999px;
        padding: 9px 14px;
        font-size: 14px !important;
        font-weight: 700 !important;
    }

    #legalDoc .links a:hover {
        background: #9d6dff !important;
        border-color: #9d6dff !important;
    }

    @media (max-width: 768px) {
        #legalDoc h1 { font-size: 24px !important; }
        #legalDoc h2 { font-size: 19px !important; }
        #legalDoc p,
        #legalDoc li { font-size: 15px !important; }
    }
</style>
@endsection

@section('content')
<section id="legalDoc">
    <div class="doc-wrap">

        <div class="doc-header">
            <h1>TERMS & CONDITIONS</h1>
            <p><strong>SingWithMe Records Ltd</strong></p>
            <p>Effective Date: 17 March 2026</p>
        </div>

        <div class="doc-section">
            <h2>1. Introduction</h2>
            <p>Welcome to SingWithMe Records Ltd ("Company", "we", "our", "us").</p>
            <p>SingWithMe Records Ltd is a digital platform designed to enable artists, songwriters, musicians, and creators to upload, share, and promote their music and related content globally.</p>
            <p>By accessing or using this platform, you agree to be legally bound by these Terms & Conditions. If you do not agree, you must not use the platform.</p>
        </div>

        <div class="doc-section">
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

        <div class="doc-section">
            <h2>3. User Accounts</h2>
            <ul>
                <li>You are responsible for maintaining the confidentiality of your account</li>
                <li>You are responsible for all activity under your account</li>
                <li>You must not share or transfer your account</li>
                <li>We reserve the right to suspend or terminate accounts at our discretion</li>
            </ul>
        </div>

        <div class="doc-section">
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

        <div class="doc-section">
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

        <div class="doc-section">
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

        <div class="doc-section">
            <h2>7. Copyright & Intellectual Property</h2>
            <ul>
                <li>You must own or have rights to all uploaded content</li>
                <li>You agree not to upload copyrighted material without permission</li>
                <li>We may remove content upon receiving valid infringement claims</li>
                <li>Repeat violations may result in account termination</li>
            </ul>
        </div>

        <div class="doc-section">
            <h2>8. Payments & Royalties</h2>
            <ul>
                <li>The platform does not guarantee earnings or royalties</li>
                <li>Monetization (if introduced) will be governed by separate agreements</li>
                <li>AI-generated content is explicitly excluded from any payouts</li>
            </ul>
        </div>

        <div class="doc-section">
            <h2>9. Content Moderation</h2>
            <p>We reserve the right to:</p>
            <ul>
                <li>Review, monitor, or remove content</li>
                <li>Suspend or terminate accounts</li>
                <li>Restrict access to features</li>
            </ul>
            <p>This may occur without prior notice if policies are violated.</p>
        </div>

        <div class="doc-section">
            <h2>10. Data Protection & Privacy</h2>
            <p>Your data is handled in accordance with our Privacy Policy.</p>
            <p>We implement reasonable measures to protect your data, but we cannot guarantee absolute security.</p>
        </div>

        <div class="doc-section">
            <h2>11. Third-Party Services</h2>
            <p>The platform may include links or integrations with third-party services.</p>
            <p>We are not responsible for:</p>
            <ul>
                <li>Their content</li>
                <li>Their policies</li>
                <li>Their practices</li>
            </ul>
        </div>

        <div class="doc-section">
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

        <div class="doc-section">
            <h2>13. Indemnification</h2>
            <p>You agree to indemnify and hold harmless SingWithMe Records Ltd from any claims, damages, or legal disputes arising from:</p>
            <ul>
                <li>Your content</li>
                <li>Your misuse of the platform</li>
                <li>Violation of these Terms</li>
            </ul>
        </div>

        <div class="doc-section">
            <h2>14. Termination</h2>
            <p>We may suspend or terminate your account:</p>
            <ul>
                <li>For violation of these Terms</li>
                <li>For legal or compliance reasons</li>
                <li>At our discretion</li>
            </ul>
            <p>You may stop using the platform at any time.</p>
        </div>

        <div class="doc-section">
            <h2>15. Changes to Terms</h2>
            <p>We reserve the right to update these Terms at any time.</p>
            <p>Continued use of the platform constitutes acceptance of updated Terms.</p>
        </div>

        <div class="doc-section">
            <h2>16. Governing Law</h2>
            <p>These Terms shall be governed by and interpreted in accordance with the laws of the United Kingdom.</p>
        </div>

        <div class="doc-section">
            <h2>17. Contact Information</h2>
            <p>SingWithMe Records Ltd<br>info@singwithmerecords.co.uk</p>
        </div>

        <div class="links">
            <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
            <a href="{{ route('legal-compliance-framework') }}">Legal & Compliance</a>
        </div>

    </div>
</section>
@endsection
