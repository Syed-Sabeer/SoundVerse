document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('fileInput');
        const uploadArea = document.getElementById('uploadArea');
        const previewGallery = document.getElementById('previewGallery');
        let uploadedFiles = [];

        // Check if elements exist before adding event listeners
        if (fileInput) {
            fileInput.addEventListener('change', handleFiles);
        }

        function handleFiles() {
            const files = Array.from(fileInput.files);
            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    addFileToGallery(file);
                }
            });
        }

        function addFileToGallery(file) {
            const fileId = Date.now() + Math.random();
            uploadedFiles.push({ file, id: fileId });
            
            const reader = new FileReader();
            reader.onload = (e) => {
                const previewItem = document.createElement('div');
                previewItem.className = 'preview-item';
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}" class="preview-image">
                    <button class="remove-btn" onclick="removeFile(${fileId})">×</button>
                `;
                
                previewGallery.appendChild(previewItem);
                previewGallery.style.display = 'grid';
                
                // Animate in
                setTimeout(() => {
                    previewItem.style.opacity = '1';
                    previewItem.style.transform = 'scale(1)';
                }, 100);
            };
            reader.readAsDataURL(file);
        }

        function removeFile(fileId) {
            uploadedFiles = uploadedFiles.filter(f => f.id !== fileId);
            const previewItems = previewGallery.children;
            
            for (let i = 0; i < previewItems.length; i++) {
                const removeBtn = previewItems[i].querySelector('.remove-btn');
                if (removeBtn && removeBtn.onclick.toString().includes(fileId)) {
                    previewItems[i].style.opacity = '0';
                    previewItems[i].style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        previewItems[i].remove();
                        if (previewGallery.children.length === 0) {
                            previewGallery.style.display = 'none';
                        }
                    }, 300);
                    break;
                }
            }
        }

        // Drag and drop functionality
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => {
                uploadArea.classList.add('drag-over');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => {
                uploadArea.classList.remove('drag-over');
            });
        });

        uploadArea.addEventListener('drop', (e) => {
            const files = Array.from(e.dataTransfer.files);
            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    addFileToGallery(file);
                }
            });
        });

        // Button ripple effect
        document.querySelector('.browse-btn').addEventListener('click', (e) => {
            const ripple = document.createElement('span');
            const rect = e.target.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.3)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            ripple.style.pointerEvents = 'none';
            
            e.target.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            .preview-item {
                opacity: 0;
                transform: scale(0.8);
                transition: all 0.3s ease;
            }
        `;
        document.head.appendChild(style);

        // Parallax effect for floating elements
        document.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            document.querySelectorAll('.floating-shape').forEach((shape, index) => {
                const speed = (index + 1) * 0.3;
                const x = (mouseX - 0.5) * speed * 30;
                const y = (mouseY - 0.5) * speed * 30;
                
                shape.style.transform = `translate(${x}px, ${y}px) rotate(${x * 0.5}deg)`;
            });
        });





        //popup js


        let selectedMethod = null;

        function openPopup() {
            document.getElementById('overlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePopup(event) {
            if (event && event.target !== document.getElementById('overlay')) return;
            document.getElementById('overlay').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function selectMethod(element) {
            // Remove selected class from all methods
            document.querySelectorAll('.payment-method').forEach(method => {
                method.classList.remove('selected');
            });
            
            // Add selected class to clicked method
            element.classList.add('selected');
            selectedMethod = element.querySelector('h3').textContent;
            
            // Enable confirm button
            document.querySelector('.btn-confirm').disabled = false;
        }

        function processWithdraw() {
            const amount = document.querySelector('.amount-input').value;
            
            if (!amount || !selectedMethod) {
                alert('Please enter an amount and select a payment method.');
                return;
            }

            if (parseFloat(amount) <= 0) {
                alert('Please enter a valid amount.');
                return;
            }

            // Simulate processing
            const confirmBtn = document.querySelector('.btn-confirm');
            confirmBtn.textContent = 'Processing...';
            confirmBtn.disabled = true;

            setTimeout(() => {
                alert(`Withdrawal of $${amount} to ${selectedMethod} has been initiated!`);
                closePopup();
                
                // Reset form
                document.querySelector('.amount-input').value = '';
                document.querySelectorAll('.payment-method').forEach(method => {
                    method.classList.remove('selected');
                });
                selectedMethod = null;
                confirmBtn.textContent = 'Confirm Withdrawal';
                confirmBtn.disabled = false;
            }, 2000);
        }

        // Close popup with Escape key - handled in global keydown listener
});