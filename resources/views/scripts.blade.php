<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



{{-- CK EDITOR START --}}
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    // CKEDITOR START
    $('.description').each( function () {
      // var editor =  CKEDITOR.replace( this.id  )
      var editor = CKEDITOR.replace( this.id, {
          language: 'en',
          extraPlugins: 'notification',
          toolbarGroups: [
              { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
              { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
              { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
              { name: 'forms', groups: [ 'forms' ] },
              '/',
              { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
              { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
              { name: 'links', groups: [ 'links' ] },
              { name: 'insert', groups: [ 'insert' ] },
              '/',
              { name: 'styles', groups: [ 'styles' ] },
              { name: 'colors', groups: [ 'colors' ] },
              { name: 'tools', groups: [ 'tools' ] },
              { name: 'others', groups: [ 'others' ] },
          ]
      });

      editor.on( 'required', function( evt ) {
          editor.showNotification( 'This field is required.', 'warning' );
      evt.cancel();
      });
  });

</script>

{{-- CK EDITOR END --}}