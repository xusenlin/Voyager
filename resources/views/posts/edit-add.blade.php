@extends('voyager::master')

@if(isset($dataTypeContent->id))
    @section('page_title','编辑文章'.$dataType->display_name_singular)
@else
    @section('page_title','添加'.$dataType->display_name_singular)
@endif

@section('css')
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ '编辑' }}@else{{ '新' }}@endif{{ $dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.posts.update', $dataTypeContent->id) }}@else{{ route('voyager.posts.store') }}@endif" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="voyager-character"></i> 文章标题
                                <span class="panel-desc"> 你的文章标题</span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'title',
                                '_field_trans' => get_field_translations($dataTypeContent, 'title')
                            ])
                            <input type="text" class="form-control post-required" post_required="标题" id="title" name="title" placeholder="Title" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif">
                        </div>
                    </div>

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-book"></i> 文章内容</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                            </div>
                        </div>
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'body',
                            '_field_trans' => get_field_translations($dataTypeContent, 'body', 'rich_text_box', true)
                        ])
                        <textarea class="form-control richTextBox "  id="richtextbody" name="body" style="border:0px;">@if(isset($dataTypeContent->body)){{ $dataTypeContent->body }}@endif</textarea>
                    </div><!-- .panel -->

                    <!-- ### EXCERPT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">摘要 <small>一小段文字描述这个文章</small></h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'excerpt',
                                '_field_trans' => get_field_translations($dataTypeContent, 'excerpt')
                            ])
                            <textarea  class="form-control post-required" post_required="摘要" name="excerpt">@if (isset($dataTypeContent->excerpt)){{ $dataTypeContent->excerpt }}@endif</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- ### DETAILS ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> 文章详情</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">地址别名(URL slug)</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'slug',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'slug')
                                ])
                                <input type="text" class="form-control post-required" post_required="地址别名" id="slug" name="slug"
                                    placeholder="slug"
                                    {{!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}}
                                    value="@if(isset($dataTypeContent->slug)){{ $dataTypeContent->slug }}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">文章状态</label>
                                <select class="form-control" name="status">
                                    <option value="PUBLISHED" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PUBLISHED'){{ 'selected="selected"' }}@endif>公开</option>
                                    <option value="DRAFT" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'DRAFT'){{ 'selected="selected"' }}@endif>草稿</option>
                                    <option value="PENDING" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PENDING'){{ 'selected="selected"' }}@endif>待定</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">文章分类</label>
                                <select class="form-control" name="category_id">
                                    @foreach(TCG\Voyager\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">精品</label>
                                <input type="checkbox" name="featured" @if(isset($dataTypeContent->featured) && $dataTypeContent->featured){{ 'checked="checked"' }}@endif>
                            </div>
                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> 文章缩略图</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(isset($dataTypeContent->image))
                                <img src="{{ Voyager::image( $dataTypeContent->image ) }}" style="width:100%" />
                            @endif
                            <input type="file" name="image">
                        </div>
                    </div>

                    <!-- ### SEO CONTENT ### -->
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-search"></i> SEO 内容</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Meta 描述</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'meta_description',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'meta_description')
                                ])
                                <textarea class="form-control post-required" post_required="meta 描述" name="meta_description">@if(isset($dataTypeContent->meta_description)){{ $dataTypeContent->meta_description }}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Meta 关键字</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'meta_keywords',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'meta_keywords')
                                ])
                                <textarea class="form-control post-required" post_required="meta 关键字" name="meta_keywords">@if(isset($dataTypeContent->meta_keywords)){{ $dataTypeContent->meta_keywords }}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">SEO 标题</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'seo_title',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'seo_title')
                                ])
                                <input type="text" class="form-control" name="seo_title" placeholder="SEO 标题" value="@if(isset($dataTypeContent->seo_title)){{ $dataTypeContent->seo_title }}@endif">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary pull-right"  onclick="isSubmit()">
                @if(isset($dataTypeContent->id)){{ '更新文章' }}@else <i class="icon wb-plus-circle"></i> 创建新文章 @endif
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>

    <div class="modal modal-warning fade" tabindex="-1" id="tips_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        <i class="voyager-info-circled"></i> <span id="tips_info"></span>
                    </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('#slug').slugify();

        @if ($isModelTranslatable)
            $('.side-body').multilingual({"editing": true});
        @endif
        });

    </script>
    @if($isModelTranslatable)
        <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
    <script src="{{ voyager_asset('js/slugify.js') }}"></script>
    <script>
        function isSubmit() {
            var required = $('.post-required');
            for(var i = 0;i<required.length;i++){

                var valLength = (required.eq(i).val()).length;

                if (valLength <= 2 ){
                    var info = required.eq(i).attr('post_required') + '不能为空并且必须大于两个字符 !';
                    $('#tips_info').text(info);
                    $('#tips_modal').modal('show');
                    return ;
                }
            }

            var active = tinyMCE.activeEditor;
            var edit = active.getBody();
            active.selection.select(edit);
            var editText = active.selection.getContent({'format':'text'});

            if (editText <= 2 ){
                var info = '文章内容不能为空并且必须大于两个字符 !';
                $('#tips_info').text(info);
                $('#tips_modal').modal('show');
                return ;
            }

            $('.form-edit-add').submit();

        }
    </script>
@stop
