@extends('common')
@section('pagetitle')
Product Page
@endsection

@section('pagename')
Laravel Project
@endsection

@section('css')
{!! Html::style('/css/parsley.css') !!}
@endsection
<!-- resources/views/products/index.blade.php -->
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <h3>Categories</h3>
        <ul class="list-group">
          @foreach ($categories->take(7) as $category)
            <li class="list-group-item"><a href="{{ route('categories.index', ['category' => $category->name]) }}">{{ $category->name }}</a></li>
          @endforeach
        </ul>
      </div>
      <div class="col-md-9">
        <h1>View Products</h1>
        <hr>
        <table class="table">
          <thead>
            <tr>
              <th>Thumbnail</th>
              <th>Title</th>
              <th>Price</th>
              <th>Purchase?</th>
            </tr>
          </thead>
          <tbody>
            
            @foreach ($items as $item)
              <tr>
                <td><a href="{{ route('products.details', [$item->id, $item->category->id]) }}"><img src="{{ Storage::url('images/items/'.$item->picture) }}" style='width:80px; height:80px;'></a></td>

                <td>{{ $item->title}}</td>
                <td>{{ $item->price }}</td>
                <td><a href="" class="btn btn-primary">Buy Me</a></td>
                
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

