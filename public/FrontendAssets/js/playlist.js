//  (function() {
//       // scope to the playlist section so no globals are created
//       const section = document.querySelector('.playlistSection');
//       if (!section) return;

//       const overlay = section.querySelector('.overlay');
//       const openBtn = section.querySelector('.create-btn');
//       const closeBtn = section.querySelector('.close-btn');
//       const form = section.querySelector('form.playlistForm');
//       const coverUpload = section.querySelector('input.coverUpload');
//       const coverUploadSection = section.querySelector('.cover-upload-section');
//       const coverPreviewDiv = section.querySelector('.cover-preview-placeholder') || section.querySelector('.upload-placeholder');
//       const selectedCountEl = section.querySelector('.selected-count');
//       const privacyOptions = section.querySelectorAll('.privacy-option');
//       const songItems = section.querySelectorAll('.song-item');
//       const submitBtn = form.querySelector('.btn-primary');
//       const cancelBtn = form.querySelector('.btn-secondary');

//       // local-scoped state (won't pollute global scope)
//       let ps_selectedPrivacy = 'public';
//       let ps_selectedSongs = new Set();

//       // Open popup
//       openBtn.addEventListener('click', () => {
//         overlay.classList.add('active');
//         document.body.style.overflow = 'hidden';
//       });

//       // Close popup when clicking overlay (outside the popup)
//       overlay.addEventListener('click', (e) => {
//         if (e.target === overlay) closePopup();
//       });

//       // Close button
//       closeBtn.addEventListener('click', closePopup);

//       // Cancel action (reset & close)
//       cancelBtn.addEventListener('click', () => {
//         form.reset();
//         coverPreviewDiv.innerHTML = '🎵';
//         privacyOptions.forEach((opt) => opt.classList.toggle('selected', opt.dataset.privacy === 'public'));
//         songItems.forEach(i => i.classList.remove('selected'));
//         ps_selectedSongs.clear();
//         updateSelectedCount();
//         ps_selectedPrivacy = 'public';
//         closePopup();
//       });

//       // Escape key closes popup when active
//       document.addEventListener('keydown', (e) => {
//         if (e.key === 'Escape' && overlay.classList.contains('active')) closePopup();
//       });

//       function closePopup() {
//         overlay.classList.remove('active');
//         document.body.style.overflow = '';
//       }

//       // Cover upload triggers
//       coverUploadSection.addEventListener('click', () => coverUpload.click());
//       coverUpload.addEventListener('change', function() {
//         const file = this.files && this.files[0];
//         if (!file) return;
//         const reader = new FileReader();
//         reader.onload = function(evt) {
//           coverPreviewDiv.innerHTML = `<img src="${evt.target.result}" alt="Cover Preview" class="cover-preview">`;
//         };
//         reader.readAsDataURL(file);
//       });

//       // Privacy options (use data-privacy attribute set in HTML)
//       privacyOptions.forEach(option => {
//         option.addEventListener('click', () => {
//           privacyOptions.forEach(opt => opt.classList.remove('selected'));
//           option.classList.add('selected');
//           ps_selectedPrivacy = option.dataset.privacy || 'public';
//         });
//       });

//       // Song toggles
//       songItems.forEach(item => {
//         item.addEventListener('click', () => {
//           const titleEl = item.querySelector('h4');
//           const title = titleEl ? titleEl.textContent.trim() : null;
//           if (!title) return;

//           if (item.classList.contains('selected')) {
//             item.classList.remove('selected');
//             ps_selectedSongs.delete(title);
//           } else {
//             item.classList.add('selected');
//             ps_selectedSongs.add(title);
//           }
//           updateSelectedCount();
//         });
//       });

//       function updateSelectedCount() {
//         const count = ps_selectedSongs.size;
//         if (!selectedCountEl) return;
//         if (count > 0) {
//           selectedCountEl.textContent = `${count} selected`;
//           selectedCountEl.style.display = 'inline-block';
//         } else {
//           selectedCountEl.style.display = 'none';
//         }
//       }

//       // Form submission (scoped)
//       form.addEventListener('submit', function(e) {
//         e.preventDefault();
//         const playlistTitle = form.querySelector('input[type="text"]').value || '';
//         if (!playlistTitle.trim()) {
//           alert('Please enter a playlist name');
//           return;
//         }

//         submitBtn.textContent = 'Creating...';
//         submitBtn.disabled = true;

//         // simulate async save
//         setTimeout(() => {
//           alert(`Playlist "${playlistTitle}" created!\nPrivacy: ${ps_selectedPrivacy}\nSongs added: ${ps_selectedSongs.size}`);

//           // Reset UI
//           form.reset();
//           coverPreviewDiv.innerHTML = '🎵';
//           privacyOptions.forEach(opt => opt.classList.toggle('selected', opt.dataset.privacy === 'public'));
//           songItems.forEach(item => item.classList.remove('selected'));
//           ps_selectedSongs.clear();
//           updateSelectedCount();
//           ps_selectedPrivacy = 'public';

//           submitBtn.textContent = 'Create Playlist';
//           submitBtn.disabled = false;
//           closePopup();
//         }, 900);
//       });
//     })();