<div class="col-9">
    <div class="p-3 profile-content">
        <div>
            <div class="m-2 border-bottom border-primary">
                <h1>Projects</h1>
            </div>
            @if(Auth::user()->projects()->exists())
                @foreach($projects = Auth::user()->projects()->get() as $project)
                    <div class="ms-4 p-2 border-0 border-bottom border-info">
                        <h4>{{$project->title}}</h4>
                        {{$project->description}}
                    </div>
                @endforeach
            @else
                <div>
                    <h3>
                        You don't have any projeccts
                    </h3>
                </div>
            @endif
            <div class="m-4 d-flex justify-content-center">
                @can('create',\App\Models\Project::class)
                    <a href="/create">
                        <button>Add project +</button>
                    </a>
                @endcan
            </div>
        </div>
    </div>
</div>
