<style>
    button, input, select, textarea {
        font-family: 'Ubuntu', Arial, Helvetica, sans-serif;
    }

    .form-item .label {
        color: #333;
        vertical-align: top;
        font-weight: 600;
        padding: 15px 21px 9px 0px;
        margin-right: 5px;
        white-space: normal;
    }

    .form-item {
        margin-bottom: 23px;
        position: relative;
    }

    input,
    textarea {
        border: 0;
        overflow: auto;
        background: white no-repeat;
        background-image: linear-gradient(to bottom, #1abc9c, #1abc9c), linear-gradient(to bottom, silver, silver);
        background-size: 0 2px, 100% 1px;
        background-position: 50% 100%, 50% 100%;
        transition: background-size 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
    }

    textarea {
        width: 60%;
        padding: 10px 5px;
    }

    input:focus,
    textarea:focus {
        background-size: 100% 2px, 100% 1px;
        outline: none;
    }

    .form-item.required > .label:after {
        content: "*";
        color: #1abc9c;
        display: inline-block;
        width: 8px;
        font-size: 14px;
        font-weight: 400;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        margin-right: -8px;
    }

    input {
        width: 300px;
    }

    .text
    {
        margin-left: 11px;
    }

</style>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel17">Documentation {{ @$docs->id > 0 ? 'Edit' : 'Save' }} Api</h4>
        </div>
        <div class="modal-body">
            <div class="modal-body">
                <div class="row" id="errors">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="height: auto;">
                            <div class="card-body collapse in">
                                <div class="card-block temp">
                                    <div id="errors">
                                    </div>
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-item required text">
                                                <label class="label" for="title">Başlıq</label>
                                                <input type="text" class="ad-change-observe" name="title" value="{{ @$docs->title }}">
                                            </div>

                                            <div class="form-item required text">
                                                <label class="label" for="description">Təsvir</label>
                                                <textarea id="description" class="ad-change-observe description"
                                                          name="description" maxlength="10000">{{ @$docs->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 m-t-10 sm-m-t-10">
                        <button type="button" class="btn grey btn-outline-secondary closed" data-dismiss="modal">Close
                        </button>
                        <button type="submit"
                                class="btn btn-success addEditBtn"> {{ @$docs->id > 0 ? 'Edit' : 'Save' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $('.addEditBtn').on('click', function () {
        var title         = $('[name=title]').val(),
            description   = $('#description').val(),
            formData      = new FormData();

        formData.append('_token', _token);
        formData.append('title', title);
        formData.append('description', description);

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.doc.add_edit', ['id' => $id]) }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response.status == 'error')
                {
                    $("#errors").html(response['errors']);
                }

                if(response.status == 'ok')
                {
                    location.reload();
                }
            },
            error: function (response) {

            }
        });

    });

</script>