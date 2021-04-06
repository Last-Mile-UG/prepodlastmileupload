<form action="{{ route($route, [$entity => $id]) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit"
        class="btn btn-danger btn-icon btn-sm"
        data-original-title="" title="" style="{{isset($style) && $style ? $style : ''}}">
        <i class="fa fa-trash"></i>
    </button>
</form>
