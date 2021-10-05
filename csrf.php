on view:-
<meta name="csrf-token1" content="{{ csrf_token() }}" />
in form:-
{{ csrf_field() }}


$.ajax({
    url : "/arogi-form-one",
    type: 'POST',
     // headers: {
    //   'X-CSRF-TOKEN': $('meta[name="csrf-token1"]').attr('content')
    // },
     // data: $("#personal_media").serialize(),
     data : new FormData(this),
     contentType: false,
     cache : false,
     processData:false,
    success:function(data)
    {
        console.log(data);
    }
});
