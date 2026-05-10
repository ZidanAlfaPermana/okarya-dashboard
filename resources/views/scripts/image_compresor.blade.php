<script>
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
                                    console.log('Upload berhasil!');
                                    this.isUploading = false;
                                    this.uploadProgress = 0;
                                    event.target.value = '';
                                },
                                (error) => {
                                    console.error('Upload gagal:', error);
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

                    if (file.size > 1048576) {
                        new window.Compressor(file, {
                            quality: 0.6,
                            success: (result) => {
                                const compressedFile = new File([result], file.name, {
                                    type: result.type,
                                    lastModified: Date.now(),
                                });
                                processedFiles.push(compressedFile);
                                checkComplete();
                            },
                            error: (err) => {
                                console.error('Gagal mengompres:', err.message);
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
</script>
