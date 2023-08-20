<link rel="stylesheet" href="{{ asset('tokenfield-master/dist/tokenfield.css') }}" />
<script src="{{ asset('tokenfield-master/dist/tokenfield.web.js') }}"></script>

<script>

function createTag(){
    var tags = {!! $tags->toJson() !!}; // from controller
    new Tokenfield({
        el: document.querySelector('.tag-input'),
        form: true,
        items: tags,
        mode: 'tokenfield',
        newItems: true,
        inputType: 'text',
        placeholder: 'Input tag',
        itemValue: 'name',
        itemName: 'tags',
        newItemName: 'newly_tags',
        maxSuggestWindow: 10,
        setItems: [],
    });
}


function editTag(existing_tags){
    var tags = {!! $tags->toJson() !!}; // from controller
    new Tokenfield({
        el: document.querySelector('.tag-input'),
        form: true,
        items: tags,
        mode: 'tokenfield',
        newItems: true,
        inputType: 'text',
        placeholder: 'Input tag',
        itemValue: 'name',
        itemName: 'tags',
        newItemName: 'newly_tags',
        maxSuggestWindow: 10,
        setItems: existing_tags,
    });
}

</script>

{{-- https://www.cssscript.com/autocomplete-token-field/ --}}
