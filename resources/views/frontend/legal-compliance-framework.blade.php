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
            <h1>LEGAL & COMPLIANCE FRAMEWORK</h1>
            <p><strong>SingWithMe Records Ltd</strong></p>
            <p>Effective Date: 17 March 2026</p>
        </div>

        <div class="doc-section">
            <h2>1. Regulatory Positioning</h2>
            <p>SingWithMe Records Ltd operates as a digital content hosting and distribution platform, not as:</p>
            <ul>
                <li>A record label (in legal liability terms)</li>
                <li>A publisher of user-generated content</li>
                <li>A copyright owner of uploaded works</li>
            </ul>
            <p>We act as an intermediary platform, enabling users to upload and share content.</p>
        </div>

        <div class="doc-section">
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

        <div class="doc-section">
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

        <div class="doc-section">
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

        <div class="doc-section">
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

        <div class="doc-section">
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

        <div class="doc-section">
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

        <div class="doc-section">
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

        <div class="doc-section">
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

        <div class="doc-section">
            <h2>10. Jurisdiction & Legal Enforcement</h2>
            <p>All disputes shall be governed under:</p>
            <p>United Kingdom</p>
            <p>Legal actions may be pursued in relevant courts under applicable law.</p>
        </div>

        <div class="doc-section">
            <h2>11. Compliance Updates</h2>
            <p>This framework may be updated to reflect:</p>
            <ul>
                <li>Legal changes</li>
                <li>Regulatory requirements</li>
                <li>Platform evolution</li>
            </ul>
            <p>Continued use of the platform indicates acceptance of updates.</p>
        </div>

        <div class="doc-section">
            <h2>12. Contact for Legal Matters</h2>
            <p>For legal inquiries, copyright claims, or compliance issues:</p>
            <p>SingWithMe Records Ltd<br>info@singwithmerecords.co.uk</p>
        </div>

        <div class="links">
            <a href="{{ route('terms-conditions') }}">Terms & Conditions</a>
            <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
        </div>
    </div>
</section>
@endsection
