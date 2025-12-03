  <script>
        // Modal
        const openBtn = document.getElementById('openLoginModal');
        const closeBtn = document.getElementById('closeLoginModal');
        const modal = document.getElementById('loginModal');

        openBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        closeBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });

        // Slider
        const slider = document.getElementById('sliderContainer');
        const dots = document.querySelectorAll('.dot');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');

        let currentIndex = 0;
        const totalSlides = dots.length;

        function updateIndicator(index) {
            dots.forEach(dot => dot.classList.remove('active'));
            dots[index].classList.add('active');
        }

        nextBtn.addEventListener('click', () => {
            if (currentIndex < totalSlides - 1) {
                currentIndex++;
                slider.scrollBy({ left: slider.clientWidth / 1.5, behavior: 'smooth' });
                updateIndicator(currentIndex);
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                slider.scrollBy({ left: -slider.clientWidth / 1.5, behavior: 'smooth' });
                updateIndicator(currentIndex);
            }
        });

        updateIndicator(currentIndex);

        // SweetAlert
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2500
            });
        @endif
    </script>