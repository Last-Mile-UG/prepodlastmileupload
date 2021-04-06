@extends('layouts.app', [
    'namePage' => 'Products Varients',
    'class' => 'sidebar-mini',
    'activePage' => 'Products Varients',
  ])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" style="float:left;">{{__('msg.productsvarients')}}</h4>
            <a href="{{route('product-variants.create')}}" class="btn btn-primary" style="float:right;">{{__('msg.addvarient')}}</a>
          </div>
          <div class="card-body">
              @include('alerts.success')
            <div class="table-responsive">
              <table class="table">
                <thead class="text-primary">
                    <th>{{__('msg.id')}}</th>
                    <th>{{__('msg.name')}}</th>
                    <th>{{__('msg.description')}}</th>
                    <th>{{__('msg.image')}}</th>
                    <th>{{__('msg.price')}}</th>
                    <th>{{__('msg.edit')}}</th>
                    <th>{{__('msg.delete')}}</th>
                </thead>
                <tbody>
                  <tr>
                    @foreach($records as $key=>$record)
                        <tr>
                            <td>{{$key +1}}</td>
                            <td>{{ $record->product ? $record->product->name : '--'}}</td>
                            <td>{{ $record->description }}</td>

                            @if(isset($record->image) && $record->image)
                                <td>
                                    <a target="blank" href="{{ $record->image }}">
                                    <img height="50px" width="100px" src="{{ $record->image }}" alt="--">
                                    </a>
                                </td>
                            @else
                                <td>--</td>
                            @endif
                            <td>{{ $record->price }}</td>
                            <td>
                                @include('components.edit', ['route' => 'product-variants.edit', 'entity' => 'product_variant','id' => $record->id])
                            </td>
                            <td>
                                @include('components.delete', ['route' => 'product-variants.destroy', 'entity' => 'product_variant', 'id' => $record->id])
                            </td>
                        </tr>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              @if(count($records) == 0)
                <p class="text-center"> No records found.</p>
              @endif
              {{$records->links()}}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
