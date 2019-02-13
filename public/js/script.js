function pageLoading(type){
    if(type == 'show'){
        $('.page_loading').show();
    }
    else{
        $('.page_loading').hide();
    }
}

function loadModal(route,data,size){
    pageLoading('show');
    size = size == undefined ? 'modal-lg' : size;
    $('.modal-dialog').addClass(size);
    $.get(route, data, function (response) {
        $('#myModal').html(response).modal('show');
        pageLoading('hide');
    });
}


//page
function loadPage(taget, route, data) {
    pageLoading('show');

    if (!data) data = {};
    data['_token'] = _token;

    $.get(route, data).done(function (response) {
        $(taget).html(response);
        pageLoading('hide');
    });
}

function orderTable(tableName){
    $(tableName+' tr').each(function (i) {
        $(this).find('td:eq(0)').text(i);
    });
}

//delete
$(document).on("click", ".deleteAction", function () {
    var elm = $(this);

    $.confirm({
        title: 'Təsdiq',
        content: 'Silmək istədiyinizə əminsiniz?',
        type: 'red',
        typeAnimated: true,
        buttons: {

            formSubmit: {
                text: 'Bəli',
                btnClass: 'btn-green',
                action: function () {
                    window.location.href = elm.attr("url");
                }
            },
            formCancel: {
                text: 'Xeyr',
                btnClass: 'btn-red',
                action: function () {

                }
            }
        }
    });

    return false;
});


//underscore custom template

function alphaTemplate(template_id,where,data,loop){
    let template = _.template(template_id.html());
    if (loop){
        _.each(data,function (d) {
            where.append(template(d));
        });
    }
    else{
        where.after(template(data));
    }
}

function alphaFormSubmit(url,method,data){
    data.append('_token',_token);
    $.ajax({
        url: url,
        type: method,
        data: data,
        async: false,
        success: function (response) {
            return response;
        },
        error : function(response){
            return response;
        },
        cache: false,
        contentType: false,
        processData: false
    });
}

