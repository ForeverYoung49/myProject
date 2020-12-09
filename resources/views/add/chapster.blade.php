@extends('layouts.layout_reader')

@section('title',$page->name)

@section('content')
<script type="text/javascript">
    $(document).ready(function(){
     $('body,html').animate({scrollTop: 70}, 0); 
});
</script>
    <nav class="navbar navbar-dark navbar-expand-md bg-dark" style="margin-bottom: 20px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/" style="padding: 0;margin: 0;">
                <i class="fas fa-book-open" style="font-size: 26px;"> LibraryManga</i>
            </a>
            <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <a href="/catalog/{{$manga->id}}" class="btn btn-dark active manga-name-reader">
                        <span class="text-white">{{ $manga->name }}</span>
                    </a>
                    
                    <div class="dropdown">

                        <button class="btn btn-dark active dropdown-toggle nav-link" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="min-width: 100%;">
                            <span >Том {{ $page->tome }} Глава {{ $page->number }} {{ $page->name }}</span>
                        </button>

                        <div class="dropdown-menu chapsters" aria-labelledby="dropdownMenuButton">
                           @foreach($all_chapster as $ch)
                               <div class="chapster d-flex justify-content-center">
                                   <a href="/catalog/{{$manga->id}}/{{$ch->id}}" class="text-white">Том {{ $ch->tome }} Глава {{ $ch->number }} {{ $ch->name }}</a>
                               </div>
                            @endforeach
                        </div>
                    </div>
                        
                    
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid" style="margin: 0;">
        
        <div class="row" style="margin-bottom: 50px;">
            <div class="col-12 d-flex justify-content-center">
                @foreach($pages as $p)
                @if($pages->currentPage() == $pages->lastPage() && $next_chapster==null)
                <a href="/catalog/{{$manga->id}}">
                    <img src="/assets/chapster/{{$manga->name}}/{{$page->tome}}_tome_{{$page->number}}_chapster_{{$page->name}}/{{$p->page}}" class="chapter">
                </a>
                @else 
                <a @if($pages->currentPage() == $pages->lastPage() && $next_chapster<>null) href="/catalog/{{$manga->id}}/{{$next_chapster->id}}" @else href="{{ $pages->url($pages->currentPage()+1) }}" @endif>
                    <img src="/assets/chapster/{{$manga->name}}/{{$page->tome}}_tome_{{$page->number}}_chapster_{{$page->name}}/{{$p->page}}" class="chapter">
                </a>
                @endif
                @endforeach
            </div>
        </div>
    </div>
@if ($pages->lastPage() > 1)
    <div class="fixed-bottom row">
        <div class="dropdown d-flex justify-content-start col-6 paginate">

            <button class="btn btn-dark dropdown-toggle" style="width: 200px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span>Страница {{ $pages->currentPage() }}/{{ $pages->lastPage() }}</span>
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="max-height: 400px; overflow: auto; width: 220px;">
                @if ($pages->lastPage() > 1)
                    
                    @for ($i = 1; $i <= $pages->lastPage(); $i++)
                        <div class="paginate_pages" >
                            <a class="btn btn-dark text-white" style="width: 200px;" href="{{ $pages->url($i) }}">Страница {{ $i }}/{{ $pages->lastPage() }}</a>
                        </div>
                    @endfor
                    
                @endif
            </div>
        </div>

        <div class="dropdown d-flex justify-content-end col-6 paginate">
            <div class="pagination">
                <a @if($pages->currentPage() == 1 && $previous_chapster<>null) href="/catalog/{{$manga->id}}/{{$previous_chapster}}" @else href="{{ $pages->url($pages->currentPage()-1) }}" @endif >
                    <button class="btn btn-dark" {{ ($pages->currentPage() == 1 && $previous_chapster==null ) ? ' disabled' : '' }}>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </a>
                <a @if($pages->currentPage() == $pages->lastPage() && $next_chapster<>null) href="/catalog/{{$manga->id}}/{{$next_chapster->id}}" @else href="{{ $pages->url($pages->currentPage()+1) }}" @endif>
                    <button class="btn btn-dark" {{ ($pages->currentPage() == $pages->lastPage() && $next_chapster==null) ? ' disabled' : '' }}>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
@endif
@endsection