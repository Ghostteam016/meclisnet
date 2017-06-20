<script src="../js/jQuery-2.1.4.min.js"></script>
<input id="file" type="file" name="file"/>
<div id="response"></div>
<script>
jQuery('document').ready(function(){
    var input = document.getElementById("file");
    var formdata = false;
    if (window.FormData) {
        formdata = new FormData();
    }
    input.addEventListener("change", function (evt) {
        var i = 0, len = this.files.length, img, reader, file;

        for ( ; i < len; i++ ) {
            file = this.files[i];

            if (!!file.type.match(/image.*/)) {
                if ( window.FileReader ) {
                    reader = new FileReader();
                    reader.onloadend = function (e) {
                        //showUploadedItem(e.target.result, file.fileName);
                    };
                    reader.readAsDataURL(file);
                }

                if (formdata) {
                    formdata.append("image", file);
                    formdata.append("extra",'extra-data');
                }

                if (formdata) {
                    jQuery('div#response').html('<br /><img src="ajax-loader.gif"/>');

                    jQuery.ajax({
                        url: "upload.php",
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                         jQuery('div#response').html("Successfully uploaded");
                        }
                    });
                }
            }
            else
            {
                alert('Not a vaild image!');
            }
        }

    }, false);
});
</script>