    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Global Form Validation UX -->
    <script>
        function handleValidationErrors(form, errors) {
            $(form).find('.is-invalid').removeClass('is-invalid');
            $(form).find('.invalid-feedback').text('');
            
            Object.keys(errors).forEach(key => {
                const input = $(form).find(`[name="${key}"]`);
                if(input.length) {
                    input.addClass('is-invalid');
                    const feedback = input.siblings('.invalid-feedback');
                    if (feedback.length) {
                        feedback.text(errors[key][0]);
                    } else {
                        input.parent().append(`<div class="invalid-feedback d-block">${errors[key][0]}</div>`);
                    }
                }
            });
        }

        $(document).ready(function() {
            // Hapus class is-invalid dan teks error saat user mulai mengisi form
            $(document).on('input change', 'input.is-invalid, select.is-invalid, textarea.is-invalid', function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text('');
            });
        });
    </script>

    <!-- Page JS -->
    @stack('myscript')

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
