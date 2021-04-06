@extends('admin.layouts.app', [
    'namePage' => 'Product Var Reviews',
    'class' => 'sidebar-mini',
    'activePage' => 'Product Var Reviews',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="row justify-content-between">
          </div>
          <div class="card-header">
            <h4 class="card-title">Product Variant Reviews</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>ID</th>
                    <th>Product</th>
                    <th>Text</th>
                    <th>Rating</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $record->productVarient ? $record->productVarient->product->name : '' }}</td>
                            <td>{{ $record->text }}</td>
                            <td>{{ $record->rating }}</td>
                            <td>
                                @include('components.delete', ['route' => 'product-var-reviews.destroy',
                                    'entity' => 'product_var_review',
                                    'id' => $record->id,
                                    'style' => 'margin-top:15px'
                                ])
                            </td>
                        </tr>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              @if($records->count() < 1)
                <p class="text-center"> No records found.</p>
              @endif
              {{ $records->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
