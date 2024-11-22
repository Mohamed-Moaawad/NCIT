<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="infoCrudModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="GForm" name="GForm" class="form-horizontal"
                  enctype="multipart/form-data"
                  method="post" >
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="info_id">
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-4 col-sm-12">       {{__('text.name')}}
                        </label>
                        <div class="col-lg-8 col-md-7 col-sm-12">

                            <textarea class="form-control m-input m-input--air m-input--pill note"
                                      rows="7"    required="" id='name'   name="name"  placeholder=" {{__('text.name')}}  "
                            ></textarea>
                        </div>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" id="btn-save" value="create">
                        {{__('text.save')}}
                    </button>
                    <div id="loading" style="display: none">
                        <p><img src="{{asset('img/ajax-loader.gif')}}"/></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
