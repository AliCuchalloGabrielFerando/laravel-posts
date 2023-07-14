@extends('admin.layout')
@section('header')
    <h1>
        Posts
        <small>Crear Publicacion</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i>Posts</a></li>
        <li class="active">Crear</li>
    </ol>
@endsection
@section('content')
    <div class="row">
        <form method="POST" action="{{ route('admin.posts.update', $post) }}">
            @csrf @method('PUT')
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label> Titulo de la publicacion</label>
                            <input name="title" class="form-control" value="{{ old('title', $post->title) }}"
                                placeholder="ingrese un titulo de la publicacion">
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}

                        </div>
                        <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                            <label> Extracto de la publicacion</label>
                            <textarea name="excerpt" class="form-control" placeholder="ingresa un extracto de la publicacion">{{ old('excerpt', $post->excerpt) }}</textarea>
                            {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <label> Contenido de la publicacion</label>
                            <textarea name="body" id="editor" rows="10" name="excerpt" class="form-control"
                                placeholder="ingresa el contenido de la publicacion">{{ old('body', $post->body) }}</textarea>
                            {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('iframe') ? 'has-error' : '' }}">
                            <label> Contenido embebido (iframe)</label>
                            <textarea rows="2" name="iframe" id="editor" rows="10" name="excerpt" class="form-control"
                                placeholder="ingresa el contenido embedido (video/audio)">{{ old('iframe', $post->iframe) }}</textarea>
                            {!! $errors->first('iframe', '<span class="help-block">:message</span>') !!}
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <!-- Date -->
                        <div class="form-group">
                            <label>Fecha de Publicacion</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="published_at" type="text" class="form-control pull-right" id="datepicker"
                                    value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/y') : '') }}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                            <label> Categorias</label>
                            <select name="category_id" class="form-control select2">
                                <option value="">Selecciona una categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                            <label>Etiquetas</label>
                            <select name="tags[]" class="form-control select2" multiple="multiple"
                                data-placeholder="Selecciona una o mas etiquetas" style="width: 100%;">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <div class="dropzone">

                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Guardar Publicacion</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if ($post->photos->count())
            
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box box-body">
                    <div class="row">
                        @foreach ($post->photos as $photo)
                        <form method="POST" action="{{route('admin.photos.destroy',$photo)}}">
                            @csrf @method('DELETE')
                        <div class="col-md-2">
                            <button class="btn btn-danger btn-xs" style="position: absolute"><i class="fa fa-remove"></i></button>
                            <img class="img-responsive" alt="" src="{{url($photo->url)}}">
                        </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/super-build/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script>
        //Initialize Select2 Elements
        $(".select2").select2({
            tags:true
        });

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });

        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                toolbar: {
                    items: [
                        'undo', 'redo','|', 'bold', 'italic', 'strikethrough', 'underline',  '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'specialCharacters', 'horizontalLine','link',  
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                placeholder: 'Escribe el contenido',
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                fontSize: {
                    options: [ 10, 12, 14, 16, 18, 20, 22 ],
                    supportAllValues: true
                },
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                htmlEmbed: {
                    showPreviews: true
                },
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                removePlugins: [
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType',
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents'
                ]
            });

        var myDropzone = new Dropzone('.dropzone', {
            url: '/admin/posts/{{ $post->url }}/photos',
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            maxFilesize: 2,
            maxFiles: 5,
            paramName: 'photo',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: "Arrastra las fotos para subirlas",
            dictRemoveFile: "Cancelar foto subida"
        });
        myDropzone.on('error', function(file, res) {
            var msg = res.message;
            //console.log(res.message);
            //console.log(file);
            $('.dz-error-message:last > span').text(msg);
        });
       
        Dropzone.autoDiscover = false;
    </script>
@endpush
