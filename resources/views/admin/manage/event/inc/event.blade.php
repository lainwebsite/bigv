<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{$event->id}}</td>
                        <td>
                            <a href="{{ route('admin.event.show', $event->id) }}"
                                class="a-normal d-flex align-items-center">
                                <img class="d-flex br-18 mr-3"
                                    src="{{ asset('uploads/' . $event->featured_image) }}" width="60"
                                    alt="Generic placeholder image">
                                <div class="d-flex align-items-start flex-column">
                                    <h5 class="m-0"><b>{{ $event->title }}</b></h5>
                                </div>
                            </a>
                        </td>
                        <td class="align-middle">
                            {{ $event->date }}
                        </td>
                        <td class="align-middle">
                            <div class="d-flex" style="gap: 10px;">
                                <a href="{{ route('admin.event.edit', $event->id) }}"
                                    class="a-normal text-info"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-edit feather-icon">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg></a>
                                <a onclick="deleteData({{ $event->id }}, '{{ $event->title }}');"
                                    class="a-normal text-danger"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-trash feather-icon">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                    </svg></a>
                            </div>
                        </td>
                    </tr>
                    <form action="{{ route('admin.event.destroy', $event->id) }}"
                        id="delete-event-form-{{ $event->id }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $events->links() }}
</div>
