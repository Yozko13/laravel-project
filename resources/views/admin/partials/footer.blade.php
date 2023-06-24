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
                    let preloaded = [
                        // {id: 1, src: 'https://picsum.photos/500/500?random=1'},
                        // {id: 2, src: 'https://picsum.photos/500/500?random=2'},
                        // {id: 3, src: 'https://picsum.photos/500/500?random=3'},
                        // {id: 4, src: 'https://picsum.photos/500/500?random=4'},
                        // {id: 5, src: 'https://picsum.photos/500/500?random=5'},
                        // {id: 6, src: 'https://picsum.photos/500/500?random=6'},
                    ];

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
