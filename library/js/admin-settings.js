'use strict';

(function() {
    if (typeof window.wp === 'undefined' || !window.wp.media) {
        return;
    }

    document.addEventListener('DOMContentLoaded', function() {
        var sliderFields = document.querySelectorAll('[data-slider-field]');
        sliderFields.forEach(function(field) {
            initSliderField(field);
        });

        var imageFields = document.querySelectorAll('[data-image-field]');
        imageFields.forEach(function(field) {
            initImageField(field);
        });
    });

    function initSliderField(field) {
        var selectButton = field.querySelector('[data-slider-select]');
        var clearButton = field.querySelector('[data-slider-clear]');
        var list = field.querySelector('[data-slider-list]');
        var input = field.querySelector('[data-slider-input]');
        var emptyState = field.querySelector('[data-slider-empty]');
        var mediaTitle = field.getAttribute('data-media-title') || 'Selecionar imagens';
        var mediaButton = field.getAttribute('data-media-button') || 'Adicionar';
        var removeLabel = field.getAttribute('data-remove-label') || 'Remover';
        var mediaFrame = null;
        var dragItem = null;

        var updateInput = function() {
            var ids = Array.from(list.querySelectorAll('[data-id]')).map(function(item) {
                return item.getAttribute('data-id');
            });
            input.value = ids.join(',');
            toggleEmptyState();
        };

        var toggleEmptyState = function() {
            if (!emptyState) {
                return;
            }
            emptyState.hidden = list.querySelectorAll('[data-id]').length > 0;
        };

        var createItem = function(attachment) {
            if (!attachment || !attachment.id) {
                return;
            }

            var existingItem = list.querySelector('[data-id="' + attachment.id + '"]');
            if (existingItem) {
                return;
            }

            var previewUrl = '';
            if (attachment.sizes && attachment.sizes.thumbnail) {
                previewUrl = attachment.sizes.thumbnail.url;
            } else {
                previewUrl = attachment.url;
            }

            var item = document.createElement('li');
            item.className = 'camara-slider-item';
            item.setAttribute('data-id', attachment.id);
            item.setAttribute('draggable', 'true');
            item.innerHTML = '' +
                '<span class="camara-slider-item__preview">' +
                '<img src="' + previewUrl + '" alt="">' +
                '</span>' +
                '<button type="button" class="button-link camara-slider-item__remove" aria-label="' + removeLabel + '">&times;</button>';

            list.appendChild(item);
        };

        var openMedia = function() {
            if (!mediaFrame) {
                mediaFrame = window.wp.media({
                    title: mediaTitle,
                    button: { text: mediaButton },
                    multiple: true
                });

                mediaFrame.on('select', function() {
                    var selection = mediaFrame.state().get('selection');
                    selection.each(function(attachment) {
                        createItem(attachment.toJSON());
                    });
                    updateInput();
                });
            }

            mediaFrame.open();
        };

        if (selectButton) {
            selectButton.addEventListener('click', function(event) {
                event.preventDefault();
                openMedia();
            });
        }

        if (clearButton) {
            clearButton.addEventListener('click', function(event) {
                event.preventDefault();
                list.innerHTML = '';
                updateInput();
            });
        }

        list.addEventListener('click', function(event) {
            var removeBtn = event.target.closest('.camara-slider-item__remove');
            if (removeBtn) {
                event.preventDefault();
                var item = removeBtn.closest('.camara-slider-item');
                if (item) {
                    item.remove();
                    updateInput();
                }
            }
        });

        list.addEventListener('dragstart', function(event) {
            var item = event.target.closest('.camara-slider-item');
            if (!item) {
                return;
            }
            dragItem = item;
            event.dataTransfer.effectAllowed = 'move';
            item.classList.add('is-dragging');
        });

        list.addEventListener('dragend', function() {
            if (dragItem) {
                dragItem.classList.remove('is-dragging');
                dragItem = null;
                updateInput();
            }
        });

        list.addEventListener('dragover', function(event) {
            event.preventDefault();
            var targetItem = event.target.closest('.camara-slider-item');

            if (!dragItem) {
                return;
            }

            if (!targetItem) {
                list.appendChild(dragItem);
                return;
            }

            if (targetItem === dragItem) {
                return;
            }

            var rect = targetItem.getBoundingClientRect();
            var offset = event.clientY - rect.top;
            if (offset > rect.height / 2) {
                targetItem.after(dragItem);
            } else {
                targetItem.before(dragItem);
            }
        });

        toggleEmptyState();
    }

    function initImageField(field) {
        var selectButton = field.querySelector('[data-image-select]');
        var removeButton = field.querySelector('[data-image-remove]');
        var input = field.querySelector('[data-image-input]');
        var preview = field.querySelector('[data-image-preview]');
        var placeholder = preview ? preview.getAttribute('data-placeholder') || '' : '';
        var mediaTitle = field.getAttribute('data-media-title') || (selectButton ? selectButton.textContent : '');
        var mediaButton = field.getAttribute('data-media-button') || (selectButton ? selectButton.textContent : '');
        var mediaFrame = null;

        var renderPlaceholder = function() {
            if (!preview) {
                return;
            }
            if (placeholder) {
                preview.innerHTML = '<span>' + placeholder + '</span>';
            } else {
                preview.innerHTML = '';
            }
        };

        var renderImage = function(url) {
            if (!preview) {
                return;
            }
            if (url) {
                preview.innerHTML = '<img src="' + url + '" alt="">';
            } else {
                renderPlaceholder();
            }
        };

        var openMediaFrame = function() {
            if (!mediaFrame) {
                mediaFrame = window.wp.media({
                    title: mediaTitle,
                    button: { text: mediaButton },
                    multiple: false
                });

                mediaFrame.on('select', function() {
                    var attachment = mediaFrame.state().get('selection').first();
                    if (!attachment) {
                        return;
                    }
                    var data = attachment.toJSON();
                    var url = data.url;
                    if (data.sizes && data.sizes.large) {
                        url = data.sizes.large.url;
                    } else if (data.sizes && data.sizes.full) {
                        url = data.sizes.full.url;
                    }
                    input.value = data.id;
                    renderImage(url);
                    if (removeButton) {
                        removeButton.disabled = false;
                    }
                });
            }

            mediaFrame.open();
        };

        if (selectButton) {
            selectButton.addEventListener('click', function(event) {
                event.preventDefault();
                openMediaFrame();
            });
        }

        if (removeButton) {
            removeButton.addEventListener('click', function(event) {
                event.preventDefault();
                input.value = '';
                renderPlaceholder();
                removeButton.disabled = true;
            });
        }
    }
})();
