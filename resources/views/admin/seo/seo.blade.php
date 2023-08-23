@extends('admin.admin_layouts')

@section('admin_content')


<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Seo Setting </h6>

            <form action="{{ route('update.seo') }}" method="POST">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <input type="hidden" name="id" value="{{ $seo->id }}">

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Meta Title:</label>
                                <input class="form-control" type="text" name="meta_title" value="{{ $seo->meta_title }}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Meta Aurthor:</label>
                                <input class="form-control" type="text" name="meta_aurthor" value="{{ $seo->meta_aurthor }}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Meta Tag:</label>
                                <input class="form-control" type="text" name="meta_tag" value="{{ $seo->meta_tag }}">
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Meta Description: </label>
                                <textarea class="form-control summernote" id="summernote" name="meta_description">
                                    {{ $seo->meta_description }}
                                </textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Google Analytics	:</label>
                                <textarea class="form-control summernote2" id="summernote2" name="google_analytics">
                                    {{ $seo->google_analytics }}
                                </textarea>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Bing Analytics	:</label>
                                <textarea class="form-control summernote3" id="summernote3" name="bing_analytics">
                                    {{ $seo->bing_analytics }}
                                </textarea>
                            </div>
                        </div><!-- col-4 -->


                    </div><!-- row -->
                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5">Submit</button>
                    </div>
                </div>
            </form>
        </div><!-- sl-mainpanel -->
    </div>
</div>

<script type="text/javascript">
    function readURL(input){
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#one')
              .attr('src', e.target.result)
              .width(80) ;
            };
            reader.readAsDataURL(input.files[0]);
          }
        }
</script>


@endsection
