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
            <h1>LEGAL & COMPLIANCE FRAMEWORK</h1>
            <p>SingWithMe Records Ltd</p>
            <p>Effective Date: 3/17/2026</p>
        </div>

        <div class="legal-block">
            <h2>1. Regulatory Positioning</h2>
            <p>SingWithMe Records Ltd operates as a digital content hosting and distribution platform, not as:</p>
            <ul>
                <li>A record label (in legal liability terms)</li>
                <li>A publisher of user-generated content</li>
                <li>A copyright owner of uploaded works</li>
            </ul>
            <p>We act as an intermediary platform, enabling users to upload and share content.</p>
        </div>

        <div class="legal-block">
            <h2>2. Compliance Standards</h2>
            <p>The platform is designed to align with:</p>
            <ul>
                <li>GDPR (General Data Protection Regulation, EU/UK)</li>
                <li>UK Data Protection Act 2018</li>
                <li>Digital Services Act (DSA, EU, where applicable)</li>
                <li>Copyright, Designs and Patents Act 1988 (UK)</li>
                <li>DMCA Principles (Global copyright handling standard)</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>3. User-Generated Content Responsibility</h2>
            <p>All content uploaded to the platform is:</p>
            <ul>
                <li>Provided by users</li>
                <li>Not pre-approved or verified by the platform</li>
                <li>The sole responsibility of the uploading user</li>
            </ul>
            <p>Users confirm that:</p>
            <ul>
                <li>They own or have rights to the content</li>
                <li>The content does not infringe any third-party rights</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>4. Copyright Compliance & Takedown Procedure</h2>
            <h3>4.1 Reporting Infringement</h3>
            <p>If you believe your copyright has been infringed, you may submit a notice including:</p>
            <ul>
                <li>Your full name and contact details</li>
                <li>Description of the copyrighted work</li>
                <li>URL/location of infringing content</li>
                <li>Proof of ownership</li>
                <li>A good faith statement</li>
                <li>A declaration of accuracy</li>
            </ul>
            <h3>4.2 Takedown Process</h3>
            <p>Upon receiving a valid complaint:</p>
            <ul>
                <li>Content may be temporarily removed or restricted</li>
                <li>The uploader may be notified</li>
                <li>Investigation will be conducted</li>
            </ul>
            <h3>4.3 Repeat Infringers</h3>
            <p>Accounts that repeatedly violate copyright may be:</p>
            <ul>
                <li>Suspended</li>
                <li>Permanently terminated</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>5. AI Content Legal Position</h2>
            <p>SingWithMe Records Ltd acknowledges the evolving nature of AI-generated content.</p>
            <h3>Platform Position:</h3>
            <ul>
                <li>AI-generated content is permitted but not endorsed as core content</li>
                <li>The platform does not assume liability for AI-generated works</li>
            </ul>
            <h3>User Obligations:</h3>
            <p>Users uploading AI content must ensure:</p>
            <ul>
                <li>No copyright infringement</li>
                <li>No unauthorized voice/style replication</li>
                <li>No violation of personality or publicity rights</li>
            </ul>
            <h3>Financial Position:</h3>
            <ul>
                <li>AI-generated content is not eligible for royalties or payouts</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>6. Content Moderation & Platform Governance</h2>
            <p>We maintain the right to:</p>
            <ul>
                <li>Remove or restrict content</li>
                <li>Suspend or terminate accounts</li>
                <li>Limit visibility or distribution</li>
            </ul>
            <p>This may occur:</p>
            <ul>
                <li>Without prior notice</li>
                <li>In cases of legal risk, policy violations, or abuse</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>7. Data Protection Compliance</h2>
            <p>We implement:</p>
            <ul>
                <li>Secure data processing practices</li>
                <li>GDPR-aligned data handling</li>
                <li>Controlled access systems</li>
            </ul>
            <p>User data is:</p>
            <ul>
                <li>Not sold</li>
                <li>Only shared when legally required or operationally necessary</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>8. Platform Liability Limitation</h2>
            <p>SingWithMe Records Ltd is not liable for:</p>
            <ul>
                <li>User-uploaded content</li>
                <li>Copyright disputes between users</li>
                <li>Financial losses related to platform use</li>
                <li>Unauthorized use of content by third parties</li>
            </ul>
            <p>We function as a neutral hosting platform.</p>
        </div>

        <div class="legal-block">
            <h2>9. Abuse, Misuse & Enforcement</h2>
            <p>We actively monitor for:</p>
            <ul>
                <li>Fraudulent activity</li>
                <li>Copyright abuse</li>
                <li>Platform manipulation</li>
                <li>Harmful or illegal content</li>
            </ul>
            <p>Violations may result in:</p>
            <ul>
                <li>Immediate content removal</li>
                <li>Account suspension</li>
                <li>Legal reporting (if required)</li>
            </ul>
        </div>

        <div class="legal-block">
            <h2>10. Jurisdiction & Legal Enforcement</h2>
            <p>All disputes shall be governed under:</p>
            <p>United Kingdom</p>
            <p>Legal actions may be pursued in relevant courts under applicable law.</p>
        </div>

        <div class="legal-block">
            <h2>11. Compliance Updates</h2>
            <p>This framework may be updated to reflect:</p>
            <ul>
                <li>Legal changes</li>
                <li>Regulatory requirements</li>
                <li>Platform evolution</li>
            </ul>
            <p>Continued use of the platform indicates acceptance of updates.</p>
        </div>

        <div class="legal-block">
            <h2>12. Contact for Legal Matters</h2>
            <p>For legal inquiries, copyright claims, or compliance issues:</p>
            <p>SingWithMe Records Ltd<br>info@singwithmerecords.co.uk<br></p>
        </div>

        <div class="legal-links">
            <a href="{{ route('terms-conditions') }}">Terms & Conditions</a>
            <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
        </div>
    </div>
</section>
@endsection
