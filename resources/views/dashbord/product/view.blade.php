@extends("dashbord.layout.main")

@section('content')

<a href= "{{ route("product.create") }}" class="btn btn-success  mb-3">Add Product</a>

<div class="card">
    <div class="card-body">
      <h4 class="card-title">product table</h4>
      </p>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th> # </th>
            <th> Name </th>
            <th> Price </th>
            <th> Sale </th>
            <th> Count </th>
            <th> Category </th>
            <th>Images</th>
            <th>Edit/Delete</th>
          </tr>
        </thead>
        <tbody>
        @forelse ($Product as $key => $product)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->sale }}</td>
            <td>{{ $product->count }}</td>
            <td>
                @foreach ($Category as $category)
                @if ($category->id==$product->category_id)
                {{ $category->name }}

                @endif

                @endforeach

            </td>
            <td>
              @php
                  $images=explode('+',$product->img);
              @endphp
              @foreach ($images as $image)
         {{--  {{ $image->extension(); --}}


            <img src="{{ asset("storage/images/". $image) }}" alt="">




              @endforeach
            </td>
            <td class=" d-flex gap-2">
                <a href="{{ route("product.show",$product->id) }}" class="btn btn-info">Update</a>

                <form action="{{ route("product.destroy",$product->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <input type="submit" value="Delete" class="btn btn-danger">

                </form>
            </td>
        </tr>

        @empty

        @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
