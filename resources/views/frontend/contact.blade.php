@extends('layouts.frontend.master')


@section('css')
<style>
/* Custom SweetAlert2 Styling */
.swal2-popup {
    font-family: inherit;
    border-radius: 15px;
}

.swal2-title {
    color: #333;
    font-weight: 600;
}

.swal2-content {
    color: #666;
    font-size: 16px;
    line-height: 1.5;
}

.swal2-confirm {
    border-radius: 25px !important;
    padding: 12px 30px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    transition: all 0.3s ease !important;
}

.swal2-confirm:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
}

/* Success modal styling */
.swal2-icon.swal2-success {
    border-color: #0a5c49 !important;
}

.swal2-icon.swal2-success [class^='swal2-success-line'] {
    background-color: #0a5c49 !important;
}

.swal2-icon.swal2-success .swal2-success-ring {
    border-color: #0a5c49 !important;
}

/* Error modal styling */
.swal2-icon.swal2-error {
    border-color: #dc3545 !important;
}

.swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
    background-color: #dc3545 !important;
}

/* Loading animation for submit button */
.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.inner-banner .h1-title {
    font-size: 48px;
}

/* Form validation styling */
.form-group.error input,
.form-group.error textarea,
.form-group.error select {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.form-group.error .error-message {
    color: #dc3545;
    font-size: 12px;
    margin-top: 5px;
    display: block;
}

/* Contact form specific styling */
.contact-form {
    position: relative;
}

.submit-btn {
    transition: all 0.3s ease;
}

.submit-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(10, 92, 73, 0.3);
}

/* Form group animations */
.form-group {
    transition: all 0.3s ease;
}

.form-group:focus-within {
    transform: scale(1.02);
}
</style>
@endsection

@section('content')


        <!-- Start of InnerBanner -->
        <section class="inner-banner contact-banner">
            <div class="contact_child">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="h1-title wow fadeup-animation" data-wow-duration="0.8s" data-wow-delay="0.2s">Get In Touch with SingWithMe Records Ltd</h1>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- End of InnerBanner -->


        @include('partials.frontend.contact')
        @include('partials.frontend.newsletter')


@endsection

@section('script')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Contact form submission with SweetAlert2
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading state
            const submitBtn = contactForm.querySelector('.submit-btn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Sending...';
            submitBtn.disabled = true;

            // Get form data
            const formData = new FormData(contactForm);

            // Make AJAX request
            fetch(contactForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                // Show SweetAlert2 based on response
                if (data.status === 'success') {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: data.icon,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#0a5c49',
                        timer: 5000,
                        timerProgressBar: true,
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    });

                    // Reset form on success
                    contactForm.reset();
                } else {
                    // Handle validation errors
                    let errorMessage = data.message;
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat().join('\n');
                        errorMessage = errorMessage + '\n\n' + errorList;
                    }

                    Swal.fire({
                        title: data.title,
                        text: errorMessage,
                        icon: data.icon,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#dc3545',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Network Error!',
                    text: 'Please check your internet connection and try again.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#dc3545',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    }
                });
            })
            .finally(() => {
                // Reset button state
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });
    }

    // Enhanced form interactions
    const inputs = contactForm.querySelectorAll('input, textarea, select');

    inputs.forEach(input => {
        // Add floating label effect
        input.addEventListener('focus', function () {
            this.parentElement.style.transform = 'scale(1.02)';
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function () {
            this.parentElement.style.transform = 'scale(1)';
            this.parentElement.classList.remove('focused');
        });

        // Add typing animation to submit button
        input.addEventListener('input', function () {
            const submitBtn = contactForm.querySelector('.submit-btn');
            submitBtn.style.transform = 'scale(1.02)';
            setTimeout(() => {
                submitBtn.style.transform = 'scale(1)';
            }, 100);
        });
    });

    // Form validation enhancement
    const requiredFields = contactForm.querySelectorAll('[required]');

    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.parentElement.classList.add('error');
                if (!this.parentElement.querySelector('.error-message')) {
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'error-message';
                    errorMsg.textContent = 'This field is required.';
                    this.parentElement.appendChild(errorMsg);
                }
            } else {
                this.parentElement.classList.remove('error');
                const errorMsg = this.parentElement.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.remove();
                }
            }
        });

        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.parentElement.classList.remove('error');
                const errorMsg = this.parentElement.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.remove();
                }
            }
        });
    });
});
</script>
@endsection
