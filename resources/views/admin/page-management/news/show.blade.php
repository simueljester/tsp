@extends('layouts.app-soft-ui')
@section('content')

    <div>
        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="mt-3"> <i class="fa-solid fa-earth-asia"></i> News </h4>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.pages.news.index')}}"> List</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><strong> {{$news->name}} </strong></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card mt-3 fadeIn">
            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                <a href="javascript:;" class="d-block mb-3">
                    <img id="outputImage" src="{{asset('images/icons').'/'.$news->thumbnail}}" class="border-custom" style="width: 180px;height:150px;object-fit:contain" />
                </a>
                <h2>
                    @if ($news->is_featured == 1)
                        <i class="fa-solid fa-star text-primary"></i>
                    @endif
                    {{$news->name}}
                </h2>
                <p class="card-description mb-4">
                    {{$news->headline}}
                </p>
                <div>
                    @if ($news->published_at)
                        <span class="badge badge-pill bg-gradient-success">Published</span>
                    @endif
                    @if ($news->is_featured == 1)
                        <span class="badge badge-pill bg-gradient-primary">Featured</span>
                    @endif
                    <strong> {{$news->created_at->format('M d, Y')}} </strong>
                </div>
            </div>
            <div class="card-body pt-2">
                {!! $news->description !!}
                <div class="mt-2">
                    {!! $news->youtube_embed !!}
                </div>
            </div>
            @if ($news->multimedia)
            <div>
                <strong>Gallery</strong>
                <div class="mt-2">
                    <div class="multiple-slider">
                        @foreach (json_decode($news->multimedia,true) as $media)
                        <div class="card-hover-scale" style="cursor: pointer;" onclick="viewGallery({{json_encode($media)}})">
                            <img class="card-img-top border-custom" src="{{asset('/images/dropzone').'/'.$media}}" style="height:200px;width:250px;object-fit: cover;">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
            <div class="card-footer bg-light">
                <a href="{{route('admin.pages.news.edit',$news)}}" class="btn btn-info btn-sm"> Edit </a>
                <a href="{{route('admin.pages.news.index')}}" class="btn btn-outline-secondary btn-sm"> Back to list </a>
            </div>
        </div>
    </div>

    {{-- Modal view image --}}
    <div class="modal fade" id="viewGalleryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <img src="" id="image" style="width: 100%;max-height: 650px;object-fit: contain;" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
@include('scripts-slick')
<script>
 function viewGallery(media){
        $('#viewGalleryModal').modal('show')
        let imgSrc = '/images/dropzone/' +media;
        $('#image').attr('src', imgSrc);
    }
</script>

@endsection

