<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>Vendor</th>
                    <th>Contact</th>
                    <th>Number of Products</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendors as $vendor)
                    <tr>
                        <td>
                            <a href="{{ route('admin.vendor.show', $vendor->id) }}"
                                class="a-normal d-flex align-items-center">
                                <img class="d-flex br-18 mr-3" src="{{ asset('uploads/' . $vendor->photo) }}"
                                    width="60" alt="Generic placeholder image">
                                <div class="d-flex align-items-start flex-column">
                                    <h5 class="m-0"><b>{{ $vendor->name }}</b></h5>
                                    <small class="m-0">{{ $vendor->location->name }}</small>
                                </div>
                            </a>
                        </td>
                        <td class="align-middle"><a href="mailto:{{ $vendor->email }}"
                                target="_blank">{{ $vendor->email }}</a><br><a
                                href="tel:{{ $vendor->phone }}">{{ $vendor->phone }}</a></td>
                        <td class="align-middle">{{ $vendor->products->count() }}</td>
                        <td class="align-middle">
                            <div class="d-flex" style="gap: 10px;">
                                <a href="{{ route('admin.vendor.edit', $vendor->id) }}" class="a-normal text-info">@include('admin.icons.edit')</a>
                                <a onclick="event.preventDefault(); document.getElementById('delete-vendor-form-{{ $vendor->id }}').submit();"
                                    class="a-normal text-danger">@include('admin.icons.delete')</a>
                            </div>
                        </td>
                    </tr>
                    <form action="{{ route('admin.vendor.destroy', $vendor->id) }}"
                        id="delete-vendor-form-{{ $vendor->id }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $vendors->links() }}
</div>
