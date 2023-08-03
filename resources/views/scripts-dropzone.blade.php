<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    var filenames = []
    Dropzone.options.dropzone =
     {
        maxFilesize: 256,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
           return time+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 5000,
        success: function(file, response){
            console.log(file);
            filenames.push(response.success)
            // console.log(filenames);
            $('#multimedia').val(filenames)

        },
        error: function(file, response){
           return false;
        },
        removedfile: function(file) {
            var index = filenames.indexOf(file.name);
            if (index !== -1) {
                filenames.splice(index, 1);
            }
            file.previewElement.remove();
            $('#multimedia').val(filenames)
        }
    };

});
</script>
