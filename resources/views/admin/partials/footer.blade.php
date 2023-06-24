        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
        <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('admin/js/misc.js') }}"></script>
        <script src="{{ asset('admin/js/settings.js') }}"></script>
        <script src="{{ asset('admin/js/todolist.js') }}"></script>
        <!-- endinject -->
        <script src="{{ asset('admin/js/file-upload.js') }}"></script>
        <script src="{{ asset('js/image-uploader.min.js') }}"></script>
        <script>
            $(function () {
                if ($('.upload-images').length > 0) {
                    let preloaded = [];

                    @isset($product, $old_images)
                        preloaded = {!! json_encode($old_images) !!};
                    @endisset

                    $('.upload-images').imageUploader({
                        preloaded: preloaded,
                        imagesInputName: 'images',
                        preloadedInputName: 'old_images',
                        maxSize: 2 * 1024 * 1024,
                        maxFiles: 10,
                        extensions: ['.jpg', '.jpeg', '.png'],
                        mimes: ['image/jpeg', 'image/png']
                    });
                }
            });
        </script>
    </body>
</html>
