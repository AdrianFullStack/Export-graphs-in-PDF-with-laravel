var tableOptions = {
    processing  : true,
    serverSide  : true,
    ajax        : {
        url     : null,
        type    : 'POST',
        beforeSend : function(xhr){
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        },
        error   : function(xhr, status, error){ console.log(error) },
    },
};