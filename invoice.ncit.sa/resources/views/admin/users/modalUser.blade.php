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
                <div class="modal-body">
                    <input type="hidden" name="id" id="info_id">
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-4 col-sm-12">{{__('text.fname')}}
                        </label>
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <input type="text" class="form-control m-input m-input--air m-input--pill"
                                   name="fname" placeholder="{{__('text.fname')}} "
                                   required="" id='fname'>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-4 col-sm-12">{{__('text.lname')}}
                        </label>
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <input type="text" class="form-control m-input m-input--air m-input--pill"
                                   name="lname" placeholder="{{__('text.lname')}} "
                                   required="" id='lname'>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-4 col-sm-12">{{__('text.email')}}

                        </label>
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <input type="email" class="form-control m-input m-input--air m-input--pill"
                                   name="email" placeholder=" {{__('text.email')}}"
                                   required="" id="email">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-4 col-sm-12">{{__('text.password')}}

                        </label>
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <input type="password" class="form-control m-input m-input--air m-input--pill"
                                   name="password" id="password" placeholder="{{__('text.password')}}  "
                                   required="" id="password">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-4 col-sm-12">{{__('text.password_confirm')}}

                        </label>
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <input type="password" class="form-control m-input m-input--air m-input--pill"
                                   name="password_confirm" placeholder="{{__('text.password_confirm')}}"
                                   required="" id="password_confirm">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-4 col-sm-12">{{__('text.status')}}

                        </label>
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <select name="status" id="status"
                                    class="form-control m-input m-input--air m-input--pill" style="
    height: 45px;
">
                                <option value="-1">{{__('text.select')}}</option>
                                <option value="1">نشط</option>
                                <option value="0">غير نشط</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-4 col-sm-12">{{__('text.type')}}

                        </label>
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <select name="type" id="type"
                                    class="form-control m-input m-input--air m-input--pill" style="
    height: 45px;
">
                                <option value="-1">{{__('text.select')}}</option>
                                <option value="1">أدمن</option>
                                <option value="2">مستخدم </option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-4 col-sm-12">     {{__('text.img')}}
                        </label>
                        <div class="col-lg-8 col-md-7 col-sm-12">
                            <input type="file" class="form-control m-input m-input--air m-input--pill"
                                   name="img" id="img" placeholder=" {{__('text.img')}}  "
                                   onchange="loadFile(event)">
                            <img id="output" src="" style="
                                 width: 20%;
                                 "/>
                        </div>
                    </div>

                    @csrf

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
