 <section class="secContact py-5">
            <div class="container">
                <div class="contact-wrapper">
                    <!-- Right Column - Form -->
                    <div class="form-section">
                        <div class="form-header">
                            <h1>Contact Us</h1>
                            <p>Ready to take the next step? Fill out the form below and we'll get back to you within 24
                                hours.</p>
                        </div>

                        <form class="contact-form" id="contactForm" action="{{route('contact.store')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" id="firstName" name="firstname" placeholder="John">
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" id="lastName" name="lastname" required placeholder="Doe">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" name="email" required placeholder="john@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <select id="subject" name="subject" required>
                                        <option value="">Select a topic</option>
                                        <option value="general">General Inquiry</option>
                                        <option value="support">Technical Support</option>
                                        <option value="sales">Sales Question</option>
                                        <option value="partnership">Partnership</option>
                                        <option value="feedback">Feedback</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group full-width">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" required
                                    placeholder="Tell us about your project, question, or how we can help you..."></textarea>
                            </div>
                            <div class="form-group full-width">
                                <div class="g-recaptcha" data-sitekey="6LdJAowsAAAAALRqUSD-INpFqA1hzSMO2cqDHk2R"></div>
                            </div>
                            <button type="submit" class="submit-btn">Send Message</button>
                        </form>
                    </div>
                    <div class="form-Cta-unique">
                        <div class="forminer_CTA">
                            <a href="tel:+44(0)1234567890">+44 (0)123 456 7890</a>
                            <script src="https://cdn.lordicon.com/lordicon.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/nnzfcuqw.json" trigger="loop" delay="2000"
                                colors="primary:#6e2db9,secondary:#0a5c49">
                            </lord-icon>
                        </div>
                        <div class="forminner_Mailto">
                            <a href="mailto:support@singwithmerecords.com">support@singwithmerecords.com</a>
                            <lord-icon src="https://cdn.lordicon.com/vpbspaec.json" trigger="loop" delay="2000"
                                colors="primary:#ffffff,secondary:#0a5c49">
                            </lord-icon>
                        </div>
                    </div>
                </div>
            </div>

        </section>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
