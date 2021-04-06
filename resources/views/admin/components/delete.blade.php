<form action="{{ route($route, [$entity => $id]) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" 
        class="btn btn-danger btn-icon btn-sm" 
        data-original-title="" title="">
        <i class="fa fa-trash"></i>
    </button>
</form>