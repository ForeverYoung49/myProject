    @if($paginator->hasPages())
		<ul class="pagination d-flex justify-content-center">
			@if($paginator->onFirstPage())
            <li class=" page-item" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="btn btn-outline-dark disabled"><i class="fas fa-arrow-left"></i></span>
            </li>
            @else
            <li class=" page-item">
                <a href="#" class="btn btn-outline-dark" wire:click="setPage('{{ $paginator->previousPageUrl() }}')" rel="prev" aria-label="@lang('pagination.previous')">
                	<i class="fas fa-arrow-left"></i>
                </a>
            </li>
            @endif
            @foreach($elements as $e)
            	@if(is_string($e))
                <li class="page-item disabled" aria-disabled="true">
                    <span class="btn btn-outline-dark">{{ $e }}</span>
                </li>
                @endif
            	@if(is_array($e))
            		@foreach($e as $page => $url)
            			@if($page == $paginator->currentPage())
			                <li class="page-item" aria-current="page">
			                    <span class="btn btn-outline-dark active">{{ $page }}</span>
			                </li>
			            @else
			            	<li class="page-item">
			                    <a href="#" wire:click="setPage('{{ $url }}')" class="btn btn-outline-dark">{{ $url }}</a>
			                </li>
			            @endif
                        {{ var_dump($url) }}
			        @endforeach
                @endif
            @endforeach 
            @if($paginator->hasMorePages())   
            <li class="page-item">
                <a href="#" rel="next" wire:click="setPage('{{$paginator->nextPageUrl()}}')" aria-label="@lang('pagination.next')" class="btn btn-outline-dark">
                	<i class="fas fa-arrow-right"></i>
                </a>
            </li>
            @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true" class="btn btn-outline-dark">
                	<i class="fas fa-arrow-right"></i>
                </span>
            </li>
            @endif
        </ul>
    @endif
