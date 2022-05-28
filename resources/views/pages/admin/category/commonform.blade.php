<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" value="{{ $category->title ?? '' }}" placeholder="Enter Title" autocomplete="off"
                class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Status</label>
            <select name="status" class="form-control" id="">
                <option value="">Choose One</option>
                <option @if (isset($category) && $category->status == 'active')
                    selected
                @endif value="active">Active</option>
                <option  @if (isset($category) && $category->status == 'inactive')
                    selected
                @endif value="inactive">InActive</option>
            </select>
        </div>
    </div>

    <div class="col-md-12 mb-2">
        <label for="">Logo</label>
        <input type="file" name="logo" class="form-control logo-change">

        <img class="mt-2 mb-2" src="{{ isset($category->logo) ? getImageUrl($category->logo) : "" }}" style="height: 100px; object-fit:cover;" alt="">
    </div>
    <div class="col-md-12">
        <label for="">Description</label>
        <textarea name="desc" class="summernote">{!!  $category->desc ?? '' !!}</textarea>
    </div>

</div>
