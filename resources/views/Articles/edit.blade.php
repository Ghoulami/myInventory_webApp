@extends("layout.layout")

@section("content")
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <h1>Modifier article</h1>
                <div class="float-sm-right text-zero">
                    <div class="btn-group">
                        <a href="{{ route('articles.create') }}" class="btn btn-primary btn-lg text-white">ADD NEW</a>
                    </div>
                </div>
            </div>

            <div class="separator mb-5"></div>

            @include('Articles._articleForm');
        </div>
    </div>
@endsection

@section("jsSection")
<script src="{{URL::asset('js/app.js')}}"></script>
@endsection
