"use strict";
// Class definition

var KTDropzoneDemo = function () {
    // Private functions
    var demo1 = function () {
        // single file upload
        // $('#kt_dropzone_1').dropzone({
        //     url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
        //     paramName: "file", // The name that will be used to transfer the file
        //     maxFiles: 1,
        //     maxFilesize: 5, // MB
        //     addRemoveLinks: true,
        //     accept: function(file, done) {
        //         if (file.name == "justinbieber.jpg") {
        //             done("Naha, you don't.");
        //         } else {
        //             done();
        //         }
        //     }
        // });

        // multiple file upload
        $('#kt_dropzone_2').dropzone({
            url: _basrUrl+"/admin/upload-gallery", // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            },
            init: function() {
                this.on("sending", function(file, xhr, formData){
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("title", $('#judul-gallery').val());
                    formData.append("id", $('#id-gallery').val());
                });
            }
        });

        // Load Images
        var myDropzone = new Dropzone(("#album-edit"), {
            url: _basrUrl+"/admin/upload-gallery",
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 1, // MB
            init: function() {
                this.on("sending", function(file, xhr, formData){
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("title", $('#judul-gallery').val());
                    formData.append("id", $('#id-gallery').val());
                });
            },
            addRemoveLinks: true,
            removedfile: function(file) {
                var name = file.name; 
                var id = $('#album-edit').attr('data-id');
                $.ajax({
                    type: "post",
                    url:  _basrUrl+"/admin/delete-gallery",
                    data: {imageName: name, albumId: id, _token: $('meta[name="csrf-token"]').attr('content')}
                });
                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
            }
        });
        galleryDetail.forEach(function(i){
            // console.log(i.file_name);
            var mockFile={name:i.file_name, size:100};
            myDropzone.emit("addedfile", mockFile);   
            myDropzone.emit("thumbnail", mockFile, _basrUrl+"/assets/backend/media/article/"+i.file_name); 
        })

        // file type validation
        // $('#kt_dropzone_3').dropzone({
        //     url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
        //     paramName: "file", // The name that will be used to transfer the file
        //     maxFiles: 10,
        //     maxFilesize: 10, // MB
        //     addRemoveLinks: true,
        //     acceptedFiles: "image/*,application/pdf,.psd",
        //     accept: function(file, done) {
        //         if (file.name == "justinbieber.jpg") {
        //             done("Naha, you don't.");
        //         } else {
        //             done();
        //         }
        //     }
        // });
    }

    return {
        // public functions
        init: function() {
            demo1();
        }
    };
}();

KTUtil.ready(function() {
    KTDropzoneDemo.init();
});
