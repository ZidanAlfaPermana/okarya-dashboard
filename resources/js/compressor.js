document.addEventListener('alpine:init', () => {
    Alpine.data('imageCompressor', () => ({
        isUploading: false,
        uploadProgress: 0,

        handleFiles(event) {
            const files = Array.from(event.target.files);
            if (files.length === 0) return;

            this.isUploading = true;
            this.uploadProgress = 0;

            let processedFiles = [];
            let processedCount = 0;

            const checkComplete = () => {
                processedCount++;

                if (processedCount === files.length) {
                    if (processedFiles.length > 0) {
                        this.$wire.uploadMultiple(
                            'gambarUploads',
                            processedFiles,
                            (uploadedFilename) => {
                                this.isUploading = false;
                                this.uploadProgress = 0;
                                event.target.value = '';
                            },
                            (error) => {
                                this.isUploading = false;
                                this.uploadProgress = 0;
                                event.target.value = '';
                            },
                            (progressEvent) => {
                                this.uploadProgress = progressEvent.detail.progress;
                            }
                        );
                    } else {
                        this.isUploading = false;
                        event.target.value = '';
                    }
                }
            };

            files.forEach(file => {
                if (!file.type.startsWith('image/')) {
                    alert('Hanya file gambar yang diperbolehkan!');
                    checkComplete();
                    return;
                }

                // Kompres jika ukuran lebih dari 1MB (1048576 bytes)
                if (file.size > 1048576) {
                    new window.Compressor(file, {
                        quality: 0.7,
                        maxWidth: 1920,
                        maxHeight: 1920,
                        mimeType: 'image/jpeg',
                        convertSize: 1000000,

                        success: (result) => {
                            // Ganti ekstensi file menjadi .jpg jika awalnya .png agar sesuai dengan tipe baru
                            const newFileName = file.name.replace(/\.[^/.]+$/, "") + ".jpg";

                            const compressedFile = new File([result], newFileName, {
                                type: result.type,
                                lastModified: Date.now(),
                            });
                            processedFiles.push(compressedFile);
                            checkComplete();
                        },
                        error: (err) => {
                            processedFiles.push(file);
                            checkComplete();
                        },
                    });
                } else {
                    processedFiles.push(file);
                    checkComplete();
                }
            });
        }
    }));
});
