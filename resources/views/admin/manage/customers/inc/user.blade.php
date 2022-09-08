<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Order Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('admin.user.show', $user->id) }}"
                                class="a-normal d-flex align-items-center">
                                <div class="d-flex align-items-start flex-column">
                                    <h5 class="m-0"><b>{{ $user->name }}</b></h5>
                                    <small
                                        class="badge bg-orange font-weight-medium badge-pill text-white m-0">{{ $user->tier->name }}</small>
                                </div>
                            </a>
                        </td>
                        <td class="align-middle"><a href="mailto:{{ $user->email }}"
                                target="_blank">{{ $user->email }}</a><br><a
                                href="tel:{{ $user->phone }}">{{ $user->phone }}</a></td>
                        <td class="align-middle">
                            {{ $user->transactions->count() }} Orders
                            ({{ $user->reviews->count() }} Reviews)
                        </td>
                        <td class="align-middle">
                            <div class="d-flex" style="gap: 10px;">
                                <a href="{{ route('admin.user.edit', $user->id) }}" class="a-normal text-info">@include('admin.icons.edit')</a>
                                <a onclick="event.preventDefault(); document.getElementById('delete-user-form-{{ $user->id }}').submit();"
                                    class="a-normal text-danger">@include('admin.icons.delete')</a>
                            </div>
                        </td>
                    </tr>
                    <form action="{{ route('admin.user.destroy', $user->id) }}"
                        id="delete-user-form-{{ $user->id }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
</div>
