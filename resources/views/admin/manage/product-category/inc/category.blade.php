<div class="card-body">
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Number of Products</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            <a href="{{route('admin.product-category.show', $category->id)}}" class="a-normal">
                                <div class="d-flex align-items-start flex-column">
                                    <h5 class="m-0"><b>{{ $category->name }}</b></h5>
                                </div>
                            </a>
                        </td>
                        <td class="align-middle">{{ $category->description }}</td>
                        <td class="align-middle">{{ $category->products->count() }}</td>
                        <td class="align-middle">
                            <div class="d-flex" style="gap: 10px;">
                                <a href="{{ route('admin.product-category.edit', $category->id) }}"
                                    class="a-normal text-info"><i data-feather="edit" class="feather-icon"></i></a>
                                <a onclick="event.preventDefault();
                                                        document.getElementById('delete-category-form-{{ $category->id }}').submit();"
                                    class="a-normal text-danger">@include('admin.icons.delete')</a>
                            </div>
                        </td>
                    </tr>
                    <form action="{{ route('admin.product-category.destroy', $category->id) }}"
                        id="delete-category-form-{{ $category->id }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $categories->links() }}
</div>
