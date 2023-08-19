<script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    // CKEDITOR START
    $('.description').each( function () {
      // var editor =  CKEDITOR.replace( this.id  )
      var editor = CKEDITOR.replace( this.id, {
          language: 'en',
          extraPlugins: 'notification',
          toolbarGroups: [
              { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
              { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
              { name: 'links', groups: [ 'links' ] },
              { name: 'insert', groups: [ 'Image']}
          ]
      });

      editor.on( 'required', function( evt ) {
          editor.showNotification( 'This field is required.', 'warning' );
      evt.cancel();
      });
  });

</script>

