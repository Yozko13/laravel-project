/*! Image Uploader - v1.2.3 - 26/11/2019
 * Copyright (c) 2019 Christian Bayer; Licensed MIT */

(function ($) {

    $.fn.appleImageUploader = function (options) {

        // Default settings
        let defaults = {
            preloaded: [],
            imagesInputName: 'images',
            preloadedInputName: 'preloaded',
            label: 'Drag & Drop files here or click to browse',
            maxSizeLabel: 'Максималния разрешен брой за качване на снимки е ',
            extensions: ['.jpg', '.jpeg', '.png', '.gif', '.svg'],
            mimes: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'],
            maxSize: undefined,
            maxFiles: undefined,
        };

        // Get instance
        let plugin = this;

        // The file input
        let $input;

        // Set empty settings
        plugin.settings = {};

        // Plugin constructor
        plugin.init = function () {

            // Define settings
            plugin.settings = $.extend(plugin.settings, defaults, options);

            // Run through the elements
            plugin.each(function (i, wrapper) {

                // Create the container
                let $container = createContainer();

                // Append the container to the wrapper
                $(wrapper).append($container);

                // Set some bindings
                $container.on("dragover", fileDragHover.bind($container));
                $container.on("dragleave", fileDragHover.bind($container));
                $container.on("drop", fileSelectHandler.bind($container));

                // If there are preloaded images
                if (plugin.settings.preloaded.length) {

                    // Change style
                    $container.addClass('has-files');

                    // Get the upload images container
                    let $uploadedContainer = $container.find('.uploaded');

                    // Set preloaded images preview
                    for (let i = 0; i < plugin.settings.preloaded.length; i++) {
                        $uploadedContainer.append(createImg(plugin.settings.preloaded[i].src, plugin.settings.preloaded[i].id, true));
                    }
                }
            });
        };

        let createContainer = function () {

            // Create the image uploader container
            let $container = $('<div>', {class: 'image-uploader'});

            // Create the input type file and append it to the container
            $input = $('<input>', {
                type: 'file',
                id: plugin.settings.imagesInputName + '-' + random(),
                name: plugin.settings.imagesInputName + '[]',
                accept: plugin.settings.extensions.join(','),
                multiple: ''
            }).appendTo($container);

            // Create the uploaded images container and append it to the container
            let $uploadedContainer = $('<div>', {class: 'uploaded'}).appendTo($container),

                // Create the text container and append it to the container
                $textContainer = $('<div>', {
                    class: 'upload-text'
                }).appendTo($container),

                // Create the icon and append it to the text container
                $i = $('<i>', {class: 'iui-cloud-upload'}).appendTo($textContainer),

                // Create the text and append it to the text container
                $span = $('<span>', {text: plugin.settings.label}).appendTo($textContainer);


            // Listen to container click and trigger input file click
            $container.on('click', function (e) {
                // Prevent browser default event and stop propagation
                prevent(e);

                // Trigger input click
                $input.trigger('click');
            });

            // Stop propagation on input click
            $input.on("click", function (e) {
                e.stopPropagation();
            });

            // Listen to input files changed
            $input.on('change', fileSelectHandler.bind($container));

            return $container;
        };


        let prevent = function (e) {
            // Prevent browser default event and stop propagation
            e.preventDefault();
            e.stopPropagation();
        };

        let createImg = function (src, id, preloaded) {

            // Create the upladed image container
            let $container = $('<div>', {class: 'uploaded-image'}),

                // Create the img tag
                $img = $('<img>', {src: src}).appendTo($container);

            // If the image is preloaded
            if (preloaded) {

                // Set a identifier
                $container.attr('data-preloaded', true);

                // Create the preloaded input and append it to the container
                let $preloaded = $('<input>', {
                    type: 'hidden',
                    name: plugin.settings.preloadedInputName + '[]',
                    value: id
                }).appendTo($container)

            } else {

                // Set the index
                $container.attr('data-index', id);
            }

            // Stop propagation on click
            $container.on("click", function (e) {
                // Prevent browser default event and stop propagation
                prevent(e);
            });

            return $container;
        };

        let fileDragHover = function (e) {

            // Prevent browser default event and stop propagation
            prevent(e);

            // Change the container style
            if (e.type === "dragover") {
                $(this).addClass('drag-over');
            } else {
                $(this).removeClass('drag-over');
            }
        };

        let fileSelectHandler = function (e) {

            // Prevent browser default event and stop propagation
            prevent(e);

            // Get the jQuery element instance
            let $container = $(this);

            // Get the files as an array of files
            // let files = Array.from(e.target.files || e.originalEvent.dataTransfer.files);
            let files = Array.from(e.target.files);

            if(files.length > plugin.settings.maxFiles) {
                alert(plugin.settings.maxSizeLabel + plugin.settings.maxFiles);

                clearData($container);
                $input.val('');

                return false;
            }

            // Will keep only the valid files
            let validFiles = [];

            // Run through the files
            $(files).each(function (i, file) {
                // Run the validations
                if (plugin.settings.extensions && !validateExtension(file)) {
                    return;
                }
                if (plugin.settings.mimes && !validateMIME(file)) {
                    return;
                }
                if (plugin.settings.maxSize && !validateMaxSize(file)) {
                    return;
                }
                if (plugin.settings.maxFiles && !validateMaxFiles(validFiles.length, file)) {
                    return;
                }
                validFiles.push(file);
            });

            if($container.find('.uploaded').children().length > 0) {
                clearData($container);
            }

            // If there is at least one valid file
            if (validFiles.length) {

                // Change the container style
                $container.removeClass('drag-over');

                // Makes the upload
                setPreview($container, validFiles);

                if($container.hasClass('has-files')) {
                    let $button = $container.find('button.delete-image');

                    if($container.find('button.delete-image').length > 0) {
                        $container.find('button.delete-image').fadeIn();
                    } else {
                        // Create the delete button
                        $button = $('<button>', {class: 'delete-image'}).appendTo($container);

                        // Create the delete icon
                        $i = $('<i>', {class: 'iui-close'}).appendTo($button);
                    }

                    // Set delete action
                    $button.on("click", function (e) {

                        // Prevent browser default event and stop propagation
                        prevent(e);

                        clearData($container);
                        $input.val('');
                    });
                }
            } else {

                // Update input files (it is now empty due to a default browser action)
                // $input.prop('files', dataTransfer.files);
            }
        };

        function clearData($container) {
            $container.find('.uploaded').children().remove();
            $container.removeClass('has-files');
            $container.find('button.delete-image').hide();
        }

        let validateExtension = function (file) {

            if (plugin.settings.extensions.indexOf(file.name.replace(new RegExp('^.*\\.'), '.')) < 0) {
                alert(`The file "${file.name}" does not match with the accepted file extensions: "${plugin.settings.extensions.join('", "')}"`);

                return false;
            }

            return true;
        };

        let validateMIME = function (file) {

            if (plugin.settings.mimes.indexOf(file.type) < 0) {
                alert(`The file "${file.name}" does not match with the accepted mime types: "${plugin.settings.mimes.join('", "')}"`);

                return false;
            }

            return true;
        };

        let validateMaxSize = function (file) {

            if (file.size > plugin.settings.maxSize) {
                alert(`The file "${file.name}" exceeds the maximum size of ${plugin.settings.maxSize / 1024 / 1024}Mb`);

                return false;
            }

            return true;

        };

        let validateMaxFiles = function (index, file) {

            // if ((index + dataTransfer.items.length + plugin.settings.preloaded.length) >= plugin.settings.maxFiles) {
            if (index >= plugin.settings.maxFiles) {
                alert(`The file "${file.name}" could not be added because the limit of ${plugin.settings.maxFiles} files was reached`);

                return false;
            }

            return true;

        };

        let setPreview = function ($container, files) {

            // Add the 'has-files' class
            $container.addClass('has-files');

            // Get the upload images container
            let $uploadedContainer = $container.find('.uploaded'),

                // Get the files input
                $input = $container.find('input[type="file"]');

            // Run through the files
            $(files).each(function (i, file) {

                // Add it to data transfer

                // Set preview
                $uploadedContainer.append(createImg(URL.createObjectURL(file), $input[0].files.length - 1), false);

            });

            // Update input files
            $input.prop('files', $input[0].files);
        };

        // Generate a random id
        let random = function () {
            return Date.now() + Math.floor((Math.random() * 100) + 1);
        };

        this.init();

        // Return the instance
        return this;
    };

}(jQuery));