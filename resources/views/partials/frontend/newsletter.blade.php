 <!-- newsletter section -->

 <section class="news_letter py-5">
        <div class="container">
            <div class="section-header">
                <h1 class="section-title">Stay <span class="un_Span">Connected</span></h1>
                <p class="section-subtitle">Join our community and never miss an update. Get the latest news, exclusive
                    content, and special offers delivered straight to your inbox.</p>
            </div>

            <div class="newsletter_parent">
                <!-- Newsletter Section -->
                <div class="newsletter-section">
                    <h2 class="newsletter-title">
                        <div class="newsletter-icon">
                            <lord-icon
                                src="https://cdn.lordicon.com/xovdoewm.json"
                                trigger="loop"
                                delay="1500"
                                state="in-reveal"
                                colors="primary:#1b1091,secondary:#a866ee">
                            </lord-icon>
                    </div>
                        Newsletter
                    </h2>
                    <p class="newsletter-description">
                        Subscribe to our weekly newsletter and be the first to know about new features, industry
                        insights, and exclusive content tailored just for you.
                    </p>
                    <form class="newsletter-form" id="newsletterForm">
                        @csrf
                        <div class="input-group">
                            <input type="email" class="email-input" placeholder="Enter your email address" required
                                id="emailInput" name="email">
                            <button type="submit" class="subscribe-btn" id="subscribeBtn">
                                <span class="btn-text">Subscribe</span>
                                <span class="btn-loading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin"></i> Subscribing...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </section>

        <!-- newsletter section -->

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const newsletterForm = document.getElementById('newsletterForm');
            const emailInput = document.getElementById('emailInput');
            const subscribeBtn = document.getElementById('subscribeBtn');
            const btnText = subscribeBtn.querySelector('.btn-text');
            const btnLoading = subscribeBtn.querySelector('.btn-loading');

            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const email = emailInput.value.trim();
                
                if (!email) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Email Required',
                        text: 'Please enter your email address.',
                        confirmButtonColor: '#1b1091'
                    });
                    return;
                }

                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid Email',
                        text: 'Please enter a valid email address.',
                        confirmButtonColor: '#1b1091'
                    });
                    return;
                }

                // Show loading state
                btnText.style.display = 'none';
                btnLoading.style.display = 'inline';
                subscribeBtn.disabled = true;

                // Prepare form data
                const formData = new FormData();
                formData.append('email', email);
                formData.append('_token', document.querySelector('input[name="_token"]').value);

                // Send AJAX request
                fetch('{{ route("newsletter.subscribe") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button state
                    btnText.style.display = 'inline';
                    btnLoading.style.display = 'none';
                    subscribeBtn.disabled = false;

                    if (data.success) {
                        // Success notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully Subscribed!',
                            text: data.message,
                            confirmButtonColor: '#1b1091',
                            timer: 3000,
                            timerProgressBar: true
                        });
                        
                        // Clear form
                        emailInput.value = '';
                    } else {
                        // Error notification
                        Swal.fire({
                            icon: 'error',
                            title: 'Subscription Failed',
                            text: data.message,
                            confirmButtonColor: '#1b1091'
                        });
                    }
                })
                .catch(error => {
                    // Reset button state
                    btnText.style.display = 'inline';
                    btnLoading.style.display = 'none';
                    subscribeBtn.disabled = false;

                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Network Error',
                        text: 'Something went wrong. Please try again later.',
                        confirmButtonColor: '#1b1091'
                    });
                });
            });
        });
        </script>