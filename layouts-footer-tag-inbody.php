<!-- SwiperJS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js?ver=<?= $rand ?>"></script>

<!-- Alpine.js -->
<script src="https://unpkg.com/alpinejs@3.13.7/dist/cdn.min.js" defer></script>

<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    $(function() {
        AOS.init({
            offset: 100,
            duration: 1000, // ระยะเวลา animation เป็นมิลลิวินาที (ms) เช่น 1000 = 1 วินาที
            once: true, // เล่นแค่ครั้งเดียวตอนเลื่อนมาเห็น
        });
    });

    // scrollToTop
    $(window).on('scroll', function() {
        if (window.scrollY > window.outerHeight) {
            $('#scrollToTop').removeClass('hidden');
        } else {
            $('#scrollToTop').addClass('hidden');
        }
    });
    $('#scrollToTop').on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, '500');
    });
</script>

<!-- Main Script -->
<script src="assets/js/main.js?ver=<?= $rand ?>"></script>